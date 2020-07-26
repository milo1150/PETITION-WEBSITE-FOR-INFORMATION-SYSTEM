<?php
class ad_main extends CI_Controller {	
	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('ad_report_model');
		$this->load->model('ad_main_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
	}	
	function index() {		
		$this->mainpage_data();			
	}
	function mainpage_data(){
		$data = $this->ad_report_model->ad_main_data();		
		$this->session->unset_userdata('max_id');
		$this->load->view('admin/main/ad_main',$data);
	}
	function remain(){
		$data['remain'] = $this->ad_main_model->remain_order();
		$this->load->view('admin/main/ad_main_remain',$data);
	}
	function timeout_order(){
		$now_date = date('Y-m-d',strtotime('now'));
		$now_time = date('H:i');		
		$data['timeout'] = $this->ad_main_model->timeout_order($now_date,$now_time);
		// print_r($data);
		$this->load->view('admin/main/ad_main_timeout',$data);
	}
	function sidenav_order_count(){
		$data = $this->ad_main_model->sidenav_order_count();
		echo json_encode($data);
	}
	function rt_noti_order(){
		$data = $this->ad_report_model->rt_order();
		echo json_encode($data);
	}
	function rt_box_event(){
		$data = $this->ad_report_model->rt_event();
		echo json_encode($data);
	}
}