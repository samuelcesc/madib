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
	
	function mail(){
		$config = array('protocol'=>'smtp','smtp_host'=>'ssl://smtp.gmail.com',
		'smtp_port'=>465,'smtp_user'=>'samuelcesc@gmail.com','smtp_pass'=>'sa123sa456','mailtype'=>'html');
		$to = "samuel.ojumah@covenantuniversity.edu.ng";
		$from = "samuelcesc@gmail.com";
		$subject = "The Course Graph";
		$message = "Finally It works...Next Stop is full functionality to the Application! Thank you Jesus!";
		// load the email library that provided by CI
		$this->load->library('email', $config);
		// this will bind your attributes to email library
		$this->email->set_newline("\r\n");
		$this->email->from($from, 'Your Company');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		
		// send your email. if it produce an error it will print 'Fail to send your message!' for you
		if($this->email->send()) {
		echo "Message sent successfully!";
		}
		else {
		echo "Fail to send your message!";
		}
	} 
}
