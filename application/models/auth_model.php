<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Auth_model extends CI_Model {
	
	var $email_address;
	var $password;
	var $details;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	function Is_Session_Set(){
		if($this->session->userdata('auth_token')){
	  	  return true;
	  	}
		return false;
	}
	
	function Login(){
		$this->email_address = $this->input->post('email_address');
		$this->password = $this->input->post('password');
		
		$this->password = $this->EncryptPassword();
		
		$login_data = array('email_address' => $this->email_address,
					   'password'=> $this->password 	
						);
		
		$query = $this->db->get_where('users',$login_data);
		
		$results = $query->result();
		if((is_array($results)) && count($results) == 1){
			$this->details = $results[0];
			$this->Set_Session();
			return true;
		}
		
		return false;
		
	}
	
	function EncryptPassword(){
		$encrypted_password = md5($this->password);
		
		return $encrypted_password;
	}
	
	function Unset_Session(){
		
		$session_vars = array(
							'auth_token' =>'',
							'firstname'=> '',
							'lastname'=>'',
							'profile_picture'=>''
							);
							
		$this->session->unset_userdata($session_vars);
		
		$this->session->keep_flashdata('error');
		
		return true;		
	}
	
	function Set_Session(){
		
		//Need Profile Picture
		$this->load->model('User_model');
		
		$this->User_model->user_auth_id = $this->details->auth_token;

		$this->session->set_userdata(array(
				'auth_token' => $this->details->auth_token,
				'firstname'=>$this->details->firstname,
				'lastname'=>$this->details->lastname,
				));
				
		$profile_picture = $this->User_model->ReturnProfilePicture();
		$this->session->set_userdata(array('profile_picture'=>$profile_picture));
		
		return true;
	} 
}
