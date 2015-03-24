<?php $this->Html->addCrumb('Muestras', array(
	'controller'=>'muestras',
	'action'=>'index'
	));
	$this->Html->addCrumb('Muestra '.$linea['Muestra']['referencia'], array(
	'controller'=>'muestras',
	'action'=>'view',
	$linea['Muestra']['id']
));
?>
<?php
	echo "<div class='actions'>\n";
	echo $this->Html->link('Modificar',array(
		'action'=>'edit',
		$linea['LineaMuestra']['id'])
	);
	echo "\n";
	echo '<p>';
	echo $this->Form->postLink('Borrar',array(
		'action'=>'delete',
		$linea['LineaMuestra']['id']),
		array('confirm'=>'Realmente quiere borrar '.$linea['LineaMuestra']['marca'].'?')
	);
	echo "\n";
	echo "</div>\n";
?>
<div class="index">
<h2>Detalles Línea <?php echo $linea['LineaMuestra']['marca']?> de muestra <?php echo $linea['Muestra']['referencia']?></h2>
</div>
<?php
	echo "<div class='view'>\n";
	echo "<dl>";
	echo "  <dt>Id</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['id'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Marca</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['marca'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Núm. de sacos</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['numero_sacos'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Ref. Proveedor</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['referencia_proveedor'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Referencia Almacen</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['referencia_almacen'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Humedad</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['humedad'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>tueste</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['tueste'];
	echo "</dd>";
	echo "  <dt>Defecto</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['defecto'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Apreciación</dt>\n";
	echo "<dd>";
	echo $linea['LineaMuestra']['apreciacion_bebida'].'&nbsp;';
	echo "</dd>";
	echo "  <dt>Criba</dt>\n";
	echo "<dd>";
	echo "<table>";
	echo $this->Html->tableHeaders(array('&nbsp;', 'Medida original', 'Medida ponderada'));
	echo $this->Html->tableCells(array(
		'Criba 20',
		$linea['LineaMuestra']['criba20'],
		$linea['CribaPonderada']['criba20']));
	echo $this->Html->tableCells(array(
		'Criba 19',
		$linea['LineaMuestra']['criba19'],
		$linea['CribaPonderada']['criba19']));
	echo $this->Html->tableCells(array('Criba 13p', $linea['LineaMuestra']['criba13p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 18',
		$linea['LineaMuestra']['criba18'],
		$linea['CribaPonderada']['criba18']));
	echo $this->Html->tableCells(array('Criba 12p', $linea['LineaMuestra']['criba12p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 17',
		$linea['LineaMuestra']['criba17'],
		$linea['CribaPonderada']['criba17']));
	echo $this->Html->tableCells(array('Criba 11p', $linea['LineaMuestra']['criba11p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 16',
		$linea['LineaMuestra']['criba16'],
		$linea['CribaPonderada']['criba16']));
	echo $this->Html->tableCells(array('Criba 10p', $linea['LineaMuestra']['criba10p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 15',
		$linea['LineaMuestra']['criba15'],
		$linea['CribaPonderada']['criba15']));
	echo $this->Html->tableCells(array('Criba 9p', $linea['LineaMuestra']['criba9p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 14',
		$linea['LineaMuestra']['criba14'],
		$linea['CribaPonderada']['criba14']));
	echo $this->Html->tableCells(array('Criba 8p', $linea['LineaMuestra']['criba8p'], '&nbsp;'));
	echo $this->Html->tableCells(array(
		'Criba 13',
		$linea['LineaMuestra']['criba13'],
		$linea['CribaPonderada']['criba13']));
	echo $this->Html->tableCells(array(
		'Criba 12',
		$linea['LineaMuestra']['criba12'],
		$linea['CribaPonderada']['criba12']));
	echo $this->Html->tableCells(array(
		'Total',
		array($suma_linea."%",array('class' => 'total')),
		array($suma_ponderada."%",array('class' => 'total'))
		));
//	echo "<tr>";
//	echo "<td>";
//	echo "<table>";
//	echo "<tr><td>Criba 20</td></tr>";
//	echo "<tr><td>Criba 19</td></tr>";
//	echo "<tr><td>Criba 13p</td></tr>";
//	echo "<tr><td>Criba 18</td></tr>";
//	echo "<tr><td>Criba 12p</td></tr>";
//	echo "<tr><td>Criba 17</td></tr>";
//	echo "<tr><td>Criba 11p</td></tr>";
//	echo "<tr><td>Criba 16</td></tr>";
//	echo "<tr><td>Criba 10p</td></tr>";
//	echo "<tr><td>Criba 15</td></tr>";
//	echo "<tr><td>Criba 9p</td></tr>";
//	echo "<tr><td>Criba 14</td></tr>";
//	echo "<tr><td>Criba 8p</td></tr>";
//	echo "<tr><td>Criba 13</td></tr>";
//	echo "<tr><td>Criba 12</td></tr>";
//	echo "</table>";
//	echo "</td>";
//	echo "<td>";
//	echo "<table>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba20']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba19']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba13p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba18']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba12p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba17']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba11p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba16']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba10p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba15']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba9p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba14']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba8p']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba13']."</td></tr>";
//	echo "<tr><td>".$linea['LineaMuestra']['criba12']."</td></tr>";
//	echo "</table>";
//	echo "</td>";
//	echo "<td>";
//	echo "<table>";
//	echo "</table>";
//	echo "</td>";
//	echo "</tr>";
	echo "</table>"."&nbsp;";
	echo "</dd>";
	echo "</dl>";
	echo "</div>";
?>
