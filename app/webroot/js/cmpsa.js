function totalDesglose(){
    //document.getElementById('total').innerHTML = "Total: " + total;
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
	//document.getElementById("ContratoDiferencial").disabled = canal[checked-1].CanalCompra.si_diferencial ? false : true;
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
