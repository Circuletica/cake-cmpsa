<h1>Bienvenido a la gestión de COMERCIAL DE MATERIAS PRIMAS </h1>

<ul class="portada">
<li><?php echo $this->Html->link('<i class="fa fa-money fa-3x"></i> <br>CONTABILIDAD','/pages/contabilidad',array('escape' => false));?></li>
		<li><?php echo $this->Html->link('<i class="fa fa-flask fa-3x"></i> <br>LABORATORIO','#',array('escape' => false));?>
				<ul>
				<li><?php echo $this->Html->link('OFERTA','/muestras/index/Search.tipo_id:1',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('EMBARQUE','/muestras/index/Search.tipo_id:2	',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ENTREGA','/muestras/index/Search.tipo_id:3',array('escape' => false));?></li>
				</ul>
			</li>

			<li><?php echo $this->Html->link('<i class="fa fa-ship fa-3x"></i> <br>TRÁFICO','/operaciones', array('escape' => false));?></li>
			<li><?php echo $this->Html->link('<i class="fa fa-shopping-cart fa-3x"></i> <br>COMERCIAL','/pages/compras',array('escape' => false));?></li>
</ul>
<script type='text/javascript' src='http://www.aemet.es/es/eltiempo/prediccion/municipios/launchwidget/madrid-id28079?w=g3p10010011ovmffffffw300z275x3F8EC1t42B4D6r1s3n2'></script>