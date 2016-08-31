<?php
class Financiacion extends AppModel {
	public $recursive = 2;
	public $belongsTo = array(
		'Banco' => array(
			'className' => 'Empresa',
			'foreignKey' => 'banco_id'),
		'TipoIva' => array(
			'className' => 'TipoIva',
			'foreignKey' => 'tipo_iva_id'),
		'TipoIvaComision' => array(
			'className' => 'TipoIva',
			'foreignKey' => 'tipo_iva_comision_id'),
		'Operacion' => array(
			'className' => 'Operacion',
			'foreignKey' => 'id')
		);
	public $hasOne = array(
		'ValorIvaFinanciacion',
		'ValorIvaComision'
	);
	public $hasMany = array(
		'RepartoOperacionAsociado' => array(
			'className' => 'RepartoOperacionAsociado',
			'foreignKey' => 'id'
		)
	);

	public function beforeDelete($cascade = true) {
		//no se deja borrar financiación si ya hay
		//anticipos exportados.
		global $count;
		$count = $this->Operacion->AsociadoOperacion->Anticipo->find(
			'count',
			array(
				'recursive' => -1,
				'conditions' => array(
					'Anticipo.si_contabilizado' => true,
					'AsociadoOperacion.operacion_id' => $this->id
				),
				'contain' => array(
					'AsociadoOperacion'
				)
			)
		);
		if ($count == 0) {
			return true;
		}
		return false;
	}
}
?>