<?php
class FacturacionesController extends AppController {
    public $paginate = array(
	'order' => array('Operacion.referencia' => 'asc')
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'Operacion'
	);
	$this->set('facturaciones', $this->paginate());
    }

    public function view($id = null) {
	if (!$id) {
	    $this->Session->setFlash('URL mal formado Facturación/view');
	    $this->redirect(array('action'=>'index'));
	}
	$facturacion = $this->Facturacion->find(
	    'first',
	    array(
		'conditions' => array('Facturacion.id' => $id),
		'contain' => array(
		    'Operacion' => array(
			'Contrato' => array(
			    'CalidadNombre',
			    'Incoterm',
			    'Proveedor'
			),
			'Transporte' => array(
			    'Naviera',
			    'Agente',
			)
		    ),
		    'Facturas' => array(
			'Asociado'
		    )
		),
		'recursive' => 3
	    )
	);
	$this->set(compact('facturacion'));
    }

    public function add() {
	$this->form($this->params['named']['from_id']);
	$this->render('form');
    }

    public function edit($id = null) {
	if (!$id && empty($this->request->data)) {
	    $this->Session->setFlash('error en URL Facturación/edit');
	    $this->redirect(array(
		'action' => 'index',
		'controller' => 'facturaciones'
	    ));
	}
	$this->form($id);
	$this->render('form');
    }

    public function form($id) {
	$this->set('action', $this->action);
	$operacion = $this->Facturacion->Operacion->find(
	    'first',
	    array(
		'conditions' => array('Operacion.id' => $id),
		'contain' => array(
		    'Contrato' => array(
			'CalidadNombre',
			'Proveedor'
		    ),
		    'Transporte' => array(
			'Naviera',
			'Agente'
		    ),
		    'PrecioTotalOperacion'
		)
	    )
	);
	$this->set(compact('operacion'));
	$this->set('referencia', $operacion['Operacion']['referencia']);
	$this->set('proveedor', $operacion['Contrato']['Proveedor']['nombre_corto']);
	$this->set('proveedor_id', $operacion['Contrato']['Proveedor']['id']);
	$this->set('calidad', $operacion['Contrato']['CalidadNombre']['nombre']);
	$this->set('condicion', $operacion['Contrato']['condicion']);
	$this->set('coste_teorico', $operacion['PrecioTotalOperacion']['precio_dolar_tonelada']."$/Tm");
	$this->set('cambio_teorico', $operacion['Operacion']['cambio_dolar_euro']."$/€");
    }
}
?>
