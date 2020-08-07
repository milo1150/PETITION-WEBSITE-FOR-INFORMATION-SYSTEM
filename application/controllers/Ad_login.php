<?php
class ad_login extends CI_Controller {
	function index() {
		$this->load->view('admin/ad_login');
	}

	function vertify() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('admin');
			if ($this->admin->can_login($username, $password)){
				$d = $this->admin->ad_data($username);
				$session_data = array(
					'username' => $d[0]['username'],
					'rank' => $d[0]['rank']
				);
				$this->session->set_userdata($session_data);
				echo json_encode(true);
			} else {
				echo json_encode(false);
			}
		} 
	}
	function logout() {
		// $this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect(base_url() . 'ad_login');
	}
}