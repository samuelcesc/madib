<?php

/**@author Ojumah Samuel
 * @copyrit 2014
 */
class Course_model extends CI_Model {
	
	var $course_id;
	var $course_code;
	var $course_title;
	var $program_id;
	var $unique_course_id;
	var $professor_id;
	var $student_id;
	var $user_type; //Can be represented as 1 for a student and 2 for a professor
	var $post_content;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('User_model');
	}
	
	function Create_Course(){
		//By d Professor Only..
		//Check if it is a professor...
		$this->professor_id = $this->User_model->user_in_session; //Need to correct dis later....user in session may not necessarily be a student... 			
		$this->unique_course_id = $this->GenerateUniqueID();
		
		$this->GetUsersProgram();
		
		$create_data = array('course_code'=>$this->course_code,'course_title'=>$this->course_title,'unique_course_id'=>$this->unique_course_id,'professor_id'=>$this->professor_id,'program_id'=>$this->program_id);
		
		$query = $this->db->insert('courses',$create_data);
		
		return TRUE;
		//Collect IF successful and return a messae to d controller 4 verification 
		
	}
	
	function CourseExists(){
		//Return true if Course Already Exists...
	}
	
	private function GetUsersProgram(){
				//Select the Program for the Course
		$query = $this->db->get_where('users',array('user_id'=>$this->professor_id)); //Optimize ONLY THE PROGRAM ID IS NEEDED NOT ALL VALUES
		$results = $query->result_array();
		
		$this->program_id = $results[0]['program_id'];
		
		return true;
	}
	
	private function GenerateUniqueID(){
		$charset = '0123456789acoventACOVENT';
	
    	$unique_id = '';
	    for ($i = 0; $i < 10; $i++) {
	        $unique_id .= $charset[rand(0, strlen($charset) - 1)];
	    }
    	
		return $unique_id;
	}
	
	private function DecodeCourseID(){
		//Returns Course ID from Unique course id
		$query = $this->db->get_where('courses',array('unique_course_id'=>$this->unique_course_id));
		$results = $query->result_array();
		
		if(empty($results)) return false;
		
		$this->course_id = $results[0]['course_id'];
		
		return true;
	}
	
	function Join_Course(){
		//Select User ID and send
		$this->student_id = $this->User_model->user_in_session;
		
		//Unique CourseID is already Set..SO decode it
		if(!$this->DecodeCourseID()){
			return false;
		} 
		
		$join_data = array('course_id' =>$this->course_id ,'student_id'=>$this->student_id);
		$query = $this->db->insert('courses_taken',$join_data);
		
		if($query->affected_rows()>0) return true;
		else return false;
	}
	
	function PostCourseContent(){
			
		if($this->DecodeCourseID()){
			
			$this->user_id = $this->User_model->user_in_session;
			
			//Next Check If User can Post Actually..
			
			$query_for_permission = $this->db->get_where('courses_taken',array('student_id'=>$this->user_id,'course_id'=>$this->course_id));
			
			if($query_for_permission->num_rows()>0){
				$post_data = array('course_id'=>$this->course_id,'user_id'=>$this->user_id,'post_content'=>$this->post_content);
			
				$this->db->insert('course_posts',$post_data);
		
				return true;
			}	

		}

		else return false;

	}
	
	function CourseFeeds(){
		//Return all posts and details for the Course Page
		if($this->DecodeCourseID()){
			$this->user_id = $this->User_model->user_in_session;
			
			//Get All Posts that have the same course_id
			$this->db->select('firstname,lastname,post_content,location,time_posted');
			$this->db->from('course_posts');
			$this->db->join('users','course_posts.user_id = users.user_id');
			$this->db->join('profile_pictures','profile_pictures.user_id = users.user_id');
			$this->db->where('course_posts.course_id',$this->course_id);
			
			$query = $this->db->get();
			
			if($query->num_rows()>0) return $query->result_array();
			else return false;
		}
		
		return false;
	}
	
	function CoursesForProgram(){
		//Returns all courses for a specific program..
		$this->GetUsersProgram();
		
		$query = $this->db->get_where('courses',array('program_id'=>$this->program_id));
		$results = $query->result_array();
		
		return $results;
	}
	
	function Courses_Taken(){
		//Select all couse_ids from d table taken by d student.
		$this->student_id = $this->User_model->user_in_session;
		$query = $this->db->get_where('courses_taken',array('student_id'=>$this->student_id));
		$results = $query->result_array();
		
		return $results;
	}
	
	function Course_members(){
		//Return all members with same course_id in courses taken 
		$query = $this->db->get_where('couses_taken',array('course_id'=>$this->course_id));
		$results = $query->result_array();
		
		return $results;
	}
	
	function Check_Permissions(){
		//Returns true if a user type is permitted to perform operations on course function
		  if($this->user_type == 1){
		  	
		  }
		  else if($this->user_type == 2){
		  	
		  }
		  else{
		  }
	}
	
	function ReturnAllPrograms(){
		$this->db->select();
		$this->db->from('programs');
		$this->db->order_by("program_name","asc");
		$query = $this->db->get();
		$results = $query->result_array();

		return $results;	
	}
	
	function GetCourseMates(){
		$this->user_id = $this->User_model->user_in_session;
		$this->db->select('program_id');
		$this->db->from('users');
		$this->db->where('user_id',$this->user_id);
		$query = $this->db->get();
		$result = $query->result_array();
		$program_id = $result[0]['program_id'];
		
		$this->db->select('level');
		$this->db->from('students');
		$this->db->where('user_id',$this->user_id);
		$level_query = $this->db->get();
		$level_result = $level_query->result_array();
		$level = $level_result[0]['level'];
		
		$this->db->select('firstname,lastname,auth_token');
		$this->db->from('users');
		$this->db->join('students','users.user_id = students.user_id');
		$this->db->where(array('users.program_id'=>$program_id,'students.level'=>$level,'users.user_id !='=>$this->user_id));
		$query = $this->db->get();
		
		$results = $query->result_array();
		
		foreach ($results as &$v) {
			$profile_pic = $this->User_model->ReturnProfilePicture($v['auth_token']);
			
			$v['profile_picture'] = $profile_pic;
		}
		
		return $results;
	}
}
