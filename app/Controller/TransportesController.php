<?php
class TransportesController extends AppController {
		public function index() {
		//$this->Calidad->recursive = 1;
		//$this->Calidad->setSource('CalidadNombre');
		$this->set('transportes', $this->paginate());

		}
}
?>