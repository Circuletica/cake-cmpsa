<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada del asociado '.$retirada['Asociado']['nombre_corto']);
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
	echo $this->html->link($retirada['Operacion']['referencia'], array(
	    'controller' => 'operaciones',
	    'action'  => 'view',
	    $retirada['Operacion']['id'])
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

foreach($retirada as $retiradas):
		echo $this->Html->tableCells(
			array(
				$this->Date->format($retiradas['fecha_retirada']),
				$retiradas['AlmacenTransporte']['cuenta_almacen'],
				$retiradas['AlmacenTransporte']['Almacen']['nombre_corto'],
				$retiradas['AlmacenTransporte']['marca_almacen'],
				$retiradas['embalaje_retirado'],
				$retiradas['peso_retirado'],
				$this->Button->editLine('retiradas',
				$retiradas['id'],'retiradas',
				$retiradas['Retirada']['id'])
			.' '.$this->Button->deleteLine('retiradas',
					$retiradas['id'],
					'retiradas',
					$retiradas['Retirada']['id'],
					'la retirada del día: '.$this->Date->format($retiradas['fecha_retirada']
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
