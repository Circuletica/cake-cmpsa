<?php
class TipoIvasController extends AppController {
    public $paginate = array(
	'limit' => 20,
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'ValorTipoIva'
	);

	//Por defecto, sacamos los valores de IVA a día de hoy.
	//Si queremos el historial, habra que ir a la view()
	$this->TipoIva->unbindModel(array(
	    'hasMany' => array(
		'ValorTipoIva'
	    )
	));
	$this->TipoIva->bindModel(array(
	    'belongsTo' => array(
		'ValorTipoIva' => array(
		    'foreignKey' => false,
		    //sólo los registros cuyo intervalo de validez
		    //incluya la fecha de hoy, o no tenga fecha de caducidad.
		    'conditions' => array(
			'AND' => array(
			    array("ValorTipoIva.fecha_inicio <=" => date('Y-m-d')),
			    'OR' => array(
				"ValorTipoIva.fecha_fin >" => date('Y-m-d'),
				"ValorTipoIva.fecha_fin" => NULL
			    ),
			    array('ValorTipoIva.tipo_iva_id = TipoIva.id')
			)
		    )
		)
	    )
	));

	$this->set('tipo_ivas', $this->paginate());
    }

    public function add() {
	if($this->request->is('post')):
	    if($this->TipoIva->save($this->request->data) ):
		$this->Session->setFlash('Tipo de IVA guardado');
	$this->redirect(array(
	    'controller' => 'tipo_ivas',
	    'action' => 'index'
	)
    );
endif;
endif;
    }

    public function view($id = null) {
	//el id y la clase del tipo de iva vienen en la URL
	if (!$id) {
	    $this->Session->setFlash('URL mal formado TipoIva/view');
	    $this->redirect(array('action'=>'index'));
	}
	$tipo_iva = $this->TipoIva->find(
	    'first',
	    array(
		'conditions' => array('TipoIva.id' => $id)
	    )
	);
	$this->set(compact('tipo_iva'));
    }

    public function edit($id = null) {
	$this->TipoIva->id = $id;
	if($this->request->is('get')):
	    $iva = $this->TipoIva->find('first', array(
		'conditions' => array(
		    'id' => $id
		)
	    )
	);
	$this->set('referencia', 'IVA '.$iva['TipoIva']['nombre']);
	$this->request->data = $this->TipoIva->read();
	else:
	    if($this->TipoIva->save($this->request->data)):
		$this->Session->setFlash(' Tipo de IVA '.$this->request->data['Iva']['nombre'].' guardado');
	$this->redirect(array('action' => 'index'));
	    else:
		$this->Session->setFlash('Tipo de IVA no guardado');
endif;
endif;
    }
    public function delete($id) {
	if($this->request->is('get')):
	    throw new MethodNotAllowedException();
	else:
	    if($this->TipoIva->delete($id)):
		$this->Session->setFlash('Tipo de IVA borrado');
	$this->redirect(array('action' => 'index'));
endif;
endif;
    }
}
