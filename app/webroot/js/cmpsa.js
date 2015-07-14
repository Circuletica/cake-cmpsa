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
    //console.log(total);
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
	if(document.getElementById("ContratoCanalCompra1").checked) {
		  //London radio button is checked
		document.getElementById("divisa_diferencial").innerHTML = '$/Tm';
		document.getElementById("divisa_opciones").innerHTML = '$/Tm';
		document.getElementById("ContratoDiferencial").disabled = false;
		document.getElementById("ContratoOpciones").disabled = false;
	}else if(document.getElementById("ContratoCanalCompra2").checked) {
		  //NY radio button is checked
		document.getElementById("divisa_diferencial").innerHTML = 'ctv/Lb';
		document.getElementById("divisa_opciones").innerHTML = 'ctv/Lb';
		document.getElementById("ContratoDiferencial").disabled = false;
		document.getElementById("ContratoOpciones").disabled = false;
	}else if(document.getElementById("ContratoCanalCompra3").checked) {
		  //Precio fijo radio button is checked
		document.getElementById("divisa_diferencial").innerHTML = '';
		document.getElementById("divisa_opciones").innerHTML = '';
		document.getElementById("ContratoDiferencial").disabled = true;
		document.getElementById("ContratoOpciones").disabled = true;
	}
}
