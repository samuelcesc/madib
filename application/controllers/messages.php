<?php
 
/**@author Ojumah Samuel
 * @copyright 2014
 */
class Messages extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function Index(){
		
		$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
		
		$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
		$firstname = $this->session->userdata('firstname');
		$lastname = $this->session->userdata('lastname');
		$page_data['sess_firstname'] = $firstname;
		$page_data['sess_lastname'] = $lastname;
		$page_data['firstname'] = $firstname;
		$page_data['lastname'] = $lastname;
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		
		$this->load->model('Conversation_model');
		
		$messages_data['messages'] = $this->Conversation_model->ShowConversations();
		
		$follow_data = $this->_GetFollowData();
		$page_data['followers_count'] = $follow_data['followers_count'];
		$page_data['following_count'] = $follow_data['following_count'];
		$page_data['coursemates_count'] = $this->coursemates_count;
		$page_data['count_unread'] = $this->CountUnreadMessages();
		$page_data['latest_post'] = $this->latest_post;
				
		$page_data['title'] = "Messages";
		$this->load->view('include/header',$page_data);
		$this->load->view('include/left_panel',$page_data);
		$this->load->view('messages/message_index',$messages_data);		
		$this->load->view('include/footer');
	}
	
	function Send(){
		$this->load->model('Conversation_model');
		$this->load->model('User_model');
		$auth_token = $this->input->post('auth_token');

		$this->Conversation_model->message = $this->input->post('message');
		$this->Conversation_model->user2 = $this->User_model->Get_User_ID_By_Token($auth_token);
		$message_sent = $this->Conversation_model->Reply();
		
		if($message_sent){
			redirect(base_url('messages'));
		}
				
	}
	
	function Reply(){
		$conv_id = $this->input->post('conversation');
		
		$this->load->model('Conversation_model');
		$this->load->model('User_model');
		
		$this->Conversation_model->c_id = $conv_id;
		$this->Conversation_model->message = $this->input->post('message');
		$message_sent = $this->Conversation_model->ReplyConversation();
		
		if($message_sent){
			redirect(base_url('messages/conversations/'.$conv_id));
		}
	}
	
	function Test(){
		$this->load->model('Conversation_model');
		$this->Conversation_model->ShowConversation();
	}
	
	function Conversations($conversation_id=false){
		
		if($conversation_id){
				
			$this->load->model('Conversation_model');
			$page_data['profile_picture'] = $this->session->userdata('profile_picture'); 
			$page_data['sess_profile_picture'] = $this->session->userdata('profile_picture');
			$firstname = $this->session->userdata('firstname');
			$lastname = $this->session->userdata('lastname');
			$page_data['sess_firstname'] = $firstname;
			$page_data['sess_lastname'] = $lastname;
			$page_data['firstname'] = $firstname;
			$page_data['lastname'] = $lastname;
			$page_data['count_unread'] = $this->CountUnreadMessages();	
			
			$this->Conversation_model->c_id = $conversation_id;
			$is_part_of_conv = $this->Conversation_model->ConversationExists($conversation_id); #Check If User Is Part of Conversation
			
			if(!$is_part_of_conv){
				redirect(base_url('messages'));
			}
			
			$page_data['messages'] = $this->Conversation_model->ConversationList();
			
			$follow_data = $this->_GetFollowData();
		
			$page_data['followers_count'] = $follow_data['followers_count'];
			$page_data['following_count'] = $follow_data['following_count'];
			$page_data['coursemates_count'] = $this->coursemates_count;
			$page_data['latest_post'] = $this->latest_post;
			
			$page_data['title'] = "Conversations";
			$this->load->view('include/header',$page_data);
			$this->load->view('include/left_panel',$page_data);
			$this->load->view('messages/conversation',$page_data);		
			$this->load->view('include/footer');
		}
		
		else redirect(base_url('messages'));
		
	}
	
}
