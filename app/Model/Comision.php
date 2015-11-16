<?php
class Comision extends AppModel {
    var $displayField = 'valor';
    public $hasMany = array('AsociadoComision');
}

