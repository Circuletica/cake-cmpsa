<?php
$this->extend('/Common/view');
$this->assign('id', $tipo_iva['TipoIva']['id']);
$this->assign('class', 'TipoIva');
$this->assign('controller', 'tipo_ivas');
$this->assign('line_controller', 'valor_tipo_ivas');
$this->assign('object', 'IVA '.$tipo_iva['TipoIva']['nombre']);
$this->assign('line_object', 'valor');

$this->start('main');
    echo "<dl>";
    echo "  <dt>Nombre:</dt>\n";
    echo "  <dd>".$tipo_iva['TipoIva']['nombre']."&nbsp;</dd>\n";
    echo "</dl>";
$this->end();

$this->start('lines');
    echo "<table>";
    echo $this->Html->tableHeaders(array(
	'válido desde','válido hasta','valor', ''));
    foreach ($tipo_iva['ValorTipoIva'] as $valor):
	echo $this->Html->tableCells(array(
	    $this->Date->format($valor['fecha_inicio']),
	    $this->Date->format($valor['fecha_fin']),
	    $valor['valor'].'%'
	));
    endforeach;
    echo "</table>";
$this->end();
?>
