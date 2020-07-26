<?php
class adminpage extends CI_Controller {
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->load->view('adminpage');
		} else {
			redirect(base_url() . 'ad_login');
		}
	}

}
