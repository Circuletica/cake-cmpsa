<?php
class NavierasController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>