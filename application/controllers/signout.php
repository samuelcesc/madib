<?php 

/**@autor Ojuma Samuel
 * 
 */
class Signout extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function Index(){
		$this->load->model('Auth_model');
		
		$logged_out = $this->Auth_model->Unset_Session();
		
		redirect(base_url());
	}
}


 ?>