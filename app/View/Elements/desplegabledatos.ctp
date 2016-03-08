<script language=javascript>
function destino(){
url = document.navegador.secciones.options[document.navegador.secciones.selectedIndex].value
if (url != "no") window.location = url;
}
</script>
<form name=navegador>
<select name="secciones" onchange="destino()">
    <option value="no">Seleccione la tabla
    <option value="/agentes">Agentes    
    <option value="/almacenes">Almacenes
    <option value="/aseguradoras">Aseguradoras
    <option value="/asociados">Asociados
    <option value="/bancos">Bancos
    <option value="/calidades">Calidades
    <option value="/contactos">Contactos
    <option value="/contratos">Contratos
    <option value="/admin/cuenta_contables">Cuentas
    <option value="/embalajes">Embalajes
    <option value="/fletes">Fletes
    <option value="/incoterms">Incoterms  
    <option value="/tipoiva">IVA    	
    <option value="/muestras">Muestras
    <option value="/navieras">Navieras
    <option value="/operaciones">Operaciones    	
    <option value="/paises">Paises
    <option value="/proveedores">Proveedores
    <option value="/puertos">Puertos   	
    <option value="/seguros">Seguros
</select>
</form>
<br>
