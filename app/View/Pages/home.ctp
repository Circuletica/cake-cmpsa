<html>
<body>
<h1>Bienvenido a la gestión de COMERCIAL DE MATERIAS PRIMAS </h1>

<ul class="portada">
		<li><?php echo $this->Html->link('<i class="fa fa-shopping-cart fa-3x"></i> <br>COMERCIAL','/contratos',array('escape' => false));?>
			<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?>
				</li>
				<li><?php echo $this->Html->link('CONTRATO','/contratos',array('escape' => false));?>
				</li>
			</ul>
		</li>
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
				<li><?php echo $this->Html->link('RETIRADAS','/retiradas',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FLETES','/fletes',array('escape' => false));?></li>				
				</ul>
			</li>

		<li><?php echo $this->Html->link('<i class="fa fa-money fa-3x"></i><br>CONTABILIDAD','#',array('escape' => false));?>
			<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FINANCIACIÓN','/financiaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FACTURACIÓN','/facturaciones',array('escape' => false));?></li>
			</ul>
		</li>
</ul>
<script type='text/javascript' src='http://www.aemet.es/es/eltiempo/prediccion/municipios/launchwidget/madrid-id28079?w=g4p01110001ovmffffffw270z365x4f86d9t95b6e9r1s8n2'></script><noscript><a target='_blank' style='font-weight: bold;font-size: 1.20em;' href='http://www.aemet.es/es/eltiempo/prediccion/municipios/madrid-id28079'>El Tiempo. Consulte la predicción de la AEMET para Madrid</a></noscript><br>
</body>
</html>