<?php
class ValorTipoIvasController extends AppController {
    public $paginate = array(
	'limit' => 20,
	'order' => array('TipoIva.valor' => 'asc')
    );

    public function index() {
	$params = array('order' => 'nombre asc');
	$this->set('valor_tipo_ivas', $this->paginate());
    }
}
?>
