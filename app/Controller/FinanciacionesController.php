<?php
class FinanciacionesController extends AppController {
    public $scaffold = 'admin';
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
}
?>
