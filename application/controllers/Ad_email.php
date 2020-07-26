<?php
class ad_email extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('ad_email_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->ad_email_order();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_email_order(){						
		$data['email_order'] = $this->ad_email_model->fecth_email_order();		
		if ($this->session->userdata('username') != '') {
			$this->load->view('ad_email_order',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	} 		
	public function report_email_order() {			
		$id = $this->input->post('id');	
		$data = $this->ad_email_model->fetch_email_report($id);
		$this->load->view('report_email_order',$data);	
	}
	/////////////////////////////////////////////////////// ACCEPT ORDER ////////////////////////////////////////////////////////
	public function report_email_order_update_accept(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'accept_date' => date("Y-m-d"),
			'close_time' => date("H:i"),
		);
		$this->ad_email_model->accept_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'ปิดงาน',
			'request_type' => 'ขอเปิดอีเมล์',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);

		echo json_encode('');
	}
	/////////////////////////////////////////////////////////// EMAIL ////////////////////////////////////////////////////////
	public function send_email(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_email($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date = $data['date_request'];
		$date_request = date('d-m-Y',strtotime($date));
		$time_request = $data['time_request'];
		$email = $data['email'];

		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'codeig.adm1n@gmail.com',
		    'smtp_pass' => 'Adminza1150',
		    'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");		
		$this->email->set_mailtype("html");	
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ');		
		$message = 'รายการขอเปิดอีเมล์ที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ขณะนี้ดำเนินการเสร็จเป็นที่เรียบร้อยแล้ว<br>';
		// รบกวนช่วยประเมินผลการทำงานด้วยครับ - <a href="http://localhost/codeig/rating">คลิ๊กที่นี่</a>'		
		$this->email->message($message);
		$this->email->print_debugger();
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_email_com(){
		$data['email_com'] = $this->ad_email_model->fecth_email_com();
		$this->load->view('ad_email_com',$data);	
	}
	public function report_email_com() {
		$id = $this->input->post('id');	
		$data = $this->ad_email_model->report_email_com($id);
		$this->load->view('report_email_com',$data);	
	}
	/*------------------------------------ Watching same page in the same time then someone ACCEPT ORDER -------------------------------------------*/
	public function watch_accept_status(){
		$id = $this->input->post('id');
		$status = $this->db->select('*')->from('request_email')->where('id',$id)->get()->result();
		echo json_encode($status);
	}		
}