<?php
class RetiradasController extends AppController {
	public $scaffold = 'admin';

	public function index() {
	$this->paginate['order'] = array('Retirada.fecha_retirada' => 'asc');
	$this->paginate['contain'] = array(
			'Asociado',
			'AlmacenTransporte'
	);

	$this->set('retiradas', $this->paginate());
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
		$this->set('divisa', $operacion['Contrato']['CanalCompra']['divisa']);
		foreach ($operacion['AsociadoOperacion'] as $linea):
			$peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
			$codigo = substr($linea['Asociado']['Empresa']['codigo_contable'],-2);
			$lineas_reparto[] = array(
				'Código' => $codigo,
				'Nombre' => $linea['Asociado']['Empresa']['nombre_corto'],
				'Cantidad' => $linea['cantidad_embalaje_asociado'],
				'Peso' => $peso
			);	
		endforeach;
		$columnas_reparto = array_keys($lineas_reparto[0]);
		//indexamos el array por el codigo de asociado
		$lineas_reparto = Hash::combine($lineas_reparto, '{n}.Código','{n}');
		//se ordena por codigo ascendente
		ksort($lineas_reparto);
		$this->set('columnas_reparto',$columnas_reparto);
		$this->set('lineas_reparto',$lineas_reparto);
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
		'controller' => 'retiradas'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

     public function form($id) { //esta acción vale tanto para edit como add

	//Listamos el nombre de asociados
	$this->loadModel('Asociado');	
	$asociados = $this->Asociado->find('list',
		array(
		'fields' => array(
			'Asociado.id',
			'Empresa.nombre_corto'),
		'order' => array('Empresa.nombre_corto' => 'asc'),
		'recursive' => 1)
	);
	$this->set(compact('asociados'));

	//Saco datos de la operación al que pertenece la linea
	//nos sirven  en la vista para detallar campos
	$operacion = $this->Retirada->AlmacenTransporte->Transporte->Operacion->find('first',array(
			'conditions' => array('Operacion.id' => $id),
			'recursive' => 5,
			'fields' => array(
			'Operacion.id')
			));
	
	//Listamos cuenta de los almacenes
    $almacen_transportes = array();
   // foreach ($operacion as $operaciones) {
		$transportes = $operaciones['Transporte'];
			foreach ($transportes as $transporte) {
			    $almacen_transportes = array_merge($almacen_transportes, $transporte['AlmacenTransporte']);
			}
	//  }
	$this->set('almacentransportes', $almacen_transportes);
	$this->set(compact('operaciones'));


	$this->set('action', $this->action);

	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) $this->Retirada->id = $id; 
	if(!empty($this->request->data)) { //la vuelta de 'guardar' el formulario
	    if($this->Retirada->save($this->request->data)){
		$this->Session->setFlash('Retirada guardada');
		$this->redirect(array(
		    'action' => 'view',
		    'controller' => 'retiradas',
		    $id
		));
	    } else {
		$this->Session->setFlash('Retirada NO guardada');
	    }
	} else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
	    $this->request->data = $this->Retirada->read(null, $id);
	}
    }

    public function delete($id = null) {
	if (!$id or $this->request->is('get')) throw new MethodNotAllowedException();
	if ($this->Retirada->delete($id)){
	    $this->Session->setFlash('Retirada borrada');
	    $this->redirect(array(
		'controller' => 'retiradas',
		'action'=>'index',
	    ));
	}
    }

}
?>
