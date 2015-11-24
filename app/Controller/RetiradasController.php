<?php
class RetiradasController extends AppController {
	public $scaffold = 'admin';

	public function index() {
		$this->paginate = array(
			'contain' => array(
				'Operacion',
				'Almacen',
				'Empresa',
				'CalidadNombre',
				'AlmacenesTransporte'
			),
		);
//		$this->Operacion->bindModel(array(
//			'belongsTo' => array(
//				'Empresa' => array(
//					'foreignKey' => false,
//					'conditions' => array('Empresa.id = Contrato.proveedor_id')
//				),
//				'CalidadNombre' => array(
//					'foreignKey' => false,
//					'conditions' => array('Contrato.calidad_id = CalidadNombre.id')
//				)
//			)
//		));
		$this->set('operaciones', $this->paginate());
	}

	public function view($id = null) {
		//el id y la clase de la entidad de origen vienen en la URL
		if (!$id) {
			$this->Session->setFlash('URL mal formado Muestra/view');
			$this->redirect(array('action'=>'index'));
		}
		$operacion = $this->Operacion->find(
			'first',
			array(
				'conditions' => array('Operacion.id' => $id),
				'recursive' => 3
			)
		);
		$this->set('operacion', $operacion);
		$this->loadModel('ContratoEmbalaje');
		$embalaje = $this->ContratoEmbalaje->find(
			'first',
			array(
				'conditions' => array(
					'ContratoEmbalaje.contrato_id' => $operacion['Operacion']['contrato_id'],
					'ContratoEmbalaje.embalaje_id' => $operacion['Operacion']['embalaje_id']
				),
				'fields' => array('Embalaje.nombre', 'ContratoEmbalaje.peso_embalaje_real')
			)
		);
		$this->set('embalaje', $embalaje);
		$this->set('divisa', $operacion['Contrato']['CanalCompra']['divisa']);
		foreach ($operacion['AsociadoOperacion'] as $linea):
			$peso = $linea['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
			$codigo = substr($linea['Asociado']['Empresa']['codigo_contable'],-2);
			$lineas_reparto[] = array(
				'Código' => $codigo,
				'Nombre' => $linea['Asociado']['Empresa']['nombre_corto'],
				'Cantidad' => $linea['cantidad_embalaje_asociado'],
				'Peso' => $peso
			);	
		endforeach;
		$columnas_reparto = array_keys($lineas_reparto[0]);
		//indexamos el array por el codigo de asociado
		$lineas_reparto = Hash::combine($lineas_reparto, '{n}.Código','{n}');
		//se ordena por codigo ascendente
		ksort($lineas_reparto);
		$this->set('columnas_reparto',$columnas_reparto);
		$this->set('lineas_reparto',$lineas_reparto);
	}

}
?>
