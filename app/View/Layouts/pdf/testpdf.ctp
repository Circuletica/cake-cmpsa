<?php echo $this->Html->docType('xhtml-trans'); ?>
<html>
<div id = "header" style="background-image:url(<?php echo $this->webroot; ?>img/BannerGradient.jpg);">
<head>

    <title> <?php echo $title_for_layout; ?></title>
    <?php echo $this->Html->css($stylesheet_used); ?>
    <?php echo $this->Html->script(array('jquery','modal.popup')); ?>


    <div id='logo'> <center>
    <?php echo $this->Html->image($image_used, array(
    "alt" => "eBox",
    'url' => array('controller' => 'eboxs', 'action' => 'home_admin'))) ?>
    </center></div>
    <div id="welcome">

    <?php if($logged_in): ?>
         Logged in as <text6><?php echo $current_user['username']; ?></text6> <?php echo $this->Html->link('My Profile', array('controller'=>'Accounts', 'action'=>'index')); ?> | <?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')); ?>
    <?php else: ?>
    <?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login')); ?>

    <?php endif; ?>

    </div>


</head>
</div>
<body>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>

</body>
</html>
