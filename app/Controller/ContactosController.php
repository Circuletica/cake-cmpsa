<?php
class ContactosController extends AppController {
    var $name = 'Contactos';
    function index() {
        $this->set('contactos', $this->Contacto->find('all'));
        $this->set('empresas', $this->Contacto->Empresa->find('list'));
    }

    public function add() {
        //el id y la clase de la entidad de origen vienen en la URL
        if (!$this->params['named']['from_id']) {
            $this->Flash->set('URL mal formado Contactos/add '.$this->params['named']['from_controller']);
            $this->redirect(array(
                'controller' => $this->params['named']['from_controller'],
                'action' => 'index'
            ));
        }
        $this->form();
        $this->render('form');
    }

    public function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Flash->set('error en URL Contactos/edit');
            $this->redirect(array(
                'action' => 'index',
                'controller' => $this->params['named']['from_controller'],
            ));
        }
        $this->form($id);
        $this->render('form');
    }

    public function form($id = null) {
        $this->set('action', $this->action);
        $empresa_id = $this->params['named']['from_id'];
        //necesitamos el nombre de la empresa para el breadcrumb y el título de la vista
        $this->set(
            'empresa',
            $this->Contacto->Empresa->findById($empresa_id)
        );
        $this->set('departamentos',$this->Contacto->Departamento->find('list'));

        if (!empty($id)) {
            $this->Contacto->id = $id;
            $contacto = $this->Contacto->findById($id);
            $this->set('referencia', $contacto['Contacto']['nombre']);
        }
        if ($this->request->is('post','put')){  //es un POST
            $this->request->data['Contacto']['empresa_id'] = $empresa_id;
            if($this->Contacto->save($this->request->data)) {
                $this->Flash->set('Contacto guardado');
                $this->redirect(
                    array(
                        'action' => 'view',
                        'controller' => $this->params['named']['from_controller'],
                        $empresa_id,
                    )
                );
            } else {
                $this->Flash->set('Contacto NO guardado');
                $this->History->Back(-1);
            }
        } else { //es un GET
            $this->request->data= $this->Contacto->read(null, $id);
        }
    }

    public function delete($id) {
        //el $id es del contacto, sacamos el id y la clase de empresa de la URL
        if($this->request->is('post') && $id){
            if($this->Contacto->delete($id)) {
                $this->Flash->set('Contacto borrado');
                $this->History->Back(0);
            } else {
                $this->Flash->set('Contacto NO borrado');
                $this->History->Back(0);
            }
        } else {
            throw new MethodNotAllowedException('URL mal formada y/o id ausente');
        }
    }
}
?>
