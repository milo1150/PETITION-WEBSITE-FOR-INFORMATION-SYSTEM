<?php
class ad_finger extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->model('ad_finger_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->ad_finger_order();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_finger_order(){						
		$data['finger_order'] = $this->ad_finger_model->fecth_finger_order();
		$this->load->view('ad_finger_order',$data);				
	}		
	public function report_finger_order(){		
		$id = $this->input->post('id');	
		$data = $this->ad_finger_model->fetch_finger_report($id);
		$this->load->view('report_finger_order',$data);		
	}
	/////////////////////////////////////////////////////// ACCEPT ORDER ////////////////////////////////////////////////////////
	public function check_id_scan(){
		$id_scan = $this->input->post('id_scan');
		$result = $this->ad_finger_model->check_id_scan($id_scan);
		echo json_encode($result);
	} 
	public function report_finger_order_update_accept(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'id_scan' => $this->input->post('id_scan'),
			'accept_date' => date("Y-m-d"),
			'close_time' => date("H:i"),
		);
		$this->ad_finger_model->accept_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'ปิดงาน',
			'request_type' => 'สแกนนิ้ว',
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
		$data = $this->send_email->send_email_finger($id);
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
		$message = 'รายการสแกนนิ้วที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ขณะนี้ดำเนินการเสร็จเป็นที่เรียบร้อยแล้ว<br>';
		// รบกวนช่วยประเมินผลการทำงานด้วยครับ - <a href="http://localhost/codeig/rating">คลิ๊กที่นี่</a>'	
		$this->email->message($message);
		$this->email->print_debugger();
		$this->email->send();
	}	
	
	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_finger_com(){						
		$data['finger_com'] = $this->ad_finger_model->fecth_finger_com();
		$this->load->view('ad_finger_com',$data);		
	}
	public function report_finger_com() {		
		$id = $this->input->post('id');	
		$data = $this->ad_finger_model->report_finger_com($id);
		$this->load->view('report_finger_com',$data);		
	}

	//----------------------------------------------------------- FINGER REPORT ----------------------------------------------------------------
	public function finger_report(){
		$data['finger_report'] = $this->ad_finger_model->finger_report();
		$this->load->view('ad_finger_list',$data);
	}
	/*------------------------------------ Watching same page in the same time then someone ACCEPT ORDER -------------------------------------------*/
	public function watch_accept_status(){
		$id = $this->input->post('id');
		$status = $this->db->select('*')->from('request_finger')->where('id',$id)->get()->result();
		echo json_encode($status);
	}

}
