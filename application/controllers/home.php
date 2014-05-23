<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Home extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function Index(){
		$this->load->model('Follow_model');
		$page_data['title'] = 	"Home | The CourseGraph";
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;

		$page_data['count_unread'] = $this->CountUnreadMessages();
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		
		$page_data['news_feed'] = $this->NewsFeed();
		$page_data['latest_post'] = $this->latest_post;
		$page_data['follow_activity'] = $this->Follow_model->GetFollowActivity();
		$page_data['suggestions'] = $this->Suggestions();
				
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('home',$page_data);
		$this->load->view('include/footer');
	}
	
	function NewPost(){
		$this->load->model('Post_model');
		$post_content = $this->input->post('post_content');
		if(empty($post_content)){
			redirect(base_url('home'));
		}
		$this->Post_model->post_content = $this->input->post('post_content');
		
		$post_content = $this->Post_model->InsertPost();
		
		if($post_content){
			redirect(base_url('home'));
		}
		
		//Set Flash Data...Content not posted... 
	}
	
}
