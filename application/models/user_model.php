<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class User_model extends CI_Model {
	
	var $firstname;
	var $lastname;
	var $user_id;
	var $user_auth_id;
	var $email_address;
	var $followers_count;
	var $following_count;
	var $profile_picture;
	var $status;
	var $user_in_session; //Holds the ID of the user in session.
	var $bio_info; #users bio information
	var $interest;
	var $facebook_name;
	var $linkedin_name;
	var $contacts;
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->user_in_session = $this->User_In_Session();
	}
	
	function UserAlreadyExists(){
		//Returns True if user exists
		$query = $this->db->get_where('users',array('email_address'=>$this->email_address));
		if($query->num_rows() == 0){
			return FALSE;
		}
		return TRUE;
	}
	
	function GenerateAuthID(){
		
    $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
    $auth_id = '';
    for ($i = 0; $i < 10; $i++) {
        $auth_id .= $charset[rand(0, strlen($charset) - 1)];
    }
    
    return $auth_id;
	
	}
	
	private function User_In_Session(){
		$query = $this->db->get_where('users',array('auth_token'=>$this->session->userdata('auth_token')));
		$results =  $query->result_array();

		return $results[0]['user_id']; //return the ID in the database of users.. 	
	}
	
	function Get_User_Name_By_ID(){
		$this->db->select('firstname,lastname');
		$this->db->from('users');
		$this->db->where('user_id',$this->user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0){
			$results = $query->result_array();
			return $results[0];
		}
		
		return false;
	}
	
	private function Get_User_Auth_By_ID(){
		$query = $this->db->get_where('users',array('user_id'=>$this->user_id));
		$results = $query->result_array();
		
		return $results[0]['auth_token'];
	}
	
	function ReturnToken($user_id=false){
		if($user_id){
			$this->user_id = $user_id;
		}		
		$auth_token = $this->Get_User_Auth_By_ID();
		return $auth_token;
	}
	
	function Get_User_ID_By_Token($token){
		$query = $this->db->get_where('users',array('auth_token'=>$token));
		$results =  $query->result_array();
		return $results[0]['user_id']; //return the ID in the database of users.. 	
	}
	
	private function Get_User_ID_By_Name($username){
		//Collect User ID by name...Used for our profile page views
		$query = $this->db->get_where('usernames',array('username'=>$this->username));
		$results =  $query->result_array();
		
		return $results[0]['user_id']; //return the ID in the database of users..
	}
	
	function Get_User_Auth_By_Name($username){
		//Collect User ID by name...Used for our profile page views
		$this->user_id = $this->Get_User_ID_By_Name($username);
		return $this->Get_User_Auth_By_ID();				
	}
	
	function ReturnUsername($auth_token){
			
		if($auth_token){
			$this->user_id = $this->Get_User_ID_By_Token($auth_token);
		}
		
		$query = $this->db->get_where('usernames',array('user_id'=>$this->user_id));
		$results =  $query->result_array();
		
		return $results[0]['username'];
	}
	
	function CreateUsername($prefix=false){ //Prefix In case of lecturers and titles..
			
		$username = $this->firstname . $this->lastname; //For Students
		
		if($prefix){
			$username = $prefix.$username; //For Lecturers
		}
		
		$this->db->insert('usernames',array('user_id'=>$this->user_id,'username'=>$username));
		return true;
		
	}
	
	function UpdateUsername(){
		//Check and make sure that the username is not part of the controllers
		$username = $this->ReturnUsername($this->auth_token);
		if(!empty($username)){
			$password_data = array('password'=>$new_enc_password);
			$this->db->where('user_id',$this->user_in_session);
			$this->db->update('usernames',array('username'=>$username));
			$this->db->select;
		}
		
		return false; 
	}
	

	
	function IsEmailValid(){
		//Must be a covenantuniversity.edu.ng address
		$domain = explode("@", $this->email_address);
		$domain = $domain[(count($domain)-1)];
		$allowed = array('covenantuniversity.edu.ng');
		if (in_array($domain, $allowed)) {
		   return  true;
		} else {
		    return false;
		}
	}
	
	function ReturnUserType($username=false){
		//Returns 1 If it is a Student and 2 Professor.
		$this->load->model('Student_model');
		
		if($this->user_auth_id){
			$this->user_id = $this->Get_User_ID_By_Token($this->user_auth_id);
			
			$this->Student_model->user_id = $this->user_id;		
		}
		else{
			$this->user_id = $this->Get_User_ID_By_Name($username); 	
			
			$this->Student_model->user_id = $this->user_id;
		}
		
		
		if($this->Student_model->Is_Valid()){
			return 1; //A Student 
		}
		else{
			$this->load->model('Professor_model');
			$this->Professor_model->user_id = $this->user_id;		
		
			if($this->Professor_model->Is_Valid()){
				return 2; // A Professor..
			}
			
			return false;
		}
		
		
	}
	
	function ReturnProfile($rand=false,$limit=false){ //Random and Limit for Any other situations, Num is for number of profiles
		$this->db->select('firstname,lastname,auth_token,program_name');
		$this->db->from('users');
		$this->db->join('programs', 'users.program_id = programs.program_id');
		if($rand){
		$this->db->order_by($rand,"random");
		}
		else{
		$this->db->where('users.user_id', $this->user_id);
		}
		
		if($limit){
		$this->db->limit($limit);
		}
		
		$query = $this->db->get();
		
		$results = $query->result_array();
		foreach ($results as &$v) {
			$profile_pic = $this->User_model->ReturnProfilePicture($v['auth_token']);
			
			$v['profile_picture'] = $profile_pic;
		}
		
		return $results;
	} 
	
	function ReturnProfilePicture($user_auth=false){
		if($user_auth){
			$this->user_id = $this->Get_User_ID_By_Token($user_auth);
		}
		
		else {
			$this->user_id = $this->Get_User_ID_By_Token($this->user_auth_id);
			$user_auth = $this->user_auth_id;
		}
		
		$query = $this->db->get_where('profile_pictures',array('user_id'=>$this->user_id,'status'=>1));
		if($query->num_rows()>0){
			$results = $query->result_array();
			$picture = $results[0]['location'];
			//Process Picture and display thumbnail 
			$pic_split = explode('.',$picture);
			$picture_location = $pic_split[0].'_thumb'.".".$pic_split[1];
			return $picture_location;
		}
		if(empty($picture_location)){
			$picture_location = '/std_default.png';
		}

		return $picture_location;	
	}
	
	function SetProfilePicture(){
		$this->user_auth_id = $this->session->userdata('auth_token');
		
		$this->UserPictureFolder();
		
		$config['upload_path'] = './user_images/'.$this->user_auth_id.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG';
		$config['max_size']	= '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		
		$this->load->library('upload', $config);
		$this->load->library('upload', $config);
		$field_name = "profile_picture";
		
		if($this->upload->do_upload($field_name)){
			$picture_data = $this->upload->data();
			
			$this->user_id = $this->user_in_session;
			$picture_location = '/'.$this->user_auth_id.'/'.$picture_data['file_name'];
			
			$confi['image_library'] = 'gd2';
			$confi['source_image']	= './user_images/'.$this->user_auth_id.'/'.$picture_data['file_name'];
			$confi['create_thumb'] = TRUE;
			$confi['maintain_ratio'] = TRUE;
			$confi['width']	 = 160;
			$confi['height'] = 160;

			$this->load->library('image_lib', $confi); 

			if (!$this->image_lib->resize())
			{
				echo $this->image_lib->display_errors();
				exit;
			}
			
			
			$this->db->trans_start();
			$this->db->update('profile_pictures',array('status'=>0),array('user_id'=>$this->user_id));
			$this->db->insert('profile_pictures',array('user_id'=>$this->user_id,'location'=>$picture_location,'status'=>1));
			$this->db->trans_complete();
			
			return true;
		}
		
			return false;
	}
	

	
	function UserPictureFolder(){
		//returns true if folder exists...if not creates it..
		$path = './user_images/'.$this->user_auth_id.'/';
		
		return is_dir($path) || mkdir($path);
	}
	
	function ChangePassword($old_password,$new_password){
		//Check if current password matches after encryption...if not send an error
		$this->load->model('Auth_model');
		
		$this->Auth_model->password = $old_password;
		$enc_old_password = $this->Auth_model->EncryptPassword();
		
		//Check the database
		$query = $this->db->get_where('users',array('user_id'=>$this->user_in_session,'password'=>$enc_old_password));
		if($query->num_rows()==0){
			return false;
		}
		
		$this->Auth_model->password = $new_password;
		$new_enc_password = $this->Auth_model->EncryptPassword();
		
		//Update the Users table
		$password_data = array('password'=>$new_enc_password);
		$this->db->where('user_id',$this->user_in_session);
		$this->db->update('users',$password_data);
		
		return true;
		
		//If it does Change to new one and return true as success
	}
	
	function SearchUsers($search_term){
		
        $sql = "SELECT u.firstname,u.lastname, u.auth_token, p.program_name
                    FROM users u, programs p 
                    WHERE MATCH (firstname, lastname) AGAINST (?) AND u.program_id = p.program_id"; 
        $query = $this->db->query($sql, array($search_term) );
		
		$results = $query->result_array();
		
		if(empty($results)){
		$stmt = "SELECT  u.auth_token,u.firstname,u.lastname,p.program_name, IF (firstname LIKE '%".$search_term."%' || lastname LIKE '%".$search_term."%', 1, 0) AS One,";
		$stmt.= "IF (firstname LIKE '%".$search_term."%' || lastname LIKE '%".$search_term."%', 1, 0) AS Two FROM users u, programs p WHERE u.program_id = p.program_id ORDER BY One DESC, Two DESC LIMIT 0,7";
		
		      $query = $this->db->query($stmt);
		
			  $results = $query->result_array(); //Optimize..But lets move on..
		}

		foreach($results as &$r){
		 $r['profile_picture'] = $this->ReturnProfilePicture($r['auth_token']);	
		}
        return $results;
	}
	
	function ActivateUser($encrypted_token){
		
		$query_for_auth = $this->db->get_where('users',array('auth_token'=>$this->user_auth_id));
		//print_r($query_for_auth->result_array()); exit;
		if($query_for_auth->num_rows()>0){
			
			$encrypted_auth_token = md5($this->user_auth_id);
			
			if($encrypted_token == $encrypted_auth_token){
				
				$this->status = 1;
				$update_data = array('status'=>$this->status);
				$query = $this->db->where('auth_token', $this->user_auth_id);
				$query = $this->db->update('users', $update_data); 	
				
				if($query->num_rows()>0){
					return true;
				}
			}
		}
		
		return false;
		

		
		if($query->affected_rows()>0){
			return TRUE;
		}
		
		return false;
	}
	
	function AddInterest(){
		//Check If Interest is exactly the same...IF true Return ID else Add New Interest
		 $query_for_interest = $this->db->get_where('interests',array('interest_name'=>$this->interest));
		 if($query_for_interest->num_rows()>0){
		 	$interest_results = $query_for_interest->result_array();
			
			return $interest_results[0]['interest_id'];
		 }
		 else{
		 	$query = $this->db->insert('interests',array('interest_name'=>$this->interest,'interest_img'=>'interest_default.jpg'));
			 
			 $query_for_interest = $this->db->get_where('interests',array('interest_name'=>$this->interest)); #Meant to be a recursive call...Quick Fix..Move On!
			 $interest_results = $query_for_interest->result_array();
			 return $interest_results[0]['interest_id'];
		 }
		 	
	}
	
	function AddUserInterests(){
		//Add to Interests first
		//Return Interest ID
		$this->user_id = $this->user_in_session;
		$interest_id = $this->AddInterest();
		
		$query = $this->db->get_where('user_interests',array('interest_id'=>$interest_id,'user_id'=>$this->user_id));
		
		if($query->num_rows() == 0){
			$this->db->insert('user_interests',array('user_id'=>$this->user_id,'interest_id'=>$interest_id)); //Exists????
			return true;
		}
		
		
		return false;
	}
	
	function ClearInterests(){
		//Clear d user interests..
		$this->user_id = $this->user_in_session;
		$this->db->delete('user_interests',array('user_id'=>$this->user_id));
		return true;
	}
	
	function ReturnUserInterests(){
		$this->user_id = $this->user_in_session;
		
		$this->db->select('interest_name');
		$this->db->from('user_interests');
		$this->db->join('interests','interests.interest_id = user_interests.interest_id');
		$this->db->where('user_id',$this->user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0){
			$results = $query->result_array();
			return $results;
		}
		
		return false;
	}
	
	function SetUserBioInfo(){
		//Set the bio-information of the user..
		
		//Check If it Exists...If Update..else Insert
		$this->user_id = $this->user_in_session;
		if($this->GetUserBio()){
			$update_data = array('bio_info'=>$this->bio_info);
			$this->db->where('user_id',$this->user_id);
			$this->db->update('profile_info',$update_data);
			
			return true;			
		}
		else{
			$insert_query = $this->db->insert('profile_info',array('user_id'=>$this->user_id,'bio_info'=>$this->bio_info));
			
			return true;
		}
	}
	
	function ClearUserBio(){
		$this->user_id = $this->user_in_session;
		$this->db->delete('profile_info',array('user_id'=>$this->user_id));
		return true;
	}
	
	function GetUserBio($user_auth=false){
		//Return the bio-information of the user
		if($user_auth){
			$this->user_id = $this->Get_User_ID_By_Token($user_auth);
		}
		else{
			$this->user_id = $this->user_in_session;
		}
		$query = $this->db->get_where('profile_info',array('user_id'=>$this->user_id));
		if($query->num_rows()>0){
			$result = $query->result_array();
			return $result[0]['bio_info'];
		}
		
		return false;
	}

	function UpdateSocialProfiles(){
		$this->user_id = $this->user_in_session;
		
		if($this->ReturnSocialProfiles()){
			$update_data = array('facebook_name'=>$this->facebook_name,'linkedin_name'=>$this->linkedin_name);
			$this->db->where('user_id',$this->user_id);
			$this->db->update('social_profiles',$update_data);
			
			return true;			
		}
		else{
			$insert_query = $this->db->insert('social_profiles',array('user_id'=>$this->user_id,'facebook_name'=>$this->facebook_name,'linkedin_name'=>$this->linkedin_name));
			
			return true;
		}
	} 
	
	function ReturnSocialProfiles($user_auth=false){
		
		if($user_auth){
		$this->user_id= $this->Get_User_ID_By_Token($user_auth); 
		}
		else{
			$this->user_id = $this->user_in_session;
		}
		
		$query = $this->db->get_where('social_profiles',array('user_id'=>$this->user_id));
		if($query->num_rows()>0){
			$result = $query->result_array();
			return $result[0];
		}
		
		return false;
	}
	
	function ReturnContacts($user_auth=false){
		
		if($user_auth){
		$this->user_id= $this->Get_User_ID_By_Token($user_auth); 
		}
		else{
			$this->user_id = $this->user_in_session;
		}
		
		$query = $this->db->get_where('user_contacts',array('user_id'=>$this->user_id));
		if($query->num_rows()>0){
			$result = $query->result_array();
			return $result[0]['contacts'];
		}
		
		return false;
	}
	
	function UpdateContacts(){
		$this->user_id = $this->user_in_session;
		
		if($this->ReturnContacts()){
			$update_data = array('contacts'=>$this->contacts);
			$this->db->where('user_id',$this->user_id);
			$this->db->update('user_contacts',$update_data);
			
			return true;			
		}
		else{
			$insert_query = $this->db->insert('user_contacts',array('user_id'=>$this->user_id,'contacts'=>$this->contacts));			
			
			return true;
		}
	} 

}
