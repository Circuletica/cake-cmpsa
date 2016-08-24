<?php
class AgentesController extends AppController {

	public function delete( $id = null) {
		$this->deleteCompany($id);
	}
}
?>