<?php
class MuestrasController extends AppController {

    public function index() {
        $this->Muestra->virtualFields['calidad']=$this->Muestra->Calidad->virtualFields['nombre'];
        $this->paginate['contain'] = array(
                'Proveedor',
                'Calidad',
                'Contrato' => array(
                    'fields' => array(
                        'id',
                        'referencia',
                        'proveedor_id',
                        'calidad_id'
                        ),
                    'Proveedor',
                    'Operacion' => array(
                        'fields' => array(
                            'id',
                            'referencia'
                            )
                        )
                    ),
                'MuestraEmbarque' => array(
                    'Calidad',
                    'Proveedor'
                    )
                    );
        $this->paginate['order'] =  array(
                'Muestra.registro' => 'DESC'
                );
        $this->paginate['recursive'] = 1;

        $this->set('tipos', $this->tipoMuestras);
        $tipo = $this->tipoMuestras[$this->passedArgs['Search.tipo_id']];

        //necesitamos la lista de proveedor_id/nombre para rellenar el select
        //del formulario de busqueda
        $this->loadModel('Proveedor');
        $proveedores = $this->Proveedor->find(
                'list',
                array(
                    'fields' => array('Proveedor.id','Empresa.nombre_corto'),
                    'order' => array('Empresa.nombre_corto' => 'asc'),
                    'recursive' => 1
                    )
                );
        $this->set('proveedores',$proveedores);

        $title = $this->filtroPaginador(
                array(
                    'Muestra' => array(
                        'Tipo' => array(
                            'columna' =>'tipo_id',
                            'exacto' => true,
                            'lista' => $this->tipoMuestras
                            ),
                        'Registro' => array(
                            'columna' => 'tipo_registro',
                            'exacto' => false,
                            'lista' => ''
                            ),
                        'Proveedor' => array(
                            'columna' => 'proveedor_id',
                            'exacto' => true,
                            'lista' => $proveedores
                            ),
                        'Calidad' => array(
                            'columna' => 'calidad',
                            'exacto' => false,
                            'lista' => ''
                            )
                            )
                            )
                            );

        //filtramos por fecha
        if(isset($this->passedArgs['Search.fecha'])) {
            $fecha = $this->passedArgs['Search.fecha'];
            //Si solo se ha introducido un año (aaaa)
            if (preg_match('/^\d{4}$/',$fecha)) { $anyo = $fecha; }
            //la otra posibilidad es que se haya introducido mes y año (mm-aaaa)
            elseif (preg_match('/^\d{1,2}-\d\d\d\d$/',$fecha)) {
                list($mes,$anyo) = explode('-',$fecha);
            } else {
                $this->Flash->set('Error de fecha');
                $this->redirect(array('action' => 'index'));
            }
            //si se ha introducido un año, filtramos por el año
            if($anyo) { $this->paginate['conditions']['YEAR(Muestra.fecha) ='] = $anyo;};
            //si se ha introducido un mes, filtramos por el mes
            if(isset($mes)) { $this->paginate['conditions']['MONTH(Muestra.fecha) ='] = $mes;};
            $this->request->data['Search']['fecha'] = $fecha;
            //completamos el titulo
            $title .= '|Fecha: '.$fecha;
        }

        $muestras =  $this->paginate();
        $title = 'Muestras | '.$title;

        //pasamos los datos a la vista
        $this->set(compact('muestras','title'));
    }

    public function view($id = null) {
        if (!$id) {
            $this->Flash->set('URL mal formada Muestra/view');
            $this->redirect(array('action'=>'index'));
        }
        $muestra = $this->Muestra->find(
                'first',
                array(
                    'conditions' => array('Muestra.id' => $id),
                    'contain' => array(
                        'Proveedor',
                        'Calidad',
                        'Contrato',
                        'LineaMuestra'=>array(
                            'AlmacenTransporte',
                            'Operacion'=>array(
                                'fields'=>array(
                                    'referencia'
                                    )
                                )
                            )
                        ),
                    )
                );
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
                'filename'=>'INFORME-'.$id.'pdf'
                );
        $this->set(compact('id'));
        //hay una view distinta para cada
        //tipo de muestra, ya que los campos
        //no son iguales
        switch ($muestra['Muestra']['tipo_id']) {
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
        $muestra = $this->Muestra->findById($id);
        $tipo = $muestra['Muestra']['tipo_id'];
        if ($this->Muestra->delete($id)) {
            $this->Flash->set('Muestra borrada');
            $this->redirect(
                    array(
                        'action'=>'index',
                        'Search.tipo_id' => $tipo
                        )
                    );
        }
    }

    public function add() {
        if(!isset($this->passedArgs['tipo_id'])) {
            $this->Flash->set('Error en URL, falta tipo muestra');
            $this->redirect(
                    array(
                        'action' => 'index',
                        'Search.tipo_id' => 1
                        )
                    );
        }
        $this->form();
        $this->render('form');
    }

    public function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Flash->set('error en URL');
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
        //$this->set('tipos', $tipos);
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
            $tipo_id = $muestra['Muestra']['tipo_id'];
            $tipo_nombre = $tipos[$tipo_id];
            $this->set('referencia',$muestra['Muestra']['tipo_registro']);
        } else { //es un add()	
            //Si no esta el tipo de muestra en la URL, volvemos
            //a muestras de oferta
            $tipo_id = $this->passedArgs['tipo_id'];
            $tipo_nombre = $tipos[$tipo_id];
            $this->Muestra->virtualFields += array(
                    'ultimoRegistro' => 'MAX(Muestra.registro)'
                    );
            $ultimo_registro = $this->Muestra->find(
                    'first',
                    array(
                        'conditions' => array(
                            'Muestra.tipo_id' => $tipo_id
                            ),
                        'fields' => array(
                            'ultimoRegistro'
                            )
                        )
                    );
            $nuevo_registro = $ultimo_registro['Muestra']['ultimoRegistro'] + 1;
            $this->set(compact('nuevo_registro'));
        }
        $this->set('tipo_id',$tipo_id);
        $this->set(compact('tipo_nombre'));

        //el titulado completo de la Calidad sale de una vista
        //de MySQL que concatena descafeinado, pais y descripcion
        $calidades = $this->Muestra->Calidad->find('list');
        $this->set('calidades',$calidades);
        $this->set(
                'contratos',
                $this->Muestra->Contrato->find('list')
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
                                'id',
                                'nombre_corto'
                                )
                            ),
                        'Calidad'
                        ),
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
                    'contain' => array(
                        'Muestra' => array(
                            'conditions' => array(
                                'Muestra.tipo_id' => 2
                                ),
                            'fields' => array(
                                'id',
                                'tipo_registro'
                                )
                            )
                        ),
                    'fields' => array(
                        'Contrato.id'
                        )
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
                        'Muestra.tipo_registro',
                        'Contrato.id',
                        'Contrato.proveedor_id',
                        'Contrato.calidad_id'
                        ),
                    'conditions' => array(
                        'tipo_id' =>2 // solo las muestras de embarque
                        )
                    )
                );
        //queremos el id de la muestra como index del array
        //por una parte, un array para el js que permite rellenar
        //los demás campos cuando se selecciona una muestra de embarque
        $this->set (
                'muestraEmbarques',
                Hash::combine($muestrasEmbarque, '{n}.Muestra.id','{n}.Muestra.tipo_registro')
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
                        $contratosMuestra[$this->request->data['Muestra']['contrato_id']]['Calidad']['id'];
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
                $this->Flash->set('Muestra guardada');
                $this->redirect(
                        array(
                            'action' => 'view',
                            $this->Muestra->id
                            )
                        );
            } else {
                $this->Flash->set('Muestra NO guardada');
            }
        } else { //es un GET
            $this->request->data= $this->Muestra->read(null, $id);
        }
        $this->render('form');
    }
}
?>
