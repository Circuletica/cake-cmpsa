<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public function validate_ccc($check) { //$cuenta_bancaria seria abcd-efgh-ij-klmnopqrst
		//para el digito de control de entidad y sucursal (i)
		//cada digito de abcd-efgh se multiplica por su factor de peso y después
		//sacamos mod(11)
		$value = array_values($check);
		//$ccc = $cuenta_bancaria['cuenta_bancaria'];
		$ccc = $value[0];
		$suma = 0; $suma += $ccc[0] * 4; $suma += $ccc[1] * 8; $suma += $ccc[2] * 5;
		$suma += $ccc[3] * 10; $suma += $ccc[4] * 9; $suma += $ccc[5] * 7;
		$suma += $ccc[6] * 3; $suma += $ccc[7] * 6; $resto = $suma % 11;
		if ($resto < 2):
			$digito1 = $resto;
		else:
			$digito1 = 11 - $resto;
		endif;
		if ($digito1 != $ccc[8]) return false;
		//lo mismo con el digito de control de la cuenta (j)
		$suma = 0;
		$suma += $ccc[10] * 1; $suma += $ccc[11] * 2; $suma += $ccc[12] * 4;
		$suma += $ccc[13] * 8; $suma += $ccc[14] * 5; $suma += $ccc[15] * 10;
		$suma += $ccc[16] * 9; $suma += $ccc[17] * 7; $suma += $ccc[18] * 3; 
		$suma += $ccc[19] * 6; 
		$resto = $suma % 11;
		if ($resto < 2):
			$digito2 = $resto;
		else:
			$digito2 = 11 - $resto;
		endif;
		if ($digito2 != $ccc[9]) return false;
		return true;
	}
}
