<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    var $scaffold = 'admin';

    public $paginate = array(
	'limit' => 20
    );

    public $helpers = array(
	'Html',
	'Form',
	'Date',
	'Button',
    );

    public $components = array('DebugKit.Toolbar','Session','RequestHandler');

    //cambia el 'hasOne' del Model por un 'belongsTo'
    //para que el LEFT JOIN de 3r nivel de la query se haga
    //después del de 2o nivel, es decir primero el JOIN con Empresa,
    //luego el JOIN con Pais si no queremos errores de SQL
    public function bindCompany($class) {
	$this->$class->unbindModel(array(
	    'hasOne' => array('Empresa')
	));
	$this->$class->bindModel(array(
	    'belongsTo' => array(
		'Empresa' => array(
		    'foreignKey' => false,
		    'conditions' => array($class.'.id = Empresa.id')
		),
		'Pais' => array(
		    'foreignKey' => false,
		    'conditions' => array('Pais.id = Empresa.pais_id')
		)
	    )
	));
	$this->paginate = array(
	    'contain' => array(
		'Empresa',
		'Pais.nombre',
	    ),
	    'recursive' => 1,
	    'order' => array('Empresa.nombre_corto' => 'ASC')
	);
    }

    public function viewCompany($class,$id) {
	$this->{$this->class}->recursive = 3;
	$empresa = $this->{$this->class}->findById($id);
	$this->set('empresa',$empresa);
	$this->set('referencia', $empresa['Empresa']['nombre_corto']);
	$cuenta_bancaria = $empresa['Empresa']['cuenta_bancaria'];
	//el método iban() definido en AppController necesita
	//como parametro un 'string'
	settype($cuenta_bancaria,"string");
	$iban_bancaria = $this->iban("ES",$cuenta_bancaria);
	$this->set('iban_bancaria',$iban_bancaria);
    }

    public function formCompany($class, $id) {
	$this->set('paises', $this->$class->Empresa->Pais->find('list'));
	$this->set('action', $this->action);
	//si es un edit, hay que rellenar el id, ya que
	//si no se hace, al guardar el edit, se va a crear
	//un _nuevo_ registro, como si fuera un add
	if (!empty($id)) {
	    $this->$class->id = $id;
	    $this->$class->Empresa->id = $id;
	    $empresa = $this->$class->Empresa->find('first',array(
		'conditions' => array( 'Empresa.id' => $id)
	    ));
	    $this->set('object', $empresa['Empresa']['nombre_corto']);
	}

	if (!empty($this->request->data)) { //es un POST
	    if ($this->$class->Empresa->save($this->request->data)) {
		$this->request->data[$class]['id'] = $this->$class->Empresa->id;
		if($this->$class->save($this->request->data)) {
		    $this->Session->setFlash($class.' guardado');
		    $this->redirect(array(
			'action' => 'view',
			$this->$class->Empresa->id
		    ));
		} else { $this->Session->setFlash($class.' NO guardado'); }
	    } else { $this->Session->setFlash('Empresa NO guardada'); }
	} else { //es un GET
	    $this->request->data = $this->$class->read(null, $id);
	}
    }

    public function deleteCompany($class, $id) {
	if (!$id or $this->request->is('get')) {
	    throw new MethodNotAllowedException();
	}
	if ($this->$class->delete($id)) {
	    $this->Session->setFlash($class.' borrado');
	    $this->$class->Empresa->delete($id);
	    $this->redirect(array('action'=>'index'));
	}
    }

    public function iban($codigoPais,$ccc){
	$pesos = array('A' => '10',
	    'B' => '11',
	    'C' => '12',
	    'D' => '13',
	    'E' => '14',
	    'F' => '15',
	    'G' => '16',
	    'H' => '17',
	    'I' => '18',
	    'J' => '19',
	    'K' => '20',
	    'L' => '21',
	    'M' => '22',
	    'N' => '23',
	    'O' => '24',
	    'P' => '25',
	    'Q' => '26',
	    'R' => '27',
	    'S' => '28',
	    'T' => '29',
	    'U' => '30',
	    'V' => '31',
	    'W' => '32',
	    'X' => '33',
	    'Y' => '34',
	    'Z' => '35' );
	$dividendo = $ccc.$pesos[substr($codigoPais, 0 , 1)].$pesos[substr($codigoPais, 1 , 1)].'00';	
	$digitoControl =  98 - bcmod($dividendo, '97');
	if(strlen($digitoControl)==1) $digitoControl = '0'.$digitoControl;
	return $codigoPais.$digitoControl.$ccc;
    }

    //el tipo de muestra puede ser:
    //1 - oferta
    //2 - embarque
    //3 - entrega
    public $tipoMuestras =  array(
	1 => 'Oferta',
	2 => 'Embarque',
	3 => 'Entrega'
    );	

    public function filtroListado() { //FILTRO-BUSCADOR
	//la página a la que redirigimos después de mandar  el formulario de filtro
	$url['action'] = 'index';
	//construimos una URL con los elementos de filtro, que luego se usan en el paginator
	//la URL final tiene ese aspecto:
	//http://gestion.gargantilla.net/controller/index/Search.referencia:mireferencia/Search.id:3
	foreach ($this->data as $k=>$v){ 
	    foreach ($v as $kk=>$vv){ 
		//sustituimos '_' por '/' en los criterios de búsqueda
		if ($vv) {$url[$k.'.'.$kk]=strtr($vv,'/','_');} 
	    } 
	}
	$this->redirect($url,null,true);
    }

    public function filtroPaginador($criterios) {
	//$criterios es un array como
	//'Naviera' => array(
	//	"Registro" => "registro",
	//	"Proveedor" => "proveedor_id",
	//	"Marca" => "marca_almacen"
	//	),
	//'Proveedor' => array(
	//	'Nombre' => 'nombre_corto',
	//)
	//los elementos de la URL pasados como Search.* son almacenados por cake en $this->passedArgs[]
	//por ej.
	//$passedArgs['Search.palabras'] = mipalabra
	//$passedArgs['Search.id'] = 3
	foreach ($criterios as $tabla => $campos) {
	    foreach ($campos as $nombre => $elementos) {
		$columna = $elementos['columna'];
		if (isset($this->passedArgs['Search.'.$columna])) {
		    //en la URL (filtroListado()) sustituimos '_' por '/' ahora, al revés
		    $valor = strtr($this->passedArgs['Search.'.$columna],'_','/');
		    if ($elementos['exacto']) {
			$this->paginate['conditions'][$tabla.'.'.$columna.' LIKE'] = $valor;
		    } else {
			$this->paginate['conditions'][$tabla.'.'.$columna.' LIKE'] = "%".$valor."%";
		    }
		    $this->request->data['Search'][$columna] = $valor;
		    if (!empty($elementos['lista'])) {
			$titulo[] = $nombre.': '.$elementos['lista'][$valor];
		    } else {
			$titulo[] = $nombre.': '.$valor;
		    }
		}
	    }
	}
	if (isset($titulo)) {
	    $titulo = implode(' | ', $titulo);
	    return $titulo;
	}
    }

//Función para sacar los porcentajes
    function porcentaje($total, $parte, $redondear) {
    	return round($parte / $total * 100, $redondear);
	}
}
