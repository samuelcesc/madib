<?php

class MY_Controller extends CI_Controller{
	var $coursemates_count;
	var $followers_count;
	var $following_count;
	var $latest_post;
	
   function __construct(){
      parent::__construct();
	  
	  $this->load->model('Auth_model');
	  
	  if(!$this->Auth_model->Is_Session_Set()){
	  	redirect(base_url().'signin');
	  }
	  
	  $this->coursemates_count = count($this->MyCourseMates());
	  $this->GetLastPost(); //Get the Last Post By the User  	
   }
   
   function _GetFollowData(){
		$this->load->model('Follow_model');
		$followers_count = $this->Follow_model->Count_Followers();
		$following_count = $this->Follow_model->Count_Following();
		
		$follow_data = array('followers_count'=>$followers_count,'following_count'=>$following_count);
		
		return $follow_data;
	}
   
   function MyCourseMates(){
   		$this->load->model('Course_model');
		$coursemates_data = $this->Course_model->GetCourseMates();
		
		return $coursemates_data;
   }
   
   	function NewsFeed(){
		$this->load->model('Post_model');

		$r = $this->Post_model->RetrievePosts();
		
		return $r;
	}
	
	function CountUnreadMessages(){
	 $this->load->model('Conversation_model');
	 $count = $this->Conversation_model->CountUnread();
	 
	 if($count>0) return $count;
	 
	}
	
	function GetLastPost(){
		//Returns the Last Post by the USER
		$this->load->model('Post_model');
		$this->latest_post = $this->Post_model->GetLastPost();
	}
	
	function Suggestions(){
		$this->load->model('Follow_model');
		$data = $this->Follow_model->Suggestions();
		return $data;
	} 
   
	
   
}
