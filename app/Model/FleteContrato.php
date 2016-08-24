<?php
class FleteContrato extends AppModel{
	public $recursive = 2;
	public $belongsTo = array(
		'Flete'
	);
}
