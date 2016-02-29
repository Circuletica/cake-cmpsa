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
}
?>
