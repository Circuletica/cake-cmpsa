<?php
class FacturaLinea extends AppModel {
    public $displayField = 'concepto';
    public $belongsTo = array(
	'TipoIva'
    )
}
