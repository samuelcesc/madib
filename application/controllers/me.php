<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Me extends MY_Controller {
	
	var $user_type; 
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	
	function Index(){
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['post_count'] = count($this->NewsFeed());
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		
		
		$this->load->model('User_model');
		$this->User_model->user_auth_id = $this->session->userdata('auth_token');
		
		$this->user_type = $this->User_model->ReturnUserType();
		
		
		if($this->user_type == 1){
			//Student
			$this->load->model('Student_model');
			$this->load->model('Follow_model');
			$this->Student_model->user_auth_id = $this->session->userdata('auth_token');
			$profile_details = $this->Student_model->GetProfileDetails();
					
			
			$page_data['title'] = $profile_details['firstname']. " ". $profile_details['lastname'];
			$page_data['level'] = $profile_details['level'];
			$page_data['grad_year'] = $profile_details['grad_year'];
			$page_data['program_name'] = $profile_details['program_name'];
			$page_data['firstname'] = $profile_details['firstname'];
			$page_data['lastname'] = $profile_details['lastname'];
			$page_data['follow_activity'] = $this->Follow_model->GetFollowActivity();
			$page_data['follow_status'] = 2; #same user no need to show the follow button
			$social_profile = $this->User_model->ReturnSocialProfiles();
			$page_data['facebook_name'] = $social_profile['facebook_name'];
			$page_data['linkedin_name'] = $social_profile['linkedin_name'];
			$page_data['count_unread'] = $this->CountUnreadMessages();
			$page_data['bio_info'] = $this->User_model->GetUserBio();
			$page_data['latest_post'] = $this->latest_post;
			
			//Load the Page
			$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
      		$this->load->view('user/student_profile',$page_data);
      		$this->load->view('include/footer');
		}
		
		else if($this->user_type == 2){
			//Professor
			$this->load->model('Professor_model');
			$this->Professor_model->user_id = $this->session->userdata('auth_token');
			
			$page_data = $this->Professor_model->GetProfileDetails(); //Modify receiving too much information
			
			$picture_data = $this->User_model->ReturnProfilePicture();
			$picture_location = $picture_data['location'];
		
			$page_data['profile_picture'] = $picture_location;
			$page_data['title'] = $page_data['firstname'] . " " . $page_data['lastname'];
			
			$this->load->view('include/header',$page_data);
      		$this->load->view('user/professor_profile',$page_data);
      		$this->load->view('include/footer');
		}
		else{
			redirect(base_url());
		}
	}
	
	function Courses(){
		//List my courses
		//print_r($this->session->all_userdata());
		$this->load->model('Course_model');
		print_r($this->Course_model->Courses_Taken());
	}
	
	function Follow($user_auth=false){
		if($user_auth == FALSE){
			redirect(base_url('home'));
		}
		
		$this->load->model('Follow_model');
		$this->load->model('User_model');
		
		$this->Follow_model->user2 = $this->User_model->Get_User_ID_By_Token($user_auth);

		$create_conn = $this->Follow_model->Create_Connection();
		
		if($create_conn){
			echo "Connection Created";
		}
		else{
			echo "Already Exists!";
		}
		
	}
	
	function UnFollow($user_auth=false){
		if($user_auth == FALSE){
			echo "No Person to Follow..Please Select";
			//redirect(base_url());
			exit;
		}
		
		$this->load->model('Follow_model');
		$this->load->model('User_model');
		
		$this->Follow_model->user2 = $this->User_model->Get_User_ID_By_Token($user_auth);
		$this->Follow_model->Disconnect();
	}
	
	function Followers(){
		//List all my followers
		$this->load->model('Follow_model');
		$page_data['follow_data'] = $this->Follow_model->Get_Followers();
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['title'] = $firstname ." ". $lastname." | The CourseGraph";
		
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		$page_data['count_unread'] = $this->CountUnreadMessages();
		$page_data['latest_post'] = $this->latest_post;
		
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('profile/followers',$page_data);
		$this->load->view('include/footer');
	}
	
	function Following(){
		
		$this->load->model('Follow_model');
		$page_data['follow_data'] = $this->Follow_model->Get_Following();
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['title'] = $firstname ." ". $lastname." | The CourseGraph";
		
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		$page_data['count_unread'] = $this->CountUnreadMessages();
		$page_data['latest_post'] = $this->latest_post;
		
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('profile/following',$page_data);
		$this->load->view('include/footer');
	}
	
	function Coursemates(){
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['title'] = $firstname ." ". $lastname." | The CourseGraph";
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		$page_data['count_unread'] = $this->CountUnreadMessages();
		$page_data['latest_post'] = $this->latest_post;
		
		$page_data['users_data'] = $this->MyCourseMates();
		
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('profile/coursemates',$page_data);
		$this->load->view('include/footer');
		
	}
	
	function Posts(){
		$this->load->model('Post_model');

		$posts = $this->Post_model->RetrievePosts();
		
		
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture');
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		
		$page_data['sess_firstname'] = $this->session->userdata('firstname');
		$page_data['sess_lastname'] = $this->session->userdata('lastname');
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		
		$page_data['post_count'] = count($this->NewsFeed());
		
		$page_data['news_feed'] = $posts;
		$page_data['title'] = 	"My Posts";
		
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('profile/posts',$page_data);
		$this->load->view('include/footer');
	}
	
}
