<?php
	$this->Html->addCrumb('Contratos', array(
		'controller' => 'contratos',
		'action' => 'index')
	); ?>

<div class="printdet">
<?php // Botones de impresión
    echo $this->element('imprimirI');
    echo "</div>";
    echo "<h2>$title</h2>";
    echo '<div class="actions">';
    echo "<h3>Búsqueda</h3>\n";
    echo $this->element('filtrocontrato'); //Elemento del buscador de contrato
?>
	</div>
	<div class='index'>
    <?php
	if (empty($contratos)):
		echo "No hay contratos en esta lista";
	else:
	echo "<table>\n";
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('Contrato.referencia','Referencia'),
		$this->Paginator->sort('Proveedor.nombre_corto','Proveedor'),
		$this->Paginator->sort('Incoterm.nombre','Incoterm'),
		$this->Paginator->sort('Contrato.calidad','Calidad'),
		$this->Paginator->sort('Contrato.peso_comprado','Peso'),
		$this->Paginator->sort('CanalCompra.nombre','Bolsa'),
		$this->Paginator->sort('Contrato.lotes_contrato','Lotes'),
		$this->Paginator->sort('Contrato.posicion_bolsa','Posición'),
		'Apr. Emb.',
		'Apr. Entr.',
		'Detalle')
	);
	foreach($contratos as $contrato):
		//mysql almacena la fecha en formato ymd
		$fecha = $contrato['Contrato']['posicion_bolsa'];
		//sacamos el nombre del mes en castellano
		setlocale(LC_TIME, "es_ES.UTF-8");
		$mes = strftime("%B", strtotime($fecha));
		$anyo = substr($fecha,0,4);
		$posicion_bolsa = $mes.' '.$anyo;
		echo $this->Html->tableCells(array(
			$contrato['Contrato']['referencia'],
			$contrato['Proveedor']['nombre_corto'],
			$contrato['Incoterm']['nombre'],
			$contrato['Contrato']['calidad'],
			$contrato['Contrato']['peso_comprado'].'kg',
			$contrato['CanalCompra']['nombre'],
			$contrato['Contrato']['lotes_contrato'],
			$posicion_bolsa,
			$contrato['Contrato']['si_muestra_emb_aprob']?'&#10004;':'',
			$contrato['Contrato']['si_muestra_entr_aprob']?'&#10004;':'',
			$this->Button->view('contratos',$contrato['Contrato']['id'])
	));
	endforeach;?>
	</table>
		<div class="btabla">
		<?php echo $this->Button->add('contratos','Contrato'); ?>
		</div>
	<?php
	echo $this->Paginator->counter(
	array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}'));
	?>

	<div class="paging">
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class'=>'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next('siguiente >', array(), null, array('class'=>'next disabled')); ?>
	</div>
	<?php endif; ?>

</div>

