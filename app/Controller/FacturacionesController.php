<?php
class FacturacionesController extends AppController {
    public $paginate = array(
	'order' => array('Operacion.referencia' => 'asc')
    );

    public function index() {
        $this->paginate['order'] = array('Operacion.referencia' => 'asc');
        $this->paginate['recursive'] = 3;
        $this->paginate['contain'] = array(
            'Operacion' => array(
            'fields' => array(
                'referencia',
                'contrato_id'
            )
            ),
            'Calidad' => array(
            'fields' => array(
                'nombre'
            )
            ),
            'Proveedor' => array(
            'fields' => array(
                'nombre_corto'
            )
            ),
            'Contrato' => array(
            'calidad_id',
            'proveedor_id'
            )
        );
        $this->Facturacion->bindModel(
            array(
                'belongsTo' => array(
                    'Contrato' => array(
                        'foreignKey' => false,
                        'conditions' => array('Contrato.id = Operacion.contrato_id')
                    ),
                    'Calidad' => array(
                        'foreignKey' => false,
                        'conditions' => array('Contrato.calidad_id = Calidad.id')
                    ),
                    'Proveedor' => array(
                        'className' => 'Empresa',
                        'foreignKey' => false,
                        'conditions' => array('Proveedor.id = Contrato.proveedor_id')
                    )
                )
            )
        );
        $this->set('facturaciones', $this->paginate());
    }

    public function view($id = null) {
        if (!$id) {
            //$this->Flash->set('URL mal formado Facturación/view');
            //$this->redirect(array('action'=>'index'));
            throw new NotFoundException('No existe tal facturación');
        }
        $facturacion = $this->Facturacion->find(
            'first',
            array(
                'conditions' => array('Facturacion.id' => $id),
                'contain' => array(
                    'Operacion' => array(
                        'Contrato' => array(
                            'Calidad',
                            'Incoterm',
                            'Proveedor'
                        ),
                        'Transporte' => array(
                            'Naviera',
                            'Agente',
                        ),
                        'PrecioTotalOperacion',
                        'PesoOperacion'
                    ),
                    'Factura' => array(
                        'Empresa'
                    )
                ),
                'recursive' => 3
            )
        );
        if (!$facturacion) {
            //$this->Flash->set('URL mal formada: No existe facturacion con id: '.$id);
            //$this->History->Back(0);
            throw new NotFoundException('No existe tal facturación');
        }
        $this->set(compact('facturacion'));
        $this->set('facturacion_id',$id);
        $this->set('referencia',$facturacion['Operacion']['referencia']);
        $this->set('proveedor',$facturacion['Operacion']['Contrato']['Proveedor']['nombre_corto']);
        $this->set('proveedor_id',$facturacion['Operacion']['Contrato']['Proveedor']['id']);
        $this->set('calidad',$facturacion['Operacion']['Contrato']['Calidad']['nombre']);
        $this->set('condicion',$facturacion['Operacion']['Contrato']['condicion']);
        $this->set('precio_estimado', $facturacion['Operacion']['PrecioTotalOperacion']['precio_euro_kilo_total']);
        $this->set('cambio_teorico', $facturacion['Operacion']['cambio_dolar_euro']);
        $this->set('precio_cafe', $facturacion['Facturacion']['precio_dolar_tm']);
        $this->set('cambio_real', $facturacion['Facturacion']['cambio_dolar_euro']);
	$this->set('gastos_bancarios', $facturacion['Facturacion']['gastos_bancarios_pagados']);
	$this->set('despacho', $facturacion['Facturacion']['despacho_pagado']);
	$this->set('seguro', $facturacion['Facturacion']['seguro_pagado']);
	$this->set('flete', $facturacion['Facturacion']['flete_pagado']);
	$this->set('total_cafe', round($facturacion['Facturacion']['total_cafe'],2));
	$this->set('total_gastos', $facturacion['Facturacion']['total_gastos']);
	$this->set('peso_facturacion', $facturacion['Facturacion']['peso_facturacion']);
	$peso_medio_saco = $facturacion['Facturacion']['peso_facturacion']/$facturacion['Operacion']['PesoOperacion']['cantidad_embalaje'];
	$this->set(compact('peso_medio_saco'));
	$this->set(
	    'precio_real',
	    round(($facturacion['Facturacion']['total_gastos']+$facturacion['Facturacion']['total_cafe'])/$facturacion['Facturacion']['peso_facturacion'],6)
	);

	//ahora el precio que facturamos por asociado
	$this->loadModel('PesoFacturacion');
	$peso_asociados = $this->PesoFacturacion->find(
	    'all',
	    array(
            'conditions' => array(
                'operacion_id' => $id
            )
	    )
	);
	$this->set(compact('peso_asociados'));
	$this->PesoFacturacion->virtualFields = array(
	    'total_peso_retirado' => 'sum(total_peso_retirado)',
	    'total_sacos_pendientes' => 'sum(sacos_pendientes)',
	    'total_peso_pendiente' => 'sum(peso_pendiente)',
	    'total_peso_total' => 'sum(peso_total)'
	);
	$totales = $this->PesoFacturacion->find(
	    'first',
	    array(
            'conditions' => array(
                'PesoFacturacion.operacion_id' => $id
            )
	    )
	);
	$this->set('totales',$totales['PesoFacturacion']);

	//Se declara para acceder al PDF
	$this->set(compact('id'));
    }

    public function add() {
        if (!isset($this->params['named']['from_id'])) {
            throw new MethodNotAllowedException('URL mal formada: from_id ausente');
        }
        $this->form($this->params['named']['from_id']);
        $this->render('form');
    }

    public function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Flash->set('error en URL Facturación/edit');
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
                        'Calidad',
                        'Proveedor'
                    ),
                    'Transporte' => array(
                        'Naviera',
                        'Agente'
                    ),
                    'PrecioTotalOperacion',
                    'PesoOperacion',
                    'Embalaje'
                )
            )
        );
        $this->set(compact('operacion'));
        $ultimo_despacho = $this->Facturacion->Operacion->Transporte->find(
            'first',
            array(
                'conditions' => array('Transporte.operacion_id' => $id),
                'fields' => array(
                    'max(fecha_despacho_op) AS ultimo'
                ),
            'recursive' => -1
            )
        );
        $bultos_despachados = $this->Facturacion->Operacion->Transporte->AlmacenTransporte->find(
            'first',
            array(
                'conditions' => array('Transporte.operacion_id' => $id),
                'fields' => array(
                    'sum(cantidad_cuenta) AS cantidad_cuenta'
                ),
                'joins' => array(
                    array(
                        'table' => 'transportes',
                        'alias' => 'Transporte',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'AlmacenTransporte.transporte_id = Transporte.id'
                        )
                    )
                ),
                'recursive' => -1
            )
        );
        $bultos_retirados = $this->Facturacion->Operacion->Retirada->find(
            'first',
            array(
                'conditions' => array(
                    'Retirada.operacion_id' => $id
                ),
                'fields' => array(
                    'sum(embalaje_retirado) AS sacos_retirados'
                )
            )
        );
        $sacos_retirados = $bultos_retirados[0]['sacos_retirados'];
        $this->set('ultimo_despacho',$ultimo_despacho[0]['ultimo']);
        $this->set('referencia', $operacion['Operacion']['referencia']);
        $this->set('proveedor', $operacion['Contrato']['Proveedor']['nombre_corto']);
        $this->set('proveedor_id', $operacion['Contrato']['Proveedor']['id']);
        $this->set('calidad', $operacion['Contrato']['Calidad']['nombre']);
        $this->set('condicion', $operacion['Contrato']['condicion']);
        $this->set('coste_teorico', $operacion['PrecioTotalOperacion']['precio_divisa_tonelada']);
        $this->set('coste_estimado', $operacion['PrecioTotalOperacion']['precio_euro_kilo_total']);
        $this->set('cambio_teorico', $operacion['Operacion']['cambio_dolar_euro']);
        foreach($operacion['Transporte'] as $transporte) {
            $transportes[] = (empty($transporte['Naviera'])?'pendiente':$transporte['Naviera']['nombre_corto'])
            .'/'.(empty($transporte['Agente'])?'pendiente':$transporte['Agente']['nombre_corto']);
        }
        $this->set(compact('transportes'));
        $this->set(
            'bultos_despachados',
            $bultos_despachados[0]['cantidad_cuenta'].'/'.$operacion['PesoOperacion']['cantidad_embalaje']
        );
        $this->set(
            'cuentaVentas',
            $this->Facturacion->CuentaVenta->find(
                'list',
                array(
                    'conditions' => array(
                    'CuentaVenta.tipo' => 'venta'
                    )
                )
            )
        );
        $this->set(
            'cuentaIvas',
            $this->Facturacion->CuentaIva->find(
                'list',
                array(
                    'conditions' => array(
                    'CuentaIva.tipo' => 'iva'
                    )
                )
            )
        );

        //solo mostramos los pesos que estan definidos
        $peso_facturacion = array();
        //el peso real de la operacion, basado en el peso ya retirado
        //solo mostramos los pesos que estan definidos
        $peso_facturacion = array();
        if ($sacos_retirados != 0) {
            $peso_retirado = round($operacion['PesoOperacion']['peso_retirado']*$operacion['PesoOperacion']['cantidad_embalaje']/$sacos_retirados);
            $peso_facturacion[$peso_retirado] = 'Peso retirado ('.$peso_retirado.'kg)';
        };
        //el peso real de la operacion, basado en el peso medido a la entrada de almacén
        $peso_entrada = round($operacion['PesoOperacion']['peso_entrada']);
        if ($peso_entrada != 0) {
            $peso_facturacion[$peso_entrada] = 'Peso entrada ('.$peso_entrada.'kg)';
        };
        //el peso real de la operacion, basado en el peso que aparece en la factura del proveedor
        $peso_pagado = $operacion['PesoOperacion']['peso_pagado'];
        if ($peso_pagado != 0) {
            $peso_facturacion[$peso_pagado] = 'Peso factura ('.$peso_pagado.'kg)';
        };
        $this->set('peso_facturacion', $peso_facturacion);

        //si es un edit, hay que rellenar el id, ya que
        //si no se hace, al guardar el edit, se va a crear
        //un _nuevo_ registro, como si fuera un add
        if (!empty($id)) $this->Facturacion->id = $id;

        if ($this->request->is(array('post', 'put'))) {//la vuelta de 'guardar' el formulario
            $this->request->data['Facturacion']['peso_medio_saco']= $this->request->data['Facturacion']['peso_facturacion']/$operacion['PesoOperacion']['cantidad_embalaje'];
            if($this->Facturacion->save($this->request->data)){
                $this->Flash->set('Facturación guardada');
                $this->redirect(array(
                    'action' => 'view',
                    'controller' => 'facturaciones',
                    $id
                ));
            } else {
                $this->Flash->set('Facturación NO guardada');
                //$this->History->Back(0);
            }
        } else { //es un GET (o sea un edit), hay que pasar los datos ya existentes
            $this->request->data = $this->Facturacion->read(null, $id);
        }
    }
}
?>
