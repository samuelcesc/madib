<?php

/**@author Ojumah Samuel
 * @copyright March 2014
 */
class Profile extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}
	
	function Index(){
		 redirect('profile/edit');
	}
	
	function Activate(){
		$encrypted_data = $this->input->get('id');
		$token = $this->input->get('token');
		
		$this->User_model->user_auth_id = $token;
		
		$request = $this->User_model->ActivateUser($encrypted_data);
		if($request){
			echo "Activated";
		}
		else{
			echo "you are a bot";
		}
		
	}
	
	
	function Edit(){
		$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$follow_data = $this->_GetFollowData();
		$bio_info_data = $this->User_model->GetUserBio();
		$interests_data = $this->User_model->ReturnUserInterests();
		$social_profile = $this->User_model->ReturnSocialProfiles();
		$contact_data = $this->User_model->ReturnContacts();
		$page_data['facebook_name'] = $social_profile['facebook_name'];
		$page_data['linkedin_name'] = $social_profile['linkedin_name'];  
		
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		$page_data['count_unread'] = $this->CountUnreadMessages();
		$page_data['bio_info'] = $bio_info_data;
		$page_data['interests'] = $interests_data;
		$page_data['contacts'] = $contact_data;
		$page_data['latest_post'] = $this->latest_post;
				
		$page_data['title'] = "Edit Profile";
	  	$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
      	$this->load->view('profile/edit',$page_data);
      	$this->load->view('include/footer');
	}
	
	function EditPicture(){
		
		$set_picture = $this->User_model->SetProfilePicture();
		if($set_picture){
			$this->load->model('Auth_model');
			$this->session->set_flashdata("success", "Changes Saved! Please Sign in to Confirm Changes.");
			redirect(base_url('signin'));
		}
		else{
			$this->session->set_flashdata("error", "Picture Change Failed. Please Try Again!");
			redirect(base_url('profile/edit'));
		}
	}
	
	function ChangePasswords(){
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$new_r_password = $this->input->post('new_r_password');
		
		if($new_password != $new_r_password){
				$this->session->set_flashdata("error", "Passwords Don't Match! Please Try Again!");
				redirect(base_url('profile/edit'));
		}
		else{
			$pwd_change = $this->User_model->ChangePassword($old_password,$new_password);
			
			if($pwd_change){
				$this->session->set_flashdata("warning", "Changes Saved! Please Login with New Password.");
				redirect(base_url('signin'));
			}
			else{
				$this->session->set_flashdata("error", "Password Changed Failed! Try Again!");
				redirect(base_url('profile/edit'));
			}
		}
	}

	function UpdateBio(){
		$bio_info = $this->input->post('bio_info');
		$interests = $this->input->post('interests');
		
		$this->User_model->bio_info = ucfirst(trim($bio_info));
		if(empty($bio_info)){
			$this->User_model->ClearUserBio();
		}
		else{
			$this->User_model->SetUserBioInfo();
		}
		
		
		if(empty($interests)){
			$this->User_model->ClearInterests();
		}
		
		
		else{
			$this->User_model->ClearInterests();
			$explode_interests = explode(',', $interests);
			$this->User_model->ClearInterests();
			foreach ($explode_interests as $k => $v) {
					
				if(!empty($v)){
				$this->User_model->interest = ucfirst(trim($v));
				$add_int = $this->User_model->AddUserInterests();
				}
			}
		
		}
	
		$this->session->set_flashdata("success", "Profile Updated Successfully!");
		redirect(base_url('profile/edit'));	
		
	}

	function UpdateSocial(){
		$facebook_name = $this->input->post('facebook');
		$linkedin_name = $this->input->post('linkedin');
		
		$this->User_model->facebook_name = $facebook_name;
		$this->User_model->linkedin_name = $linkedin_name;
		
		$this->User_model->UpdateSocialProfiles();
		
		$this->session->set_flashdata("success", "Social Profiles have been Updated Successfully!");
		redirect(base_url('profile/edit'));	
	}
	
	function UpdateContacts(){
		$contacts = trim($this->input->post('contacts'));
		
		$this->User_model->contacts = $contacts;
		
		$this->User_model->UpdateContacts();
		
		$this->session->set_flashdata("success", "Your Contact Details have been Updated Successfully!");
		redirect(base_url('profile/edit'));	
	}
}
