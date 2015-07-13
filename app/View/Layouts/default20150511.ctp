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
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('cake.concreto');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="header">
	<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
	<?php echo $this->Html->getCrumbs(' > ', 'Inicio');	?>

	<div id="tabs"> 
		<ul>
			<li><?php echo $this->Html->link('Contabilidad','/pages/contabilidad',array('class'=>'button'));?></li>
			<li><?php echo $this->Html->link('Laboratorio-Calidad','/pages/laboratorio',array('class'=>'button'));?></li>
			<li><?php echo $this->Html->link('Transporte-Tráfico','/pages/trafico',array('class'=>'button'));?></li>
			<li><?php echo $this->Html->link('Comercial-Compras','/pages/compras',array('class'=>'button'));?></li>
		</ul>	
	</div>
</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>

		</div>
				
		
		<div id="footer">
			<div id="tabs">
				<ul>
					<li><?php echo $this->Html->link('Informes','/pages/informes',array('class'=>'button'));?></li>
					<li ><?php echo $this->Html->link('Preferencias','/pages/preferencias',array('class'=>'button'));?></li>
					<li><?php echo $this->Html->link('Gestión Datos','/pages/gestiondatos',array('class'=>'button'));?></li>
				</ul>
			</div>
					<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered'));
					?>

			
				<?php 
				echo $cakeVersion;
				echo "   - Optimizado para resolución superior a 1280x720";	 ?>
			
		</div>
	
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
