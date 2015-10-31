<?php
class ValorTipoIva extends AppModel {
	public $displayField = 'valor';
	public $belongsTo = array(
	    'TipoIva'
	);
	//implementado un método de búsqueda personalizado
	//que sólo saca el valor de IVA a día de hoy
	public $findMethods = array('now' => true);
	protected function _findNow($state, $query, $results = array()) {
	    if ($state === 'before') {
		$query['conditions']['ValorTipoIva.fecha_inicio'] <= date('Y-m-d');
		$query['conditions']['ValorTipoIva.fecha_fin'] > date('Y-m-d');
		return $query;
	    }
	    return $results;
	}
}
