<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $scaffold = 'admin';
	public $helpers = array('Html','Form','Date','Button');
	public $components = array('DebugKit.Toolbar','Session','RequestHandler');
	public function iban($codigoPais,$ccc){
	  $pesos = array('A' => '10',
	 		'B' => '11',
	 		'C' => '12',
	 		'D' => '13',
	 		'E' => '14',
			'F' => '15',
			'G' => '16',
			'H' => '17',
	 		'I' => '18',
	 		'J' => '19',
			'K' => '20',
	 		'L' => '21',
			'M' => '22',
			'N' => '23',
			'O' => '24',
			'P' => '25',
			'Q' => '26',
			'R' => '27',
			'S' => '28',
			'T' => '29',
			'U' => '30',
			'V' => '31',
			'W' => '32',
			'X' => '33',
			'Y' => '34',
			'Z' => '35' );
	$dividendo = $ccc.$pesos[substr($codigoPais, 0 , 1)].$pesos[substr($codigoPais, 1 , 1)].'00';	
	$digitoControl =  98 - bcmod($dividendo, '97');
	if(strlen($digitoControl)==1) $digitoControl = '0'.$digitoControl;
	return $codigoPais.$digitoControl.$ccc;
	}
	
	//el tipo de muestra puede ser:
	//1 - oferta
	//2 - embarque
	//3 - entrega
	public $tipoMuestras =  array(
			1 => 'Oferta',
			2 => 'Embarque',
			3 => 'Entrega'
		);	

	public function filtroListado() { //FILTRO-BUSCADOR
		//la página a la que redirigimos después de mandar  el formulario de filtro
		$url['action'] = 'index';
		//construimos una URL con los elementos de filtro, que luego se usan en el paginator
		//la URL final tiene ese aspecto:
		//http://gestion.gargantilla.net/controller/index/Search.referencia:mireferencia/Search.id:3
		foreach ($this->data as $k=>$v){ 
			foreach ($v as $kk=>$vv){ 
			if ($vv) {$url[$k.'.'.$kk]=$vv;} 
			} 

		}
		$this->redirect($url,null,true);
	}
}
