<?php
App::uses('AppHelper', 'View/Helper');
class DateHelper extends AppHelper {
    public function format($date="") {
       $year = substr($date,0,4);
	$month = substr($date,5,2);
	$day = substr($date,8,2);
	return $day.'-'.$month.'-'.$year;
}
}
?>
