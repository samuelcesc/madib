<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */

 //This is the Signup Controller 
class SignUp extends CI_Controller {
	
	var $session_data;
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	
	function Index(){
		
		$this->load->helper(array('form','url'));		
		
		$this->load->view('signup/signup');
		$this->load->view('include/footer');
	}
	
	function Next(){
		$this->load->model('Course_model');
		$this->load->model('User_model');
		$dataa['programs'] = $this->Course_model->ReturnAllPrograms();
		 
		$data = $this->input->post();
		$data['firstname'] = ucfirst($data['firstname']);
		$data['lastname'] = ucfirst($data['lastname']);
		
		
		$this->User_model->email_address = $data['email_address'];
		
		$email_valid = $this->User_model->IsEmailValid();
		
		if(!$email_valid){ //Email not Valid, Redirect..
			redirect(base_url('signup'));
		}
		
		$this->session_data = $this->session->set_userdata($data);		
		
		if($this->session->userdata('user') == "student"){
			$this->load->view('signup/student',$dataa);
		}
		else if($this->session->userdata('user') == "professor"){
			$this->load->view('signup/professor',$dataa);
		}
		else{
			redirect(base_url('signup'));
		}
		
	}
	
	function Complete(){
			
		//Complete the Sinup Process 
		$post_data = $this->input->post();
		
		//Does User Exist???
		$this->load->model('User_model');
		$this->User_model->email_address = $this->session->userdata('email_address');
		
		$user_exists = $this->User_model->UserAlreadyExists();
		
		if($user_exists){
			$this->session->set_flashdata("warning", "You Already have an account. Please Sign In to Continue");
			redirect(base_url('signin'));
		} 
		
		//In the View, I had to set a value for the buttons....Any better way??
		
		if($this->input->post('complete_professor')){

			$this->load->model('Professor_model');
			
			$this->Professor_model->firstname = $this->session->userdata('firstname');
			$this->Professor_model->lastname = $this->session->userdata('lastname');
			$this->Professor_model->email_address = $this->session->userdata('email_address');
			$this->Professor_model->password = $this->session->userdata('password');
			
			$this->Professor_model->title = $this->input->post('title');
			$this->Professor_model->program = $this->input->post('program');
			
			$this->Professor_model->Create_Profile();
			redirect(base_url());
		}
		else if($this->input->post('complete_student')){
			$this->load->model('Student_model');
			
			$this->Student_model->firstname = $this->session->userdata('firstname');
			$this->Student_model->lastname = $this->session->userdata('lastname');
			$this->Student_model->email_address = $this->session->userdata('email_address');
			$this->Student_model->password = $this->session->userdata('password');
			
			$this->Student_model->program = $this->input->post('program');
			$this->Student_model->level = $this->input->post('level');
			$this->Student_model->grad_year = $this->input->post('class');
			
			$create_student = $this->Student_model->Create_Profile();
			
			if($create_student){
				$this->session->set_flashdata("success", "Your Account has been Successfully Created. Please Sign In to Continue");
				redirect(base_url('signin'));
			}
			else{
				redirect(base_url('signup'));
			}		
			
		}		
	}
	
	
}
