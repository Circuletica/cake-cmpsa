<?php
class MuestrasController extends AppController {

    public function index() {
	$this->paginate['contain'] = array(
	    'Empresa',
	    'CalidadNombre'
	);
	$this->paginate['order'] =  array(
	    'Muestra.fecha' => 'ASC'
	);
	$this->paginate['recursive'] = 1;

	$this->set('tipos', $this->tipoMuestras);
	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$proveedores = $this->Muestra->Proveedor->find('list', array(
	    'fields' => array('Proveedor.id','Empresa.nombre_corto'),
	    'order' => array('Empresa.nombre_corto' => 'asc'),
	    'recursive' => 1
	)
    );
	$this->set('proveedores',$proveedores);
	//los elementos de la URL pasados como Search.* son almacenados por cake en $this->passedArgs[]
	//por ej.
	//$passedArgs['Search.palabras'] = mipalabra
	//$passedArgs['Search.id'] = 3

	//Si queremos un titulo con los criterios de busqueda
	$titulo = array();

	//filtramos por referencia
	if(isset($this->passedArgs['Search.referencia'])) {
	    $referencia = $this->passedArgs['Search.referencia'];
	    $this->paginate['conditions']['Muestra.referencia LIKE'] = "%$referencia%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['referencia'] = $referencia;
	    //completamos el titulo
	    $title[] = 'Referencia: '.$referencia;
	}
	//filtramos por tipo
	if(isset($this->passedArgs['Search.tipo_id'])) {
	    $tipo_id = $this->passedArgs['Search.tipo_id'];
	    $this->paginate['conditions']['Muestra.tipo LIKE'] = "$tipo_id";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['tipo_id'] = $tipo_id;
	    //Sacamos el nombre del tipo
	    $tipo = $this->tipoMuestras[$tipo_id];	
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['tipo_id'] = $tipo_id;
	}
	//filtramos por proveedor
	if(isset($this->passedArgs['Search.proveedor_id'])) {
	    $proveedor_id = $this->passedArgs['Search.proveedor_id'];
	    $this->paginate['conditions']['Empresa.id LIKE'] = "$proveedor_id";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['proveedor_id'] = $proveedor_id;
	    //completamos el titulo
	    $title[] ='Proveedor: '.$proveedores[$proveedor_id];
	}
	//filtramos por fecha
	if(isset($this->passedArgs['Search.fecha'])) {
	    $fecha = $this->passedArgs['Search.fecha'];
	    //Si solo se ha introducido un año (aaaa)
	    if (preg_match('/^\d{4}$/',$fecha)) { $anyo = $fecha; }
	    //la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
	    elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fecha)) {
		list($mes,$anyo) = explode('-',$fecha);
	    } else {
		$this->Session->setFlash('Error de fecha');
		$this->redirect(array('action' => 'index'));
	    }
	    //si se ha introducido un año, filtramos por el año
	    if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
	    //si se ha introducido un mes, filtramos por el mes
	    if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
	    $this->request->data['Search']['fecha'] = $fecha;
	    //completamos el titulo
	    $title[] = 'Fecha: '.$fecha;
	}
	//filtramos por calidad
	if(isset($this->passedArgs['Search.calidad'])) {
	    $calidad = $this->passedArgs['Search.calidad'];
	    $this->paginate['conditions']['CalidadNombre.nombre LIKE'] = "%$calidad%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['calidad'] = $calidad;
	    //completamos el titulo
	    $title[] ='Calidad: '.$calidad;
	}

	$this->Muestra->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array('Empresa.id = Muestra.proveedor_id')
		)
	    )
	));
	$muestras =  $this->paginate();
	//generamos el título
	if (isset($tipo)) { //en caso de que se quiera mostrar todos los tipos de muestra
	    if (isset($title)) { //si hay criterios de filtro, excluyendo el tipo
		$title = implode(' | ', $title);
		$title = 'Muestras de '.$tipo.' | '.$title;
	    } else { // Solo se filtra sobre el tipo de muestra
		$title = 'Muestras de '.$tipo;
	    }
	} else {
	    $title = 'Todas las muestras';
	}
	//pasamos los datos a la vista
	$this->set(compact('muestras','title'));
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formada Muestra/view');
	    $this->redirect(array('action'=>'index'));
	}
	//$this->set('tipos', $this->tipoMuestras);
	$this->Muestra->bindModel(array(
	    'belongsTo' => array(
		'CalidadNombre' => array(
		    'foreignKey' => false,
		    'conditions' => array('CalidadNombre.id = Muestra.calidad_id'),
		)
	    )
	));
	$muestra = $this->Muestra->find('first', array(
	    'conditions' => array('Muestra.id' => $id),
	    'fields' => array(
		'Muestra.*',
		'CalidadNombre.*'
	    ),
	    'recursive' => 3));
	$this->set('muestra',$muestra);

	//Exportar PDF
	//$this->set('title_for_layout', 'Factura');
	//$this->layout = 'facturas';
	$this->Muestra->id = $id;
	if (!$this->Muestra->exists()) {
	    throw new NotFoundException(__('Informe inválido'));
	}
	$this->pdfConfig = array(
	    'orientation'=>'portrait',
	    'download'=>true,
	    'filename'=>'INFORME-'.$id.'pdf'
	);
	//hay una view distinta para cada
	//tipo de muestra, ya que los campos
	//no son iguales
	switch ($muestra['Muestra']['tipo']) {
	case 1:
	    $this->render('view_oferta');
	    break;
	case 2:
	    $this->render('view_embarque');
	    break;
	case 3:
	    $this->render('view_entrega');
	    break;
	}
    }

    public function delete( $id = null) {
	if (!$id or $this->request->is('get')) :
	    throw new MethodNotAllowedException();
endif;
if ($this->Muestra->delete($id)):
    $this->Session->setFlash('Muestra borrada');
$this->redirect(array('action'=>'index'));
endif;
    }

    public function add() {
	$this->set('tipos', $this->tipoMuestras);
	//Si no esta el tipo de muestra en la URL, volvemos
	//a muestras de oferta
	if(!isset($this->passedArgs['tipo_id'])) {
	    $this->Session->setFlash('Error en URL, falta tipo muestra');
	    $this->redirect(
		array(
		    'action' => 'index',
		    'Search.tipo_id' => 1
		)
	    );
	} else {
	    $this->request->data['Muestra']['tipo'] = $this->passedArgs['tipo_id'];
	}
	//el titulado completo de la Calidad sale de una vista
	//de MySQL que concatena descafeinado, pais y descripcion
	$calidades = $this->Muestra->CalidadNombre->find('list');
	$this->set('calidades',$calidades);
	$this->set(
	    'proveedores',
	    $this->Muestra->Proveedor->find(
		'list',
		array(
		    'fields' => array(
			'Proveedor.id',
			'Empresa.nombre_corto'),
		    'recursive' => 1
		)
	    )
	);
	$this->set(
	    'contratos',
	    $this->Muestra->Contrato->find('list')
	);
	//para el javascript de la view
	//queremos el transporte como 'embarque 03/2016' o 'entrega 01/2015'
	$this->Muestra->Contrato->virtualFields = array(
	    'transporte' => 'CONCAT(
		CASE Contrato.si_entrega WHEN 0 THEN "embarque" WHEN 1 THEN "entrega" END,
		" ",
		SUBSTR(Contrato.fecha_transporte,6,2),
	"/",
	SUBSTR(Contrato.fecha_transporte,1,4)
    )'
	);
	$contratosMuestra = $this->Muestra->Contrato->find(
	    'all',
	    array(
		'contain' => array(
		    'Proveedor' => array(
			'Empresa' => array(
			    'fields' =>array(
				'nombre_corto'
			    )
			)
		    ),
		    'CalidadNombre'
		),
		'fields' => array(
		    'Contrato.id',
		    'CalidadNombre.nombre',
		    'Contrato.transporte'
		)
	    )
	);
	//queremos el id del contrato como index del array
	$contratosMuestra = Hash::combine($contratosMuestra, '{n}.Contrato.id','{n}');
	$this->set(compact('contratosMuestra'));

	if($this->request->is('post')):
	    //if ($this->request['Contrato']['id']){
	    //}
	    if($this->Muestra->save($this->request->data)):
		$this->Session->setFlash('Muestra guardada');
	$this->redirect(array(
	    'action' => 'index',
	    'Search.tipo_id' => $this->request->data['Muestra']['tipo']
	));
endif;
endif;
    }

    public function edit( $id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formada');
	    $this->redirect(array('action'=>'index'));
	}
	$this->Muestra->id = $id;
	$muestra = $this->Muestra->findById($id);
	$this->set('muestra',$muestra);
	$tipos = $this->tipoMuestras;
	$this->set('tipos', $tipos);
	$tipo = $tipos[$muestra['Muestra']['tipo']];
	$this->set('tipo',$tipo);
	//el titulado completo de la Calidad sale de una vista
	//de MySQL que concatena descafeinado, pais y descripcion
	$calidades = $this->Muestra->CalidadNombre->find('list');
	$this->set('calidades',$calidades);
	$this->set('proveedores', $this->Muestra->Proveedor->find('list', array(
	    'fields' => array('Proveedor.id','Empresa.nombre'),
	    'recursive' => 1
	))
    );
	//$this->set('almacenes', $this->Muestra->Almacen->find('list', array(
	//    'fields' => array('Almacen.id','Empresa.nombre'),
	//    'recursive' => 1))
	//);

	if($this->request->is('get')):
	    $this->request->data = $this->Muestra->read();
	else:
	    if ($this->Muestra->save($this->request->data)):
		$this->Session->setFlash('Muestra '.
		$this->request->data['Muestra']['registro'].
		' modificada con éxito');
	$this->redirect(array(
	    'action' => 'view',
	    $id
	)
    );
	    else:
		$this->Session->setFlash('Muestra NO guardada');
endif;
endif;
    }
}
?>
