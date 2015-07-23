<?php
class Asociado extends AppModel{
    public $recursive = 3;
    public $displayField = 'id';
    public $hasOne = array('Empresa' => array(
	'className' => 'Empresa',
	'foreignKey' => 'id')
    );
	public $hasMany = array(
		'AsociadoOperacion' => array(
			'className' => 'AsociadoOperacion',
			'foreignKey' => 'asociado_id'
		)
	);
}
