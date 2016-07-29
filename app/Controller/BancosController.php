<?php
class BancosController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}

	public function view_pdf($id = null) {
		$this->Banco->id = $id;
		if (!$this->Banco->exists()) {
			throw new NotFoundException(__('No existe banco con tal id'));
		}
		// increase memory limit in PHP
		ini_set('memory_limit', '512M');
		$this->set('banco', $this->Banco->read(null, $id));
	}
}
?>
