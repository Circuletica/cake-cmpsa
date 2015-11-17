<?php
class Anticipo extends AppModel {
    public $belongsTo = array(
	'Asociado',
	'Financiacion'
    );
}
