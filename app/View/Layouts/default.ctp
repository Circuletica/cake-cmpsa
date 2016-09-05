<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'CMPSA Gestión');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css(array('cake.generic','cake.concreto','font-awesome-4.4.0/css/font-awesome.min.css'));
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
echo $this->Html->script('cmpsa');//incluye funciones javascript
?>
</head>
<body>
<div id="header">
	<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
	<div id="cssmenu">
	<ul>
		<!--<li class="active"><a href="/">Inicio</a></li>-->
		<li class="has-sub"><?php echo $this->Html->link('<i class="fa fa-shopping-cart"></i> COMERCIAL','#',array('escape' => false));?>
			<ul>
				<li class="has-sub"><?php echo $this->Html->link('Contrato','/contratos',array('escape' => false));?>
					<ul>
						<li class="last"><?php echo $this->Html->link('Peso Pendiente','/contratos/index_left',array('escape' => false));?></li>
					</ul>
				</li>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?></li>
			</ul>
		</li>
		<li><?php echo $this->Html->link('<i class="fa fa-flask"></i> LABORATORIO','#',array('escape' => false));?>
			<ul>
				<li><?php echo $this->Html->link('OFERTA','/muestras/index/Search.tipo_id:1',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('EMBARQUE','/muestras/index/Search.tipo_id:2	',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ENTREGA','/muestras/index/Search.tipo_id:3',array('escape' => false));?></li>
			</ul>
		</li>
		<li class="has-sub"><?php echo $this->Html->link('<i class="fa fa-ship"></i> TRAFICO','#', array('escape' => false));?>
			<ul>
				<li class="has-sub"><?php echo $this->Html->link('Operación','/operaciones/index_trafico',array('escape' => false));?>
					<ul>
						<li><?php echo $this->Html->link('Despachos','/transportes/index',array('escape' => false));?></li>
						<li><?php echo $this->Html->link('Embarque','/transportes/embarque',array('escape' => false));?></li>
						<li><?php echo $this->Html->link('Supl. sin reclamación','/transportes/suplemento',array('escape' => false));?></li>
						<li><?php echo $this->Html->link('Pediente de adjudicar','/almacen_transportes/pendiente',array('escape' => false));?></li>
						<li><?php echo $this->Html->link('Sin reclamación pendientes','/transportes/reclamacion_factura',array('escape' => false));?></li>
						<li class="last"><?php echo $this->Html->link('Prorrogas pendientes','/transportes/prorrogas_pendientes',array('escape' => false));?></li>

					</ul>
				</li>
				<li><?php echo $this->Html->link('CUENTAS ALMACÉN','/almacen_transportes',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('RETIRADA','/retiradas',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FLETES','/fletes',array('escape' => false));?></li>
			</ul>
		</li>
		<li class="last"><?php echo $this->Html->link('<i class="fa fa-money"></i> CONTABILIDAD','#',array('escape' => false));?>
			<ul>
				<li><?php echo $this->Html->link('OPERACIÓN','/operaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FINANCIACIÓN','/financiaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ANTICIPOS','/anticipos',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('FACTURACIÓN','/facturaciones',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('RETIRADA','/retiradas/index_conta',array('escape' => false));?></li>
			</ul>
		</li>
		<li><?php echo $this->Html->link('<i class="fa fa-database"></i> DATOS','/pages/gestiondatos',array('escape' => false));?>
		<li><a href="/users/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
	</ul>
	</div>
		<?php //echo $this->Html->link('Salir','/users/logout',array('class'=> 'salir','escape' => false));?>
</div>
	<div id="content">
		<div id="bread">
			<i class="fa fa-home"></i>
			<?php echo $this->Html->getCrumbs(' > ', 'Inicio');	?>
		</div>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>

	</div>

	<div id="footer">
		<?php echo '<p style="text-align:center;">&nbsp&nbsp'.$cakeVersion.' - Optimizado para resolución superior a 1280x720</p>'; ?>
	</div>
	<?php echo $this->Js->writeBuffer(); //write cached scripts ?>
</body>
</html>
