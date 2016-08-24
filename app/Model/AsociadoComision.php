<?php
class AsociadoComision extends AppModel {
	public $name = 'Comisión de asociado';
	public $useTable = 'asociado_comisiones';
	public $belongsTo = array(
		'Comision',
		'Asociado'
	);
}
