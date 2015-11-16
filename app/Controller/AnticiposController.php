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
?>
