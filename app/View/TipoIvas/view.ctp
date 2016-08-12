<?php
$this->extend('/Common/view');
$this->assign('id', $tipo_iva['TipoIva']['id']);
$this->assign('class', 'TipoIva');
$this->assign('controller', 'tipo_ivas');
$this->assign('line_controller', 'valor_tipo_ivas');
$this->assign('object', 'IVA '.$tipo_iva['TipoIva']['nombre']);
$this->assign('line_object', 'valor');
$this->assign('line_add', '1'); // si se muestra el botón de añadir 'line'

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
		$valor['valor'].'%',
		$this->Button->editLine('valor_tipo_ivas',$valor['id'],'tipo_ivas',$valor['tipo_iva_id'])
		.' '.$this->Button->deleteLine('valor_tipo_ivas',$valor['id'],'tipo_ivas',$valor['tipo_iva_id'],$valor['valor'].'%')
	));
endforeach;
echo "</table>";
$this->end();
?>
