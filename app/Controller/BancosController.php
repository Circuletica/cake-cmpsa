<?php
class BancosController extends AppController {
	public $paginate = array(
		'order' => array('Empresa.nombre' => 'asc')
	);
		function index($id = null) {
		//$this -> set('bancos', $this->Banco->find('all'));
		$this->set('bancos', $this->paginate());
			//Exportar PDF
		$this->pdfConfig = array(
			'orientation'=>'landscape',
			'filename'=>'Bancos-'.$id.'pdf',
			'title'=>'Listado de Bancos',
			'margin' => array(
            'bottom' => 15,
            'left' => 30,
            'right' => 30,
            'top' => 15
        	));
		 $this->set('Listado', $this->Banco->read(null, $id));
		// $this->layout = 'pdf\facturas'; //this will use the pdf.ctp layout
		 $this->render();
				
	}
	public function view($id = null) {
		if (!$id) {
			//$this->set('params',$this->request->params);
			$this->Session->setFlash('URL mal formado Banco/view ');
			$this->redirect(array('action'=>'index'));
		}
		//sacamos el banco cuyo id se ha pasado al view
		$banco = $this->Banco->findById($id);
		$this->set('banco',$banco);
		//calculamos el IBAN
		$cuenta_cliente = $banco['Banco']['cuenta_cliente_1'];
		//la funcion necesita una cadena como parametro
		settype($cuenta_cliente,"string");
		//debug($ccc);
		$iban_cliente = $this->iban("ES",$cuenta_cliente);
		$this->set('iban_cliente',$iban_cliente);
		//debug($iban_cliente);
		//Exportar PDF
		$this->pdfConfig = array(
			'orientation'=>'portrait',
			'download'=>true,
			'filename'=>'bancos-'.$id.'pdf'
			);
	}
	public function add() {
		//los paises que rellenan el desplegable de 'País'
		$this->set('paises', $this->Banco->Empresa->Pais->find('list'));
		if($this->request->is('post')):
			//quitamos los guiones de la entrada de formulario
			$numero_form = $this->data['Banco']['cuenta_cliente_1'];
			$cuenta_cliente_1 = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$numero_form = $this->data['Empresa']['cuenta_bancaria'];
			$cuenta_bancaria = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$this->request->data['Banco']['cuenta_cliente_1'] = $cuenta_cliente_1;
			$this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
			//primero se guarda la empresa y con el id que devuelve
			//mysql guardamos el banco con el mismo id
			$this->Banco->Empresa->save($this->request->data);
			$this->request->data['Banco']['id'] = $this->Banco->Empresa->id;
			if($this->Banco->save($this->request->data)):
				$this->Session->setFlash('Banco guardado');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}
	public function delete( $id = null) {
		if (!$id or $this->request->is('get')) :
    			throw new MethodNotAllowedException();
			//$this->Session->setFlash('URL mal formado');
			//$this->redirect(array('action'=>'index'));
		endif;
		if ($this->Banco->Empresa->delete($id)):
			$this->Session->setFlash('Banco borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}
	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Banco->id = $id;
		$this->Banco->Empresa->id = $id;
		$this->set('paises', $this->Banco->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Banco->read();
		else:
			//if ($this->Banco->save($this->request->data)):
			if ($this->Banco->Empresa->save($this->request->data) and $this->Banco->save($this->request->data)):
				$this->Session->setFlash('Banco '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Banco NO guardado');
			endif;
		endif;
	}
}
?>