<h2>Agregar Financiación a Operación <em><?php echo $operacion['Operacion']['referencia']?></em></h2>

<?php
    $this->Html->addCrumb('Operaciones','/operaciones');
    //$this->Html->addCrumb('Contrato '.$contrato['Contrato']['referencia'],'/'.$this->params['named']['from_controller'].'/view/'.$this->params['named']['from_id']);
    echo "<dl>";
    echo "  <dt>Operación</dt>\n";
    echo "  <dd>".$referencia.'&nbsp;'."</dd>";
    echo "  <dt>Calidad</dt>\n";
    echo "  <dd>".$calidad.'&nbsp;'."</dd>";
    echo "  <dt>Proveedor</dt>\n";
    echo "<dd>";
    echo $this->html->link($proveedor, array(
	    'controller' => 'proveedores',
	    'action' => 'view',
	    $proveedor_id)
    );
    echo "</dd>";
    echo "  <dt>Condición</dt>\n";
    echo "<dd>".$condicion.'&nbsp;'."</dd>";
    echo "</dl>";
    echo $this->Form->create('Financiacion');
    echo $this->Form->hidden('id', array(
	'value' => $operacion['Operacion']['id']
	)
    );
    echo "<div class='linea'>\n";
    echo $this->Form->input('fecha_vencimiento', array(
	'label' => 'Fecha de vencimiento',
	'dateFormat' => 'DMY'
	)
);
    echo "</div>\n";
    echo $this->Form->input('banco_id');
    echo $this->Form->input('tipo_iva_id', array(
    	'value' => 3
	)
    );
    echo $this->Form->input('tipo_iva_comision_id', array(
    	'value' => 4
	)
    );
    echo $this->Form->input('precio_euro_kilo', array(
	'value' => $precio_euro_kilo
	)
    );
    echo $this->Form->end('Guardar Financiación');

