<?php
class OperacionRetirada extends AppModel{
   public $recursive = 2;
   public $belongsTo = array(
      'Operacion' => array(
      'className' => 'Operacion',
      'foreignKey' => 'id'
      ),
      'Retirada'
  );

}
