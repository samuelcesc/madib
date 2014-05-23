<?php

/**@author Ojumah Samuel
 * @copyriht March 2014
 */
class Search extends MY_Controller {
	
	var $string;
	
	function __construct() {
		parent::__construct();
	}
	
	function Index(){
		
		$this->load->library('session');		
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
				
		if($this->input->get('s')){
			$this->load->model('User_model');	
			$this->string = $this->input->get('s');
		
			$page_data['search_results'] = $this->User_model->SearchUsers($this->string);
			
			$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
			$firstname = $this->session->userdata('firstname');
			$lastname = $this->session->userdata('lastname');
			$page_data['sess_firstname'] = $firstname;
			$page_data['sess_lastname'] = $lastname;
			$page_data['firstname'] = $firstname;
			$page_data['lastname'] = $lastname;
			
			$page_data['title'] = "Search";
			
			$follow_data = $this->_GetFollowData();
			$page_data['followers_count'] = $follow_data['followers_count'];
			$page_data['following_count'] = $follow_data['following_count'];
			$page_data['post_count'] = count($this->NewsFeed());
			$page_data['coursemates_count'] = $this->coursemates_count;
			$page_data['count_unread'] = $this->CountUnreadMessages();
			$page_data['latest_post'] = $this->latest_post;
			
			$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
      		$this->load->view('search',$page_data);
      		$this->load->view('include/footer');
			
		}
		else redirect(base_url('home'));
	}
	
}
