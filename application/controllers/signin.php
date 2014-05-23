<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
 
class Signin extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
		$this->Auth_model->Unset_Session();
	}
	
	function Index(){
			$this->session->set_flashdata("error", "Please Sign In to Continue");
      		$this->load->view('signin');
			$this->load->view('include/footer');
	}
	
	function auth(){
		$this->load->model('Auth_model');
		$login_data = $this->Auth_model->Login();
		
		if(empty($login_data)){
			$this->session->set_flashdata("error", "You can login using any email associated with your account. Make sure that it is typed correctly");
			redirect(base_url('signin'));
		}
		
		redirect(base_url('home'));
	}
}
