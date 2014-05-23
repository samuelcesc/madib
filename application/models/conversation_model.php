<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
 
class Conversation_model extends CI_Model {
	 var $user1;
	 var $user2;
	 var $message;
	 var $c_id;
	 
	function __construct() {
		parent::__construct();
		
		$this->GetUser_ID();
	}
	
	private function GetUser_ID(){
		//Return the ID of the User from the Token
		$this->load->model('User_model');
		$this->user1 = $this->User_model->user_in_session;
	}
	
	function CreateConversation(){
		//Returns the Conversation id
			$conv_data = array('user1'=>$this->user1,'user2'=>$this->user2);
			$this->db->insert('conversation',$conv_data);
			
			//Get the Conversation id
			$query = $this->db->get_where('conversation',array('user1'=>$this->user1,'user2'=>$this->user2));
			$results = $query->result_array();
			
			$this->c_id = $results[0]['c_id'];
			
			return true;	
		
	}
	
	function Reply(){
		
		if(!$this->ConversationExists()){
				
			$this->CreateConversation();
			
		} 
		$reply_data = array('user_id_fk'=>$this->user1,'reply'=>$this->message,'c_id_fk'=>$this->c_id,'status'=>0);
		
		$this->db->insert('conversation_reply',$reply_data);
		
		return true;
	
		
		return false;
	}
	
	function ReplyConversation(){
		
		if(!$this->ConversationExists($this->c_id)){
				
			$this->CreateConversation();
			
		} 
		$reply_data = array('user_id_fk'=>$this->user1,'reply'=>$this->message,'c_id_fk'=>$this->c_id);
		
		$this->db->insert('conversation_reply',$reply_data);
		
		return true;
	
		
		return false;
	}

	
	function ConversationExists($c_id=false){
		
		//Returns True if Conversation exists...
		if($c_id){
			$this->c_id = $c_id;
			$sql = "SELECT `c_id` FROM conversation WHERE `user1`='".$this->user1."' AND `c_id`='".$this->c_id."' OR `user2`='".$this->user1."' AND `c_id`='".$this->c_id."'";
		}
		else{
			$sql = "SELECT `c_id` FROM conversation WHERE `user1`='".$this->user1."' AND `user2`='".$this->user2."' OR `user1`='".$this->user2."' AND `user2`='".$this->user1."'";
		}
		
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0){
			$results = $query->result_array();
			$this->c_id = $results[0]['c_id'];
			
			return true;
		}
		
		return false;
	}
	
	
	function ShowConversations(){
		$this->load->model('User_model');
		
		$sql= "SELECT u.user_id,u.auth_token,c.c_id,u.firstname,u.lastname FROM conversation c, users u WHERE CASE WHEN c.user1 = '".$this->user1."'";
 		$sql.= "THEN c.user2 = u.user_id WHEN c.user2 = '".$this->user1."' THEN c.user1= u.user_id END AND ( c.user1 ='".$this->user1."' OR c.user2 ='".$this->user1."') Order by c.c_id DESC Limit 20";
		
		$query = $this->db->query($sql);
		$results=$query->result_array();
		
		$con_results = null;
		
		foreach ($results as $k=> &$v){
			$c_id = $v['c_id'];
			$auth_token = $v['auth_token'];
			
			$csql = "SELECT R.cr_id,R.time,R.reply,R.status FROM conversation_reply R WHERE R.c_id_fk='".$c_id."' ORDER BY R.cr_id DESC LIMIT 1";
			$cquery = $this->db->query($csql);
			$cresults = $cquery->result_array();
			
			$profile_picture = $this->User_model->ReturnProfilePicture($auth_token);
			
			$con_results[] = array('c_id'=>$c_id,'firstname'=>$v['firstname'],'lastname'=>$v['lastname'],'reply'=>$cresults[0]['reply'],'status'=>$cresults[0]['status'],'time'=>$cresults[0]['time'],'profile_picture'=>$profile_picture);
			
		}
			return $con_results;
	}
	
	function ConversationList(){
		$this->load->model('User_model');
		
		$stmt = "SELECT R.cr_id,R.reply,R.time,U.user_id,U.auth_token,U.firstname,U.lastname FROM users U, conversation_reply";
		$stmt.= " R WHERE R.user_id_fk=U.user_id and R.c_id_fk='".$this->c_id."' ORDER BY R.cr_id ASC LIMIT 20";
		$query = $this->db->query($stmt);
		
		$results =  $query->result_array();
		
		if(!empty($results)){
			$this->MarkAsSeen();
		}
		
		foreach ($results as $k => &$v) {
			$auth_token = $v['auth_token'];
			$v['profile_picture'] = $this->User_model->ReturnProfilePicture($auth_token);
			$v['c_id'] = $this->c_id;
		}
		
		return $results;
	}
	
	function MarkAsSeen(){
		 $this->db->where(array('c_id_fk'=>$this->c_id,'user_id_fk !='=>$this->user1));
		 $this->db->update('conversation_reply',array('status'=>1)); //Simply Mark as read
		 
		 return true;
	}
	
	function CountUnread(){
		//Returns the number of unread messages for a user
	 $stmt = "SELECT `c_id` FROM conversation WHERE `user1`='".$this->user1."' OR `user2`='".$this->user1."'";
	 $query = $this->db->query($stmt);
	 if($query->num_rows()>0){
	  $results = $query->result_array();
	  $c = 0;	
	  foreach($results as $r){
			$c_id = $r['c_id'];
			
			$query_for_conv = $this->db->get_where('conversation_reply',array('user_id_fk !='=>$this->user1,'c_id_fk'=>$c_id,'status'=>0));
			$count = $query_for_conv->num_rows();
			
			$c = $c + $count;
		}
		return $c;	
	 }
	 
	 return 0;

	}
}