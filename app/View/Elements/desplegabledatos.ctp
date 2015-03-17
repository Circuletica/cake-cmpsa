<script language=javascript>

function destino(){

url = document.navegador.secciones.options[document.navegador.secciones.selectedIndex].value

if (url != "no") window.location = url;

}

</script>
<form name=navegador>
<select name="secciones" onchange="destino()">
    <option value="no">Seleccione la Tabla de Datos
    <option value="/banco_pruebas">Bancos
    <option value="/proveedores">Proveedores
    <option value="/asociados">Asociados
    <option value="/navieras">Navieras
    <option value="/agentes">Agentes
    <option value="/almacenes">Almacenes
    <option value="/paises">Pa&iacute;ses
</select>
</form>
