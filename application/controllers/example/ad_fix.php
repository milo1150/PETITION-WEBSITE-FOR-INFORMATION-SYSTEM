<?php
class ad_fix extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('ad_fix_model');
    }
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->ad_fix_order();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_fix_order() {								
		$data['fix_order'] = $this->ad_fix_model->fecth_fix_order();
		$this->load->view('ad_fix_order',$data);
	}
	public function report_fix_order(){	
		$id = $this->input->post('id');			 
		$data = $this->ad_fix_model->fetch_fix_report($id);	
		$this->load->view('report_fix_order',$data);	
	}
	
	/////////////////////////////////////////////////////// ACCEPT ORDER ////////////////////////////////////////////////////////
	public function report_fix_order_update(){	
		$v = $this->input->post('id');
        echo  $op = $this->db->query("UPDATE request_fix SET order_status = 1 WHERE id=$v");    
		return $op; 	
	}
	public function report_fix_order_update_accept(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'accept_date' => date("d/m/Y"),
			'accept_time' => date("H:i"),
		);
		$this->ad_fix_model->accept_order($data);
		echo json_encode('');           		
	}	

	/////////////////////////////////////////////////////////// INPROC ////////////////////////////////////////////////////////
	public function ad_fix_inproc() {						
		$data['fix_inproc'] = $this->ad_fix_model->fecth_fix_inproc();
		$this->load->view('ad_fix_inproc',$data);		
	}
	public function report_fix_inproc(){
		if ($this->session->userdata('username') != '') {
			$id = $this->input->post('id');			
			$this->load->model('ad_fix_model');	
			$data = $this->ad_fix_model->fetch_fix_report_inproc($id);	
			$this->session->report_fix_data = $data;			
			redirect(base_url().'ad_fix/report_fix_detail2');
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_fix_detail2(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_fix_inproc');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_fix_inproc_update(){					
		if($_POST['id']){
			$iid = $_POST['id'];
			$this->db->query("UPDATE request_fix SET order_status = 2 WHERE id=$iid");
		}		
	}
	public function report_fix_inproc_update_session(){	
		date_default_timezone_set("Asia/Bangkok");	
		$id = $this->input->post('id');
		$ad_username = $this->input->post('ad_username');	
		$close_date = date("d/m/Y");
		$close_time = date("H:i");			
		$this->db->set('admin_close_name',$ad_username);
		$this->db->set('admin_close_date',$close_date);
		$this->db->set('admin_close_time',$close_time);
        $this->db->where('id',$id);                      
		$this->db->update('request_fix');              		
	}	

	/////////////////////////////////////////////////////////// EMAIL ////////////////////////////////////////////////////////
	public function send_email(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_fix($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date_request = $data['date_request'];
		$time_request = $data['time_request'];
		$email = $data['email'];

		$this->session->email_data = $data;		
		//$cookie_name = "QUEUE";
		//$cookie_value = $data['id'];
		setcookie("QUE",$data['id'],time()+60,"/"); // 86400 = 1 day

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
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ');		
		$message = 'รายการแจ้งซ่อมที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ขณะนี้ดำเนินการเสร็จเป็นที่เรียบร้อยแล้ว<br>
		รบกวนช่วยประเมินผลการทำงานด้วยครับ - <a href="http://localhost/codeig/rating">คลิ๊กที่นี่</a>';		
		$this->email->message($message);
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_fix_com() {
		if ($this->session->userdata('username') != '') {
			$this->load->model('ad_fix_model'); 						
			$data['fix_com'] = $this->ad_fix_model->fecth_fix_com();
			$this->load->view('ad_fix_com',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_fix_com(){
		if ($this->session->userdata('username') != '') {
			$id = $this->input->post('id');			
			$this->load->model('ad_fix_model');	
			$data = $this->ad_fix_model->fetch_fix_report_com($id);	
			$this->session->report_fix_data = $data;			
			redirect(base_url().'ad_fix/report_fix_detail3');
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_fix_detail3(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_fix_com');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
				
	
}	
?>
