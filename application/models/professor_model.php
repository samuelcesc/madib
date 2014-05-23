<?php

/**@author Ojumah Samuel
 * 
 */
class Professor_model extends User_model {
	
	var $firstname;
	var $lastname;
	var $email_address;
	var $program;
	var $picture;
	var $title;
	var $user_id;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	function Create_Profile(){
		//Make Sure D email is not already used...Validate email
		//Store Passord usin encryption...
		$this->picture = "professor_default.jpg";
		 
		$query = $this->db->get_where('programs', array('program_name' => $this->program));
		$result = $query->result_array();
		
		$program_id = $result[0]['program_id'];
		
		$this->user_auth_id = $this->GenerateAuthID();
		$this->password = $this->EncryptPassword();
		
		$user_table_data = array('firstname'=>$this->firstname,'lastname'=>$this->lastname,
							  'email_address'=>$this->email_address,'password'=>$this->password,	
							  'auth_token'=>$this->user_auth_id,'program_id'=>$program_id							
							);
		
		$this->db->trans_start();
		$this->db->insert('users',$user_table_data);
		
		$query_for_email = $this->db->get_where('users', array('email_address' => $this->email_address));
		$user_data = $query_for_email->result_array();
		
		$user_id = $user_data[0]['user_id'];
		
		$professor_data = array('title_id'=>$this->title,'user_id'=>$user_id);
		$this->db->insert('professors',$professor_data);
		
		$picture_data = array('user_id'=>$user_id,'location'=>$this->picture);
		$this->db->insert('profile_pictures',$picture_data);

		$this->db->trans_complete();
	}
	
	
	function Is_Valid(){
		//Returns true if it is a valid Professor...
		$query = $this->db->get_where('professors',array('user_id'=>$this->user_id));
		if($query->num_rows() == 1){
			return true;
		}
		
		return false;
	}
	
	function GetProfileDetails(){
		//Return Details for Users Profile
		$this->load->model('User_model');
		
		if(!isset($this->user_id)){
		$this->user_id = $this->User_model->Get_User_ID_By_Token($this->user_id); //Just Like a call to require ID of USER
		}
		
		$this->db->select('firstname,lastname,auth_token,program_name,title_name');
		$this->db->from('users');
		$this->db->join('programs','users.program_id = programs.program_id');
		$this->db->join('professors', 'professors.user_id = users.user_id');
		$this->db->join('titles', 'professors.title_id = titles.title_id');
		$this->db->where('users.user_id', $this->user_id);
		$query = $this->db->get();
		
		$results = $query->result_array();
		return $results[0];
	}
}
