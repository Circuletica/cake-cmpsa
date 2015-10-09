<?php
class AsociadosController extends AppController {
<<<<<<< HEAD
=======
	var $scaffold = 'admin';
>>>>>>> master
	public $paginate = array(
		'order' => array('Empresa.nombre' => 'asc')
	);
	public $scaffold = 'admin';

	public function index() {
		//hay que cambiar el 'hasOne' del Model por un 'belongsTo'
		//para que el LEFT JOIN de 3r nivel de la query se haga
		//después del de 2o nivel, es decir primero el JOIN con Empresa,
		//luego el JOIN con Pais si no queremos errores de SQL
		$this->Asociado->unbindModel(array(
			'hasOne' => array('Empresa')
		));
		$this->Asociado->bindModel(array(
			'belongsTo' => array(
				'Empresa' => array(
					'foreignKey' => false,
					'conditions' => array('Asociado.id = Empresa.id')
				),
				'Pais' => array(
					'foreignKey' => false,
					'conditions' => array('Pais.id = Empresa.pais_id')
				)
			)
		));
		$this->paginate = array(
			'contain' => array(
				'Empresa',
				'Pais.nombre',
			),
			'recursive' => 1,
			'order' => array('Empresa.nombre_corto' => 'ASC')
		);
		$this->set('empresas', $this->paginate());
	}
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Asociado/view ');
			$this->redirect(array('action'=>'index'));
		}
		$empresa = $this->Asociado->find(
			'first',
			array('conditions' => array('Asociado.id' => $id))
		);
		$this->set('empresa',$empresa);
		$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
		$this->set('referencia', $empresa['Empresa']['nombre_corto']);
		//el método iban() definido en AppController necesita
		//como parametro un 'string'
		settype($cuenta_bancaria,"string");
		$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
		$this->set('iban_bancaria',$iban_bancaria);
	}
	public function add() {
		$this->set('paises', $this->Asociado->Empresa->Pais->find('list'));
		if($this->request->is('post')):
			//quitamos los guiones  de la CCC
			$numero_form = $this->data['Empresa']['cuenta_bancaria'];
			$cuenta_bancaria = substr($numero_form,0,4).
	      			substr($numero_form,5,4).
	      			substr($numero_form,10,2).
	     			substr($numero_form,13,10);
			$this->request->data['Empresa']['cuenta_bancaria'] = $cuenta_bancaria;
			//primero se guarda la nueva empresa y con
			//el ID que le da mysql, se guarda la entidad
			//con el mismo ID
			$this->Asociado->Empresa->save($this->request->data);
			$this->request->data['Asociado']['id'] = $this->Asociado->Empresa->id;
			if($this->Asociado->save($this->request->data)):
				$this->Session->setFlash('Asociado guardado');
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
<<<<<<< HEAD
		if ($this->Naviera->Empresa->delete($id)):
			$this->Session->setFlash('Asociado borrado');
=======
		if ($this->Asociado->delete($id)):
			$this->Session->setFlash('Asociado borrado');
			$this->Asociado->Empresa->delete($id);
>>>>>>> master
			$this->redirect(array('action'=>'index'));
		endif;
	}
	public function edit( $id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Asociado->id = $id;
		$this->Asociado->Empresa->id = $id;
<<<<<<< HEAD
		$asociado = $this->Asociado->find('first',array(
			'conditions' => array('Asociado.id' => $id)));
		$this->set('empresa',$asociado);
=======
		$agente = $this->Asociado->find('first',array(
			'conditions' => array('Asociado.id' => $id)));
		$this->set('empresa',$agente);
>>>>>>> master
		$this->set('paises', $this->Asociado->Empresa->Pais->find('list'));
		if($this->request->is('get')):
			$this->request->data = $this->Asociado->read();
		else:
<<<<<<< HEAD
=======
			//if ($this->BancoPrueba->save($this->request->data)):
>>>>>>> master
			if ($this->Asociado->Empresa->save($this->request->data) and $this->Asociado->save($this->request->data)):
				$this->Session->setFlash('Asociado '.
				$this->request->data['Empresa']['nombre'].
			        ' modificado con éxito');
				$this->redirect(array('action' => 'view', $id));
			else:
				$this->Session->setFlash('Asociado NO guardado');
			endif;
		endif;
	}
}
?>
