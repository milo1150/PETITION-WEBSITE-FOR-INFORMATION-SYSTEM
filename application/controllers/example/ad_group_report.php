<?php
class ad_group_report extends CI_Controller {
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->load->view('ad_group_report');
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
}