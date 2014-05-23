<?php

/**A class for manipulatin our profile..Different Operations on the Profile of a Person.
 * Lets see but thinikin other models can do this..anyways continue
 */
class Profile_model extends CI_Model {
	
	var $auth_token;
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	function SendPasswordLink($email){
		$this->db->insert('password_requests',array('email_address'=>$email));
		
		return true;
	}
}
