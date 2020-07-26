<?php
class ad_alert_all extends CI_Controller {
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->load->view('ad_alert_all');
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
}
