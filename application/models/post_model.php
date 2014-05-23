<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
 
class Post_model extends CI_Model {
	
	var $post_id;
	var $post_content;
	var $user_id;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	function InsertPost(){
		$this->load->model('User_model');
		
		$this->user_id = $this->User_model->user_in_session;
		
		$postData = array('post_content' => $this->post_content,'user_id'=> $this->user_id);
		
		$query = $this->db->insert('posts',$postData);
		
		return true;
	}
	
	function RetrievePosts($auth_token=false){
		$this->load->model('User_model');
		
		if($auth_token){
		   $this->user_id = $this->User_model->Get_User_ID_By_Token($auth_token);	
		}
		else{
			$this->user_id = $this->User_model->user_in_session;
		}
			
		$this->db->select('auth_token,firstname,lastname,post_content,time_posted');
		$this->db->from('posts');
		$this->db->join('users', 'posts.user_id = users.user_id');
		$this->db->where(array('posts.user_id'=> $this->user_id));
		$this->db->order_by('post_id','desc');
		$query = $this->db->get();
	
		$results =  $query->result_array();

		foreach($results as &$r){
		 $r['profile_picture'] = $this->User_model->ReturnProfilePicture($r['auth_token']);
		}
		
		return $results;
	}
	
	function RetrieveTimeline(){
		$this->load->model('Follow_model');
		
		$Fids = $this->Follow_model->Get_FollowingIds();
		$Fids[] = $this->User_model->user_in_session;
		print_r($Fids);	
		
		$query = $this->db->select()->from('posts')->order_by('time_posted','desc')->get();
		
		$results = $query->result_array();

		foreach($results as &$r){
		  if(in_array($r['user_id'], $Fids)){
			$posts[] = $r;			
		  }
		}
		
		return $posts;
	}
	
	function GetPostFeeds(){
		//Main Function to communicate wit those you are followin..Simple
		$this->load->model('User_model');
		$this->load->model('Follow_model');
		
		$this->user_id = $this->User_model->user_in_session;
		$followers = $this->Follow_model->Get_Following();
		
		$this->db->select('firstname,lastname,post_content');
		$this->db->from('posts');
		$this->db->join('following', 'posts.user_id = following.user2');
		$this->db->join('users', 'posts.user_id = users.user_id');
		$this->db->where(array('following.user1'=>$this->user_id,'posts.user_id'=>$this->user_id));
		$query = $this->db->get();
	
		return $query->result_array();
		
		$posts = array();

	$user_string = implode(',', $userid);
	$extra =  " and id in ($user_string)";

	if ($limit > 0){
		$extra = "limit $limit";
	}else{
		$extra = '';	
	}

	$sql = "select user_id,body, stamp from posts 
		where user_id in ($user_string) 
		order by stamp desc $extra";
	echo $sql;
	$result = mysql_query($sql);

	while($data = mysql_fetch_object($result)){
		$posts[] = array( 	'stamp' => $data->stamp, 
							'userid' => $data->user_id, 
							'body' => $data->body
					);
	}
	return $posts;
	}
	
	function GetLastPost($user_auth=false){
		$this->load->model('User_model');
		if($user_auth){
			$this->user_id = $this->User_model->Get_User_ID_By_Token($user_auth);
		}
		else{
			$this->user_id = $this->User_model->user_in_session;
		}
		$stmt = "SELECT * FROM posts WHERE `user_id`='".$this->user_id."' ORDER BY `post_id` DESC LIMIT 0,1";
		$query = $this->db->query($stmt);
		
		if($query->num_rows()>0){
			$results = $query->result_array();
			$post = $results[0]['post_content'];
		}
		else{
			$post = "";
		}
		
		return $post;
				
	} 
	
}
