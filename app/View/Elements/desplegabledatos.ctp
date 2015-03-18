<script language=javascript>

function destino(){

url = document.navegador.secciones.options[document.navegador.secciones.selectedIndex].value

if (url != "no") window.location = url;

}

</script>
<form name=navegador>
<select name="secciones" onchange="destino()">
    <option value="no">Seleccione la tabla
    <option value="/almacenes">Almacenes
    <option value="/banco_pruebas">Bancos
    <option value="/calidades">Calidades
    <option value="/contactos">Contactos
    <option value="/empresas">Empresas
    <option value="/muestras">Muestras
    <option value="/paises">Pa&iacute;ses
    <option value="/proveedores">Proveedores
    <option value="/asociados">Asociados
    <option value="/navieras">Navieras
    <option value="/agentes">Agentes
</select>
</form>
<br>
