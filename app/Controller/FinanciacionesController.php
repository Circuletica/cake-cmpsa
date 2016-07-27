<?php
class FinanciacionesController extends AppController {
	public $paginate = array(
		'order' => array('Operacion.referencia' => 'asc')
	);

	public function index() {
		$this->paginate['contain'] = array(
			'Banco',
			'Operacion'
		);
		$this->set('financiaciones', $this->paginate());
	}

	public function view($id = null) {
		//el id y la clase de la financiación de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Financiación/view');
			$this->redirect(array('action'=>'index'));
		}
		$financiacion = $this->Financiacion->find(
			'first',
			array(
				'contain' => array(
					'Banco',
					'Operacion' => array(
						'Contrato' => array(
							'Calidad',
							'Incoterm',
							'Proveedor'
						),
						'AsociadoOperacion' => array(
							'Asociado'
						)
					),
					'ValorIvaFinanciacion',
					'ValorIvaComision',
				),
				'conditions' => array('Financiacion.id' => $id),
				'recursive' => 4
			)
		);
		$this->set(compact('financiacion'));

		//calculamos el total de cada línea de reparto como campo virtual del modelo
		//Si metemos el campo nuevo directamente en el 'contain' del find, sale
		//un element [0] en el resultado
		$this->Financiacion->RepartoOperacionAsociado->virtualFields = array(
			'total' => 'precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0)',
			'saldo_anticipo' => 'precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0)-ifnull(total_anticipo,0)'
		);
		$distribuciones = $this->Financiacion->RepartoOperacionAsociado->find(
			'all',
			array(
				'conditions'=>array(
					'RepartoOperacionAsociado.id' => $id
				),
				'contains' => array(
					'Asociado' => array(
						'fields' => array('nombre_corto')
					)
				),
				'order' => array('Asociado.codigo_contable' => 'ASC')
			)
		);
		$this->set(compact('distribuciones'));

		$this->Financiacion->RepartoOperacionAsociado->virtualFields = array(
			'total' => 'precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0)',
			'total_porcentaje_embalaje' => 'sum(porcentaje_embalaje_asociado)',
			'total_peso' => 'sum(peso_asociado)',
			'total_precio' => 'sum(precio_asociado)',
			'total_iva' => 'sum(iva)',
			'total_comision' => 'sum(comision)',
			'total_iva_comision' => 'sum(iva_comision)',
			'total_general' => 'sum(precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0))',
		);
		$totales = $this->Financiacion->RepartoOperacionAsociado->find(
			'first',
			array(
				'conditions' => array('RepartoOperacionAsociado.id' => $id),
				'fields' => array(
					'total',
					'total_porcentaje_embalaje',
					'total_peso',
					'total_precio',
					'total_iva',
					'total_comision',
					'total_iva_comision',
					'total_general',
				)
			)
		);
		$this->set('totales',$totales['RepartoOperacionAsociado']);

		$anticipos = $this->Financiacion->Operacion->AsociadoOperacion->Anticipo->find(
			'all',
			array(
				'recursive' => 3,
				'contain' => array(
					'Banco' => array(
						'fields' => array('nombre_corto')
					),
					'AsociadoOperacion' => array(
						'fields' => array('asociado_id','operacion_id'),
						'Asociado' => array(
							'fields' => array(
								'id',
								'nombre'
							),
						)
					)
				),
				'conditions' => array(
					'AsociadoOperacion.operacion_id' => $id
				)
			)
		);
		$this->set(compact('anticipos'));

		$this->set('financiacion_id', $financiacion['Financiacion']['id']);
		$this->set('referencia', $financiacion['Operacion']['referencia']);
		$this->set('proveedor', $financiacion['Operacion']['Contrato']['Proveedor']['nombre_corto']);
		$this->set('proveedor_id', $financiacion['Operacion']['Contrato']['Proveedor']['id']);
		$this->set('calidad', $financiacion['Operacion']['Contrato']['Calidad']['nombre']);
		$this->set('condicion', $financiacion['Operacion']['Contrato']['condicion']);
		$this->set('fecha_vencimiento',$financiacion['Financiacion']['fecha_vencimiento']);
		$cuenta = $financiacion['Banco']['nombre_corto'].' '.$this->iban('ES',$financiacion['Banco']['cuenta_bancaria']);
		$this->set(compact('cuenta'));
		$this->set('precio_euro_kilo', $financiacion['Financiacion']['precio_euro_kilo']);
		$this->set('iva',$financiacion['ValorIvaFinanciacion']['valor']);
		$this->set('iva_comision',$financiacion['ValorIvaComision']['valor']);

		//Se declara para acceder al PDF
		$this->set(compact('id'));

		$this->pdfConfig = array(
			'filename' => 'financiacion',
			'paperSize' => 'A4',
			'orientation' => 'landscape'
		);	



	}

	public function add() {
		$this->form($this->params['named']['from_id']);
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash('error en URL');
			$this->redirect(array(
				'action' => 'index',
				'controller' => 'financiaciones'
			));
		}
		$this->form($id);
		$this->render('form');
	}

	public function form($id) { //esta acción vale tanto para edit como add
		//en el desplegable de bancos quieren que aparezca los dos últimos
		//digitos del codigo contable, seguido por el nombre del banco
		//Podemos crear un campo virtual de Empresa y luego pasarlo
		//a Banco, pero hay que tener cuidado de borrar los dos después
		//http://book.cakephp.org/2.0/en/models/virtual-fields.html#limitations-of-virtualfields
		$this->loadModel('Banco');
		$this->Banco->Empresa->virtualFields = array(
			'codigo_nombre' => 'CONCAT(SUBSTRING(Empresa.codigo_contable,7),"-",Empresa.nombre_corto)'
		);
		$this->Banco->virtualFields['codigo_nombre'] = $this->Banco->Empresa->virtualFields['codigo_nombre'];
		$bancos = $this->Banco->find(
			'list',
			array(
				'fields' => array(
					'Banco.id',
					'Banco.codigo_nombre'
				),
				'order' => array('Banco.codigo_nombre' => 'asc'),
				'recursive' => 1
			)
		);
		unset($this->Banco->Empresa->virtualFields);
		unset($this->Banco->virtualFields);
		$this->set(compact('bancos'));

		$operacion = $this->Financiacion->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 1,
				'contain' => array(
					'Contrato' => array(
						'Proveedor',
						'Calidad',
						'Incoterm'
					),
					'PrecioTotalOperacion'
				),
			)
		);
		$this->set(compact('operacion'));

		$tipoIvas = $this->Financiacion->TipoIva->find('list');
		$this->set(compact('tipoIvas'));
		$this->set('tipoIvaComisiones', $tipoIvas);
		$this->set('referencia', $operacion['Operacion']['referencia']);
		$this->set('proveedor', $operacion['Contrato']['Proveedor']['nombre_corto']);
		$this->set('proveedor_id', $operacion['Contrato']['Proveedor']['id']);
		$this->set('calidad', $operacion['Contrato']['Calidad']['nombre']);
		$this->set('condicion', $operacion['Contrato']['condicion']);
		$this->set('precio_euro_kilo', $operacion['PrecioTotalOperacion']['precio_euro_kilo_total']);
		$this->set('action', $this->action);

		//si es un edit, hay que rellenar el id, ya que
		//si no se hace, al guardar el edit, se va a crear
		//un _nuevo_ registro, como si fuera un add
		if (!empty($id)) $this->Financiacion->id = $id; 
		if(!empty($this->request->data)) { //la vuelta de 'guardar' el formulario
			if($this->Financiacion->save($this->request->data)){
				$this->Session->setFlash('Financiación guardada');
				$this->redirect(array(
					'action' => 'view',
					'controller' => 'financiaciones',
					$id
				));
			} else {
				$this->Session->setFlash('Financiación NO guardada');
			}
		} else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
			$this->request->data = $this->Financiacion->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
		if ($this->Financiacion->delete($id)){
			$this->Session->setFlash('Financiación borrada');
			$this->redirect(array(
				'controller' => 'financiaciones',
				'action'=>'index',
			));
		}
	}
}
?>
