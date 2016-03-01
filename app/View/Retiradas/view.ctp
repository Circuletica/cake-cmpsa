<?php
$this->extend('/Common/view');
$this->assign('id',$retiradas['Retirada']['id']);
$this->assign('object', 'Retirada del asociado '.$retiradas['Asociado']['nombre_corto']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');

$this->Html->addCrumb('Operación'.$retiradas['Operacion']['referencia'],
	array(
		'controller' => 'operaciones',
		'action'=>'view_trafico',
		 $retiradas['Operacion']['id']
		 )
	);
$this->Html->addCrumb('Retiradas','/retiradas');
$this->Html->addCrumb($retiradas['Asociado']['nombre_corto'],
		array(
		'controller' => 'retiradas',
		'action'=>'view',
		 $retiradas['Retirada']['id']
		 )
	);


$this->start('filter');

echo "Filtro de búsqueda de las retiradas";

$this->end();

$this->start('main');
echo "<dl>";
	echo "  <dt>Operación:</dt>\n";
	echo "<dd>";
	echo $this->html->link($retiradas['Operacion']['referencia'], array(
	    'controller' => 'operaciones',
	    'action'  => 'view',
	    $retiradas['Operacion']['id'])
	);
	echo "</dd>";
/*		echo "<dt>Sacos solicitados:</dt>\n";
	echo "<dd>".$retiradas['Retirada']['Operacion']['AsociadoOperacion']['cantidad_embalaje_asociado'].'&nbsp;'."</dd>";
		echo "<dt>Peso solicitado:</dt>\n";
	echo "<dd>".$retiradas['Operacion']['AsociadoOperacion']['cantidad_embalaje_asociado'].'&nbsp;'."</dd>";*/
		echo "<dt>Fecha retirada:</dt>\n";
	echo "<dd>".$this->Date->format($retiradas['Retirada']['fecha_retirada']).'&nbsp;'."</dd>";
		echo "<dt>Sacos retirados:</dt>\n";
	echo "<dd>".$retiradas['Retirada']['embalaje_retirado'].'&nbsp;'."</dd>";
		echo "<dt>Peso retirado:</dt>\n";
	echo "<dd>".$retiradas['Retirada']['peso_retirado'].'&nbsp;'."</dd>";
		echo "<dt>Almacén:</dt>\n";
	echo "<dd>".$retiradas['AlmacenTransporte']['Almacen']['nombre_corto'].'&nbsp;'."</dd>";
		echo "<dt>Ref. Almacén:</dt>\n";
	echo "<dd>".$retiradas['AlmacenTransporte']['cuenta_almacen'].'&nbsp;'."</dd>";
		echo "<dt>Marca en Almacén:</dt>\n";
	echo "<dd>".$retiradas['AlmacenTransporte']['marca_almacen'].'&nbsp;'."</dd>";
echo "</dl>";
$this->end();
?>
		</div>
</div>
