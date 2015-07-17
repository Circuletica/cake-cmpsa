<?php
class ContratosController extends AppController {
	var $scaffold = 'admin';
	var $displayField = 'referencia';
	public $paginate = array(
		'order' => array('Contrato.referencia' => 'asc')
	);

	public function index() {
		$proveedores = $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			)
		);
//		$canales = array(
//			'0' => 'Bolsa LND',
//			'1' => 'Bolsa NY',
//			'2' => 'Precio fijo'
//		);
		$canales = $this->Contrato->CanalCompra->find('all');
		$this->set('proveedores', $proveedores);
		//$contratos = $this->paginate();
		$this->set('contratos', $this->paginate());
	}

	public function add() {
		$proveedores = $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			)
		);
//		$canales = array(
//			'0' => 'Bolsa LND',
//			'1' => 'Bolsa NY',
//			'2' => 'Precio fijo'
//		);
		$canales = $this->Contrato->CanalCompra->find('list', array(
			'fields' => array('id','nombre')
			)
		);
		$this->set('canales', $canales);
		$this->set('proveedores', $proveedores);
		//En la vista se muestra la lista de todos los embalajes existentes
		$embalajes = $this->Contrato->ContratoEmbalaje->Embalaje->find('all', array(
			'order' => array('Embalaje.nombre' => 'asc')
			)
		);
		$this->set('embalajes', $embalajes);
		$this->set('incoterms', $this->Contrato->Incoterm->find('list'));
		$this->set('calidades', $this->Contrato->CalidadNombre->find('list'));
		if($this->request->is('post')):
			if($this->Contrato->save($this->request->data)):
				//Las claves del array data['Embalaje'] no son secuenciales,
				//son realmente el embalaje_id
				foreach ($this->request->data['Embalaje'] as $embalaje_id => $valor) {
					//no interesa guardar lineas vacías
					//if ($this->request->data['ContratoEmbalaje']['cantidad_embalaje'] != NULL) {
					if ($valor['cantidad_embalaje'] != NULL) {
						$this->request->data['ContratoEmbalaje']['contrato_id'] = $this->Contrato->id;
						$this->request->data['ContratoEmbalaje']['embalaje_id'] = $embalaje_id;
						$this->request->data['ContratoEmbalaje']['cantidad_embalaje'] = $valor['cantidad_embalaje'];
						$this->request->data['ContratoEmbalaje']['peso_embalaje_real'] = $valor['peso_embalaje_real'];
						$this->Contrato->ContratoEmbalaje->saveAll($this->request->data['ContratoEmbalaje']);
					}
				}
				$this->Session->setFlash('Contrato guardado');
				$this->redirect(array('action' => 'index'));
			endif;
		endif;
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado Contrato/view');
			$this->redirect(array('action'=>'index'));
		}
		$contrato = $this->Contrato->find('first', array(
			'conditions' => array('Contrato.id' => $id),
			'recursive' => 2));
		$this->set('contrato',$contrato);
		$this->loadModel('CalidadNombre');
		//el nombre de calidad concatenado esta en una view de MSQL
	}

	public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('URL mal formado');
			$this->redirect(array('action'=>'index'));
		}
		$this->Contrato->id = $id;
		$contrato = $this->Contrato->findById($id);
		$this->set('contrato',$contrato);
		//el titulado completo de la Calidad sale de una vista
		//de MySQL que concatena descafeinado, pais y descripcion
		$this->set('calidades',$this->Contrato->CalidadNombre->find('list'));
		$this->set('incoterms', $this->Contrato->Incoterm->find('list'));
		$this->set('proveedores', $this->Contrato->Proveedor->find('list', array(
			'fields' => array('Proveedor.id','Empresa.nombre'),
			'recursive' => 1
			))
		);
		//En la vista se muestra la lista de todos los embalajes existentes
		$embalajes = $this->Contrato->ContratoEmbalaje->Embalaje->find('all', array(
			'order' => array('Embalaje.nombre' => 'asc')
			)
		);
		$this->set('embalajes', $embalajes);
		if($this->request->is('get')):
			$this->request->data = $this->Contrato->read();
			foreach($contrato['ContratoEmbalaje'] as $embalaje) {
				$this->request->data['Embalaje'][$embalaje['embalaje_id']]['cantidad_embalaje'] = $embalaje['cantidad_embalaje'];
				$this->request->data['Embalaje'][$embalaje['embalaje_id']]['peso_embalaje_real'] = $embalaje['peso_embalaje_real'];
			}
		else:
			if ($this->Contrato->save($this->request->data)):
				//Los registros de ContratoEmbalaje se van sumando
				//entonces hay que borrarlos todos porque el saveAll()
				//los volverá a crear y no queremos duplicados
				$this->Contrato->ContratoEmbalaje->deleteAll(array(
					'ContratoEmbalaje.contrato_id' => $this->Contrato->id
					)
				);
				//sacamos los datos del formulario en edit.ctp para crear nuevos
				//registros en la tabla de join
				//Las claves del array data['Embalaje'] no son secuenciales,
				//son realmente el embalaje_id
				foreach ($this->request->data['Embalaje'] as $embalaje_id => $valor) {
					//no interesa guardar lineas vacías
					if ($valor['cantidad_embalaje'] != NULL) {
						$this->request->data['ContratoEmbalaje']['contrato_id'] = $this->Contrato->id;
						$this->request->data['ContratoEmbalaje']['embalaje_id'] = $embalaje_id;
						$this->request->data['ContratoEmbalaje']['cantidad_embalaje'] = $valor['cantidad_embalaje'];
						$this->request->data['ContratoEmbalaje']['peso_embalaje_real'] = $valor['peso_embalaje_real'];
						$this->Contrato->ContratoEmbalaje->saveAll($this->request->data['ContratoEmbalaje']);
					}
				}
				$this->Session->setFlash('Contrato '.
				$this->request->data['Contrato']['referencia'].
			        ' modificada con éxito');
				$this->redirect(array(
					'action' => 'view',
					$id
					)
				);
			else:
				$this->Session->setFlash('Contrato NO guardado');
			endif;
		endif;
	}

	public function delete($id = null) {
		if (!$id or $this->request->is('get')) :
			throw new MethodNotAllowedException();
		endif;
		if ($this->Contrato->delete($id)):
			$this->Session->setFlash('Contrato borrado');
			$this->redirect(array('action'=>'index'));
		endif;
	}
}
?>
