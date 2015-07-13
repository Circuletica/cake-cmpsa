<?php
class Cliente extends AppModel{
  //public $belongsTo = 'Empresa';
  public $belongsTo = 'Pais';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );
}
