<?php

/**@author Ojumah Samuel  
 * @copyright 2014
 */
 
class User extends MY_Controller {
	var $username;
	var $user_auth;
	
	function __construct() {
		parent::__construct();
		$this->username = $this->uri->segment(1);
		$this->user_auth = $this->__ReturnUserAuth();
		
		if(empty($this->user_auth)){
			redirect(base_url('me')); //If User does not exist redirect to profile
		}
	}
	
	function Index(){
	
		if($this->username){
						
			$this->_LoadProfile();
		}		
	}
	
	function __ReturnUserAuth(){
		$this->load->model('User_model');
		$user_auth = $this->User_model->Get_User_Auth_By_Name($this->username);
		
		if($user_auth){
			return $user_auth;
		}
		
		return false;
	}
	
	function Followers(){
		$this->load->model('Follow_model');
		$followers = $this->Follow_model->Get_Followers('',$this->user_auth);
		
		print_r($followers);
		
	}
	
	function Following(){
		$this->load->model('Follow_model');
		$following = $this->Follow_model->Get_Following('',$this->user_auth);
		
		print_r($following);
	}
	
	
	function _LoadProfile(){
	
		
		$this->load->model('User_model');
		//$this->User_model->user_auth_id = $this->session->userdata('auth_token');
		
		$this->user_type = $this->User_model->ReturnUserType($this->username);
		
		
		if($this->user_type == 1){
			//Student
			$this->load->model('Student_model');
			$this->load->model('Follow_model');
			//Some Performance Bottle Necks here...Not supposed to do same thing twice....OPTIMIZE...Check ME Contoller and this Function
			
			$this->Student_model->user_auth_id = $this->User_model->Get_User_Auth_By_Name($this->username);
			$page_data = $this->Student_model->GetProfileDetails();
			
			$user_auth = $page_data['auth_token'];
			
			//Load d Profile Pictures Involved...User in session and Profile.
			$page_data['profile_picture'] = $this->User_model->ReturnProfilePicture($user_auth);
			
			//Check If there is a connection
			$this->Follow_model->user2 = $this->User_model->Get_User_ID_By_Token($user_auth);
			$is_following = $this->Follow_model->Is_Following();
			$following = $this->Follow_model->Get_Following(10,$user_auth);
			
			if($this->User_model->user_in_session == $this->Follow_model->user2){
				$page_data['follow_status'] = 2; #same as the user checking the profile
			}
			else if($is_following){
				$page_data['follow_status'] = 1; #Following
				$page_data['user_auth'] = $user_auth;
			}
			else{
				$page_data['follow_status'] = 0; #Not following
				$page_data['user_auth'] = $user_auth;
			}
			#end of checking if a connection exists
			$page_data['title'] = $page_data['firstname'] . " " . $page_data['lastname'];
			
			//Load the User In session Variables...Firstname and Lastname..
			$page_data['sess_firstname'] = $this->session->userdata('firstname');
			$page_data['sess_lastname'] = $this->session->userdata('lastname');
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
			$page_data['following'] = $following;
			$this->load->model('Post_model');
			$page_data['feeds'] = $this->Post_model->RetrievePosts($user_auth);
			$page_data['latest_post'] = $this->Post_model->GetLastPost($user_auth);
			$social_profile = $this->User_model->ReturnSocialProfiles($user_auth);
			$page_data['facebook_name'] = $social_profile['facebook_name'];
			$page_data['linkedin_name'] = $social_profile['linkedin_name'];
			$page_data['count_unread'] = $this->CountUnreadMessages();
			$page_data['bio_info'] = $this->User_model->GetUserBio($user_auth);
			
			$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
      		$this->load->view('user/student_profile',$page_data);
      		$this->load->view('include/footer');
		}
		
		else if($this->user_type == 2){
			//Professor
			$this->load->model('Professor_model');
			$this->Professor_model->user_id = $this->User_model->Get_User_ID_By_Name($this->username);
			
			$page_data = $this->Professor_model->GetProfileDetails(); //Modify receiving too much information
			 
			$user_auth = $page_data['auth_token'];   
			$picture_data = $this->User_model->ReturnProfilePicture($user_auth);
			
			//Load d Profile Pictures Involved...User in session and Profile.
			$page_data['user_profile_picture'] = $picture_data;
			$page_data['profile_picture'] = $this->User_model->ReturnProfilePicture();
		
			$page_data['title'] = $page_data['firstname'] . " " . $page_data['lastname'];
			
			//Load the User In session Variables...Firstname and Lastname..
			$page_data['sess_firstname'] = $this->session->userdata('firstname');
			$page_data['sess_lastname'] = $this->session->userdata('lastname');
			
			$this->load->view('include/header',$page_data);
      		$this->load->view('user/professor_profile',$page_data);
      		$this->load->view('include/footer');
		}
		else{
			redirect(base_url('me'));
		}
	}
	
}
