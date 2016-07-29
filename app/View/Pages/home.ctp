<html>
<body>
<h1 style="text-align:center;">Bienvenido a la gestión de COMERCIAL DE MATERIAS PRIMAS </h1>
<br><br>
<ul class="portada">
		<li>&nbsp;&nbsp;<i class="fa fa-shopping-cart fa-3x"></i> <b>COMERCIAL</b><br>
			<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?>
				</li>
				<li><?php echo $this->Html->link('CONTRATO','/contratos',array('escape' => false));?>
				</li>
			</ul>
		</li>
		<li>&nbsp;&nbsp;<i class="fa fa-flask fa-3x"></i> <b>LABORATORIO</b><br>
				<ul>
				<li><?php echo $this->Html->link('OFERTA','/muestras/index/Search.tipo_id:1',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('EMBARQUE','/muestras/index/Search.tipo_id:2	',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ENTREGA','/muestras/index/Search.tipo_id:3',array('escape' => false));?></li>
				</ul>
			</li>
			<li>&nbsp;&nbsp;<i class="fa fa-ship fa-3x"></i> <b>TRÁFICO</b><br>
				<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones/index_trafico',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ALMACENES','/almacen_transportes',array('escape' => false));?></li>		
				<li><?php echo $this->Html->link('RETIRADAS','/retiradas',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FLETES','/fletes',array('escape' => false));?></li>				
				</ul>
			</li>

		<li>&nbsp;&nbsp;<i class="fa fa-money fa-3x"></i> <b>CONTABILIDAD</b><br>
			<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FINANCIACIÓN','/financiaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FACTURACIÓN','/facturaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('RETIRADAS','/retiradas/index_conta',array('escape' => false));?></li>
			</ul>
		</li>
</ul>
<iframe frameborder="0" scrolling="no" height="350" width="300" allowtransparency="true" marginwidth="0" marginheight="0" src="http://tools.es.forexprostools.com/market_quotes.php?tabs=3,1,2,4&tab_1=1,2,6&tab_2=166,167,174&tab_3=8832,8833,8911&tab_4=8880,8907,8886&select_color=000000&default_color=0059b0"></iframe>
</body>
</html>