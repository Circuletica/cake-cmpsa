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

