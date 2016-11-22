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
echo $this->Html->script('jquery')."\n"; // Include jQuery library
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

if ($action == 'add') {
	echo "<h2>Añadir Operación Venta (tipo 3)</h2>\n";
}
if ($action == 'edit') {
	echo "<h2>Modificar Operación Venta (tipo3)</h2>\n";
}
$this->Html->addCrumb('Operaciones (venta)','/operacion_ventas');

echo $this->Form->create('OperacionVenta');
//Info de la operación
?>
<fieldset>
	<legend>Datos</legend>
	<?php
	echo $this->Form->input(
		'referencia',
		array(
			'autofocus' => 'autofocus'
		)
	);
	echo $this->Form->input(
	    'calidad_id',
	    array(
		'label' => 'Calidad',
		'empty' => array('' => 'Selecciona'),
		'class' => 'ui-widget',
		'id' => 'combobox',
		'style' => 'width: 100%' //Si no marco el estilo se deforma todo el fieldset.
	    )
	);
?>
</fieldset>
<fieldset>
<br>
<?php
	echo $this->Form->input(
		'precio_directo_euro',
		array(
			'label' => 'Precio fijo (€/kg)',
			'id' => 'precioFijoEuro'
		)
	);
	echo $this->element('cancelarform');
	echo $this->Form->end('Siguiente');
?>
</legend>
