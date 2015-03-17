<?php
class Naviera extends AppModel{
  public $belongsTo = 'Pais';
  public $validate = array(
    'nombre' => array(
      'rule' => 'notEmpty',
      'message' => 'El nombre no puede ser vacio'
      )
    );
}
