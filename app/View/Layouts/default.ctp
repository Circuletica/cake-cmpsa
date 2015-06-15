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
		echo $this->Html->css(array('cake.generic','cake.concreto'));
		echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="header">
	<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
		<div class="menuheader"> 
		<ul class="tabs">
			<li><?php echo $this->Html->link('<i class="fa fa-money"></i> CONTABILIDAD','/pages/contabilidad',array('escape' => false));?></li>
			<li><?php echo $this->Html->link('<i class="fa fa-flask"></i> LABORATORIO','#',array('escape' => false));?>
				<ul>
				<li><?php echo $this->Html->link('OFERTA','/muestras/index/Search.tipo_id:1',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('EMBARQUE','/muestras/index/Search.tipo_id:2	',array('escape' => false));?></li>
				<li><?php echo $this->Html->link('ENTREGA','/muestras/index/Search.tipo_id:3',array('escape' => false));?></li>
				</ul>
			</li>
			<li><?php echo $this->Html->link('<i class="fa fa-ship"></i> TRAFICO','/admin/operaciones', array('escape' => false));?></li>
			<li><?php echo $this->Html->link('<i class="fa fa-shopping-cart"></i> COMERCIAL','/pages/compras',array('escape' => false));?></li>
		</ul>	
	</div>
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
	
	</div>
			<div class="menufooter">
				<ul class="tabs">
					<li><?php echo $this->Html->link('<i class="fa fa-bar-chart"></i> INFORMES','/highcharts/highcharts_demo',array('escape' => false));?></li>
					<li ><?php echo $this->Html->link('<i class="fa fa-cog"></i> PREFERENCIAS','/pages/preferencias',array('escape' => false));?></li>
					<li><?php echo $this->Html->link('<i class="fa fa-database"></i> DATOS','/pages/gestiondatos',array('escape' => false));?></li>
				</ul>
			</div>
	
					<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered'));
					*/?>
			
				<?php echo '&nbsp&nbsp'.$cakeVersion.' - Optimizado para resolución superior a 1280x720'; ?>
			
		</div>
	
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
