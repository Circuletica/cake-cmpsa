  <?php
   echo $this->Form->create('Retirada', array('action'=>'filtroListado'));?>
  <div class="linea">
    <?php
    echo $this->Form->input('Search.referencia',
      array(
        'label' => 'Ref. operación'
        )
      );
    echo $this->Form->input('Search.desde',
      array(
        'type'=>'date',
        'dateFormat' => 'DMY',
        'minYear' => date('Y')-4,
        'maxYear' => date('Y'),
        'orderYear' => 'asc',
        'label'=> 'Retirada desde',
        'empty' => true
        )
      );
    echo $this->Form->input('Search.hasta',
      array(
        'type'=>'date',
        'dateFormat' => 'DMY',
        'minYear' => date('Y')-4,
        'maxYear' => date('Y'),
        'orderYear' => 'asc',
        'label'=> 'Retirada hasta',
        'empty' => true

        )
      );
      ?>
    </div>
    <div class="formuboton">
      <ul>
        <li><?php
          echo $this->Html->Link('<i class="fa fa-refresh"></i> Resetear',array(
            'action'=>'index'), array('escape'=>false));
            ?>
          </li>
          <li style="margin: 0">
            <?php
            echo $this->Form->end('Buscar');
            ?>
          </li>
        </ul>
      </div>
