<?php
class AseguradorasController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>
