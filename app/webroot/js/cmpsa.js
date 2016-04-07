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

function pesoAsociado(){
    //la tabla con el peso de los embalajes del contrato que nos viene de la View
    var embalajes = window.app.embalajesCompleto;
    //el valor del option del desplegable
    var selectedIndex = document.getElementById('OperacionEmbalajeId').selectedIndex;
    //el id de embalaje al que se corresponde
    var selectedOption = document.getElementById('OperacionEmbalajeId').options[selectedIndex].value;
    //el peso del embalaje seleccionado
    var pesoEmbalaje = embalajes[selectedOption].peso_embalaje_real;
    //un array con las cantidades de cada socio
    var cantidades = document.getElementsByClassName('cantidad');
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
    }
}

function pesoAsociadoEdit(){
    //la tabla con el peso de los embalajes del contrato que nos viene de la View
    var pesoEmbalaje = window.app.pesoEmbalaje;
    //un array con las cantidades de cada socio
    var cantidades = document.getElementsByClassName('cantidad');
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
    }
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
    document.getElementById('total').value = tot.toFixed(1);
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
	    if (calidadId.options[i].value == contratos[contratoSelOpt].CalidadNombre.id){
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
    //console.log(asociadoId);
    var cuentaId = cuentaBox.options[cuentaIndex].value;

		//modificamos _todo_ el select de operaciones
	if (operacionId in operaciones) {
		var asociadosOperacion = operaciones[operacionId].Asociado;
		var opt1 = asociadosOperacion.length; //cuantos asociados tiene la operación
	    asociadoBox.options.length = opt1;

	    for (var i=0; i<opt1; i++){
		asociadoBox.options[i].value = asociadosOperacion[i].id;
		asociadoBox.options[i].text = asociadosOperacion[i].nombre_corto;
		}
 	  
		//CUENTA ALMACEN
			var almacenesOperacion = cuentas[operacionId].AlmacenTransporte;
			var opt2 = almacenesOperacion.length; //cuantas cuentas tiene la operación
			cuentaBox.options.length = opt2;
	
			for (var i=0; i<opt2; i++){
			cuentaBox.options[i].value = almacenesOperacion[i].id;
			cuentaBox.options[i].text = almacenesOperacion[i].cuenta_almacen;
			}
	}
}

function operacionAlmacen() {
    var operacionAlmacenes = window.app.operacionAlmacenes;
    var operacionId = document.getElementById('LineaMuestraOperacionId');
    var almacenId = document.getElementById('LineaMuestraAlmacenTransporteId');
    var sacos = document.getElementById('LineaMuestraSacos');
    console.log(sacos);

    //el almacen seleccionado (si edit)
    var almacenIndex = almacenId.selectedIndex;
    var almacenSelOpt = almacenId.options[almacenIndex].value;
    //la operacion seleccionada
    var operacionIndex = operacionId.selectedIndex;
    var operacionSelOpt = operacionId.options[operacionIndex].value;
    console.log(operacionSelOpt);
    if (operacionSelOpt != '') {
	var almacenes = operacionAlmacenes[operacionSelOpt].AlmacenTransporte;
	var opts = almacenes.length;
	almacenId.options.length = opts;
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
    var totalCafe = (pesoFacturacion/1000) * precioDolarTm / cambioDolarEuro;
    totalCafeField.innerHTML = 'Total café: '+totalCafe.toFixed(2)+'€';
    var gastosBancarios = parseFloat(document.getElementById('FacturacionGastosBancariosPagados').value);
    var fletePagado = parseFloat(document.getElementById('FacturacionFletePagado').value);
    var despachoPagado = parseFloat(document.getElementById('FacturacionDespachoPagado').value);
    var seguroPagado = parseFloat(document.getElementById('FacturacionSeguroPagado').value);
    var totalGastos = gastosBancarios + fletePagado + despachoPagado + seguroPagado;
    totalGastosField.innerHTML = 'Total gastos: '+totalGastos+'€';
    var totalOperacion = (totalCafe + totalGastos) / pesoFacturacion;
    totalOperacionField.innerHTML = 'Precio real operación: '+totalOperacion.toFixed(6)+'€/kg';
}



