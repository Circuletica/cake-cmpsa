<?php
class OperacionesController extends AppController {
	public $scaffold = 'admin';
	public $paginate = array(
		'order' => array('referencia' => 'asc')
	);

	public function index() {
		$this->set('lineas', $this->paginate());
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado operaciones/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'index')
			);
		}
		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$contrato = $this->Operacion->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $this->params['named']['from_id']),
			'recursive' => 2,
			'fields' => array(
				'Contrato.id',
				'Contrato.referencia',
				'Contrato.proveedor_id',
				'Contrato.peso_comprado',
				'CanalCompra.nombre',
				'CanalCompra.divisa',
				'Incoterm.nombre',
				'Incoterm.si_flete',
				'Incoterm.si_seguro',
				'CalidadNombre.nombre')
		));
		$this->set('contrato',$contrato);
		$embalajes_contrato = $this->Operacion->Contrato->ContratoEmbalaje->find('all', array(
			'conditions' => array('ContratoEmbalaje.contrato_id' => $this->params['named']['from_id']),
			'fields' => array(
				'Embalaje.id',
				'Embalaje.nombre',
				'ContratoEmbalaje.cantidad_embalaje',
				'ContratoEmbalaje.peso_embalaje_real'
				)
			)
		);
		//hace falta para el desplegable de 'Embalaje'
		//recombinamos el array anterior que quedaba asi:
		//Array
		//  (
		//    [0] => Array
		//      id => 2
		//      nombre => big bag
		//    [1] => Array
		//      id => 1
		//      nombre => saco 60kg
		//y se transforma así
		//Array
		//  (
		//    [2] => big bag
		//    [1] => saco 60kg
		$embalajes = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.Embalaje.nombre');
		$this->set('embalajes', $embalajes);
		$embalajes_nombre = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.Embalaje');
		$embalajes_peso = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.ContratoEmbalaje');
		//sumamos los distintos arrays de mismo index para llegar a esto:
		//Array
		//  (
		//    [2] =>Array
		//      id => 2
		//      nombre => big bag
		//      cantidad_embalaje => 60
		//      peso_embalaje_real => 60
		//    [1] => ...
		$embalajes_completo = array_replace_recursive($embalajes_nombre,$embalajes_peso);
		$this->set('embalajes_completo', $embalajes_completo);
		//solo para mostrar el proveedor a nivel informativo
		$this->set('proveedor',$contrato['Proveedor']['Empresa']['nombre']);
		//a quienes van asociadas las lineas de contrato
		$asociados = $this->Operacion->AsociadoOperacion->Asociado->find('list', array(
			'fields' => array('Asociado.id','Empresa.nombre_corto'),
			'recursive' => 1
			)
		);
		$this->set('asociados', $asociados);

		if($this->request->is('post')):
			//al guardar la linea, se incluye a qué contrato pertenece
			$this->request->data['Operacion']['contrato_id'] = $this->params['named']['from_id'];
			//primero guardamos los datos de Operacion
			if($this->Operacion->save($this->request->data)):
				//luego las cantidades de cada asociado en AsociadoOperacion
				foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
					if ($cantidad != NULL) {
						$this->request->data['AsociadoOperacion']['operacion_id'] = $this->Operacion->id;
						$this->request->data['AsociadoOperacion']['asociado_id'] = $asociado_id;
						$this->request->data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
						//$cantidad_embalaje_operacion += $cantidad;
						if (!$this->Operacion->AsociadoOperacion->saveAll($this->request->data['AsociadoOperacion']))
							throw New Exception('error en guardar AsociadoOperacion');
					}
				}
				//falta aquí guardar el peso total de la linea de contrato
				//y el tipo de embalaje
				//.....
				$this->Session->setFlash('Linea de Contrato guardada');
				//volvemos al contrato a la que pertenece la linea creada
				$this->redirect(array(
					'controller' => $this->params['named']['from_controller'],
					'action' => 'view',
					$this->params['named']['from_id']));
			endif;
		endif;
	}

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Operacion->id = $id;
		$operacion = $this->Operacion->find('first', array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 3
			)
		);
		$this->set('operacion', $operacion);
		$asociados = $this->Operacion->AsociadoOperacion->Asociado->find('list', array(
			'fields' => array('Asociado.id','Empresa.nombre_corto'),
			'order' => array('Empresa.nombre_corto' => 'ASC'),
			'recursive' => 1
			)
		);
		$this->set('asociados', $asociados);
		//los que ya tienen embalajes en la operacion
		$asociados_operacion = $operacion['AsociadoOperacion'];
		//queremos el id del socio como index del array
		$asociados_operacion = Hash::combine($asociados_operacion, '{n}.Asociado.id', '{n}');
		$this->set('asociados_operacion', $asociados_operacion);
		//Ahora que tenemos todos los datos, rellenamos el formulario
		$embalaje = $this->Operacion->Contrato->ContratoEmbalaje->find('first', array(
			'conditions' => array(
				'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
				'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
			)
		));
		$this->set('embalaje', $embalaje);

		if($this->request->is('get')): //al abrir el edit, meter los datos de la bdd
			$this->request->data = $this->Operacion->read();
			foreach ($asociados_operacion as $asociado_id => $asociado) {
				$this->request->data['CantidadAsociado'][$asociado_id] = $asociado['cantidad_embalaje_asociado'];
			}
		else:
			if ($this->Operacion->save($this->request->data)):
				//Los registros de AsociadoOperacion se van sumando
				//asi que hay que borrarlos todos porque el saveAll() los
				//vuelve a crear y no queremos duplicados.
				$this->Operacion->AsociadoOperacion->deleteAll(array(
					'AsociadoOperacion.operacion_id' => $id
				));
				foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
					if ($cantidad != NULL) {
						$this->request->data['AsociadoOperacion']['operacion_id'] = $this->Operacion->id;
						$this->request->data['AsociadoOperacion']['asociado_id'] = $asociado_id;
						$this->request->data['AsociadoOperacion']['cantidad_embalaje_asociado'] = $cantidad;
						$this->Operacion->AsociadoOperacion->saveAll($this->request->data['AsociadoOperacion']);
					}
				}
				$this->Session->setFlash('Operacion '.
				$this->request->data['Operacion']['referencia'].
			        ' modificada con éxito');
				$this->redirect(array(
					'action' => 'view',
					$id
					)
				);

			else:
				$this->Session->setFlash('Operacion NO guardada');
			endif;
		endif;
	}
	
	public function view($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$operacion = $this->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 3
			)
		);
		$this->set('operacion', $operacion);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
				),
				'fields' => array('Embalaje.nombre', 'ContratoEmbalaje.peso_embalaje_real')
			)
		);
		$this->set('embalaje', $embalaje);

	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
		endif;
		if ($this->Operacion->delete($id)):
			$this->Session->setFlash('Línea de contrato borrada');
		$this->redirect(array(
			'controller' => $this->params['named']['from_controller'],
			'action'=>'view',
			$this->params['named']['from_id']
		));
		endif;
	}
}
?>
