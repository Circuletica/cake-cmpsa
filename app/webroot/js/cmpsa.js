function totalDesglose(){
    var pesoComprado = document.getElementById('pesoComprado').value;
    var cantidades = document.getElementsByClassName('cantidad');
    var pesos = document.getElementsByClassName('peso');
    var total=0;
    for(var i=0;i<cantidades.length;i++){
	if(parseFloat(cantidades[i].value) && parseFloat(pesos[i].value)) {
	    var cantidad = parseFloat(cantidades[i].value);
	    var peso = parseFloat(pesos[i].value);
	    console.log(cantidad);
	    console.log(peso);
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
    console.log(tot);
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
    var muestraIndex = muestraEmbarqueId.selectedIndex;
    //el id de la muestra
    var muestraSelOpt = muestraEmbarqueId.options[muestraIndex].value;
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
	if (contratoSelOpt in embarques) {
	    var muestras = embarques[contratoSelOpt].Muestra; //las muestras de embarque del contrato seleccionado
	    var opts = muestras.length; //cuantas muestras de emb. tiene este contrato
	    muestraEmbarqueId.options.length = opts;
	    for (var i=0; i<opts; i++){
		muestraEmbarqueId.options[i].value = muestras[i].id;
		muestraEmbarqueId.options[i].text = muestras[i].registro;
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
    //la muestra de embarque que seleccionamos
    var selectedIndex = document.getElementById('MuestraMuestraEmbarqueId').selectedIndex;
    //el id de la muestra
    var selectedOption = document.getElementById('MuestraMuestraEmbarqueId').options[selectedIndex].value;
    console.log(selectedOption);
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
    var operaciones = window.app.operacionesRetirada;
    var operaciones = window.app.operacionesEmbarque;
    //el contrato que seleccionamos
    var selectedIndex = document.getElementById('MuestraContratoId').selectedIndex;
    //el id del contrato
    var selectedOption = document.getElementById('MuestraContratoId').options[selectedIndex].value;
    var combobox = document.getElementById('combobox');;
    var embarque = document.getElementById('embarque');

    if (selectedOption != '') {
		//modificamos _todo_ el select de operaciones
	if (selectedOption in operaciones) {
	    var muestras = operaciones[selectedOption].Muestra; //las muestras de embarque del contrato seleccionado
	    var opts = muestras.length; //cuantas muestras de emb. tiene este contrato
	    operacion.options.length = opts;
	    
	    //console.log(operacion.options.length);
	    for (var i=0; i<opts; i++){
		operacion.options[i].value = muestras[i].id;
		operacion.options[i].text = muestras[i].registro;
	    }
	    //console.log(operacion.options);
	} else {
	    operacion.options.length = 1;
	    operacion.options[0].value = '';
	    operacion.options[0].text = '';
	    operacion.options[0].selected = true;
	}
    } else { // si se deja el contrato vacío, borramos calidad y proveedor
	//console.log(combobox.options);
	//lo siguiente no vale: cuando editamos muestra de oferta que ya
	//tiene calidad_id y proveedor_id, se borran del formulario
	//combobox.options[0].selected = true;
	//proveedor.options[0].selected = true;
    }
}
