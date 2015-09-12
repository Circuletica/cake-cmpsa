<?php //$this->Html->getCrumbs(' > ');?>
<?php
	$this->Html->addCrumb('Contratos', array(
		'controller' => 'contratos',
		'action' => 'index')
	); ?>
<h2>Contratos</h2>
	<div class="actions">
		<?php	echo $this->element('desplegabledatos'); //Elemento del Desplegable Datos
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
		$this->Paginator->sort('Empresa.nombre_corto','Proveedor'),
		$this->Paginator->sort('Incoterm.nombre','Incoterm'),
		$this->Paginator->sort('CalidadNombre.nombre','Calidad'),
		$this->Paginator->sort('Contrato.peso_comprado','Peso'),
		$this->Paginator->sort('CanalCompra.nombre','Bolsa'),
		$this->Paginator->sort('Contrato.lotes_contrato','Lotes'),
		$this->Paginator->sort('Contrato.posicion_bolsa','Posición'),
		//El diferencial para view()
		//'Diferencial',
		//Las opciones en Operacion
		//'Opciones',
		'')
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
			$contrato['Empresa']['nombre_corto'],
			$contrato['Incoterm']['nombre'],
			$contrato['CalidadNombre']['nombre'],
			$contrato['Contrato']['peso_comprado'].'kg',
			$contrato['CanalCompra']['nombre'],
			$contrato['Contrato']['lotes_contrato'],
			$posicion_bolsa,
			$this->Html->link('Detalles',array('action'=>'view',$contrato['Contrato']['id']), array('class' =>'boton' , ))
	));

	endforeach;?>
	</table>
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
	<div class="btabla">
		<?php echo $this->Html->link('Añadir Contrato',array('action'=>'add')); ?>
	</div>
</div>
