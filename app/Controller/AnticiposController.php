<?php
class AnticiposController extends AppController {
    public $paginate = array(
	'order' => array('Anticipo.fecha_conta' => 'asc')
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'Asociado',
	    'Financiacion'
	);
	$this->set('anticipos', $this->paginate());
    }
    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'view',
		'controller' => $this->params['named']['from_controller'],
		$this->params['from_id']
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form ($id = null) {
	$bancos = $this->Anticipo->Banco->find('list', array(
	    'fields' => array(
		'Banco.id',
		'Empresa.nombre_corto'
	    ),
	    'order' => array('Empresa.nombre_corto' => 'asc'),
	    'recursive' => 1
	));
	$this->set(compact('bancos'));

	$this->Anticipo->Financiacion->Operacion->AsociadoOperacion->unbindModel(array(
	    'belongsTo' => array('Asociado')
	));
	$this->Anticipo->Financiacion->Operacion->AsociadoOperacion->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array('Empresa.id = AsociadoOperacion.asociado_id')
		)
	    )
	));
	$asociados = $this->Anticipo->Financiacion->Operacion->AsociadoOperacion->find(
	    'list',
	    array(
		'contain' => array(
		    'Empresa',
		),
		'fields' => array(
		    'Empresa.id',
		    'Empresa.nombre_corto',
		),
		'conditions' => array(
		    'AsociadoOperacion.operacion_id' => $this->params['named']['from_id']
		),
		'recursive' => 2,
		'order' => array('Empresa.codigo_contable' => 'ASC')
	    )
	);
	$this->set(compact('asociados'));

	if (!empty($this->request->data)){
	    if ($this->Anticipo->save($this->request->data)) {
		$this->Session->setFlash('Anticipo guardado');
		$this->redirect(array(
		    'action' => view,
		    'controller' => $this->params['named']['from_controller'],
		    $this->params['named']['from_id']
		));
	    } else {
		$this->Session->setFlash('Anticipo NO guardado');
	    }
	} else {
	    $this->request->data = $this->Anticipo->read(null, $id);
	}
    }
}
?>
