<?php
class BancosController extends AppController {

public $class = 'Banco';

    public function index() {
	$this->bindCompany($this->class);
	$this->set('empresas', $this->paginate());

	//Exportar PDF
	//$this->pdfConfig = array(
	//    'orientation'=>'landscape',
	//    'filename'=>'Bancos-'.$id.'pdf',
	//    'title'=>'Listado de Bancos',
	//    'margin' => array(
	//	'bottom' => 15,
	//	'left' => 30,
	//	'right' => 30,
	//	'top' => 15
	//    ));
	//$this->set('Listado', $this->Banco->read(null, $id));
	//// $this->layout = 'pdf\facturas'; //this will use the pdf.ctp layout
	//$this->render();

    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado '.$this->class.'/view ');
	    $this->redirect(array('action'=>'index'));
	}
	$this->viewCompany($this->class, $id);

	//Exportar PDF
	//$this->pdfConfig = array(
	//    'orientation'=>'portrait',
	//    'download'=>true,
	//    'filename'=>'bancos-'.$id.'pdf'
	//);
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => Inflector::tableize($this->class)
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->formCompany($this->class, $id);
    }

    public function delete( $id = null) {
	$this->deleteCompany($this->class, $id);
    }
}
?>
