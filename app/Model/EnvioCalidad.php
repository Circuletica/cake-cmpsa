<?php
class EnvioCalidad extends AppModel {
    var $useTable = false;
    var $_schema = array(
	    'email' => array('type'=>'string', 'length'=>200),
	    'calidad' => array('type'=>'string', 'length'=>200),
	    'trafico' => array('type'=>'string', 'length'=>200)

	);

	var $validate = array(
    'email' => array(
        'rule'=>'email', 
        'message'=>'Un correo válido al menos es requerido' )
	);    
}
?>