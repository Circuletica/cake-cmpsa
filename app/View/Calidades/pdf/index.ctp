<h2>Listado de calidades</h2>
<table>
  <tr>
    <th><?php echo $this->Paginator->sort('descafeinado','Proceso')?></th>
    <th><?php echo $this->Paginator->sort('Pais.nombre','Origen')?></th>
    <th><?php echo $this->Paginator->sort('descripcion', 'Descripción')?></th>
  </tr>
<?php foreach($calidades as $calidad):?>
  <tr>
    <td>
      <?php echo $calidad['Calidad']['descafeinado'] ? 'Descafeinado' : 'Natural'; ?>
    </td>
    <td>
      <?php echo $calidad['Pais']['nombre'] ? $calidad['Pais']['nombre'] : 'Blend'?>
    </td>
    <td>
      <?php echo $calidad['Calidad']['descripcion']?>
    </td>
  </tr>
<?php endforeach;?>
</table>
    <?php echo $this->Paginator->counter(
	   array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
      );?>
</div>

