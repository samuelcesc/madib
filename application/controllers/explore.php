<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Explore extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function Index(){
		
			$this->load->library('session');		
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
				
			$this->load->model('User_model');	
			
			$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
			$firstname = $this->session->userdata('firstname');
			$lastname = $this->session->userdata('lastname');
			$page_data['sess_firstname'] = $firstname;
			$page_data['sess_lastname'] = $lastname;
			$page_data['firstname'] = $firstname;
			$page_data['lastname'] = $lastname;
			$page_data['title'] = "Explore Communities";
			
			$follow_data = $this->_GetFollowData();
			$page_data['followers_count'] = $follow_data['followers_count'];
			$page_data['following_count'] = $follow_data['following_count'];
			$page_data['post_count'] = count($this->NewsFeed());
			$page_data['coursemates_count'] = $this->coursemates_count;
			$page_data['count_unread'] = $this->CountUnreadMessages();
			$page_data['interests'] = $this->_InterestList(); //Returns an error if it is empty.... 
			$page_data['latest_post'] = $this->latest_post;

			
			$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
			$this->load->view('explore',$page_data);
      		$this->load->view('include/footer');
	}
	
	function Search(){
		//Collect Results based on search term and results...
	}
	
	function _InterestList(){
		$this->load->model('Interests_model');
		$v = $this->Interests_model->ReturnInterests();
		return $v;
	}
	
	function Interests($interest=false){
		$this->load->model('Interests_model');
		
		if($interest){
		  $this->Interests_model->interest = $interest;
		  
		  $users_interested = $this->Interests_model->UsersInterested();
		  
		  
		  if($users_interested){
		  $page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
				
			$this->load->model('User_model');	
			
			$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
			$firstname = $this->session->userdata('firstname');
			$lastname = $this->session->userdata('lastname');
			$page_data['sess_firstname'] = $firstname;
			$page_data['sess_lastname'] = $lastname;
			$page_data['firstname'] = $firstname;
			$page_data['lastname'] = $lastname;
			$page_data['title'] = "Explore Communities";
			
			$follow_data = $this->_GetFollowData();
			$page_data['followers_count'] = $follow_data['followers_count'];
			$page_data['following_count'] = $follow_data['following_count'];
			$page_data['post_count'] = count($this->NewsFeed());
			$page_data['coursemates_count'] = $this->coursemates_count;
			$page_data['count_unread'] = $this->CountUnreadMessages();
			$page_data['interest_name'] = $interest;
			$page_data['latest_post'] = $this->latest_post;
			$page_data['users_data'] = $users_interested;
			
			
		  	$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
			$this->load->view('users',$page_data);
      		$this->load->view('include/footer');
		  }
		  else{
			$this->Index();
		  }
		}
		
		else{
			$this->Index();
		}
		
	
	}
}