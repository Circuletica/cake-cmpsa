<?php
class LineaContratosController extends AppController {
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
				'CalidadNombre.nombre')
		));
		$this->set('contrato',$contrato);
		//queda por ver si $embalajes_contrato no puede ser usada en su lugar
//		$embalajes = $this->LineaContrato->Contrato->ContratoEmbalaje->find('list', array(
//			'conditions' => array('ContratoEmbalaje.contrato_id' => $this->params['named']['from_id']),
//			'fields' => array('ContratoEmbalaje.embalaje_id','Embalaje.nombre'),
//			'recursive' => 1
//				)
//			);
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
		//$this->set('embalajes_contrato', $embalajes_contrato);
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
		$embalajes_nombre = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.Embalaje');
		$this->set('embalajes_nombre', $embalajes_nombre);
		$embalajes_peso = Hash::combine($embalajes_contrato, '{n}.Embalaje.id', '{n}.ContratoEmbalaje');
		$this->set('embalajes_peso', $embalajes_peso);
		//sumamos los distintos arrays de mismo index para llegar a esto:
		//Array
		//  (
		//    [2] =>Array
		//      id => 2
		//      nombre => big bag
		//      cantidad_embalaje => 60
		//      peso_embalaje_real => 60
		//    [1] => ...
		$embalajes = array_replace_recursive($embalajes_nombre,$embalajes_peso);
		$this->set('embalajes', $embalajes);
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
			//debug($this->request->data['LineaContrato']);
			//debug($this->request->data['CantidadAsociado']);
			//throw New Exception('array depurado');
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
}
?>
