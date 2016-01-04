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
	console.log(pesoEmbalaje);
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
