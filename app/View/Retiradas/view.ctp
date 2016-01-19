<?php
$this->extend('/Common/view');
$this->assign('object', 'Retirada');
//$this->assign('line_object', 'precio');
//$this->assign('id',$flete['Retirada']['id']);
$this->assign('class','Retirada');
$this->assign('controller','retiradas');
$this->assign('line_controller','retiradas');

$this->start('filter');
$this->end();

$this->start('main');
echo "<dl>";
	echo "  <dt>Operación:</dt>\n";
	echo "<dd>";
	/*echo $this->html->link($retirada['Contrato']['referencia'], array(
	    'controller' => 'contratos',
	    'action' => 'view',
	    $retirada['Contrato']['id'])
	);*/
	echo "  </dd>";
	echo "  <dt>Asociado:</dt>\n";
	echo "<dd>";
	echo $this->html->link($retirada['Asociado']['nombre_corto'], array(
	    'controller' => 'asociados',
	    'action' => 'view',
	    $retirada['Asociado']['id'])
	    );
	echo "  </dd>";
	echo "  <dt>Sacos solicitados:</dt>\n";
	echo "  <dd>".$retirada['PesoOperacion']['peso'].' kg&nbsp;'."</dd>";
	echo "  <dt>Peso solicitado:</dt>\n";
	echo "  <dd>".
	    $retirada['PesoOperacion']['cantidad_embalaje'].' x '.
	    $embalaje['Embalaje']['nombre'].
	    ' ('.$retirada['PesoOperacion']['peso'].'kg)&nbsp;'."</dd>";
	echo "  <dt>Almacen:</dt>\n";
	echo "  <dd>".$retirada['AlmacenTransporte']['Almacen']['nombre_corto'].'&nbsp;'."</dd>";
	echo "  <dt>Cuenta Almacén:</dt>\n";
	echo "  <dd>".$retirada['AlmacenTransporteacenTransporte']['cuenta_almacen'].'&nbsp;'."</dd>";
	echo "  <dt>Sacos retirado:</dt>\n";
	echo "  <dd>".$retirada['embalaje_retirado'].'&nbsp;'."</dd>";
	echo "  <dt>Peso retirado:</dt>\n";
	echo "  <dd>".$retirada['peso_retirado'].'&nbsp;'."</dd>";
	echo "  <dt>Fecha Retirada:</dt>\n";
	echo "  <dd>".$retirada['fecha_retirada'].'&nbsp;'."</dd>";

echo "</dl>";
$this->end();
?>
		</div>
</div>
