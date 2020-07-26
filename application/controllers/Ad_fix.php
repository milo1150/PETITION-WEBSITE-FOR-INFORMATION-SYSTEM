<?php
class ad_fix extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('ad_fix_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		$this->ad_fix_order();
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_fix_order() {								
		$data['fix_order'] = $this->ad_fix_model->fecth_fix_order();
			$this->load->view('admin/fix/ad_fix_order',$data);	
	}
	public function report_fix_order(){	
		$id = $this->input->post('id');			 
		$data = $this->ad_fix_model->fetch_fix_report($id);	
		$this->load->view('admin/fix/report_fix_order',$data);	
	}
	
	/////////////////////////////////////////////////////// ACCEPT ORDER ////////////////////////////////////////////////////////
	public function report_fix_order_update_accept(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'accept_date' => date("Y-m-d"),
			'accept_time' => date("H:i"),
		);
		$this->ad_fix_model->accept_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'รับงาน',
			'request_type' => 'แจ้งซ่อม',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);
		echo json_encode('');           		
	}	
	/////////////////////////////////////////////////////////// EMAIL (ACCEPT ORDER) ////////////////////////////////////////////////////////
	public function send_email_accept(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_fix($id);
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
		    // 'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");	
		$this->email->set_mailtype("html");	  	     
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - แจ้งซ่อม');		
		$message = 'รายการแจ้งซ่อมที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ได้รับเรื่องเรียบร้อยแล้ว<br>';		
		$this->email->message($message);
		$this->email->send();
		echo json_encode('');
	}
	/////////////////////////////////////////////////////////// INPROC ////////////////////////////////////////////////////////
	public function ad_fix_inproc() {						
		$data['fix_inproc'] = $this->ad_fix_model->fecth_fix_inproc();
		$this->load->view('admin/fix/ad_fix_inproc',$data);		
	}
	public function report_fix_inproc(){
		$id = $this->input->post('id');			
		$data = $this->ad_fix_model->fetch_fix_report_inproc($id);	
		$this->load->view('admin/fix/report_fix_inproc',$data);	
	}
	
	/////////////////////////////////////////////////////// CLOSING ORDER ////////////////////////////////////////////////////////
	public function report_fix_order_update_close(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'ad_comment' => $this->input->post('ad_comment'),
			'close_date' => date("Y-m-d"),
			'close_time' => date("H:i"),
		);
		$this->ad_fix_model->close_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'ปิดงาน',
			'request_type' => 'แจ้งซ่อม',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);
		echo json_encode('');           		
	}	

	/////////////////////////////////////////////////////////// EMAIL (COMPLETE) ////////////////////////////////////////////////////////
	public function send_email_com(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_fix($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date = $data['date_request'];
		$date_request = date('d-m-Y',strtotime($date));
		$time_request = $data['time_request'];
		$email = $data['email'];
		$reqid = base_url().'rating?reqid='.$data['reqid'];

		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'codeig.adm1n@gmail.com',
		    'smtp_pass' => 'Adminza1150',
		    // 'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");		     
		$this->email->set_mailtype("html");
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - แจ้งซ่อม');		
		$message = 'รายการแจ้งซ่อมที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ขณะนี้ดำเนินการเสร็จเป็นที่เรียบร้อยแล้ว<br>
		รบกวนช่วยประเมินผลการทำงานด้วยครับ - '.'<a href="'.$reqid.'">'.'คลิ้กที่นี่'.'</a>';		
		$this->email->message($message);
		$this->email->send();
		echo json_encode('');
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_fix_com() {						
		$data['fix_com'] = $this->ad_fix_model->fecth_fix_com();
		$this->load->view('admin/fix/ad_fix_com',$data);		
	}
	public function report_fix_com(){
		$id = $this->input->post('id');			
		$data = $this->ad_fix_model->fetch_fix_report_com($id);	
		$this->load->view('admin/fix/report_fix_com',$data);	
	}
	/////////////////////////////////////////////////////////// CANCLE ORDER ////////////////////////////////////////////////////////
	/*-------------------- REPORT --------------------*/
	public function ad_fix_cancle(){					
		$data['fix_order'] = $this->ad_fix_model->fecth_fix_cancle();
		$this->load->view('admin/fix/ad_fix_cancle',$data);		
	}			
	public function report_fix_cancle(){		
		$id = $this->input->post('id');								
		$data = $this->ad_fix_model->fetch_fix_order_cancle($id);	
		$this->load->view('admin/fix/report_fix_cancle',$data);	
	}
	/*-------------------- Function -------------------*/
	public function cancle_order(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'cancle_admin' => $this->input->post('ad_username'),
			'cancle_detail' => $this->input->post('cancle_detail'),
			'cancle_date' => date("Y-m-d"),
			'cancle_time' => date("H:i"),
		);
		$this->ad_fix_model->cancle_order($data);
		echo json_encode('');           		
	}
	public function email_cancle_order(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_fix($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date = $data['date_request'];
		$date_request = date('d-m-Y',strtotime($date));
		$time_request = $data['time_request'];
		$email = $data['email'];
		$cancle_detail = $this->input->post('cancle_detail');

		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'codeig.adm1n@gmail.com',
		    'smtp_pass' => 'Adminza1150',
		    // 'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");		
		$this->email->set_mailtype("html");
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - แจ้งซ่อม');		
		$message = 'รายการแจ้งซ่อมที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.' ได้ถูกยกเลิกรายการเนื่องจาก'.$cancle_detail.'<br>';		 
		$this->email->message($message);
		$this->email->send();
		echo json_encode('');
	}	

	/*------------------------------------ Watching same page in the same time then someone ACCEPT ORDER -------------------------------------------*/
	public function watch_accept_status(){
		$id = $this->input->post('id');
		$status = $this->db->select('*')->from('request_fix')->where('id',$id)->get()->result();
		echo json_encode($status);
	}

	//---------------------------------------------------------- overall deep data --------------------------------------------------------------
	public function ad_fix_alldata(){
		// echo no data for fetch
		$data = array(
			'0' => "",
			'1' => "",
			'2' => "",
			'3' => "",
		);
		$data['output'] = $this->ad_fix_model->filter_data($data);

		//echo null for filter ***เข้า function ทีเดียว
		$data['fixlist'] = "";  
		$data['building'] = "";
		$data['floor'] = "";
		$data['room'] = "";		

		//print_r($data);
		$this->load->view('admin/fix/ad_fix_alldata',$data);
	}
	public function filter_serch(){
		$data = array();
		if($_GET['fixlist']!=null){
			$data[0] = $this->input->get('fixlist');
		}else{
			$data[0] = "";
		}
		if($_GET['building']!=null){
			$data[1] = $this->input->get('building');
		}else{
			$data[1] = "";
		}
		if($_GET['floor']!=null){
			$data[2] = $this->input->get('floor');
		}else{
			$data[2] = "";
		}
		if($_GET['room']!=null){
			$data[3] = $this->input->get('room');
		}else{
			$data[3] = "";
		}

		//print_r($data);
		// Data for table
		$data['output'] = $this->ad_fix_model->filter_data($data);
		// Data for set filter value
		$data['fixlist'] = $data[0];
		$data['building'] = $data[1];
		$data['floor'] = $data[2];
		$data['room'] = $data[3];
				

		//print_r($data);
		$this->load->view('admin/fix/ad_fix_alldata',$data);	
		
	}
	
	



	
}	
?>
