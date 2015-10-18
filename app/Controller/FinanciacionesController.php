<?php
class FinanciacionesController extends AppController {
    public $scaffold = 'admin';
    public $paginate = array(
	'order' => array('Operacion.referencia' => 'asc')
    );

    public function index() {
	$this->paginate['contain'] = array(
	    'Empresa',
	    'Operacion'
	);
	$this->Financiacion->bindModel(array(
		'belongsTo' => array(
			'Empresa' => array(
				'foreignKey' => false,
				'conditions' => array('Empresa.id = Financiacion.banco_id')
				)
			)
	));
	$this->set('financiaciones', $this->paginate());
    }
    public function view($id = null) {
	//el id y la clase de la financiación de origen vienen en la URL
	if (!$id) {
		$this->Session->setFlash('URL mal formado Financiación/view');
		$this->redirect(array('action'=>'index'));
	}
	$financiacion = $this->Financiacion->find(
		'first',
		array(
			'conditions' => array('Financiacion.id' => $id),
			'recursive' => 4
		)
	);
	$totales = $this->Financiacion->RepartoOperacionAsociado->find(
	    'first',
	    array(
		'conditions' => array('RepartoOperacionAsociado.id' => $id),
		'fields' => array(
		    'sum(porcentaje_embalaje_socio) AS total_porcentaje_embalaje',
		    'sum(cantidad_embalaje_asociado) AS total_cantidad_embalaje',
		    'sum(peso_asociado) AS total_peso',
		    'sum(precio_asociado) AS total_precio',
		    'sum(precio_asociado_con_iva) AS total_precio_con_iva',
		)
	    )
	);
	//quitamos un nivel de anidacion en el array que obtenemos
	$this->set('totales',$totales[0]);
	$this->set(compact('financiacion'));
	$this->set('referencia', $financiacion['Operacion']['referencia']);
	$this->set('proveedor', $financiacion['Operacion']['Contrato']['Proveedor']['Empresa']['nombre_corto']);
	$this->set('proveedor_id', $financiacion['Operacion']['Contrato']['Proveedor']['id']);
	$this->set('calidad', $financiacion['Operacion']['Contrato']['CalidadNombre']['nombre']);
	$this->set('repartos', $financiacion['RepartoOperacionAsociado']);
	$transporte = $financiacion['Operacion']['Contrato']['si_entrega'] ? 'entrega' : 'embarque';
	//solo el año de embarque/entrega
	$transporte .= ' '.substr($financiacion['Operacion']['Contrato']['fecha_transporte'],0,4);
	$this->set(compact('transporte'));
	$this->set('fecha_vencimiento',$financiacion['Financiacion']['fecha_vencimiento']);
	$cuenta = $financiacion['Banco']['Empresa']['nombre_corto'].' '.$this->iban('ES',$financiacion['Banco']['Empresa']['cuenta_bancaria']);
	$this->set(compact('cuenta'));
    }
}
?>
