<?php
$this->extend('/Common/index');
$this->assign('object', 'IVA');
$this->assign('controller', 'ivas');
$this->assign('class', 'Iva');

$this->start('filter');
$this->end();

$this->start('main');
?>
<table>
  <tr>
    <th>Id</th>
    <th><?php echo $this->Paginator->sort('valor')?></th>
  </tr>
<?php foreach($ivas as $iva):?>
  <tr>
    <td> <?php echo $iva['Iva']['id']?> </td>
    <td> <?php echo $iva['Iva']['valor'].'%'?> </td>
    <td>
<?php
	echo $this->Button->edit('ivas',$iva['Iva']['id'])
	.' '.$this->Button->delete('ivas',$iva['Iva']['id'],$iva['Iva']['valor'].'%');
?>
    </td>
  </tr>
<?php endforeach;
echo "</table>\n";
$this->end();
?>
