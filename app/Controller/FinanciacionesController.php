<?php
class FinanciacionesController extends AppController {
    public $paginate = array(
	'order' => array('Operacion.referencia' => 'asc')
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'Empresa',
	    'Operacion'
	);
	$this->Financiacion->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array('Empresa.id = Financiacion.banco_id')
		)
	    )
	));
	$this->set('financiaciones', $this->paginate());
    }
    public function view($id = null) {
	//el id y la clase de la financiación de origen vienen en la URL
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Financiación/view');
	    $this->redirect(array('action'=>'index'));
	}
	//calculamos el total de cada línea de reparto como campo virtual del modelo
	//Si metemos el campo nuevo directamente en el 'contain' del find, sale
	//un element [0] en el resultado
	$this->Financiacion->RepartoOperacionAsociado->virtualFields = array(
	    'total' => 'precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0)'
	);
	$financiacion = $this->Financiacion->find(
	    'first',
	    array(
		'contain' => array(
		    'Banco' => array(
			'Empresa'
		    ),
		    'Operacion' => array(
			'Contrato' => array(
			    'CalidadNombre',
			    'Incoterm',
			    'Proveedor' => array(
				'Empresa'
			    )
			),
			'AsociadoOperacion' => array(
			    'Asociado' => array(
				'Empresa'
			    )
			)
		    ),
		    'ValorIvaFinanciacion',
		    'ValorIvaComision',
		    'Anticipo' => array(
			'Asociado' => array('Empresa'),
			'Banco' => array('Empresa')
		    )
		),
		'conditions' => array('Financiacion.id' => $id),
		'recursive' => 4
	    )
	);
	$this->set(compact('financiacion'));

	$this->set('anticipos', $financiacion['Anticipo']);

	$this->Financiacion->RepartoOperacionAsociado->virtualFields = array(
	    'total' => 'precio_asociado+iva+ifnull(comision,0)+ifnull(iva_comision,0)');
	$this->Financiacion->RepartoOperacionAsociado->unbindModel(array(
	    'belongsTo' => array('Asociado')
	));
	$this->Financiacion->RepartoOperacionAsociado->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array('Empresa.id = RepartoOperacionAsociado.asociado_id')
		)
	    )
	));
	$repartos = $this->Financiacion->RepartoOperacionAsociado->find(
	    'all',
	    array(
		'conditions'=>array(
		    'RepartoOperacionAsociado.id' => $id
		),
		'contains' => array(
		    'Empresa' => array(
			'fields' => array('nombre_corto')
		    )
		),
		'order' => array('Empresa.codigo_contable' => 'ASC')
	    )
	);
	$this->set(compact('repartos'));

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

	$this->set('financiacion_id', $financiacion['Financiacion']['id']);
	$this->set('referencia', $financiacion['Operacion']['referencia']);
	$this->set('proveedor', $financiacion['Operacion']['Contrato']['Proveedor']['Empresa']['nombre_corto']);
	$this->set('proveedor_id', $financiacion['Operacion']['Contrato']['Proveedor']['id']);
	$this->set('calidad', $financiacion['Operacion']['Contrato']['CalidadNombre']['nombre']);
	$condicion = $financiacion['Operacion']['Contrato']['si_entrega'] ? 'entrega' : 'embarque';
	//solo el año de embarque/entrega
	$condicion .= ' '.substr($financiacion['Operacion']['Contrato']['fecha_transporte'],0,4);
	//y el incoterm del contrato
	$condicion .= ' ('.$financiacion['Operacion']['Contrato']['Incoterm']['nombre'].')';
	$this->set(compact('condicion'));
	$this->set('fecha_vencimiento',$financiacion['Financiacion']['fecha_vencimiento']);
	$cuenta = $financiacion['Banco']['Empresa']['nombre_corto'].' '.$this->iban('ES',$financiacion['Banco']['Empresa']['cuenta_bancaria']);
	$this->set(compact('cuenta'));
	$this->set('precio_euro_kilo', $financiacion['Financiacion']['precio_euro_kilo']);
	$this->set('iva',$financiacion['ValorIvaFinanciacion']['valor']);
	$this->set('iva_comision',$financiacion['ValorIvaComision']['valor']);
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
	$operacion = $this->Financiacion->Operacion->find(
	    'first',
	    array(
		'conditions' => array('Operacion.id' => $id),
		'recursive' => 4,
		'contain' => array(
		    'Contrato' => array(
			'Proveedor' => array(
			    'Empresa'
			),
			'CalidadNombre',
			'Incoterm'
		    ),
		    'PrecioTotalOperacion'
		)
	    )
	);
	$this->set(compact('operacion'));
	$bancos = $this->Financiacion->Banco->find('list', array(
	    'fields' => array('Banco.id','Empresa.nombre_corto'),
	    'order' => array('Empresa.nombre_corto' => 'asc'),
	    'recursive' => 1
	));
	$this->set(compact('bancos'));
	$tipoIvas = $this->Financiacion->TipoIva->find('list');
	$this->set(compact('tipoIvas'));
	$this->set('tipoIvaComisiones', $tipoIvas);
	$this->set('referencia', $operacion['Operacion']['referencia']);
	$this->set('proveedor', $operacion['Contrato']['Proveedor']['Empresa']['nombre_corto']);
	$this->set('proveedor_id', $operacion['Contrato']['Proveedor']['id']);
	$this->set('calidad', $operacion['Contrato']['CalidadNombre']['nombre']);
	$condicion = $operacion['Contrato']['si_entrega'] ? 'entrega' : 'embarque';
	//solo el año de embarque/entrega
	$condicion .= ' '.substr($operacion['Contrato']['fecha_transporte'],0,4);
	$condicion .= ' ('.$operacion['Contrato']['Incoterm']['nombre'].')';
	$this->set(compact('condicion'));
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
