<?php

/**@author Ojumah Samuel
 * @copyright 2014
 * Just awake and coding...Kinda took me time to analyze and come up with this class
 */
class Follow_model extends CI_Model {
	
	var $user1;
	var $user2;
	var $token;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->load->model('User_model');
	}
	
	function Create_Connection(){
		$this->user1 = $this->User_model->user_in_session;
 		//This Just creates a connection and inserts into two tables so in the future, we will shard easily.  
		$follow_data = array('user1'=>$this->user1,'user2'=>$this->user2);
		
		//Then swap data because Once I follow you, I am your follower...inserting into different tables so this just makes sense to insert
		$follower_data = array('user1'=>$this->user2,'user2'=>$this->user1);
		
		if($this->Is_Following()) return false;
		
		$this->db->trans_start();
		$this->db->insert('following',$follow_data);	
		$this->db->insert('followers',$follower_data);
		$this->db->trans_complete();
		
		return true;
		
	}
	
	function Disconnect(){
		$this->user1 = $this->User_model->user_in_session;
		$follow_data =  array('user1'=>$this->user1,'user2'=>$this->user2);
		
		$follower_data = array('user1'=>$this->user2,'user2'=>$this->user1);
		
		$this->db->trans_start();
		$this->db->delete('following',$follow_data);
		$this->db->delete('followers',$follower_data);
		$this->db->trans_complete();
		
	}
	
	function Is_Following(){
	
		$this->user1 = $this->User_model->user_in_session;
		$follow_data = array('user1'=>$this->user1,'user2'=>$this->user2);
		
		$query = $this->db->get_where('following',$follow_data);
		if($query->num_rows()>0){
			return true;
		}
		
		return false;
	}
	
	function Count_Followers(){
		$this->user1 = $this->User_model->user_in_session;
		//Get rows of followers
		$query = $this->db->get_where('followers',array('user1'=>$this->user1));
		return $query->num_rows();
	}
	
	function Count_Following(){
		$this->user1 = $this->User_model->user_in_session;
		//Get rows of following people
		$query = $this->db->get_where('following',array('user1'=>$this->user1));
		return $query->num_rows();
	}
	
	
	function Get_Followers($limit=false,$auth_token=false){
		if($auth_token){
		   $this->user1 = $this->User_model->Get_User_ID_By_Token($auth_token);	
		}
		else{
			$this->user1 = $this->User_model->user_in_session;
		}
		
		$this->db->select('firstname,lastname,auth_token,program_name');
		$this->db->from('followers');
		$this->db->join('users', 'followers.user2 = users.user_id');
		$this->db->join('programs', 'users.program_id = programs.program_id');
		$this->db->where('followers.user1', $this->user1);
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
	
	function Get_FollowingIds(){
		$query = $this->db->get_where('following',array('user1'=>$this->user1));
		$results =  $query->result_array();
		foreach($results as $r){
		 $p[] = $r['user2'];
		}
		return $p;
		
	}
	
	function Get_Following($limit=false,$auth_token=false){
		if($auth_token){
		   $this->user1 = $this->User_model->Get_User_ID_By_Token($auth_token);	
		}
		else{
			$this->user1 = $this->User_model->user_in_session;
		}		
		
		$this->db->select('firstname,lastname,auth_token,program_name');
		$this->db->from('following');
		$this->db->join('users', 'following.user2 = users.user_id');
		$this->db->join('programs', 'users.program_id = programs.program_id');
		$this->db->where('following.user1', $this->user1);
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

	function GetFollowActivity(){
		$this->user1 = $this->User_model->user_in_session;
		
		$stmt = "SELECT * FROM followers WHERE `user1`='".$this->user1."'ORDER BY time_started desc LIMIT 0,15";
		$query = $this->db->query($stmt);
		
		if($query->num_rows() > 0){
			$follow_results = $query->result_array();
			
			foreach ($follow_results as $k => &$v) {
				$this->User_model->user_id = $v['user2'];
				$username = $this->User_model->Get_User_Name_By_ID();
				$v['firstname'] = $username['firstname'];
				$v['lastname'] = $username['lastname'];
				$auth_token = $this->User_model->ReturnToken(); 
				$v['profile_picture'] = $this->User_model->ReturnProfilePicture($auth_token);
				unset($v['user1']); #we do not need all these values...
				unset($v['user2']);
			}
			return $follow_results;
		}
		
		return false;
	}
	
	function RandomSelect(){
		$this->db->select();
		$this->db->from('users');
		$this->db->order_by("id","random");
		$this->db->limit(5);
		$query = $this->db->get();
		$results = $query->result_array();
		
		foreach($results as  $r){
		 $user_auth = $r['auth_token'];	
		}
		
		return $results;
	}

	function Suggestions(){
		//Find People based on Interests
		//Filter with your own interests
		$this->load->model('User_model');
		
		$following = $this->Get_Following();		
		if(empty($following)){
			//Randomly collect users...
			$results = $this->User_model->ReturnProfile("id",5);
		}
		else{
			//Get People who you are following and randomly select
			$results = $this->User_model->ReturnProfile("id",5);
		}
		return $results;
	}	
	
}
