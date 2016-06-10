<?php
$this->extend('/Common/index');
$this->assign('class', 'Puerto');

$this->start('filter');
$this->end();

$this->start('main');
echo "<table class='tc4'>\n";
echo $this->Html->tableHeaders(array(
   'Id',
    $this->Paginator->sort('nombre'),
    $this->Paginator->sort('pais'),
    'Detalle'));

foreach($puertos as $puerto):
 echo $this->Html->tableCells(array(
  $puerto['Puerto']['id'],
  $puerto['Puerto']['nombre'],
  $puerto['Pais']['nombre'],
  $this->Html->link('<i class="fa fa-pencil-square-o"></i>',
    array('action'=>'edit', $puerto['Puerto']['id']),
    array('class'=>'botond','escape'=>false, 'title'=>'Modificar puerto'))
   .' '.$this->Form->postLink('<i class="fa fa-trash"></i>',
    array('action'=>'delete',$puerto['Puerto']['id']),
    array('class'=>'botond', 'escape'=>false, 'title'=> 'Borrar','confirm'=>'¿Realmente quiere borrar '.$puerto['Puerto']['nombre'].'?'))
 ));
endforeach;
echo "</table>\n";
$this->end();
?>
