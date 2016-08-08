<?php
$this->extend('/Common/view');
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
	echo "  <dt>Ref. operación</dt>\n";
	echo "<dd>";
	echo $this->html->link($operacion['Operacion']['referencia'], array(
	    'controller' => 'operaciones',
	    'action'  => 'view_trafico',
	    $operacion_id)
	).'&nbsp;';
	echo "</dd>";
	echo "<dt>Sacos solicitados</dt>\n";
	echo "<dd>".$asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado'].' x '.$embalaje['nombre'].'&nbsp';
		"</dd>";
	echo "<dt>Peso solicitado</dt>\n";
	echo "<dd>".$peso.' Kg &nbsp;'."</dd>";
echo "</dl>";

$this->end();
$this->start('lines');
echo "<table class='tc1 tc2 tr5 tr6 tc7'>\n";
echo $this->Html->tableHeaders(array('Fecha retirada','Cuenta almacén','Almacén','Marca','Sacos retirados','Peso retirado', 'Detalle'));

foreach($retiradas as $retirada):
		echo $this->Html->tableCells(
			array(
				$this->Date->format($retirada['Retirada']['fecha_retirada']),
				$this->html->link($retirada['AlmacenTransporte']['cuenta_almacen'], array(
					'controller' => 'almacen_transportes',
					'action'  => 'view',
					$retirada['Retirada']['almacen_transporte_id']
					)
				),
				$retirada['AlmacenTransporte']['Almacen']['nombre_corto'],
				$retirada['AlmacenTransporte']['marca_almacen'],
				$retirada['Retirada']['embalaje_retirado'],
				$retirada['Retirada']['peso_retirado'],
				$this->Html->link(
						'<i class="fa fa-pencil-square-o"></i>',array(
							'controller' => 'retiradas',
							'action' => 'edit',
							$retirada['Retirada']['id'],
							'asociado_id'=>$this->params['named']['asociado_id'],
							'from_controller' => 'operaciones',
							'from_id' => $retirada['Retirada']['operacion_id']
							),
						array(
							'class' => 'botond',
							'title' => 'Modificar',
							'escape' => false
							)
				)
			.' '.$this->Button->deleteLine('retiradas',	$retirada['Retirada']['id'],'operaciones',$retirada['Retirada']['operacion_id'],
					'la retirada del día: '.$this->Date->format($retirada['Retirada']['fecha_retirada']
					)
					)
			/*.
			$this->Html->link('<i class="fa fa-trash"></i>',
				    array(
					'controller' => 'retiradas',
					'asociado_id' => $this->params['named']['asociado_id'],
					'action' => 'delete',
					$retirada['Retirada']['id'],
					'from_controller' => 'operaciones',
					'from_id' => $retirada['Retirada']['operacion_id']
				    ),
				    array(
					'class' => 'botond',
					'escape' => false,
					'title' => 'Borrar',
					'confirm' => '¿Seguro que quieres borrar la retirada del día: '.$this->Date->format($retirada['Retirada']['fecha_retirada'].'?'	)
					)
			)	*/
			));
				
endforeach;?>
</table>
<?php

echo "<h4>Retiradas: ".$retirado.' / Restan: '.$restan;
			if (($retirado < $asociado_op['AsociadoOperacion']['cantidad_embalaje_asociado']) && $cuenta_almacen['cuenta_almacen']!= NULL ){
			echo '<div class="btabla">';
				echo $this->Html->link(
						'<i class="fa fa-plus"></i> Añadir retirada de '. $asociado_nombre['Asociado']['nombre_corto'],array(
							'controller' => 'retiradas',
							'action' => 'add',
							'asociado_id'=>$asociado_op['AsociadoOperacion']['asociado_id'],
							'from_controller' => 'operaciones',
							'from_id' => $operacion_id
							),
						array(
							'class' => 'botond',
							'title' => 'Añadir retirada de '. $asociado_nombre['Asociado']['nombre_corto'],
							'escape' => false
							)
				);
			echo '</div>';
			}elseif($cuenta_almacen['cuenta_almacen'] == NULL ){
				echo " - "."<span style=color:#c43c35;>Aún no se ha almacenado nada para poder retirar.</span></h4>";

			}else{
				echo " - "."<span style=color:#c43c35;>Todos los bultos han sido almacenados</span></h4>";
			}
?>
<br><br>
<?php
    echo $this->Html->Link('<i class="fa fa-arrow-left"></i> Volver', 
    	array(
    		'action'=>'view_trafico',
	   		'controller' => 'operaciones',
	   		$operacion_id
	   		),
     	array(
	  		'class' => 'botond',
    		'escape'=>false
    		)
     	);
	$this->end();

?>
		</div>
</div>
