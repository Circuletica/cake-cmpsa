<?php
$this->extend('/Common/index');
$this->assign('object', 'Cuentas de almacén');
$this->assign('class', 'AlmacenTransporte');
$this->assign('add_button', 0);


$this->start('filter');
    echo $this->element('informes_trafico'); //Elemento de informes de tráfico
$this->end();

$this->start('main');
	if (empty($almacentransportes)){
    echo "No hay cuentas de almacén en esta lista";
	}else{
    	if ($action == 'index') { //INDEX ES INFORME DE DESPACHO
	      	echo '<table class="tr3 tr4">';
			echo $this->Html->tableHeaders(array(
				$this->Paginator->sort('AlmacenTransporte.cuenta_almacen','Cuenta Corriente'),
				$this->Paginator->sort('Almacen.nombre_corto','Almacén'),
				$this->Paginator->sort('AlmacenTransporte.cantidad_cuenta','Cantidad'),
				$this->Paginator->sort('AlmacenTransporte.peso_bruto','Peso bruto'),
				$this->Paginator->sort('AlmacenTransporte.marca_almacen','Marca'),
				'Detalle')
			);
			foreach($almacentransportes as $almacentransporte):
				echo $this->Html->tableCells(array(
					$almacentransporte['AlmacenTransporte']['cuenta_almacen'],
					$almacentransporte['Almacen']['nombre_corto'],
					$almacentransporte['AlmacenTransporte']['cantidad_cuenta'].' bultos',
					$almacentransporte['AlmacenTransporte']['peso_bruto'].' kg',
					$almacentransporte['AlmacenTransporte']['marca_almacen'],
					$this->Button->view('almacen_transportes',$almacentransporte['AlmacenTransporte']['id'])
				));
			endforeach;
			echo '</table>';

     	}elseif($action == 'pendiente'){
        //$total_asignados=['AlmacenTransporteAsociado']['sacos_asignados'] // Es lo mejor en controlador transporte o en almacen transporte?
			echo "<table class='tc2 tc4 tc5 '>\n";
	        echo $this->Html->tableHeaders(array(
	          $this->Paginator->sort('Operacion.referencia','Ref. Operación'),
	          $this->Paginator->sort('Transporte.linea','Nº línea'),
	          $this->Paginator->sort('Calidad.nombre', 'Calidad'),
	          $this->Paginator->sort('Transporte.cantidad_embalaje', 'Sacos Pendientes'), // SACOS PENDIENTES DE ADJUDICAR
	          $this->Paginator->sort('AlmacenTransporte.cuenta_almacen', 'Ref. Almacén'),
	          $this->Paginator->sort('Almacen.nombre_corto', 'Almacén'),
	          'Detalle'
	          )
	        );
		    foreach($almacentransportes as $almacentransporte){
				echo $this->Html->tableCells(array(
		            $almacentransporte['Operacion']['referencia'],
		            $almacentransporte['Transporte']['linea'],
		            $almacentransporte['Calidad']['nombre'],
		            $almacentransporte['Transporte']['cantidad_embalaje'],// SACOS PENDIENTES DE ADJUDICAR
		            $almacentransporte['AlmacenTransporte']['cuenta_almacen'],
		        //  $transporte['Almacen']['nombre_corto'],
					$this->Button->view('almacen_transportes',$almacentransporte['AlmacenTransporte']['id'])
				)
			);
	        }
	        echo "</table>\n"; 
    	}
	}    
$this->end();
?>	