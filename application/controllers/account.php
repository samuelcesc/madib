<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Account extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	
	function Index(){
		redirect(base_url());
	}
	
	function Reset_Password(){
		$this->load->view('account/reset_password');
	}
	
	function SendLink(){
		$email_address = $this->input->post('email_address');
		$this->load->model('Profile_model');
		$this->Profile_model->SendPasswordLink($email_address);
		$this->session->set_flashdata("success", "Your Account will be verified and a link will be sent to you Shortly");
		redirect(base_url('account/reset_password'));
	}
	
	function test(){
		$id = $this->input->post('user_id');
		echo $id;
	}
}
