<?php
App::uses('AppHelper', 'View/Helper');

class NumberHelper extends AppHelper {
	public function round($number) {
		return number_format((float)$number, 2, ',', '.');
	}
}
?>