<?php
class LineaContratosController extends AppController {
	public $paginate = array(
		'order' => array('referencia' => 'asc')
	);

	public function index() {
		$this->set('lineas', $this->paginate());
	}

	public function add() {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$this->params['named']['from_id']) {
			$this->Session->setFlash('URL mal formado lineaContrato/add '.$this->params['named']['from']);
			$this->redirect(array(
				'controller' => $this->params['named']['from'],
				'action' => 'index')
			);
		}
		//sacamos los datos del contrato al que pertenece la linea
		//nos sirven en la vista para detallar campos
		$contrato = $this->LineaContrato->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $this->params['named']['from_id']),
			'recursive' => 2,
			'fields' => array(
				'Contrato.id',
				'Contrato.referencia',
				'Contrato.proveedor_id',
				'Contrato.peso_comprado',
				'CanalCompra.nombre',
				'CanalCompra.divisa',
				'Calidad.nombre')
		));
		$this->set('contrato',$contrato);
		$embalajes_contrato = $this->LineaContrato->Contrato->ContratoEmbalaje->find('all', array(
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
		$asociados = $this->LineaContrato->AsociadoLineaContrato->Asociado->find('list', array(
			'fields' => array('Asociado.id','Empresa.nombre_corto'),
			'recursive' => 1
			)
		);
		$this->set('asociados', $asociados);

		if($this->request->is('post')):
			//al guardar la linea, se incluye a qué contrato pertenece
			$this->request->data['LineaContrato']['contrato_id'] = $this->params['named']['from_id'];
			//primero guardamos los datos de LineaContrato
			if($this->LineaContrato->save($this->request->data)):
				//luego las cantidades de cada asociado en AsociadoLineaContrato
				foreach ($this->request->data['CantidadAsociado'] as $asociado_id => $cantidad) {
					if ($cantidad != NULL) {
						$this->request->data['AsociadoLineaContrato']['linea_contrato_id'] = $this->LineaContrato->id;
						$this->request->data['AsociadoLineaContrato']['asociado_id'] = $asociado_id;
						$this->request->data['AsociadoLineaContrato']['cantidad_embalaje_asociado'] = $cantidad;
						//$cantidad_embalaje_linea_contrato += $cantidad;
						if (!$this->LineaContrato->AsociadoLineaContrato->saveAll($this->request->data['AsociadoLineaContrato']))
							throw New Exception('error en guardar AsociadoLineaContrato');
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
	public function view($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$linea_contrato = $this->LineaContrato->find(
			'first',
			array(
				'conditions' => array('LineaContrato.id' => $id),
				'recursive' => 3
			)
		);
		$this->set('linea_contrato', $linea_contrato);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $linea_contrato['LineaContrato']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $linea_contrato['LineaContrato']['embalaje_id']
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
		if ($this->LineaContrato->delete($id)):
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
