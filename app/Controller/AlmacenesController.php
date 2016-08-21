<?php
class AlmacenesController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>