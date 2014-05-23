<?php if (!defined('BASEPATH')) die();
class Frontpage extends CI_Controller {
	
	function __construct(){
      parent::__construct();
	  
	  $this->load->model('Auth_model');
	  
	  if($this->Auth_model->Is_Session_Set()){
	  	redirect(base_url().'home');
	  }
   }
   
   public function index()
	{
      $this->load->view('frontpage');
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
