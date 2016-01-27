<?php
class MuestrasController extends AppController {

    public function index() {
	$this->paginate['contain'] = array(
	    'Proveedor',
	    'CalidadNombre',
	    'Contrato' => array(
		'CalidadNombre',
		'Proveedor'
	    ),
	    'MuestraEmbarque' => array(
		'CalidadNombre',
		'Proveedor'
	    )
	);
	$this->paginate['order'] =  array(
	    'Muestra.fecha' => 'ASC'
	);
	$this->paginate['recursive'] = 1;

	$this->set('tipos', $this->tipoMuestras);

	//necesitamos la lista de proveedor_id/nombre para rellenar el select
	//del formulario de busqueda
	$this->loadModel('Proveedor');
	$proveedores = $this->Proveedor->find('list', array(
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
	if(isset($this->passedArgs['Search.registro'])) {
	    $registro = $this->passedArgs['Search.registro'];
	    $this->paginate['conditions']['Muestra.registro LIKE'] = "%$registro%";
	    //guardamos el criterio para el formulario de vuelta
	    $this->request->data['Search']['registro'] = $registro;
	    //completamos el titulo
	    $title[] = 'Registro: '.$registro;
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
	    $this->paginate['conditions']['Proveedor.id LIKE'] = "$proveedor_id";
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
	if (!$id or $this->request->is('get')){
	    throw new MethodNotAllowedException();
	}
	if ($this->Muestra->delete($id)) {
	    $this->Session->setFlash('Muestra borrada');
	    $this->redirect(array('action'=>'index'));
	}
    }

    public function add() {
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'financiaciones'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id = null) {
	$this->set('action', $this->action);
	$tipos = $this->tipoMuestras;
	$this->set('tipos', $tipos);
	$this->loadModel('Proveedor');
	$this->set(
	    'proveedores',
	    $this->Proveedor->find(
		'list',
		array(
		    'fields' => array(
			'Proveedor.id',
			'Empresa.nombre_corto'
		    ),
		    'recursive' => 1,
		    'order' => array('Empresa.nombre_corto' => 'ASC')
		)
	    )
	);

	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) {
	    $this->Muestra->id = $id;
	    $muestra = $this->Muestra->findById($id);
	    $tipo_nombre = $tipos[$muestra['Muestra']['tipo']];
	    $tipo = $muestra['Muestra']['tipo'];
	} else { //es un add()	
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
		$tipo = $this->passedArgs['tipo_id'];
		$tipo_nombre = $tipos[$this->passedArgs['tipo_id']];
	    }
	}
	$this->set('tipo',$tipo);
	$this->set(compact('tipo_nombre'));

	//el titulado completo de la Calidad sale de una vista
	//de MySQL que concatena descafeinado, pais y descripcion
	$calidades = $this->Muestra->CalidadNombre->find('list');
	$this->set('calidades',$calidades);
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
	//el array que se pasa al javascript para cambiar
	//calidad y proveedor automaticamente
	//cuando se cambia el contrato
	$contratosMuestra = $this->Muestra->Contrato->find(
	    'all',
	    array(
		'contain' => array(
		    'Proveedor' => array(
			    'fields' =>array(
				'nombre_corto'
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
	
	//el array que se pasa al javascript para cambiar
	//embarque automaticamente cuando se cambia el contrato
	//Solo queremos los contratos que tienen muestra de embarque
	//También saldran los contratos que no tienen muestra de embarque,
	//pero no saldran las muestras que no son de embarque :|
	//http://book.cakephp.org/2.0/en/core-libraries/behaviors/containable.html#containing-deeper-associations
	$contratosEmbarque = $this->Muestra->Contrato->find(
	    'all',
	    array(
		'contain' => 'Muestra.tipo = 2'
	    )
	);
	//queremos el id del contrato como index del array
	$contratosEmbarque = Hash::combine($contratosEmbarque, '{n}.Contrato.id','{n}');
	//repasamos cada contrato para poner bien las muestras de embarque
	foreach($contratosEmbarque as $key => $contrato) {
	    //el contenido del contrato no interesa, solo el id
	    unset($contratosEmbarque[$key]['Contrato']);
	    //solo guardamos los contratos que sí tienen
	    //muestra de embarque
	    if (empty($contratosEmbarque[$key]['Muestra']))
		unset ($contratosEmbarque[$key]);
	}
	//debug($contratosEmbarque);
	$this->set(compact('contratosEmbarque'));

	//el array que se pasa al javascript para cambiar
	//contrato, calidad y proveedor automaticamente
	//cuando se cambia la muestra de embarque en
	//muestras de entrega
	$muestrasEmbarque = $this->Muestra->find(
	    'all',
	    array(
		'contain' => array(
		    'Contrato' => array(
		    )
		),
		'fields' => array(
		    'Muestra.id',
		    'Muestra.registro',
		    'Contrato.id',
		    'Contrato.proveedor_id',
		    'Contrato.calidad_id'
		),
		'conditions' => array(
		    'tipo' =>2 // solo las muestras de embarque
		)
	    )
	);
	//queremos el id de la muestra como index del array
	//por una parte, un array para el js que permite rellenar
	//los demás campos cuando se selecciona una muestra de embarque
	$this->set (
	    'muestraEmbarques',
	    Hash::combine($muestrasEmbarque, '{n}.Muestra.id','{n}.Muestra.registro')
	);
	//por otra parte la lista del desplegable de muestras de embarque
	//para el formulario
	$muestrasEmbarque = Hash::combine($muestrasEmbarque, '{n}.Muestra.id','{n}');
	$this->set(compact('muestrasEmbarque'));

	if (!empty($this->request->data)){  //es un POST
	    //rellenamos los campos del registro que vienen de otras tablas,
	    //por ejemplo si la muestra tiene muestra de embarque, hay que sacar el
	    //contrato_id, proveedor_id y calidad_id para meterlos en el registro de
	    //la propia tabla de muestras si no queremos problemas con el paginador luego
	    if (!isset($this->request->data['Muestra']['proveedor_id'])) {
		if (empty($this->request->data['Muestra']['muestra_embarque_id'])) {
		    $this->request->data['Muestra']['proveedor_id'] =
			$contratosMuestra[$this->request->data['Muestra']['contrato_id']]['Proveedor']['id'];
		    $this->request->data['Muestra']['calidad_id'] =
			$contratosMuestra[$this->request->data['Muestra']['contrato_id']]['CalidadNombre']['id'];
		} else {
		    $this->request->data['Muestra']['proveedor_id'] =
			$muestrasEmbarque[$this->request->data['Muestra']['muestra_embarque_id']]['Contrato']['proveedor_id'];
		    $this->request->data['Muestra']['calidad_id'] =
			$muestrasEmbarque[$this->request->data['Muestra']['muestra_embarque_id']]['Contrato']['calidad_id'];
		    $this->request->data['Muestra']['contrato_id'] =
			$muestrasEmbarque[$this->request->data['Muestra']['muestra_embarque_id']]['Contrato']['id'];
		}
	    }
	    if($this->Muestra->save($this->request->data)) {
		$this->Session->setFlash('Muestra guardada');
		$this->redirect(
		    array(
			'action' => 'index',
			'Search.tipo_id' => $tipo
		    )
		);
	    } else {
		$this->Session->setFlash('Muestra NO guardada');
	    }
	} else { //es un GET
	    $this->request->data= $this->Muestra->read(null, $id);
	}
	$this->render('form');
    }
}
?>
