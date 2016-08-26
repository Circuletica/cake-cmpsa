<div style="margin: 0 auto; width:300px">
    <?php echo $this->Flash->render('auth');
          echo $this->Form->create('User'); ?>
<h3 align="center">Acceso a la aplicacion de gestión</h3>
<h4 align="center">Por favor, introduzca su nombre y contraseña</h4>
                <?php //echo __('Por favor, introduzca su nombre y contraseña'); ?>

    <?php echo $this->Form->input(
        'username',
        array(
            'label' => 'Usuario'
        )
    );
    echo $this->Form->input(
        'password',
        array(
            'label' => 'Contraseña'
        )
    );
    echo $this->Form->end(__('Iniciar sesión')); ?>
</div>
