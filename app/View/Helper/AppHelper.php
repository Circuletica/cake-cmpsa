<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class AppHelper extends Helper {
/**
 * Overwrite to make URLs absolute for PDF content.
 *
 * @param mixed $url
 * @param bool $full
 * @return string
 */
public function url($url = null, $full = false) {
	if (!empty($this->request->params['ext']) && $this->request->params['ext'] === 'pdf') {
		$full = true;
	}
	return parent::url($url, $full);
}
/**
 * Overwrite to make paths for assets absolute so they can be found by the PDF engine.
 *
 * @param string $path
 * @param array $options
 * @return string
 */
public function assetUrl($path, $options = array()) {
	if (!empty($this->request->params['ext']) && $this->request->params['ext'] === 'pdf') {
			$options['fullBase'] = true;
	}
	return parent::assetUrl($path, $options);
}
}?>