<?php
class ad_item extends CI_Controller {
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->ad_item_order();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_item_order() {
		if ($this->session->userdata('username') != '') {
			$this->load->model('ad_item_model');  						
			$data['item_order'] = $this->ad_item_model->fecth_item_order();
			$this->load->view('ad_item_order',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_order(){
		if ($this->session->userdata('username') != ''){			
			$id = $this->input->post('id');			
			$this->load->model('ad_item_model');	
			$data = $this->ad_item_model->fetch_item_report($id);	
			$this->session->report_item_data = $data;			
			redirect(base_url().'ad_item/report_item_detail');						
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_detail(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_item_order');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_order_update(){	
		$v=$this->input->post('id');
        echo  $op = $this->db->query("UPDATE request_item SET order_status = 1 WHERE id=$v");    
		return $op; 	
	}
	public function report_item_order_update_session(){
		date_default_timezone_set("Asia/Bangkok");
		$id = $this->input->post('id');
		$ad_username = $this->input->post('ad_username');	
		$accept_date = date("d/m/Y");
		$accept_time = date("H:i");					
		$this->db->set('admin_accept_name',$ad_username);
		$this->db->set('admin_accept_date',$accept_date);
		$this->db->set('admin_accept_time',$accept_time);
        $this->db->where('id',$id);                      
		$this->db->update('request_item');              		
	}

	/////////////////////////////////////////////////////////// INPROC ////////////////////////////////////////////////////////
	public function ad_item_inproc(){
		if ($this->session->userdata('username') != '') {
			$this->load->model('ad_item_model');  						
			$data['item_inproc'] = $this->ad_item_model->fecth_item_inproc();
			$this->load->view('ad_item_inproc',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	}	
	public function report_item_inproc(){
		if ($this->session->userdata('username') != '') {
			$id = $this->input->post('id');			
			$this->load->model('ad_item_model');	
			$data = $this->ad_item_model->fetch_item_report_inproc($id);	
			$this->session->report_item_data = $data;			
			redirect(base_url().'ad_item/report_item_detail2');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_detail2(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_item_inproc');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_inproc_update(){					
		if($_POST['id']){
			$iid = $_POST['id'];
			$this->db->query("UPDATE request_item SET order_status = 2 WHERE id=$iid");
		}		
	}
	public function report_item_inproc_update_session(){
		date_default_timezone_set("Asia/Bangkok");
		$id = $this->input->post('id');
		$ad_username = $this->input->post('ad_username');	
		$accept_date = date("d/m/Y");
		$close_time = date("H:i");			
		$this->db->set('admin_close_name',$ad_username);
		$this->db->set('admin_close_date',$accept_date);
		$this->db->set('admin_close_time',$close_time);
        $this->db->where('id',$id);                      
		$this->db->update('request_item');              		
	}
	/////////////////////////////////////////////////////////// EMAIL ////////////////////////////////////////////////////////
	public function send_email(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_item($id);
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
		$message = 'รายการเบิกของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ทำการส่งของคืนเป็นที่เรียบร้อยแล้ว<br>
		รบกวนช่วยประเมินผลการทำงานด้วยครับ - <a href="http://localhost/codeig/rating">คลิ๊กที่นี่</a>';		
		$this->email->message($message);
		$this->email->print_debugger();
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_item_com(){
		if ($this->session->userdata('username') != '') {
			$this->load->model('ad_item_model');  						
			$data['item_com'] = $this->ad_item_model->fecth_item_com();
			$this->load->view('ad_item_com',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	}		
	public function report_item_com(){
		if ($this->session->userdata('username') != '') {
			$id = $this->input->post('id');			
			$this->load->model('ad_item_model');	
			$data = $this->ad_item_model->fetch_item_report_com($id);	
			$this->session->report_item_data = $data;			
			redirect(base_url().'ad_item/report_item_detail3');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_detail3(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_item_com');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}	

	/////////////////////////////////////////////////////////// CANCLE ORDER ////////////////////////////////////////////////////////
	public function cancle_order(){
		$id = $this->input->post('id');
		$cancle_detail = $this->input->post('cancle_detail');
		$ad_username = $this->input->post('ad_username');
		$this->db->set('order_status',4);
		$this->db->set('cancle_detail',$cancle_detail);
		$this->db->set('cancle_admin',$ad_username);
		$this->db->where('id',$id);
		$this->db->update('request_item');
		redirect(base_url().'ad_item');
	}
	public function ad_item_cancle(){
		if ($this->session->userdata('username') != ''){
			$this->load->model('ad_item_model');  						
			$data['item_order'] = $this->ad_item_model->fecth_item_cancle();
			$this->load->view('ad_item_cancle',$data);
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_cancle(){
		if ($this->session->userdata('username') != ''){			
			$id = $this->input->post('id');			
			$this->load->model('ad_item_model');	
			$data = $this->ad_item_model->fetch_item_order_cancle($id);	
			$this->session->report_item_data = $data;			
			redirect(base_url().'ad_item/report_item_detail4');						
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function report_item_detail4(){
		if ($this->session->userdata('username') != ''){	
			$this->load->view('report_item_cancle');	
		} else {
			redirect(base_url() . 'ad_login');
		}
	}
	public function email_cancle_order(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_item($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date_request = $data['date_request'];
		$time_request = $data['time_request'];
		$email = $data['email'];
		$cancle_detail = $this->input->post('cancle_detail');

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
		$message = 'รายการเบิกของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.' ได้ถูกยกเลิกรายการเนื่องจาก'.$cancle_detail.'<br>';		 
		$this->email->message($message);
		$this->email->send();
	}	



}	
?>
