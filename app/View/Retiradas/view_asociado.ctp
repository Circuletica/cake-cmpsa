<?php
$this->extend('/Common/view_withoutbuttons');
$this->assign('object', 'Retirada del asociado '.$asociado_nombre['Asociado']['nombre_corto']);
//$this->assign('line_object', 'precio');
//$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
$this->assign('line_controller','retiradas');

$this->start('main');
echo "<dl>";
	echo "  <dt>Operación:</dt>\n";
	echo "<dd>";
	echo $this->html->link($operacion['Operacion']['referencia'], array(
	    'controller' => 'operaciones',
	    'action'  => 'view',
	    $operacion_id)
	);
	echo "</dd>";
	echo "<dt>Sacos solicitados:</dt>\n";
	echo "<dd>".$asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'].' x '.$embalaje['Embalaje']['nombre'].'&nbsp';
		"</dd>";
	echo "<dt>Peso solicitado:</dt>\n";
	 $peso = $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'] * $embalaje['ContratoEmbalaje']['peso_embalaje_real'];
	echo "<dd>".$peso.' Kg &nbsp;'."</dd>";
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
				$this->Button->editLine('retiradas',$retirada['Retirada']['id'],'operaciones',$retirada['Retirada']['operacion_id'])
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

echo "<h4>Retiradas: ".$retirado.' / Restan: '.$restan;
			if ($retirado < $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado']){
			echo '<div class="btabla">';
				echo $this->Button->addLine('retiradas','operaciones',$retirada['Retirada']['operacion_id'],'retirada de '.$asociado_nombre['Asociado']['nombre_corto']);
			echo '</div>';
			}else{
				echo " - "."<span style=color:#c43c35;>Todos los bultos han sido almacenados</span></h4>";
			}
?>
<br><br>
<?php
    echo $this->Html->Link('<i class="fa fa-arrow-left"></i> Volver', 
    	$this->request->referer(''), array('class' => 'botond',
    	'escape'=>false
    	)
    );
	$this->end();

?>
		</div>
</div>
