<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada');
//$this->assign('line_object', 'precio');
//$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
$this->assign('line_controller','retiradas');

$this->start('filter');
$this->end();

$this->start('main');
echo "<dl>";
	echo "  <dt>Operación:</dt>\n";
	echo "<dd>";
	echo $this->html->link($retirada['OperacionRetirada']['Operacion']['referencia'], array(
	    'controller' => 'operacion',
	    'action' => 'view',
	    $retirada['OperacionRetirada']['Operacion']['id'])
	);
	echo "  </dd>";
	echo "  <dt>Sacos solicitados:</dt>\n";
	echo "  <dd>".$retirada['Asociado']['AsociadoOperacion']['peso'].' kg&nbsp;'."</dd>";
	echo "  <dt>Peso solicitado:</dt>\n";
	echo "  <dd>".$retirada['Asociado']['AsociadoOperacion']['cantidad_embalaje']."</dd>";

		echo "<dd>";
		//mysql almacena la fecha en formato ymd
		$fecha = $retirada['Retirada']['fecha_retirada'];
		$dia = substr($fecha,8,2);
		$mes = substr($fecha,5,2);
		$anyo = substr($fecha,0,4);
		$fecha_retirada= $dia.'-'.$mes.'-'.$anyo;
		echo $fecha_retirada.'&nbsp;';
		echo "</dd>";
echo "</dl>";

$this->end();
$this->start('lines');
echo "<table>\n";
echo $this->Html->tableHeaders(array(
    'Cuenta Almacén','Almacén','Sacos retirados','Peso retirado'));

echo"</table>\n";
$this->end();
?>
		</div>
</div>
