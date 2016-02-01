<?php
class OperacionRetirada extends AppModel{
   public $belongsTo = array(
      'Operacion' => array(
      'className' => 'Operacion',
      'foreignKey' => 'id'
      ),
      'Retirada'
  );

}
