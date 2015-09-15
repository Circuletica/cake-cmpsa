<?php
App::uses('AppHelper', 'View/Helper');

class ButtonHelper extends AppHelper {
    public $helpers = array('Html','Form');
    //dibujar un boton de 'editar', el tipico que aparece
    //en view(). Como variables pasamos:
    //$controller: el contralador de la clase del objeto a modificar
    //$id: el id del objeto que editamos
    //$from: la clase a la que volvemos después de terminar la modificación
    //$id: el id del objeto de la clase a la que volvemos después de modificar
    public function view($controller,$id) {
	    return $this->Html->link(
		 '<i class="fa fa-info-circle"></i>',
		array(
			'controller' => $controller,
			'action' => 'view',
			$id,
		),
		    array(
			'class' => 'botond',
			'title' => 'Modificar',
			'escape' => false
		    )
		);

    }
    public function edit($controller,$id) {
	    return $this->Html->link(
		    '<i class="fa fa-pencil-square-o"></i> Modificar',
		    array(
			'controller' => $controller,
			'action' => 'edit',
			$id,
		    ),
		    array(
			'class' => 'botond',
			'title' => 'Modificar',
			'escape' => false
		    )
		);
	}
    //la versión pequeña, solo el botón sin texto, con retorno
    //a la página 'padre'. Se usa en los listados dentro de una vista
    public function editLine($controller,$id,$from,$from_id) {
	    return $this->Html->link(
		    '<i class="fa fa-pencil-square-o"></i>',
		    array(
			'controller' => $controller,
			'action' => 'edit',
			$id,
			'from' => $from,
			'from_id' => $from_id
		    ),
		    array(
			'class' => 'botond',
			'title' => 'Modificar',
			'escape' => false
		    )
		);
	}
    //identico a los anteriores, pero para borrar
    public function delete($controller,$id,$objeto) {
	return $this->Form->postLink(
	    '<i class="fa fa-trash"></i> Borrar',
	    array(
		'controller' => $controller,
		'action' => 'delete',
		$id,
	    ),
	    array(
		'class' => 'botond',
		'escape' => false,
		'title' => 'Borrar',
		'confirm' => '¿Seguro que quieres borrar '.$objeto.'?'
		)
	);
    }
    public function deleteLine($controller,$id,$from,$from_id,$objeto) {
	return $this->Form->postLink(
	    '<i class="fa fa-trash"></i>',
	    array(
		'controller' => $controller,
		'action' => 'delete',
		$id,
		'from' => $from,
		'from_id' => $from_id
	    ),
	    array(
		'class' => 'botond',
		'escape' => false,
		'title' => 'Borrar',
		'confirm' => '¿Seguro que quieres borrar '.$objeto.'?'
		)
	);
    }
    public function add($controller,$objeto) {
	return $this->Html->link(
	    '<i class="fa fa-user-plus"></i> Añadir '.$objeto,
	    array(
		'controller' => $controller,
		'action' => 'add'
	    ),
	    array(
		'escape' => false,
		'title' => 'Añadir '.$objeto
	    )
	);
    }
    public function addLine($controller,$from,$from_id,$objeto) {
	return $this->Html->link(
	    '<i class="fa fa-plus"></i> Añadir '.$objeto,
	    array(
		'controller' => $controller,
		'action' => 'add',
		'from_controller' => $from,
		'from_id' => $from_id
	    ),
	    array(
		'escape' => false,
		'title' => 'Añadir '.$objeto
	    )
	);
    }
}
?>
