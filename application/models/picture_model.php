<?php

/**
 * 
 */
class Picture_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function ScaleProfilePicture(){
		$config['image_library'] = 'gd2';
		$config['source_image']	= '/path/to/image/mypic.jpg';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']	 = 149;
		$config['height']	= 149;
		
		$this->load->library('image_lib', $config); 
		
		$this->image_lib->resize();
	}
}
