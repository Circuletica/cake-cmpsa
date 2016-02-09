<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada del asociado '.$asociado_nombre);
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
	echo $this->html->link($operacion_ref, array(
	    'controller' => 'operaciones',
	    'action'  => 'view',
	    $operacion_id)
	);
	echo "</dd>";
	echo "<dt>Sacos solicitados:</dt>\n";
	//echo "<dd>".$retirada['Operacion']['AsociadoOperacion']['cantidad_embalaje_asociado'].'&nbsp;'."</dd>";
	echo "<dt>Peso solicitado:</dt>\n";
//	echo "<dd>".$retirada['Operacion']['AsociadoOperacion']['cantidad_embalaje_asociado'].'&nbsp;'."</dd>";
echo "</dl>";

$this->end();
$this->start('lines');
echo "<table>\n";
echo $this->Html->tableHeaders(array('Fecha retirada','Cuenta almacén','Almacén','Marca','Sacos retirados','Peso retirado', 'Detalle'));

foreach($retiradas as $retirada):
		echo $this->Html->tableCells(
			array(
				$this->Date->format($retirada['Retirada']['fecha_retirada']),
				$retirada['AlmacenTransporte']['cuenta_almacen'],
				$retirada['AlmacenTransporte']['Almacen']['nombre_corto'],
				$retirada['AlmacenTransporte']['marca_almacen'],
				$retirada['Retirada']['embalaje_retirado'],
				$retirada['Retirada']['peso_retirado'],
				$this->Button->editLine('retiradas',
				$retirada['Retirada']['id'],'retiradas',
				$retirada['Retirada']['id'])
			.' '.$this->Button->deleteLine('retiradas',
					$retirada['Retirada']['id'],
					'retiradas',
					$retirada['Retirada']['id'],
					'la retirada del día: '.$this->Date->format($retirada['Retirada']['fecha_retirada']
					)
				)
			)
		);
	
endforeach;?>
</table>
<?php
$this->end();
?>
		</div>
</div>
