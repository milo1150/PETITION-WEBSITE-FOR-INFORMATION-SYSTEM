<?php
class ad_report_overall extends CI_Controller{
	public function __construct(){
        parent::__construct();
		$this->load->model('ad_report_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		if ($this->session->userdata('username') != ''){
			$this->report_overall();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	function report_overall(){	 		
		$data = $this->ad_report_model->report_admin_overall();
		//print_r($data);
		$this->load->view('ad_report_overall',$data);		
	}
	
}
