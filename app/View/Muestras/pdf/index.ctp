<h2><?php echo $title;?></h2>
<div class='index'>
  <table>
  <tr>
    <th><?php echo $this->Paginator->sort('tipo')?></th>
    <th><?php echo $this->Paginator->sort('referencia')?></th>
    <th><?php echo $this->Paginator->sort('fecha')?></th>
    <th><?php echo $this->Paginator->sort('CalidadNombre.nombre', 'Calidad')?></th>
    <th><?php echo $this->Paginator->sort('proveedor')?></th>
  </tr>
  <?php foreach($muestras as $muestra):?>
  <tr>
    <td>
      <?php echo $muestra['Muestra']['tipo']?>
    </td>
    <td>
      <?php echo $muestra['Muestra']['referencia']?>
    </td>
    <td>
      <?php
	//no queremos la hora
	//mysql almacena la fecha en formato YMD
	echo $this->Date->format($muestra['Muestra']['fecha']);
     ?>
    </td>
    <td>
      <?php echo $muestra['CalidadNombre']['nombre']; ?>
    </td>
    <td>
      <?php echo $muestra['Proveedor']['Empresa']['nombre']; ?>
    </td>
  </tr>
  <?php endforeach;?>
  </table>
</div>
