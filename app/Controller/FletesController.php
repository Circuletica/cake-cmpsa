<?php
class FletesController extends AppController {
    function index() {
	$this->Flete->bindModel(
	    array(
		'belongsTo' => array(
		    'Pais' => array(
			'foreignKey' => false,
			'conditions' => array('Pais.id = PuertoCarga.pais_id')
		    )
		)
	    )
	);
	//los paises para el filtro
	$paises = $this->Flete->Pais->find('list');
	$this->set(compact('paises'));
	//las navieras para el filtro
	$this->loadModel('Naviera');
	$this->set(
	    'navieras',
	    $this->Naviera->find(
		'list',
		array(
		    'fields' => array(
			'Naviera.id',
			'Empresa.nombre_corto'
		    ),
		    'recursive' => 1,
		    'order' => array('Empresa.nombre_corto' => 'ASC')
		)
	    )
	);
	//los puertos de carga para el filtro
	$this->set(
	    'puertoCargas',
	    $this->Flete->PuertoCarga->find('list')
	);

	//los puertos de destino para el filtro
	$this->set(
	    'puertoDestinos',
	    $this->Flete->PuertoDestino->find(
		'list',
		array(
		    'conditions' => array(
			//solo los puertos españoles
			'PuertoDestino.pais_id' => 3
		    )
		)
	    )
	);

	$this->paginate = array(
	    'contain' => array(
		'Naviera',
		'PuertoCarga',
		'Pais',
		'PuertoDestino.nombre',
		'Embalaje.nombre',
		'PrecioActualFlete'
	    ),
	    'order' => array(
		'Pais.nombre' => 'ASC',
		'PuertoCarga.nombre' => 'ASC',
		'PuertoDestino.nombre' => 'ASC'
	    ),
	    'recursive' => 2
	);
	//a la vez que definimos las condiciones del 
	//paginador AppController.php,
	//sacamos un titulo con los criterios de filtro
	$titulo = $this->filtroPaginador(
	    array(
		'Naviera' => 'naviera_id',
		'Puerto de Carga' => 'puerto_carga_id',
		'Puerto de Destino' => 'puerto_destino_id'
	    )
	);
	//como el filtrado de pais es sobre PuertoCarga.pais_id
	//no vale la función anterior
	if(isset($this->passedArgs['Search.pais_id'])) {
	    $pais_id = $this->passedArgs['Search.pais_id'];
	    $this->paginate['conditions']['PuertoCarga.pais_id LIKE'] = "$pais_id";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['pais_id'] = $pais_id;
	    //completamos el titulo
	    $titulo .= '| País de origen: '.$paises[$pais_id];
	}
	$fletes = $this->paginate();
	$this->set(compact('fletes','titulo'));
    }

    function add(){
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id) {
	    $this->Session->setFlash('error en URL/No id de flete para edit');
	    $this->redirect(
		array(
		    'action' => 'index',
		    'controller' => 'fletes'
		)
	    );
	}
	$this->form($id);
	$this->render('form');
    }

    function form($id = null) {
	$this->set('action', $this->action);
	$this->loadModel('Naviera');
	$this->set(
	    'navieras',
	    $this->Naviera->find(
		'list',
		array(
		    'fields' => array(
			'Naviera.id',
			'Empresa.nombre_corto'
		    ),
		    'recursive' => 1,
		    'order' => array('Empresa.nombre_corto' => 'ASC')
		)
	    )
	);

	$puerto_cargas = $this->Flete->PuertoCarga->find(
	    'list', array(
		'order' => array('PuertoCarga.nombre' => 'ASC')
	    )
	);
	$this->set(compact('puerto_cargas'));
	$puerto_destinos = $this->Flete->PuertoDestino->find(
	    'list', array(
		'order' => array('PuertoDestino.nombre' => 'ASC'),
		//solo puertos de destino en España.
		//No mola naaaaada el tener el pais_id hard-codeado...
		'conditions' => array('PuertoDestino.pais_id' => 3)
	    )
	);
	$this->set(compact('puerto_destinos'));
	$embalajes = $this->Flete->Embalaje->find(
	    'list', array(
		'order' => array('Embalaje.nombre' => 'ASC')
	    )
	);
	$this->set('embalajes', $embalajes);

	if (!empty($id)) { //es un edit
	    $this->Flete->id = $id;
	    $flete = $this->Flete->findById($id);
	    $this->set(compact('flete'));
	    $this->set('referencia', $flete['PuertoCarga']['Pais']['nombre'].'-'.$flete['PuertoDestino']['nombre']);
	}
	if (!empty($this->request->data)){  //es un POST
	    if($this->Flete->save($this->request->data)) {
		$this->Session->setFlash('Flete guardado');
		$this->redirect(
		    array(
			'action' => 'index',
		    )
		);
	    } else {
		$this->Session->setFlash('Flete NO guardado');
	    }
	} else { //es un GET
	    $this->request->data= $this->Flete->read(null, $id);
	}
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Flete/view');
	    $this->redirect(array('action'=>'index'));
	}
	$flete = $this->Flete->find('first', array(
	    'conditions' => array('Flete.id' => $id),
	    'recursive' => 2));
	$this->set('flete',$flete);
	$this->set('referencia',
	    $flete['PuertoCarga']['nombre']
	    .' ('.$flete['PuertoCarga']['Pais']['nombre'].')'
	    .' - '.$flete['PuertoDestino']['nombre']);
	$costes = $this->Flete->PrecioFleteTonelada->find(
	    'all',
	    array(
		'conditions' => array('PrecioFleteTonelada.flete_id' => $id),
		'order' => array('PrecioFleteTonelada.fecha_inicio' => 'ASC')
	    )
	);
	$this->set('costes',$costes);
    }

    public function delete($id) {
	if($this->request->is('post')):
	    if($this->Flete->delete($id)):
		$this->Session->setFlash('Flete borrado');
	$this->redirect(array(
	    'controller' => 'fletes',
	    'action' => 'index'
	));
endif;
else:
    throw new MethodNotAllowedException();
endif;    
    }
}
?>
