<?php
class EnvioCalidad extends AppModel {
    var $useTable = false;
    var $_schema = array(
	    'email' => array('type'=>'string', 'length'=>200),
	    'referencia' => array('type'=>'text'), 
	    'a' => array('type'=>'string', 'length'=>100), 
	    'atn' => array('type'=>'string'), 
	    //'asunto' => array('type'=>'string','length'=>150), 
	    //'mensaje' => array('type'=>'text'), 
	    'observacion' => array('type'=>'text')
	    );

	var $validate = array(
    'email' => array(
        'rule'=>'email', 
        'message'=>'Un correo válido al menos es requerido' ),
    'asunto' => array(
        'rule'=>array('minLength', 1), 
        'message'=>'Asunto es necesario' )
);    
}
?>