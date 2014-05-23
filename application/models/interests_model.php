<?php

/**@author Ojumah Samuel
 * @copyright 2014
 */
class Interests_model extends CI_Model {
	
	var $interest;
	var $interest_id;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	function InterestExists(){
		//Check If a particular Interest Exists
		return $this->GetInterestID(); 
	}
	
	function GetInterestID(){
		//Get Interest by ID..
		$query_for_interest = $this->db->get_where('interests',array('interest_name'=>$this->interest));
		 if($query_for_interest->num_rows()>0){
		 	$interest_results = $query_for_interest->result_array();
			
			return $interest_results[0]['interest_id'];
		 }
		 return false;
	}
	
	function ReturnInterests($limit=false){
		//Return Interest by a specified limit
		$stmt = "SELECT * FROM interests ORDER BY `interest_name` LIMIT 0,20 ";
		$query = $this->db->query($stmt);
		
		if($query->num_rows()>0){
			$results =  $query->result_array();
			foreach($results as &$r){
			 $this->interest_id = $r['interest_id'];
			 $r['user_count'] = $this->CountInterestUsers();
			}
			return $results;
		}
		
		return false;
	}
	
	function CountInterestUsers(){
		//Counts particular Interests and tries to
		
		$query = $this->db->get_where('user_interests',array('interest_id'=>$this->interest_id));
		return $query->num_rows();	
	}
	
	function CreateSlug(){
		//Create a Friendly Url for the Interest Name
	}
	
	function ReturnName(){
		$this->load->model('User_model');
		$this->interest_id = $this->GetInterestID();
		$query = $this->db->get_where('user_interests',array('interest_id'=>$this->interest_id));
		
		$results = $query->result_array();
		return $results[0]['interest_name'];
	}
	
	function UsersInterested(){
		$this->load->model('User_model');
		$this->interest_id = $this->GetInterestID();
		$query_for_user_id = $this->db->get_where('user_interests',array('interest_id'=>$this->interest_id));
		//Add a Limit to this..say 20
	
		if($query_for_user_id->num_rows()>0){
			$results = $query_for_user_id->result_array();
			
			foreach($results as $v){
				//Return the Firstname and lastname and also profile picture
				$this->User_model->user_id = $v['user_id'];
				$user_profile[] = $this->User_model->ReturnProfile();
			}
			
			
			return $user_profile[0];
		}
			return false;
	}
	/*
	function AddInterest(){
		//Check If Interest is exactly the same...IF true Return ID else Add New Interest
		 $query_for_interest = $this->db->get_where('interests',array('interest_name'=>$this->interest));
		 if($query_for_interest->num_rows()>0){
		 	$interest_results = $query_for_interest->result_array();
			
			return $interest_results[0]['interest_id'];
		 }
		 else{
		 	$query = $this->db->insert('interests',array('interest_name'=>$this->interest));
			 
			 $query_for_interest = $this->db->get_where('interests',array('interest_name'=>$this->interest)); #Meant to be a recursive call...Quick Fix..Move On!
			 $interest_results = $query_for_interest->result_array();
			 return $interest_results[0]['interest_id'];
		 }
		 	
	}
	
	function AddUserInterests(){
		//Add to Interests first
		//Return Interest ID
		$this->user_id = $this->user_in_session;
		$interest_id = $this->AddInterest();

		$this->db->insert('user_interests',array('user_id'=>$this->user_id,'interest_id'=>$interest_id));
		
		return true;
	}
	
	function ClearInterests(){
		//Clear d user interests..
		$this->user_id = $this->user_in_session;
		$this->db->delete('user_interests',array('user_id'=>$this->user_id));
		return true;
	}
	
	function ReturnUserInterests(){
		$this->user_id = $this->user_in_session;
		
		$this->db->select('interest_name');
		$this->db->from('user_interests');
		$this->db->join('interests','interests.interest_id = user_interests.interest_id');
		$this->db->where('user_id',$this->user_id);
		
		$query = $this->db->get();
		if($query->num_rows()>0){
			$results = $query->result_array();
			return $results;
		}
		
		return false;
	}
	*/

}

?>