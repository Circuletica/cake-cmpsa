<?php
class LineaMuestrasController extends AppController {
    public $paginate = array(
	'order' => array('marca' => 'asc')
    );

    public function index() {
	$this->set('lineas', $this->paginate());
    }

    public function view($id = null) {

	if (!$id) {
	    $this->Flash->set('URL mal formado Muestra/view');
	    $this->redirect(array('action'=>'index'));
	}

	$linea = $this->LineaMuestra->findById($id);
	$this->set('tipos', $this->tipoMuestras);
	$this->set('linea',$linea);
	$suma_linea = $linea['LineaMuestra']['criba20'] +
	    $linea['LineaMuestra']['criba19'] +
	    $linea['LineaMuestra']['criba13p'] +
	    $linea['LineaMuestra']['criba18'] +
	    $linea['LineaMuestra']['criba12p'] +
	    $linea['LineaMuestra']['criba17'] +
	    $linea['LineaMuestra']['criba11p'] +
	    $linea['LineaMuestra']['criba16'] +
	    $linea['LineaMuestra']['criba10p'] +
	    $linea['LineaMuestra']['criba15'] +
	    $linea['LineaMuestra']['criba9p'] +
	    $linea['LineaMuestra']['criba14'] +
	    $linea['LineaMuestra']['criba8p'] +
	    $linea['LineaMuestra']['criba13'] +
	    $linea['LineaMuestra']['criba12'];
	$suma_ponderada = $linea['CribaPonderada']['criba20'] +
	    $linea['CribaPonderada']['criba19'] +
	    $linea['CribaPonderada']['criba18'] +
	    $linea['CribaPonderada']['criba17'] +
	    $linea['CribaPonderada']['criba16'] +
	    $linea['CribaPonderada']['criba15'] +
	    $linea['CribaPonderada']['criba14'] +
	    $linea['CribaPonderada']['criba13'] +
	    $linea['CribaPonderada']['criba12'];
	$this->set('suma_linea',$suma_linea);
	$this->set('suma_ponderada',$suma_ponderada);
	
	//Para crear PDF
	$this->set(compact('id'));

    }

    public function add() {
	//el id y la clase de la entidad de origen vienen en la URL
	if (!$this->params['named']['from_id']) {
	    $this->Flash->set('URL mal formado lineaMuestra/add '.$this->params['named']['from_controller']);
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action' => 'index')
	    );
	}
	$this->form();
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Flash->set('error en URL');
	    $this->redirect(array(
		'action' => 'view',
		'controller' => $this->params['named']['from_controller'],
		$this->params['from_id']
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form ($id = null) {
	//si es un edit(), hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) {
	    $this->LineaMuestra->id = $id;
	    //sacamos los datos de la muestra a la que pertenece la linea
	    //nos sirven en la vista para detallar campos
	    $linea_muestra = $this->LineaMuestra->findById($id);
	    $muestra_id=$linea_muestra['Muestra']['id'];
	} else { //un add()
	    $muestra_id = $this->params['named']['from_id'];
	}
	//sacamos los datos de la muestra a la que pertenece la linea
	//nos sirven en la vista para detallar campos
	//$this->LineaMuestra->Muestra->Contrato->Operacion->Transporte->AlmacenTransporte->virtualFields = array(
	//    'cuenta_marca' => 'CONCAT(cuenta_almacen," (",marca_almacen,")")'
	//    );
	$muestra = $this->LineaMuestra->Muestra->find(
	    'first',
	    array(
		'conditions' => array(
		    'Muestra.id' => $muestra_id
		),
		'recursive' => 3,
		'contain' => array(
		    'Calidad',
		    'Proveedor',
		    'Contrato' => array(
			'Operacion' => array(
			    'fields' => array(
				'id',
				'referencia',
				'embalaje_id'
			    ),
			    'Transporte' => array(
				'fields' => array(
				    'id'
				),
				'AlmacenTransporte'
			    )
			)
		    )
		)
	    )
	);
	//necesitamos 'subir' el array $muestra['Muestra']
	//de 1 nivel para que sea igual al que devuelve el
	//find anterior
	//los dos find no devuelven la misma estructura
	//pasamos de:
	//array(
	//	'Muestra' => array(
	//		'id' => '22',
	//		'calidad_id' => '28',
	//		'contrato_id' => '27',
	//	),
	//	'Calidad' => array(),
	//	'Contrato' => array()
	//)
	//a
	//array(
	//	'id' => '22',
	//	'calidad_id' => '28',
	//	'contrato_id' => '27',
	//	'Calidad' => array(),
	//	'Contrato' => array()
	//)
	$muestra += $muestra['Muestra'];
	unset($muestra['Muestra']);
	//legado a este punto, vengamos de add o edit
	//$muestra tiene el mismo valor
	$this->set('muestra',$muestra);

	//necesitamos un array de tipo 'list' de cakephp
	//primero se sacan todos los almacen_transportes
	//de todos los transportes de la operacion relativa
	//de la muestra
	if (isset($muestra['Contrato']['Operacion'])) {
	    $operaciones = $muestra['Contrato']['Operacion'];
	    //tenemos que usar $operacion por referencia si
	    //queremos que se modifique $operaciones a la vez
	    foreach ($operaciones as &$operacion) {
		$operacion['AlmacenTransporte'] = array();
		foreach ($operacion['Transporte'] as $transporte) {
		    $operacion['AlmacenTransporte'] = array_merge(
			$operacion['AlmacenTransporte'],
			$transporte['AlmacenTransporte']
		    );
		}
		unset($operacion['Transporte']);
		//nunca olvidar dereferenciar la referencia
		unset($operacion);
	    }
	    //Recombinamos para pasar de:
	    //array(
	    //	(int) 0 => array(
	    //		'id' => '8',
	    //		'almacen_id' => '59',
	    //		'transporte_id' => '45',
	    //		'cuenta_almacen' => '54131',
	    //		'cantidad_cuenta' => '20.00'
	    //	),
	    //	(int) 1 => array(
	    //		'id' => '9',
	    //		'almacen_id' => '50',
	    //		'transporte_id' => '53',
	    //		'cuenta_almacen' => '251478/5451',
	    //		'cantidad_cuenta' => '33.00'
	    //
	    //A
	    //
	    //array(
	    //	(int) 8 => '54131',
	    //	(int) 9 => '251478/5451',
	    //)
	    //el array que va al js para rellenar el desplegable de cuenta_almacen_id
	    //según la operacion elegida
	    $operacion_almacenes = Hash::combine($operaciones,'{n}.id','{n}');
	    //la lista para el desplegable de operacion_id
	    $operaciones = Hash::combine($operaciones,'{n}.id','{n}.referencia');
	    $this->set(compact('operacion_almacenes'));
	    $this->set(compact('operaciones'));
	}

	$this->set('action', $this->action);

	if (!empty($this->request->data)){  //es un POST
	    //al guardar la linea, se incluye a qué muestra pertenece
	    $this->request->data['LineaMuestra']['muestra_id'] = $muestra_id;
	    //comprobamos que el total de criba es de 100%
	    $suma_criba = $this->request->data['LineaMuestra']['criba20']+
		$this->request->data['LineaMuestra']['criba19']+
		$this->request->data['LineaMuestra']['criba13p']+
		$this->request->data['LineaMuestra']['criba18']+
		$this->request->data['LineaMuestra']['criba12p']+
		$this->request->data['LineaMuestra']['criba17']+
		$this->request->data['LineaMuestra']['criba11p']+
		$this->request->data['LineaMuestra']['criba16']+
		$this->request->data['LineaMuestra']['criba10p']+
		$this->request->data['LineaMuestra']['criba15']+
		$this->request->data['LineaMuestra']['criba9p']+
		$this->request->data['LineaMuestra']['criba14']+
		$this->request->data['LineaMuestra']['criba8p']+
		$this->request->data['LineaMuestra']['criba13']+
		$this->request->data['LineaMuestra']['criba12'];
	    if(number_format($suma_criba,2) != 100){
		$this->Flash->set('Linea de Muestra no guardada, la suma de criba no es 100%');
	    } else {
		if ($this->LineaMuestra->save($this->request->data)) {
		    $this->Flash->set('Línea de muestra guardada');
		    $this->redirect(array(
			'action' => 'view',
			'controller' => 'linea_muestras',
			$this->LineaMuestra->id
		    ));
		} else {
		    $this->Flash->set('Línea de muestra NO guardada');
		}
	    }
	} else { //es un GET
	    $this->request->data = $this->LineaMuestra->read(null, $id);
	}
    }

    public function delete( $id = null) {
	if (!$id or $this->request->is('get')) 
	    throw new MethodNotAllowedException();

	if ($this->LineaMuestra->delete($id)) {
	    $this->Flash->set('Línea de muestra borrada');
	    $this->redirect(array(
		'controller' => $this->params['named']['from_controller'],
		'action'=>'view',
		$this->params['named']['from_id']
	    ));
	}
    }

    public function info_calidad($id){
	$linea = $this->LineaMuestra->findById($id);
	$this->set('tipos', $this->tipoMuestras);
	$this->set('linea',$linea);
	$suma_linea = $linea['LineaMuestra']['criba20'] +
	    $linea['LineaMuestra']['criba19'] +
	    $linea['LineaMuestra']['criba13p'] +
	    $linea['LineaMuestra']['criba18'] +
	    $linea['LineaMuestra']['criba12p'] +
	    $linea['LineaMuestra']['criba17'] +
	    $linea['LineaMuestra']['criba11p'] +
	    $linea['LineaMuestra']['criba16'] +
	    $linea['LineaMuestra']['criba10p'] +
	    $linea['LineaMuestra']['criba15'] +
	    $linea['LineaMuestra']['criba9p'] +
	    $linea['LineaMuestra']['criba14'] +
	    $linea['LineaMuestra']['criba8p'] +
	    $linea['LineaMuestra']['criba13'] +
	    $linea['LineaMuestra']['criba12'];
	$suma_ponderada = $linea['CribaPonderada']['criba20'] +
	    $linea['CribaPonderada']['criba19'] +
	    $linea['CribaPonderada']['criba18'] +
	    $linea['CribaPonderada']['criba17'] +
	    $linea['CribaPonderada']['criba16'] +
	    $linea['CribaPonderada']['criba15'] +
	    $linea['CribaPonderada']['criba14'] +
	    $linea['CribaPonderada']['criba13'] +
	    $linea['CribaPonderada']['criba12'];
	$this->set('suma_linea',$suma_linea);
	$this->set('suma_ponderada',$suma_ponderada);
	
	//Para crear PDF
	$this->set(compact('id'));

    }

 public function info_envio ($id) {
 	
//Necesario para volcar los datos en el PDF
 	$linea = $this->LineaMuestra->findById($id);
	$this->set('tipos', $this->tipoMuestras);
	$this->set('linea',$linea);
	$suma_linea = $linea['LineaMuestra']['criba20'] +
	    $linea['LineaMuestra']['criba19'] +
	    $linea['LineaMuestra']['criba13p'] +
	    $linea['LineaMuestra']['criba18'] +
	    $linea['LineaMuestra']['criba12p'] +
	    $linea['LineaMuestra']['criba17'] +
	    $linea['LineaMuestra']['criba11p'] +
	    $linea['LineaMuestra']['criba16'] +
	    $linea['LineaMuestra']['criba10p'] +
	    $linea['LineaMuestra']['criba15'] +
	    $linea['LineaMuestra']['criba9p'] +
	    $linea['LineaMuestra']['criba14'] +
	    $linea['LineaMuestra']['criba8p'] +
	    $linea['LineaMuestra']['criba13'] +
	    $linea['LineaMuestra']['criba12'];
	$suma_ponderada = $linea['CribaPonderada']['criba20'] +
	    $linea['CribaPonderada']['criba19'] +
	    $linea['CribaPonderada']['criba18'] +
	    $linea['CribaPonderada']['criba17'] +
	    $linea['CribaPonderada']['criba16'] +
	    $linea['CribaPonderada']['criba15'] +
	    $linea['CribaPonderada']['criba14'] +
	    $linea['CribaPonderada']['criba13'] +
	    $linea['CribaPonderada']['criba12'];
	$this->set('suma_linea',$suma_linea);
	$this->set('suma_ponderada',$suma_ponderada);


	$linea_muestra = $this->LineaMuestra->find(
		'first',
		array(
			'conditions' => array(
			    'LineaMuestra.id' => $id
			),
			'recursive' => -1,
			'contain' => array(
				'Muestra' => array(
					'fields' => array(
						'id',
						'tipo_registro'
					)
				),
				'Operacion' =>array(
					'fields'=> array(
						'referencia'
						)
					)
			)
		)
	 );
	//$this->set('linea_muestra',$linea_muestra);
	$linea_muestra += $linea_muestra['Muestra'];
	unset($linea_muestra['Muestra']);
	//legado a este punto, vengamos de add o edit
	//$linea_muestra tiene el mismo valor
	$this->set('linea_muestra',$linea_muestra);

//Contactos de los asociados
	$this->loadModel('Contacto');
	$contactos = $this->Contacto->find(
	    'all',
	    array(
	    	 'conditions' =>array(
	    	 	'departamento_id' => array(2,4)
	    	 	),
	    	 	'order' => array('Empresa.nombre_corto' => 'asc')
	    	 )
	    );
	$this->set('contactos',$contactos);	

//Usuarios de la CMPSA
	$this->loadModel('Usuario');
	$usuarios = $this->Usuario->find(
	    'all',
	    array(
	    	 'conditions' =>array(
	    	 	'departamento_id' => array(2,4)
	    	 	),
	    	 'contain'=>array(
	    	 	'Departamento'=>array(
	    	 		'fields'=>array(
	    	 			'nombre'
	    	 			)
	    	 		)	    	 	
	    	 	)
	    	 )
	    );
	$this->set('usuarios',$usuarios);		


if (!empty($id)) $this->LineaMuestra->id = $id; 
	if($this->request->is('get')){//Comprobamos si hay datos previos en esa línea de muestras
		$this->request->data = $this->LineaMuestra->read();//Cargo los datos
	}else{//es un POST	
		if (!empty($this->request->data['guardar'])) {	//Pulsamos previsualizar
			$this->LineaMuestra->save($this->request->data['LineaMuestra']); //Guardamos los datos actuales en los campos de Linea Muestra			
			$this->Flash->set('<i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i> Los datos del informe han sido guardados.');
		}elseif(empty($this->request->data['email'])){
			$this->Flash->set('<i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Los datos del informe NO fueron enviados. Faltan destinatarios');
		}else{	
		    $this->LineaMuestra->save($this->request->data['LineaMuestra']); //Guardamos los datos actuales en los campos		    

		    foreach ($this->data['email'] as $email){
		   		$lista_email[]= $email;
		   	}
		if(!empty($this->data['trafico'])){
		   	foreach ($this->data['trafico'] as $email){
		   		$lista_bcc[]= $email;
		   	}	
		 }
		if(!empty($this->data['calidad'])){
		   	foreach ($this->data['calidad'] as $email){
		   		$lista_bcc[]= $email;
		   	}
		}
		   	debug($lista_bcc);

//GENERAMOS EL PDF
			App::uses('CakePdf', 'CakePdf.Pdf');
		    require_once(APP."Plugin/CakePdf/Pdf/CakePdf.php");
		    $CakePdf = new CakePdf();
		    $CakePdf->template('info_calidad');
		    $CakePdf->viewVars(array('linea'=>$linea));
		    // Get the PDF string returned
		    //$pdf = $CakePdf->output();
		    // Or write it to file directly
		    $pdf = $CakePdf->write(APP.'Informes' . DS . $linea_muestra['tipo_registro'].'_'.date('Ymd').'.pdf');

//ENVIAMOS EL CORREO CON EL INFORME
			$Email = new CakeEmail(); //Llamamos la instancia de email     
			$Email->config('calidad'); //Plantilla de email.php
			$Email->from(array('calidad@cmpsa.com' => 'Calidad CMPSA'));
			$Email->to($lista_email);
		if(!empty($lista_bcc)){
			$Email->bcc($lista_bcc);
		}
			$Email->subject('PRUEBAS//PRUEBAS//Informe de calidad '.$linea_muestra['tipo_registro'].' / operación '.$linea_muestra['Operacion']['referencia']);
			$Email->attachments(APP.'Informes' . DS . $linea_muestra['tipo_registro'].'_'.date('Ymd').'.pdf');
			$Email->send('Adjuntamos informe de calidad '.$linea_muestra['tipo_registro'].' de la operación '.$linea_muestra['Operacion']['referencia']);

		    $this->Flash->set('<i class="fa fa-check-circle-o fa-lg" aria-hidden="true"></i> ¡Informe de calidad enviado!');
	  		$this->redirect(array(
	  			'action'=>'view',
	  			'controller' =>'LineaMuestras',
	  			$linea_muestra['LineaMuestra']['id']
	  			)
	  		);
		}
	}
}
}
?>
