<?php
$this->extend('/Common/view');
$this->assign('titulo', 'Flete '.$referencia);
$this->assign('id',$flete['Flete']['id']);
$this->assign('clase','Flete');
$this->assign('controller','fletes');
$this->Html->addCrumb('Fletes', array(
	'controller'=>'fletes',
	'action'=>'index'
));
$this->start('filtro');
?>
<div class="actions">
	<?php echo $this->element('filtroflete'); ?>
</div>
<?php $this->end()?>
<div class='view'>
	<?php
		echo "<dl>";
		echo "  <dt>Naviera:</dt>\n";
		echo "  <dd>".$flete['Naviera']['Empresa']['nombre_corto'].'&nbsp;'."</dd>";
		echo "  <dt>Puerto de Carga:</dt>\n";
		echo "  <dd>".$flete['PuertoCarga']['nombre'].'&nbsp;'."</dd>";
		echo "  <dt>Puerto de Destino:</dt>\n";
		echo "  <dd>".$flete['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
		echo "  <dt>Tipo embalajes:</dt>\n";
		echo "  <dd>".$flete['Embalaje']['nombre'].'&nbsp;'."</dd>";
		echo "  <dt>Peso contenedor:</dt>\n";
		echo "  <dd>".$flete['Flete']['peso_contenedor_tm'].'Tm&nbsp;'."</dd>";
		echo "</dl>";
		//la tabla con los costes de flete
		echo "<table>";
			echo $this->Html->tableHeaders(array(
				'válido desde','válido hasta','coste contenedor','coste $/Tm'));
			foreach ($costes as $coste):
				echo $this->Html->tableCells(array(
					$coste['PrecioFlete']['fecha_inicio'],
					$coste['PrecioFlete']['fecha_fin'],
					$coste['PrecioFlete']['coste_contenedor_dolar'],
					$coste['PrecioFlete']['coste_contenedor_dolar']
					)
				);
			endforeach;
		echo "</table>";
?>
</div>
