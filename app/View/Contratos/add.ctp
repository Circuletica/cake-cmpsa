<div class="add">
    <h1>Añadir Contrato</h1>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
	.custom-combobox {
	    position: relative;
	    display: inline-block;
	}
	.custom-combobox-toggle {
	    position: absolute;
	    top: 0;
	    bottom: 0;
	    margin-left: -1px;
	    padding: 0;
	}
	.custom-combobox-input {
	    margin: 0;
	    padding: 5px 10px;
	}
    </style>

<?php
$this->Html->addCrumb('Contratos', '/contratos');
echo $this->Html->script('jquery')."\n"; // Include jQuery library
//Pasamos la lista de 'bolsas' al javascript de la vista
$this->Js->set('canalCompraDivisa', $canal_compras_divisa);
echo $this->Js->writeBuffer(array('onDomReady' => false));
?>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
<script>
(function($) {
    $.widget("custom.combobox", {
    _create: function() {
	this.wrapper = $("<span>")
	    .addClass("custom-combobox")
	    .insertAfter(this.element);
	this.element.hide();
	this._createAutocomplete();
	this._createShowAllButton();
    },
	_createAutocomplete: function() {
	    var selected = this.element.children(":selected"),
		value = selected.val() ? selected.text() : "";
	    this.input = $("<input>")
		.appendTo(this.wrapper)
		.val(value)
		.attr("title", "")
		.addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left")
		.autocomplete({
		delay: 0,
		    minLength: 0,
		    source: $.proxy(this, "_source")
		})
		.tooltip({
		tooltipClass: "ui-state-highlight"
		});
	    this._on(this.input, {
	    autocompleteselect: function(event, ui) {
		ui.item.option.selected = true;
		this._trigger("select", event, {
		item: ui.item.option
		});
	    },
		autocompletechange: "_removeIfInvalid"
		});
	},
	    _createShowAllButton: function() {
		var input = this.input,
		    wasOpen = false;
		$("<a>")
		    .attr("tabIndex", -1)
		    .attr("title", "Ver todos los valores")
		    .tooltip()
		    .appendTo(this.wrapper)
		    .button({
		    icons: {
		    primary: "ui-icon-triangle-1-s"
		    },
		    text: false
		    })
		    .removeClass("ui-corner-all")
		    .addClass("custom-combobox-toggle ui-corner-right")
		    .mousedown(function() {
			wasOpen = input.autocomplete("widget").is(":visible");
		    })
			.click(function() {
			    input.focus();
			    // Close if already visible
			    if (wasOpen) {
				return;
			    }
			    // Pass empty string as value to search for, displaying all results
			    input.autocomplete("search", "");
			});
	    },
		_source: function(request, response) {
		    var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
		    response(this.element.children("option").map(function() {
			var text = $(this).text();
			if (this.value && (!request.term || matcher.test(text)))
			    return {
			    label: text,
				value: text,
				option: this
			};
		    }));
		},
		    _removeIfInvalid: function(event, ui) {
			// Selected an item, nothing to do
			if (ui.item) {
			    return;
			}
			// Search for a match (case-insensitive)
			var value = this.input.val(),
			    valueLowerCase = value.toLowerCase(),
	    valid = false;
			this.element.children("option").each(function() {
			    if ($(this).text().toLowerCase() === valueLowerCase) {
				this.selected = valid = true;
				return false;
			    }
			});
			// Found a match, nothing to do
			if (valid) {
			    return;
			}
			// Remove invalid value
			this.input
			    .val("")
			    .attr("title", value + " no se corresponde a ningun valor")
			    .tooltip("open");
			this.element.val("");
			this._delay(function() {
			    this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.autocomplete("instance").term = "";
		    },
			_destroy: function() {
			    this.wrapper.remove();
			    this.element.show();
			}
});
})(jQuery);
$(function() {
    $("#combobox").combobox();
    $("#toggle").click(function() {
	$("#combobox").toggle();
    });
});
</script>

<?php
//si no esta la calidad en el listado, dejamos un enlace para
//agragarla
$enlace_anyadir_calidad = $this->Html->link ('Añadir Calidad', array(
    'controller' => 'calidades',
    'action' => 'add',
    'from_controller' => 'contratos',
    'from_action' => 'add',
)
	   );
//si no esta el proveedor en el listado, dejamos un enlace para
//agragarlo
$enlace_anyadir_proveedor = $this->Html->link (
    'Añadir Proveedor',
    array(
	'controller' => 'proveedores',
	'action' => 'add',
	'from_controller' => 'contratos',
	'from_action' => 'add',
    )
);

echo $this->Form->create('Contrato');
?>
	
    <div class='radiomuestra'>
	<?php
	echo $this->Form->radio(
	    'canal_compra_id',
	    $canal_compras,
	    array(
		'legend' => false,
		'value' => 1,
		'separator' => ' -- ',
		'onclick' => 'canalCompra()'
	    ),
	    array('class'=>'radiomuestra')
	);
	?>
	</div>
<hr>
<br>
<fieldset>
<legend>Datos</legend>
	<div class="col2">
<?php

echo $this->Form->input(
    'referencia',
    array('autofocus' => 'autofocus')
);
echo $this->Form->input(
    'incoterm_id',
    array(
	'label' => 'Incoterms',
	'empty' => array('' => 'Selecciona')
    )
);
?></div>
	<div class="col2">
	<?php
	echo $this->Form->input(
	    'puerto_carga_id',
	    array(
		'label' => 'Puerto de carga',
		'empty' => true
	    )
	);
	echo $this->Form->input(
	    'puerto_destino_id',
	    array(
		'label' => 'Puerto de destino',
		'empty' => true
	    )
	);
	?>
	</div>
	<?php

echo $this->Form->input(
    'calidad_id',
    array(
	'label' => 'Calidad ('.$enlace_anyadir_calidad.')',
	'empty' => array('' => 'Selecciona'),
	'class' => 'ui-widget',
	'id' => 'combobox',
    'style' => 'width: 100%' //Si no marco el estilo se deforma todo el fieldset.
    )
    );
echo $this->Form->input(
    'proveedor_id',
    array(
	'label' => 'Proveedor ('.$enlace_anyadir_proveedor.')',
	'empty' => array('' => 'Selecciona')
    )
);
	?>
<div class="col2">
	<?php
	echo $this->Form->input(
	    'peso_comprado',
	    array(
		'label' => 'Peso comprado (kg)',
		'id' => 'pesoComprado',
		'oninput' => 'totalDesglose()'
	    )
	);
	echo $this->Form->input('lotes_contrato');
	?>
	</div>
<div class='linea'>
	<?php
	echo $this->Form->input(
	    'posicion_bolsa',
	    array(
		'label' => 'Posición de bolsa',
		'dateFormat' => 'MY',
		'minYear' => date('Y'),
		'maxYear' => date('Y')+5,
		'orderYear' => 'asc'
	    )
	);
	?>
	</div>
	

</fieldset>
<fieldset>
<br>

 <table>
	<tr>
      <th>Tipo bulto</th>
      <th>Cantidad</th>
      <th>Peso</th>
	</tr>

<?php
foreach ($embalajes as $embalaje){
    echo '<tr>';
    echo "<td>".$embalaje['Embalaje']['nombre']."</td>\n";
    echo '<td>';
    echo $this->Form->input(
	'Embalaje.'.$embalaje['Embalaje']['id'].'.cantidad_embalaje',
	array(
	    'label' => '',
	    'class' => 'cantidad',
	    'oninput' => 'totalDesglose()'
	)
    );
    echo '</td>';
    echo '<td>';
    //rellenamos la celda de peso y la dejamos en lectura sola si
    //el peso del embalaje es fijo
    //casi siempre, menos los bigbag que tienen un peso variable
    if(!$embalaje['Embalaje']['peso_embalaje']){
	echo $this->Form->input(
	    'Embalaje.'.$embalaje['Embalaje']['id'].'.peso_embalaje_real',
	    array(
		'label' => '',
		'class' => 'peso',
		'oninput' => 'totalDesglose()'
	    )
	);
    } else {
	echo $this->Form->input(
	    'Embalaje.'.$embalaje['Embalaje']['id'].'.peso_embalaje_real',
	    array(
		'label' => '',
		'default' => $embalaje['Embalaje']['peso_embalaje'],
		'class' => 'peso',
		'oninput' => 'totalDesglose()',
		'readonly' => true
	    )
	);
    }
    echo '</td>';
    echo '</tr>';
}
?>
    </table>
    <p id="total"></p>
    <?php
    echo $this->Form->input(
    'diferencial',
    array('between' => '(<var id="divisa_diferencial"></var>)')
);
?>
 </fieldset>
<fieldset> 
<?php
//echo '<p id="divisa_opciones"></p>';
?>
<legend>Fecha de transporte</legend>
    <div class='radiomuestra'>
	<?php
	echo $this->Form->radio(
	    'si_entrega',
	    $tipos_fecha_transporte,
	    array(
		'legend' => '',//Fecha de transporte',
		'value' => '0'
	    )
	);
	?>
	<br>
	</div>
	<div class='linea'>
	<?php
	echo $this->Form->input('fecha_transporte', array(
	    'label' => '',
	    'dateFormat' => 'DMY',
	    'minYear' => date('Y'),
	    'maxYear' => date('Y')+5,
	    'orderYear' => 'asc',
	    'selected' => date('Y-m-1', strtotime("+30 days"))
	    )
	);
echo "</div>\n";
echo $this->Form->input('comentario');
echo $this->element('cancelarform');
echo $this->Form->end('Guardar Contrato');
?>
</fieldset>
</div>
<script type="text/javascript">
window.onload = canalCompra();
</script>
