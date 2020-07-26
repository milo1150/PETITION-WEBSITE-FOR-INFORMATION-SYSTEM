<?php

class request extends CI_Controller{
	public function __construct()
    {
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->helper(array('form', 'url'));	   
	   $this->load->library('form_validation');
    }
	function index (){
		$this->load->view('user/request/request');
	}
}