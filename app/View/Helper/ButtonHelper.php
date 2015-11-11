<?php
App::uses('AppHelper', 'View/Helper');
class ButtonHelper extends AppHelper {
    public $helpers = array('Html','Form');
    public function view($controller,$id) {
	    return $this->Html->link(
		 '<i class="fa fa-info-circle"></i> ',
			array(
			'controller' => $controller,
			'action' => 'view',
			$id,
			),
		    array(
			'class' => 'boton',
			'title' => 'Detalle',
			'escape' => false
		    )
		);
    }
     //la versión pequeña, solo el botón sin texto, con retorno
    //a la página 'padre'. Se usa en los listados dentro de una vista
    public function viewLine($controller,$id,$from_controller,$from_id) {
	    return $this->Html->link(
		 '<i class="fa fa-info-circle"></i> ',
			array(
			'controller' => $controller,
			'action' => 'view',
			$id,
			'from_controller' => $from,
			'from_controller' => $from_controller,
			'from_id' => $from_id
		    ),
		    array(
			'class' => 'boton',
			'title' => 'Detalle línea',
			'escape' => false
		    )
		);
    }    
    //dibujar un boton de 'editar', el tipico que aparece
    //en view(). Como variables pasamos:
    //$controller: el contralador de la clase del objeto a modificar
    //$id: el id del objeto que editamos
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
    public function editLine($controller,$id,$from_controller,$from_id) {
	    return $this->Html->link(
		    '<i class="fa fa-pencil-square-o"></i>',
		    array(
			'controller' => $controller,
			'action' => 'edit',
			$id,
			'from_controller' => $from_controller,
			'from_id' => $from_id
		    ),
		    array(
			'class' => 'botond',
			'title' => 'Modificar línea',
			'escape' => false
		    )
		);
	}
    //identico a los anteriores, pero para borrar
    public function delete($controller,$id,$object) {
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
		'confirm' => '¿Seguro que quieres borrar '.$object.'?'
		)
	);
    }
    public function deleteLine($controller,$id,$from_controller,$from_id,$object) {
	return $this->Form->postLink(
	    '<i class="fa fa-trash"></i>',
	    array(
		'controller' => $controller,
		'action' => 'delete',
		$id,
		'from' => $from_controller,
		'from_id' => $from_id
	    ),
	    array(
		'class' => 'botond',
		'escape' => false,
		'title' => 'Borrar',
		'confirm' => '¿Seguro que quieres borrar '.$object.'?'
		)
	);
    }
    public function add($controller,$object) {
	return $this->Html->link(
	    '<i class="fa fa-plus"></i> Añadir '.$object,
	    array(
		'controller' => $controller,
		'action' => 'add'
	    ),
	    array(
		'escape' => false,
		'title' => 'Añadir '.$object
	    )
	);
    }
    public function addLine($controller,$from_controller,$from_id,$object) {
	return $this->Html->link(
	    '<i class="fa fa-plus"></i> Añadir '.$object,
	    array(
		'controller' => $controller,
		'action' => 'add',
		'from_controller' => $from_controller,
		'from_id' => $from_id
	    ),
	    array(
		'escape' => false,
		'title' => 'Añadir '.$object
	    )
	);
    }
}
?>
