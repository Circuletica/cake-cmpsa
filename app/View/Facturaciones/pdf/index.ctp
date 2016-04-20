<?php
$this->extend('/Common/index');
$this->assign('object','Facturación');
$this->assign('class','Facturacion');

$this->start('filter');
$this->end();

$this->start('main');
echo "<table>\n";
echo "  <tr>\n";
echo "    <th>".$this->Paginator->sort('Operacion.referencia','Operación')."</th>\n";
echo "    <th>".$this->Paginator->sort('Calidad.nombre','Calidad')."</th>\n";
echo "    <th>".$this->Paginator->sort('Proveedor.nombre_corto','Proveedor')."</th>\n";
echo "  </tr>\n";
foreach($facturaciones as $facturacion) {
    echo "  <tr>\n";
    echo "    <td>".$facturacion['Operacion']['referencia']."</td>\n";
    echo "    <td>".$facturacion['Calidad']['nombre']."</td>\n";
    echo "    <td>".$facturacion['Proveedor']['nombre_corto']."</td>\n";
    echo "    <td>".$this->Button->view('facturaciones',$facturacion['Facturacion']['id'])."</td>\n";
    echo "  </tr>\n";
}
echo "</table>\n";
$this->end();
?>
