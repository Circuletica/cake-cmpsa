function totalDesglose(){
	var pesoComprado = document.getElementById('pesoComprado').value;
	var cantidades = document.getElementsByClassName('cantidad');
	var pesos = document.getElementsByClassName('peso');
	var total=0;
	for(var i=0;i<cantidades.length;i++){
		if(parseFloat(cantidades[i].value) && parseFloat(pesos[i].value)) {
			var cantidad = parseFloat(cantidades[i].value);
			var peso = parseFloat(pesos[i].value);
			total += cantidad * peso;
		}
	}
	if(total == pesoComprado){
		document.getElementById('total').innerHTML = "Total desglose: " + total + "kg";
		document.getElementById('total').style.color = "black";
		document.getElementById('total').style.fontSize = "large";
	}
	if(total != pesoComprado) {
		document.getElementById('total').innerHTML = "&#9888; Total desglose: " + total + "kg";
		document.getElementById('total').style.color = "red";
		document.getElementById('total').style.fontSize = "large";
	}
}

function precioFactura(){
	var diferencial = parseFloat(window.app.diferencial);
	var precioFijacionBox = document.getElementById('OperacionPrecioFijacion');
	var precioFacturaBox = document.getElementById('OperacionPrecioCompra');
	precio = parseFloat(precioFijacionBox.value) + diferencial;
	precioFacturaBox.value = precio;
}

function pesoAsociado(){
	//la tabla con el peso de los embalajes del contrato que nos viene de la View
	var embalajes = window.app.embalajesCompleto;
	//el valor del option del desplegable
	var selectedIndex = document.getElementById('OperacionEmbalajeId').selectedIndex;
	//el id de embalaje al que se corresponde
	var EmbalajeOption = document.getElementById('OperacionEmbalajeId').options[selectedIndex].value;
	//el peso del embalaje seleccionado
	var pesoEmbalaje = embalajes[EmbalajeOption].peso_embalaje_real;
	//un array con las cantidades de cada socio
	var cantidades = document.getElementsByClassName('cantidad');
	var totalReparto = document.getElementById('totalReparto');
	var totalPeso = 0;
	for(var i=0;i<cantidades.length;i++){
		//el id del socio
		var id = cantidades[i].id;
		//la cantidad de embalajes del socio
		var cantidad = cantidades[i].value;
		//el peso que representa
		var pesoAsociado = cantidad * pesoEmbalaje;
		//el elemento html donde vamos a escribir el peso
		var textoPesoAsociado = document.getElementById('pesoAsociado' + id);
		//escribimos el peso
		textoPesoAsociado.innerHTML = "= " + pesoAsociado + "kg";
		totalPeso += pesoAsociado;
	}
	totalReparto.innerHTML = "Total peso: " + totalPeso + 'kg';
	//ahora cambiar la lista de fletes segun puertos/embalajes
	var precioFletes = window.app.precioFletes;
	var fleteId = document.getElementById('OperacionFlete');
	if (fleteId != null) {
		selectedIndex = document.getElementById('OperacionPuertoCargaId').selectedIndex;
		var puertoCargaOption = document.getElementById('OperacionPuertoCargaId').options[selectedIndex].value;
		selectedIndex = document.getElementById('OperacionPuertoDestinoId').selectedIndex;
		var puertoDestinoOption = document.getElementById('OperacionPuertoDestinoId').options[selectedIndex].value;
		var opts = precioFletes.length;
		var listaFlete = [];
		for (var i=0; i<opts; i++){
			if ((precioFletes[i].Flete.puerto_carga_id == puertoCargaOption || puertoCargaOption == '')
					&& (precioFletes[i].Flete.puerto_destino_id == puertoDestinoOption || puertoDestinoOption == '')
					&& precioFletes[i].Flete.embalaje_id == EmbalajeOption) {
				var flete = {name:precioFletes[i].Flete.name, value:precioFletes[i].Flete.value};
				listaFlete.push(flete);
			}
		}
		var opts = listaFlete.length;
		fleteId.options.length = opts;
		for (var i=0; i<opts; i++){
			fleteId.options[i].value = listaFlete[i].value;
			fleteId.options[i].text = listaFlete[i].name;
		}
	}
}

function pesoAsociadoEdit(){
	//la tabla con el peso de los embalajes del contrato que nos viene de la View
	var pesoEmbalaje = window.app.pesoEmbalaje;
	//un array con las cantidades de cada socio
	var cantidades = document.getElementsByClassName('cantidad');
	var totalCantidad = 0;
	var totalPeso = 0;
	var totalReparto = document.getElementById('totalReparto');
	for(var i=0;i<cantidades.length;i++){
		//el id del socio
		var id = cantidades[i].id;
		//la cantidad de embalajes del socio
		var cantidad = cantidades[i].value;
		//el peso que representa
		var pesoAsociado = cantidad * pesoEmbalaje;
		//el elemento html donde vamos a escribir el peso
		var textoPesoAsociado = document.getElementById('pesoAsociado' + id);
		//escribimos el peso
		textoPesoAsociado.innerHTML = "= " + pesoAsociado + "kg";
		//el total de sacos/peso
		if (cantidad) {
			totalCantidad += parseInt(cantidad);
		}
		totalPeso += pesoAsociado;
	}
	totalReparto.innerHTML = "Total sacos: " + totalCantidad +
		" / Total peso: " + totalPeso + "kg";
}

function canalCompra(){
	var canal = window.app.canalCompraDivisa;
	//la bolsa que seleccionamos
	var checked = $('input:checked').val();
	//la divisa correspondiente
	//!!!ESTA MAL el index del array no tiene
	//porque coincidir con el id del canal en la bdd
	var divisa = canal[checked-1].CanalCompra.divisa;
	//mostramos la divisa al lado del diferencial
	document.getElementById("divisa_diferencial").innerHTML = divisa;
	//desactivamos el diferencial si el canal no tiene diferencial
	document.getElementById("ContratoDiferencial").disabled = !canal[checked-1].CanalCompra.si_diferencial;
}

function lotesPorFijar() {
	var lotesPendientes = parseInt(document.getElementById('lotes').innerHTML);
	var lotesOperacion = document.getElementById('OperacionLotesOperacion').value;
	if (lotesOperacion > lotesPendientes) {
		document.getElementById('OperacionLotesOperacion').style.color = "red";
	} else {
		document.getElementById('OperacionLotesOperacion').style.color = "black";
	}
}

function closeSelf(f) {
	f.submit();
	window.close();
}

function totalCriba(){
	var arr = document.getElementsByClassName('criba');
	var tot=0;
	for(var i=0;i<arr.length;i++){
		if(parseFloat(arr[i].value))
			tot += parseFloat(arr[i].value);
	}
	document.getElementById('total').innerHTML = 'TOTAL: ' + tot.toFixed(1);
	if(tot == 100)
		document.getElementById('total').style.color = "black";
	if(tot != 100)
		document.getElementById('total').style.color = "red";
}

function contratosMuestra(){
	var contratos = window.app.contratosMuestra;
	var embarques = window.app.contratosEmbarque;
	var contratoId  = document.getElementById('MuestraContratoId');
	var calidadId = document.getElementById('MuestraCalidadId');
	var proveedorId = document.getElementById('MuestraProveedorId');
	var muestraEmbarqueId = document.getElementById('MuestraMuestraEmbarqueId');
	var transporte = document.getElementById('transporte_contrato');
	//la muestra de embarque que seleccionamos
	if (muestraEmbarqueId != null) {
		var muestraIndex = muestraEmbarqueId.selectedIndex;
		//el id de la muestra
		var muestraSelOpt = muestraEmbarqueId.options[muestraIndex].value;
	}
	//el contrato que seleccionamos
	var contratoIndex = contratoId.selectedIndex;
	//el id del contrato
	var contratoSelOpt = contratoId.options[contratoIndex].value;

	if (contratoSelOpt != '') {
		//cambiamos el transporte
		transporte.innerHTML = contratos[contratoSelOpt].Contrato.transporte;
		//cambiamos el 'selected' del combobox
		var opts = calidadId.options.length;
		for (var i=0; i<opts; i++){
			if (calidadId.options[i].value == contratos[contratoSelOpt].Calidad.id){
				calidadId.options[i].selected = true;
				break;
			}
		}
		//cambiamos el 'selected' del proveedor
		var opts = proveedorId.options.length;
		for (var i=0; i<opts; i++){
			if (proveedorId.options[i].value == contratos[contratoSelOpt].Proveedor.id){
				proveedorId.options[i].selected = true;
				break;
			}
		}
		//modificamos _todo_ el select de embarque
		if (muestraEmbarqueId != null) {
			if ((contratoSelOpt in embarques) && (muestraEmbarqueId != null)) {
				var muestras = embarques[contratoSelOpt].Muestra; //las muestras de embarque del contrato seleccionado
				var opts = muestras.length; //cuantas muestras de emb. tiene este contrato
				muestraEmbarqueId.options.length = opts;
				for (var i=0; i<opts; i++){
					muestraEmbarqueId.options[i].value = muestras[i].id;
					muestraEmbarqueId.options[i].text = muestras[i].tipo_registro;
					//volver a seleccionar la mues. de emb. si existía
					if (muestraEmbarqueId.options[i].value == muestraSelOpt) {
						muestraEmbarqueId.options[i].selected = true;
					}
				}
			} else {
				muestraEmbarqueId.options.length = 1;
				muestraEmbarqueId.options[0].value = '';
				muestraEmbarqueId.options[0].text = '';
				muestraEmbarqueId.options[0].selected = true;
			}
		}
	}
}

function muestraOferta() {
	var aprobado = document.getElementById('MuestraAprobado').checked;
	contrato = document.getElementById('MuestraContratoId');
	calidad = document.getElementById('MuestraCalidadId');
	proveedor = document.getElementById('MuestraProveedorId');
	contrato.disabled = !aprobado;
	calidad.disabled = aprobado;
	proveedor.disabled = aprobado;
	if (!aprobado) {
		contrato.options[0].selected = true;
	}
	console.log(contrato.selectedIndex);
	if (aprobado && contrato.selectedIndex == 0) {
		combobox.options[0].selected = true;
		proveedor.options[0].selected = true;
	}
}

function muestraEntrega() {
	var muestrasEmbarque = window.app.muestrasEmbarque;
	//el desplegable de contrato
	var contrato = document.getElementById('MuestraContratoId');
	var combobox = document.getElementById('combobox');
	var proveedor = document.getElementById('proveedor');
	var muestra = document.getElementById('MuestraMuestraEmbarqueId');
	//la muestra de embarque que seleccionamos
	var selectedIndex = muestra.selectedIndex;
	//el id de la muestra
	var selectedOption = muestra.options[selectedIndex].value;
	if (selectedOption != '') {
		contrato.disabled = 1;
		combobox.disabled = 1;
		proveedor.disabled = 1;
		var opts = contrato.options.length;
		for (var i=0; i<opts; i++){
			if (contrato.options[i].value == muestrasEmbarque[selectedOption].Contrato.id){
				contrato.options[i].selected = true;
				break;
			} else { // por si la muestra de embarque no tiene contrato
				contrato.options[0].selected = true;
				combobox.options[0].selected = true;
				proveedor.options[0].selected = true;
			}
		}
		//cambiamos el transporte
		//document.getElementById('transporte_contrato').innerHTML = contratos[selectedOption].Contrato.transporte;
		//cambiamos el 'selected' del combobox
		var opts = combobox.options.length;
		for (var i=0; i<opts; i++){
			if (combobox.options[i].value == muestrasEmbarque[selectedOption].Contrato.calidad_id){
				combobox.options[i].selected = true;
				break;
			}
		}
		//cambiamos el 'selected' del proveedor
		var opts = proveedor.options.length;
		for (var i=0; i<opts; i++){
			if (proveedor.options[i].value == muestrasEmbarque[selectedOption].Contrato.proveedor_id){
				proveedor.options[i].selected = true;
				break;
			}    
		}
	} else {
		contrato.disabled = 0;
	}
}

function operacionesRetirada(){
	var operaciones = window.app.operaciones_asociados;
	var cuentas = window.app.operaciones_almacen;
	//Se declaran als variables según el desplegable que queremos controlar
	//La variable es todo el elemento
	var operacionBox = document.getElementById('RetiradaOperacionId');
	var asociadoBox = document.getElementById('asociado');
	var cuentaBox = document.getElementById('almacen');

	//la operación que seleccionamos. Es el índice de la lista de operaciones
	var operacionIndex = operacionBox.selectedIndex;
	var asociadoIndex = asociadoBox.selectedIndex;
	var cuentaIndex = cuentaBox.selectedIndex;

	//el id de la operación, asociado y cuenta almacén
	var operacionId = operacionBox.options[operacionIndex].value;
	var asociadoId = asociadoBox.options[asociadoIndex].value;
	var cuentaId = cuentaBox.options[cuentaIndex].value;
	console.log(asociadoId);

	//modificamos _todo_ el select de asociados
	if (operacionId in operaciones) {
		var asociadosOperacion = operaciones[operacionId].Asociado;
		var opt1 = asociadosOperacion.length; //cuantos asociados tiene la operación
		asociadoBox.options.length = opt1;

		for (var i=0; i<opt1; i++){
			asociadoBox.options[i].value = asociadosOperacion[i].id;
			asociadoBox.options[i].text = asociadosOperacion[i].nombre_corto;
			if(asociadoBox.options[i].value == asociadoId){
				asociadoBox.options[i].selected = true;
			}
		}

		//CUENTA ALMACEN
		var almacenesOperacion = cuentas[operacionId].AlmacenTransporte;
		var opt2 = almacenesOperacion.length; //cuantas cuentas tiene la operación
		cuentaBox.options.length = opt2;
		for (var i=0; i<opt2; i++){
			cuentaBox.options[i].value = almacenesOperacion[i].id;
			cuentaBox.options[i].text = almacenesOperacion[i].cuenta_almacen;
			if(cuentaBox.options[i].value == cuentaId){
				cuentaBox.options[i].selected = true;
			}
		}
	}
}

function operacionAlmacen() {
	var operacionAlmacenes = window.app.operacionAlmacenes;
	var operacionId = document.getElementById('LineaMuestraOperacionId');
	var almacenId = document.getElementById('LineaMuestraAlmacenTransporteId');
	var sacos = document.getElementById('LineaMuestraSacos');
	//console.log(sacos);

	//el almacen seleccionado (si edit)
	var almacenIndex = almacenId.selectedIndex;
	var almacenSelOpt = almacenId.options[almacenIndex].value;
	//la operacion seleccionada
	var operacionIndex = operacionId.selectedIndex;
	var operacionSelOpt = operacionId.options[operacionIndex].value;
	console.log(operacionSelOpt);
	if (operacionSelOpt != '') {
		var almacenes = operacionAlmacenes[operacionSelOpt].AlmacenTransporte;
		console.log(almacenes);
		var opts = almacenes.length;
		if (opts != 0){
			almacenId.options.length = opts;
		} else {
			almacenId.options.length = 1;
			almacenId.options[0].value = '';
			almacenId.options[0].text = '';
			almacenId.options[0].selected = true;
		}

		for (var i=0; i<opts; i++){
			almacenId.options[i].value = almacenes[i].id;
			almacenId.options[i].text = almacenes[i].cuenta_marca;
			//volver a seleccionar la mues. de emb. si es un edit
			if (almacenId.options[i].value == almacenSelOpt) {
				console.log(almacenes[i]);
				almacenId.options[i].selected = true;
				sacos.value = almacenes[i].cantidad_cuenta;
			}
		}
	} else {
		almacenId.options.length = 1;
		almacenId.options[0].value = '';
		almacenId.options[0].text = '';
		almacenId.options[0].selected = true;
	}
}

function pesoFacturacion() {
	var pesoFacturacionRadio = document.getElementsByName('data[Facturacion][peso_facturacion]');
	var totalCafeField = document.getElementById('totalCafe');
	var totalGastosField = document.getElementById('totalGastos');
	var totalOperacionField = document.getElementById('totalOperacion');
	var precioDolarTm = document.getElementById('FacturacionPrecioDolarTm').value;
	var cambioDolarEuro = document.getElementById('FacturacionCambioDolarEuro').value;
	var pesoFacturacion;
	for (var i = 0; i < pesoFacturacionRadio.length; i++) {
		if (pesoFacturacionRadio[i].checked) {
			pesoFacturacion = pesoFacturacionRadio[i].value;
		}
	}
	var totalCafeDolar = (pesoFacturacion/1000) * precioDolarTm;
	var totalCafe = (pesoFacturacion/1000) * precioDolarTm / cambioDolarEuro;
	totalCafeField.innerHTML = 'Total café: '+totalCafe.toFixed(4)+'€ / '+totalCafeDolar.toFixed(4)+'$';
	var gastosBancarios = parseFloat(document.getElementById('FacturacionGastosBancariosPagados').value);
	var fletePagado = parseFloat(document.getElementById('FacturacionFletePagado').value);
	var despachoPagado = parseFloat(document.getElementById('FacturacionDespachoPagado').value);
	var seguroPagado = parseFloat(document.getElementById('FacturacionSeguroPagado').value);
	var totalGastos = gastosBancarios + fletePagado + despachoPagado + seguroPagado;
	totalGastosField.innerHTML = 'Total gastos: '+totalGastos+'€';
	var totalOperacion = (totalCafe + totalGastos) / pesoFacturacion;
	totalOperacionField.innerHTML = 'Precio real operación: '+totalOperacion.toFixed(6)+'€/kg';
}

function sacosAsignados(){
	//la tabla con la cantidad de los sacos almacenados en la cuenta del distribucion.ctp
	var cantidadCuenta = window.app.cantidadCuenta;
	//un array con las cantidades de cada socio
	var cantidades = document.getElementsByClassName('cantidad');
	var porcentajes = document.getElementsByClassName('porcentajeAsociado');
	//totalCantidad asignada
	var textototalCantidad = document.getElementById('totalCantidad');
	var textototalPorcentaje = document.getElementById('totalPorcentaje');

	var totalCantidad = 0;
	var totalPorcentaje = 0;

	var totalCantidad = 0;
	for(var i=0;i<cantidades.length;i++){
		totalCantidad += parseInt(cantidades[i].value);
	}
	for(var i=0;i<cantidades.length;i++){
		//el id del socio
		var id = cantidades[i].id;
		//la cantidad de sacos del socio
		var cantidad = cantidades[i].value;
		//el peso que representa
		var porcentajeAsociado = cantidad * 100/ totalCantidad;
		//el elemento html donde vamos a escribir el peso
		var textoporcentajeAsociado = document.getElementById('porcentajeAsociado' + id);
		//escribimos el peso
		textoporcentajeAsociado.innerHTML = porcentajeAsociado.toFixed(2) + "%";
		totalPorcentaje +=porcentajeAsociado; 
	}
	textototalCantidad.innerHTML = totalCantidad;
	textototalPorcentaje.innerHTML = totalPorcentaje.toFixed(2) + "%";
}

function precioF(){
	//    if ($("#siPrecioFijo").is(':checked')) {
	//	$(".precioFijo").hide();
	//	$("#precioFijoEuro").show();
	//    } else {
	//	$(".precioFijo").show();
	//	$("#precioFijoEuro").hide();
	//    }
	$(".precioFijo").prop('disabled', $("#siPrecioFijo").is(':checked'));
	$("#precioFijoEuro").prop('disabled', !$("#siPrecioFijo").is(':checked'));
}

function anticipoAsociado() {
	var operaciones = window.app.lista_operaciones;

	var operacionBox = document.getElementById('AsociadoOperacionOperacionId');
	var asociadoBox = document.getElementById('AsociadoOperacionAsociadoId');
	var operacionIndex = operacionBox.selectedIndex;
	var asociadoIndex = asociadoBox.selectedIndex;
	console.log(asociadoIndex);
	var operacionId = operacionBox.options[operacionIndex].value;
	console.log(operacionId);
	if (asociadoIndex > 0) {
		var asociadoId = asociadoBox.options[asociadoIndex].value;
	}

	//modificamos _todo_ el select de asociados
	if (operacionId in operaciones) {
		var asociadosOperacion = operaciones[operacionId].Asociado;
		var opt1 = asociadosOperacion.length; //cuantos asociados tiene la operación
		asociadoBox.options.length = opt1;
		for (var i=0; i<opt1; i++){
			asociadoBox.options[i].value = asociadosOperacion[i].id;
			asociadoBox.options[i].text = asociadosOperacion[i].nombre_corto;
			if(asociadoBox.options[i].value == asociadoId){
				asociadoBox.options[i].selected = true;
			}
		}
	}
}
