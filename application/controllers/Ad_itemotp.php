<?php
class ad_itemotp extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('ad_itemotp_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 		
    }
	function index() {
		if ($this->session->userdata('username') != '') {
			$this->ad_itemotp_order();
		} else {
			redirect(base_url() . 'ad_login');
		}
	}


	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_itemotp_order() {					
		$data['itemotp_order'] = $this->ad_itemotp_model->fecth_item_order();
		$this->load->view('ad_itemotp_order',$data);		
	}
	public function report_itemotp_order(){			
		$id = $this->input->post('id');			
		$data = $this->ad_itemotp_model->fetch_item_report($id);
		$data['itemotp_list'] = $this->ad_itemotp_model->report_item_list($id);
		$this->load->view('report_itemotp_order',$data);							
	}


	/////////////////////////////////////////////////////// CLOSE ORDER ////////////////////////////////////////////////////////
	public function report_item_order_update_accept(){	

		//------------- UPDATE item_order_status > 1 -----------------	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'accept_date' => date("Y-m-d"),
			'accept_time' => date("H:i"),
		);
		$this->ad_itemotp_model->accept_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'อนุมัติ',
			'request_type' => 'เบิกของ',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);
		
		//-------------- UPDATE item_unit_remain (PRODUCT) ------------
		$row_count = $this->input->post('row_count');
		$req_data = $this->input->post('req_data');
		//----- SELECT ONLY PRODUCT ------
		for($i=3;$i<=$row_count;$i=$i+2){
			$item_type = $req_data[$i][0];
			if($item_type == 'วัสดุ'){
				$item_type = $req_data[$i][0];
				$item_name = $req_data[$i][1];
				$item_unit = $req_data[$i][2];
				$this->ad_itemotp_model->item_recount($item_type,$item_name,$item_unit);
			}					
		}

		//-------------- UPDATE item_information ------------
		$id = $this->input->post('id');
		$req_data = $this->input->post('req_data');
		$this->ad_itemotp_model->item_information_update($id,$req_data);		
		
		echo json_encode('');   
	}

	/////////////////////////////////////////////////////////// EMAIL ////////////////////////////////////////////////////////
	public function send_email(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_itemotp($id);
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
		    'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");		
		$this->email->set_mailtype("html");
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - เบิกของ');		
		$message = 'รายการเบิกของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ได้รับอนุมัติแล้ว
		รบกวนช่วยประเมินผลการทำงานด้วยครับ - '.'<a href="'.$reqid.'">'.'คลิ้กที่นี่'.'</a>';	
		$this->email->message($message);
		$this->email->print_debugger();
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_itemotp_com(){						
		$data['itemotp_com'] = $this->ad_itemotp_model->fecth_item_com();
		$this->load->view('ad_itemotp_com',$data);
	}		
	public function report_itemotp_com(){
		$id = $this->input->post('id');						
		$data = $this->ad_itemotp_model->fetch_item_report_com($id);		
		$data['itemotp_list'] = $this->ad_itemotp_model->report_itemotp_com_list($id);
		$this->load->view('report_itemotp_com',$data);	
	}

	/////////////////////////////////////////////////////////// CANCLE ORDER ////////////////////////////////////////////////////////
	public function ad_itemotp_cancle(){					
		$data['itemotp_order'] = $this->ad_itemotp_model->fecth_item_cancle();
		$this->load->view('ad_itemotp_cancle',$data);		
	}
				
	public function report_itemotp_cancle(){		
		$id = $this->input->post('id');								
		$data = $this->ad_itemotp_model->fetch_item_order_cancle($id);	
		$data['itemotp_list'] = $this->ad_itemotp_model->report_item_list($id);
		$this->load->view('report_itemotp_cancle',$data);	
	}

	public function cancle_order(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'cancle_admin' => $this->input->post('ad_username'),
			'cancle_detail' => $this->input->post('cancle_detail'),
			'cancle_date' => date("Y-m-d"),
			'cancle_time' => date("H:i"),
		);
		$this->ad_itemotp_model->cancle_order($data);
		echo json_encode('');           		
	}

	public function email_cancle_order(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_itemotp($id);
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
		    'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");		
		$this->email->set_mailtype("html");
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - เบิกของ');		
		$message = 'รายการเบิกของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.' ได้ถูกยกเลิกรายการเนื่องจาก'.$cancle_detail.'<br>';		 
		$this->email->message($message);
		$this->email->send();
	}	


	//----------------------------------------------------------- itemotp_product -----------------------------------------------------------------------
	//------- Main page-------
	public function item_product(){	
		$data['itemotp_product'] = $this->ad_itemotp_model->product_list();
		$this->load->view('ad_itemotp_product',$data);
	}
	//------- Add item -------
	public function item_product_add(){		
		$this->form_validation->set_rules('item_name','item_name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]|is_unique[itemotp_db_product.item_name]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุอักษรภาษาอังกฤษหรือตัวเลข',
                'is_unique'     => 'ชื่อวัสดุซ้ำ'
		));
		$this->form_validation->set_rules('item_unit','จำนวน','trim|required|regex_match[/^[0-9-]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวเลขเท่านั้น',
		));
		if($this->form_validation->run()){
			$data = array(
				'item_type' => 'วัสดุ',
				'item_name' => $this->input->post('item_name'),
				'item_unit_remain' => $this->input->post('item_unit'),
			);
			$this->db->insert('itemotp_db_product',$data);

			//------ Insert -----
			$ad_username = $this->input->post('ad_username');
			$item_name = $this->input->post('item_name');
			$item_unit = $this->input->post('item_unit');
			$this->ad_itemotp_model->itemotp_insert_log_add($ad_username,$item_name,$item_unit);
			echo json_encode($data);
		}else{	
			$error_name = form_error('item_name');
			$error_unit = form_error('item_unit');
			$error = array(
				'error_name' => $error_name,
				'error_unit' => $error_unit,
			);
			echo json_encode($error);
		}				
	}
	//---------------------------- Edit and Delete page ---------------------------
	public function item_product_editndel(){	
		$data['itemotp_product'] = $this->ad_itemotp_model->product_list();
		$this->load->view('ad_itemotp_product_editndel',$data);
	}
	public function item_product_edit(){
		$this->form_validation->set_rules('item_new_name','item_name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุอักษรภาษาอังกฤษหรือตัวเลข',
                'is_unique'     => 'ชื่อวัสดุซ้ำ'
		));
		$this->form_validation->set_rules('item_new_unit','จำนวน','trim|required|regex_match[/^[0-9-]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวเลขเท่านั้น',
		));
		if($this->form_validation->run()){
			//------ Insert New Item --------
			$id = $this->input->post('item_id');
			$data = array(
				'item_name' => $this->input->post('item_new_name'),
				'item_unit_remain' => $this->input->post('item_new_unit')
			);
			$this->db->where('id',$id);
			$this->db->update('itemotp_db_product',$data);

			//------ Insert Log -------
			$item_id = $this->input->post('item_id');
			$ad_username = $this->input->post('ad_username');
			$item_old_name = $this->input->post('item_old_name');
			$item_new_name = $this->input->post('item_new_name');
			$item_old_unit = $this->input->post('item_old_unit');
			$item_new_unit = $this->input->post('item_new_unit');
			$this->ad_itemotp_model->itemotp_insert_log_edit($item_id,$ad_username,$item_old_name,$item_new_name,$item_old_unit,$item_new_unit);
			echo json_encode($data);
		}else{	
			$error_name = form_error('item_new_name');
			$error_unit = form_error('item_new_unit');
			$error = array(
				'error_name' => $error_name,
				'error_unit' => $error_unit,
			);
			echo json_encode($error); 
		}		
	}
	public function item_product_del(){			
		//---- Delete -----
		$id = $this->input->post('item_id');
		$this->db->where('id',$id);
		$this->db->delete('itemotp_db_product');

		//---- Insert Log -----
		$item_id = $this->input->post('item_id');
		$ad_username = $this->input->post('ad_username');
		$item_name = $this->input->post('item_name');
		$item_unit = $this->input->post('item_unit');
		$this->ad_itemotp_model->itemotp_insert_log_del($item_id,$ad_username,$item_name,$item_unit);

		echo json_encode('');
	}
	//----------------------------------------------------- itemotp LOG ---------------------------------------------------------------
	public function itemotp_product_log(){	
		$data['itemotp_log'] = $this->ad_itemotp_model->itemotp_log();
		$this->load->view('ad_itemotp_product_log',$data);
	}
	//---------------------------------------------------------- History ---------------------------------------------------------------
	public function history(){
		$item_name = $this->input->get('item_name');
		$data['item_name'] = $item_name;
		$data['history_list'] = $this->ad_itemotp_model->otp_history_list($item_name);
		$this->load->view('ad_itemotp_history',$data);
	}
	/*------------------------------------ Watching same page in the same time then someone ACCEPT ORDER -------------------------------------------*/
	public function watch_accept_status(){
		$id = $this->input->post('id');
		$status = $this->db->select('*')->from('request_itemotp')->where('id',$id)->get()->result();
		echo json_encode($status);
	}

}	
?>
