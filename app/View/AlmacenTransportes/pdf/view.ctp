<?php
$this->layout = 'compras';

$this->extend('/Common/pdf/viewPdf');
//$this->assign('object', 'Operación '.$referencia);
$this->assign('line_object', 'Distribución');
//$this->assign('id',$operacion['Operacion']['id']);
$this->assign('class','AlmacenTransporte');
$this->assign('controller','almacenes_transportes');
$this->assign('line_controller','asociado_operaciones');
$this->assign('line_add','1');

$this->start('main');
echo "<h3 style='text-align: center;'>DEPARTAMENTO DE TRÁFICO</h3>";
echo "<h3 style='text-align: center;'>DISPOSICIÓN EN ALMACÉN</h3>";
echo "<hr><br><br>";
echo "<dl>";
echo "  <dt>Ref. operación</dt>\n";
echo "  <dd>".$almacentransportes['Transporte']['Operacion']['referencia'].'&nbsp;'."</dd>";
echo "  <dt>Calidad</dt>\n";
echo "  <dd>".$almacentransportes['Transporte']['Operacion']['Contrato']['Calidad']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Transporte</dt>\n";
echo "  <dd>".$almacentransportes['Transporte']['Operacion']['Contrato']['transporte'].'&nbsp;'."</dd>";
echo "</dl><br><br>";
echo "<dl>";
echo "  <dt>Cantidad de bultos</dt>\n";
echo "  <dd>".$almacentransportes['AlmacenTransporte']['cantidad_cuenta'].'&nbsp;'."</dd>";
echo "  <dt>Almacén de carga</dt>\n";
echo "  <dd>".$almacentransportes['Almacen']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Ref. almacén</dt>\n";
echo "  <dd>".$almacentransportes['AlmacenTransporte']['cuenta_almacen'].'&nbsp;'."</dd>";
echo "  <dt>Puerto de despacho</dt>\n";
echo "  <dd>".$almacentransportes['Transporte']['PuertoDestino']['nombre'].'&nbsp;'."</dd>";
echo "  <dt>Marcas</dt>\n";
echo "  <dd>".$almacentransportes['AlmacenTransporte']['marca_almacen'].'&nbsp;'."</dd>";
echo "  <dt>Agente de aduana</dt>\n";
echo "  <dd>".$almacentransportes['Transporte']['Agente']['nombre'].'&nbsp;'."</dd>";



echo "</dl>";
$this->end();
$this->start('lines');
echo "<br><table class='tr2'>";
        echo $this->Html->tableHeaders(
            array(
        	'Asociados',
        	'Bultos'
            )
        );
    foreach($almacentransportes['AlmacenTransporteAsociado'] as $almacentransporte){
        echo $this->Html->tableCells(
    	array(
        	$almacentransporte['Asociado']['Empresa']['nombre'],
        	$almacentransporte['sacos_asignados'].' bultos',
    	)
        );
    }
?>
	</table>
	</div>
</div>

<div id="footer">
	<br><br><br>
	Atentos saludos<br>
	C.M.P.S.A
</div>
<?php

$this->end();
?>
