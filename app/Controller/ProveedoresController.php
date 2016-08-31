<?php
class ProveedoresController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>
