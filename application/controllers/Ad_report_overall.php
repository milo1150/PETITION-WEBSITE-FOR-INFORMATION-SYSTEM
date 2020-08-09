<?php
class ad_report_overall extends CI_Controller{
	public function __construct(){
        parent::__construct();
		$this->load->model('ad_report_model');
		$this->load->model('Admin_report_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		$this->report_overall();
	}
	function report_overall(){	 		
		$data = $this->ad_report_model->report_admin_overall();
		$this->load->view('admin/report/ad_report_overall',$data);		
	}
	public function flexReportAll(){
		$post = json_decode(file_get_contents('php://input'),true);
		$data = $this->Admin_report_model->flexReportAll($post);
		echo json_encode($data);
	}
	
}
