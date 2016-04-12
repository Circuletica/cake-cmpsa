<?php
echo date("d-m-Y", strtotime("-1 month"));
echo '////////////';
echo date("d-m-Y");
if(date("d-m-Y", strtotime("-1 month")) < date("d-m-Y")){
	echo 'va';
}

?>