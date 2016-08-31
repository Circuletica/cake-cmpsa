<?php
$this->extend('/Common/pdf/viewPdf');
$this->assign('object', 'Retirada del asociado '.$asociado_nombre['Asociado']['nombre_corto']);
//$this->assign('line_object', 'precio');
//$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
$this->assign('line_controller','retiradas');
$this->assign('button_edit_delete',0);
$this->assign('print_pdf',0);

$this->start('main');
echo "<dl>";
	echo "  <dt>Operación</dt>\n";
	echo "<dd>";
	echo $operacion['Operacion']['referencia'];
	echo "</dd>";
	echo "<dt>Sacos solicitados</dt>\n";
	echo "<dd>".$asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'].' x '.$embalaje['nombre'].'&nbsp';
		"</dd>";
	echo "<dt>Peso solicitado</dt>\n";
	echo "<dd>".$peso.' Kg &nbsp;'."</dd>";
echo "</dl>";

$this->end();
$this->start('lines');
echo "<table class='tc5'>\n";
echo $this->Html->tableHeaders(array('Fecha retirada','Cuenta almacén','Almacén','Marca','Sacos retirados','Peso retirado'));
foreach($retiradas as $retirada){
		echo $this->Html->tableCells(
			array(
				$this->Date->format($retirada['Retirada']['fecha_retirada']),
				$retirada['AlmacenTransporte']['cuenta_almacen'],
				$retirada['AlmacenTransporte']['Almacen']['nombre_corto'],
				$retirada['AlmacenTransporte']['marca_almacen'],
				$retirada['Retirada']['embalaje_retirado'],
				$retirada['Retirada']['peso_retirado']
			)
		);
}
?>
</table>
<?php
$this->end();
?>
		</div>
</div>
