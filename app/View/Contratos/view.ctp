<?php $this->Html->addCrumb('Contratos', array(
	'controller'=>'contratos',
	'action'=>'index'
	));
	$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'], array(
	'controller'=>'contratos',
	'action'=>'view',
	$contrato['Contrato']['id']
));
?>
<h2>Detalles Contrato <?php echo $contrato['Contrato']['referencia']?></h2>
<div class="actions">
	<?php
	echo $this->element('filtromuestra');
	?>
</div>
<div class="acciones">
<?php
	echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Modificar',array(
		'action'=>'edit',
		$contrato['Contrato']['id']),array('title'=>'Modificar Contrato','escape'=>false))
	.' '.$this->Form->postLink('<i class="fa fa-trash"></i> Borrar',array(
		'action'=>'delete',
		$contrato['Contrato']['id']),array(
		'escape'=>false, 'title'=> 'Borrar',
		'confirm'=>'¿Realmente quiere borrar el contrato '.$contrato['Contrato']['referencia'].'?')
	);
?>
</div>
	<div class='view'>
	<?php
	echo "<dl>";
	echo "  <dt>Referencia</dt>\n";
	echo "  <dd>".$contrato['Contrato']['referencia'].'&nbsp;'."</dd>";
	echo "  <dt>Proveedor</dt>\n";
	echo "<dd>";
	echo $this->html->link($contrato['Proveedor']['Empresa']['nombre_corto'], array(
		'controller' => 'proveedores',
		'action' => 'view',
		$contrato['Proveedor']['id'])
	);
	echo "</dd>";
	echo "  <dt>Calidad</dt>\n";
	echo "  <dd>".$contrato['CalidadNombre']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Lotes</dt>\n";
	echo "  <dd>".$contrato['Contrato']['lotes_contrato'].' ('.$posicion_bolsa.')&nbsp;'."</dd>";
	echo "  <dt>Peso</dt>\n";
	echo "  <dd>".$contrato['Contrato']['peso_comprado'].' kg&nbsp;'."</dd>";
	echo "  <table>\n";
	echo $this->html->tableheaders(array('cantidad','embalaje', 'peso ud.', 'peso'));
	$peso_total = 0;
	foreach($contrato['ContratoEmbalaje'] as $embalaje):
		$peso_embalaje = $embalaje['cantidad_embalaje'] * $embalaje['peso_embalaje_real'];
		echo $this->html->tablecells(array(
			$embalaje['cantidad_embalaje'],
			$embalaje['Embalaje']['nombre'],
			$embalaje['peso_embalaje_real']." kg",
			$peso_embalaje." kg",
			));
		$peso_total += $peso_embalaje;
	endforeach;
	echo "  </table>\n";
//	echo "  <dt>Fecha de embarque</dt>\n";
//	echo "  <dd>".$fecha_embarque."</dd>";
//	echo "  <dt>Fecha de entrega</dt>\n";
//	echo "  <dd>".$fecha_entrega."</dd>";
	echo "  <dt>$tipo_fecha_transporte</dt>\n";
	echo "  <dd>".$fecha_transporte."</dd>";
	echo "  <dt>Puerto de destino</dt>\n";
	echo "  <dd>".$contrato['Puerto']['nombre']."&nbsp;</dd>";
	echo "  <dt>Bolsa</dt>\n";
	echo "  <dd>".$contrato['CanalCompra']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Diferencial</dt>\n";
	echo "  <dd>".$contrato['Contrato']['diferencial']." ".$contrato['CanalCompra']['divisa']."</dd>";
	echo "  <dt>Incoterm</dt>\n";
	echo "  <dd>".$contrato['Incoterm']['nombre'].'&nbsp;'."</dd>";
	echo "  <dt>Comentarios</dt>\n";
	echo "  <dd>".$contrato['Contrato']['comentario'].'&nbsp;'."</dd>";
	echo "</dl>";?>
	<div class="detallado">
	<h3>Operaciones</h3>
<table>
<?php
	$peso_fijado = 0;
	echo $this->html->tableheaders(array('referencia','peso','fecha de fijación', 'precio de fijación', 'precio de factura'));
	foreach($contrato['Operacion'] as $linea):
		//guardamos el total del peso de las líneas para calcular
		//lo que falta por fijar
		$peso_fijado += $linea['PesoOperacion']['peso'];
		echo $this->html->tablecells(array(
			$linea['referencia'],
			$linea['PesoOperacion']['peso']." kg",
			$linea['fecha_pos_fijacion'],
			$linea['precio_fijacion']." ".$contrato['CanalCompra']['divisa'],
			$linea['precio_compra']." ".$contrato['CanalCompra']['divisa'],
			$this->html->link(
				'<i class="fa fa-info-circle"></i>',
				array(
					'controller'=>'operaciones',
					'action'=>'view',
					$linea['id']),
				array(
					'class'=>'botond',
					'escape' => false,
					'title'=>'detalles')
			)
		));
	endforeach;
?>
</table>
<?php
	//calculamos la cantidad que queda por fijar
	$queda_por_fijar = $contrato['Contrato']['peso_comprado'] - $peso_fijado; 
	echo "<em>Quedan por fijar ".$contrato['RestoLotesContrato']['lotes_restantes']
		." lotes (".$queda_por_fijar."kg)</em>";
	echo '<div class="btabla">';
	echo $this->html->link('<i class="fa fa-plus"></i> añadir operacion',array(
		'controller' => 'operaciones',
		'action' => 'add',
		'from_controller' => 'contratos',
		'from_id' => $contrato['Contrato']['id']),
		 array('escape' => false,'title'=>'añadir operacion'));
?>
		</div>
	</div>
</div>
