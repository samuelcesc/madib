<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Courses extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Course_model');
	}
	
	function Index(){
		
		$course_list = $this->Course_model->CoursesForProgram();
		
		if(empty($course_list)){
			echo "No Courses have been created for your program";
		}
		else{
			$page_data['course_list'] = $course_list;
		}
		
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_firstname'] = $this->session->userdata('firstname');
		$page_data['sess_lastname'] = $this->session->userdata('lastname');
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
	}
	
	function create(){
		//Add New Course
		
		//$this->Course_model->course_name = $this->input->post('course_name');
		//$this->Course_model->course_title = $this->input->post('course_title');
		
		$this->Course_model->course_code = "CSC 421";
		$this->Course_model->course_title = "Software Engineering 2";
		
		$create_course = $this->Course_model->Create_Course();
		if($create_course){
			//Show Flash Message that course was created
		}
		else{
			//Send Flash Data that error was generated..
		}
		
	}
	
	function MyCourses(){
		//List All courses for a user
		$my_courses = $this->Course_model->Courses_Taken();
		
		if(empty($my_courses)){
			//Set a flash Data to Show No Courses
		}
		else{
			$page_data['title'] = "My Courses";
			$page_data['course_list'] = $my_courses;
			
			$this->load->view('include/header',$page_data);
			$this->load->view('courses/list',$page_data);
			$this->load->view('include/footer',$page_data);
		}
	}
	
	function NewPost(){
		//$this->Course_model->post_content = $this->input->post('post_content');
		$this->Course_model->unique_course_id = $this->input->post('unc_id');
		
		$this->Course_model->post_content = "I know that this platform will provide a way to know more and see the future better";
		$this->Course_model->unique_course_id = "EEOVce83e6";
		
		$this->Course_model->PostCourseContent();
	}
	
	function View($course_id=false){
		if($course_id){
			$this->Course_model->unique_course_id = $course_id;
			
			$course_feeds = $this->Course_model->CourseFeeds();
			print_r($course_feeds);
		}
		
		redirect(base_url('courses'));
		
	}
	
	function Join(){
		
		$this->Course_model->unique_course_id = $this->input->get('unc_id');
		
		$join = $this->Course_model->Join_Course();
		
		if($join){
			//Set Flash Message...yOU HAVE jOINED THE cOURSE
		}
		else echo "Join Failed!";
	}
}
