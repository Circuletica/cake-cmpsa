<?php
class OperacionRetirada extends AppModel{
  public $recursive = 2;
  public $belongsTo = array(
      'Retirada' => array(
      	'foreignKey'=> 'retirada_id'
      	)
  );
}
