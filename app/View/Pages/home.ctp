<h1>Bienvenido a la gestión de COMERCIAL DE MATERIAS PRIMAS </h1>

<ul class="portada">
<li><?php echo $this->Html->link('<i class="fa fa-money fa-3x"></i><br>CONTABILIDAD','/pages/contabilidad',array('escape' => false));?></li>
		<li><?php echo $this->Html->link('<i class="fa fa-flask fa-3x"></i> <br>LABORATORIO','#',array('escape' => false));?>
				<ul>
				<li><?php echo $this->Html->link('OFERTA','/muestras/index/Search.tipo_id:1',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('EMBARQUE','/muestras/index/Search.tipo_id:2	',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ENTREGA','/muestras/index/Search.tipo_id:3',array('escape' => false));?></li>
				</ul>
			</li>
			<li><?php echo $this->Html->link('<i class="fa fa-ship fa-3x"></i> <br>TRÁFICO','/operaciones', array('escape' => false));?>
				<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones/index_trafico',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('RETIRADA','/retiradas',array('escape' => false));?></li>
				</ul>
			<li><?php echo $this->Html->link('<i class="fa fa-shopping-cart fa-3x"></i> <br>COMERCIAL','/contratos',array('escape' => false));?></li>
</ul>
</div>
