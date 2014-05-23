<?php

/**@author Ojumah Samuel
 * @copyriht 2014
 */
class Student_model extends User_model {
	
	var $firstname;
	var $lastname;
	var $email_address;
	var $program;
	var $picture;
	var $level;
	var $user_id;
	var $grad_year;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	function Create_Profile(){
		
		$this->load->model('Auth_model');
		
		$this->picture = "student_default.jpg";
		
		$query = $this->db->get_where('programs', array('program_name' => $this->program));
		$result = $query->result_array();
		
		$program_id = $result[0]['program_id'];
		
		$this->user_auth_id = $this->GenerateAuthID();
		
		$this->Auth_model->password = $this->password;
		$this->password = $this->Auth_model->EncryptPassword();
		
		$user_table_data = array('firstname'=>$this->firstname,'lastname'=>$this->lastname,
							  'email_address'=>$this->email_address,'password'=>$this->password,'auth_token'=>$this->user_auth_id,	
							  'program_id'=>$program_id							
							);
		
		$this->db->trans_start();
		$this->db->insert('users',$user_table_data);
		
		$query_for_email = $this->db->get_where('users', array('email_address' => $this->email_address));
		$user_data = $query_for_email->result_array();
		
		$user_id = $user_data[0]['user_id'];
		
		$student_table_data = array('level'=>$this->level,'user_id'=>$user_id,'grad_year'=>$this->grad_year);
		$this->db->insert('students',$student_table_data);
		
		$picture_data = array('user_id'=>$user_id,'location'=>$this->picture);
		$this->db->insert('profile_pictures',$picture_data);

		$this->db->trans_complete();
		
		return true;
	}
	
	function Is_Valid(){
		//Returns true if it is a valid student...
		$query = $this->db->get_where('students',array('user_id'=>$this->user_id));
		if($query->num_rows() == 1){
			return true;
		}
		
		return false;
	}
	
	function GetProfileDetails(){
		//Return Details for Users Profile
		$this->load->model('User_model');
		
		$this->user_id = $this->User_model->Get_User_ID_By_Token($this->user_auth_id); //Just Like a call to require ID of USER
		//Did this because the user_id might be set but above function just represents auth ID and sends to model to deliver real ID
		
		$this->db->select('firstname,lastname,auth_token,program_name,level,grad_year');
		$this->db->from('users');
		$this->db->join('programs', 'programs.program_id = users.program_id');
		$this->db->join('students', 'students.user_id = users.user_id');
		$this->db->where('users.user_id', $this->user_id);
		$query = $this->db->get();
		
		$results = $query->result_array();
		
		return $results[0];
	}
	
}
