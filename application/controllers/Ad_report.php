<?php
class ad_report extends CI_Controller{
	public function __construct(){
        parent::__construct();
		$this->load->model('ad_report_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		if ($this->session->userdata('username') != ''){
			$this->ad_list();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function ad_list(){								 
		$this->session->unset_userdata('graph_data');						
		$data['ad_list'] = $this->ad_report_model->admin_list();
		$this->load->view('ad_report_single',$data);			
	}
	function admin_report(){
		$username = $this->input->post('username');		 		
		$data = $this->ad_report_model->order_alltime($username);
		//print_r($data['year_data_accept']);
		$this->load->view('ad_report_single_detail',$data);		
	}
}
