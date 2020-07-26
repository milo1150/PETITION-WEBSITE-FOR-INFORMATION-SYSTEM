<?php
class ad_item extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('ad_item_model');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 		
    }
	function index() {
		$this->ad_item_order();
	}
	/////////////////////////////////////////////////////////// ORDER ////////////////////////////////////////////////////////
	public function ad_item_order() {					
		$data['item_order'] = $this->ad_item_model->fecth_item_order();
		$this->load->view('admin/item/ad_item_order',$data);		
	}
	public function report_item_order(){			
		$id = $this->input->post('id');			
		$data = $this->ad_item_model->fetch_item_report($id);
		$data['item_list'] = $this->ad_item_model->report_item_list($id);
		$data['product_id'] = $this->ad_item_model->report_item_list_pd_id($id);
		// print_r($data);
		$this->load->view('admin/item/report_item_order',$data);							
	}
	//------------ query เลขครุภัณฑ์ ------------
	/*public function report_item_order_product_id(){
		$data = $this->input->post('data_pd_id');
		$count = count($data);
		$req_data = array();
		for($i=0;$i<$count;$i++){
			$item_type = $data[$i][0];
			$item_name = $data[$i][1];
			$item_id = $this->db->select('item_id')->from('item_db_product_id')->where('item_type',$item_type)->where('item_name',$item_name)->where('item_status',0)->get()->result_array();
			$req_data[$i] = $item_id;
		}
		//print_r($req_data);
		//print_r($req_data);
		echo json_encode($req_data);
	}*/

	/////////////////////////////////////////////////////// ACCEPT ORDER ////////////////////////////////////////////////////////
	public function report_item_order_update_accept(){	
		date_default_timezone_set("Asia/Bangkok");
		//------------- UPDATE item_order_status > 1 -----------------										
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'accept_date' => date("Y-m-d"),
			'accept_time' => date("H:i"),
		);
		$this->ad_item_model->accept_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'อนุมัติ',
			'request_type' => 'ยืมของ',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);

		//-------------- UPDATE item_unit_remain & item_unit_out (PRODUCT) ------------
		$row_count = $this->input->post('row_count');
		$req_data = $this->input->post('req_data');
		//----- SELECT ONLY PRODUCT ------
		for($i=3;$i<=$row_count;$i=$i+2){
			$item_type = $req_data[$i][0];
			if($item_type == 'วัสดุ'){
				$item_type = $req_data[$i][0];
				$item_name = $req_data[$i][1];
				$item_unit = $req_data[$i][2];
				$this->ad_item_model->item_recount($item_type,$item_name,$item_unit);
				//echo $item_type.$item_name.$item_unit;
			}					
		}
		
		//-------------- UPDATE item_status (PRODUCT_ID) ------------
		$select_data = $this->input->post('select_data');
		$select_data_length = count($select_data);
		//print_r($select_data_length);	

		for($j=0;$j<$select_data_length;$j++){
			$array_positionJ_length = count($select_data[$j]);
			for($k=0;$k<$array_positionJ_length;$k++){
				//echo $select_data[$j][$k];
				$this->db->set('item_status','1')->where('item_id',$select_data[$j][$k])->update('item_db_product_id');
			}
		}

		//-------------- UPDATE item_information ------------
		$id = $this->input->post('id');
		$req_data = $this->input->post('req_data');
		$select_data = $this->input->post('select_data');
		$this->ad_item_model->item_information_update($id,$req_data,$select_data);		
		
		echo json_encode('');   
	}
	/////////////////////////////////////////////////////////// EMAIL (ACCEPT ORDER) ////////////////////////////////////////////////////////
	public function send_email_accept(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_item($id);
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$date = $data['date_request'];
		$date_request = date('d-m-Y',strtotime($date));
		$time_request = $data['time_request'];
		$email = $data['email'];


		//---------- วัสดุ ------------
		$req_data = $this->input->post('req_data');  // req_data ที่ส่งมาไม่ได้เรียง ข้อมูลในตำแหน่งจะเป็น 3 5 7 9 .....		
		$count = count($req_data)-1;		
		for($i=3;$i<=$count;$i=$i+2){
			if($req_data[$i][0]=='วัสดุ'){
				$x[$i] = $req_data[$i][0].' : '.$req_data[$i][1].' (จำนวน '.$req_data[$i][2].')<br>';
			}			
		}
		$req_data_string = implode($x);

		//---------- ครุภัณฑ์ --------
		$y = array(); $z1 = array();
		$email_data_name =$this->input->post('email_data_name');
		$email_data = $this->input->post('email_data');
		for($i=0;$i<count($email_data_name);$i++){
			for($j=0;$j<count($email_data[$i]);$j++){
				$y[$i][$j] = ' '.$email_data_name[$i].' : '.$email_data[$i][$j].'<br>'; //ใส่ช่องว่างเพื่อ explode 	
			}
			$z1[$i] = implode($y[$i]);	// รวม array to string		
		}
		$product_id_string = implode($z1); // รวม array to string


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
		$this->email->subject('ระบบสารสนเทศ - ยืมของ');		
		$message = 'รายการยืมของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ได้รับอนุมัติแล้ว<br>'.
		'ซึ่งมีรายระเอียดของรายการที่เบิกดังนี้<br>'.
		$req_data_string.$product_id_string.'<br>';		
		$this->email->message($message);
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// INPROC ////////////////////////////////////////////////////////
	public function ad_item_inproc(){					
		$data['item_inproc'] = $this->ad_item_model->fecth_item_inproc();
		$this->load->view('admin/item/ad_item_inproc',$data);
	}	
	public function report_item_inproc(){
		$id = $this->input->post('id');		
		$data = $this->ad_item_model->fetch_item_report_inproc($id);	
		$data['item_list'] = $this->ad_item_model->report_inproc_item_list($id);
		$data['item_detail'] = $this->ad_item_model->report_inproc_item_list_detail($id);
		$this->load->view('admin/item/report_item_inproc',$data);						
	}

	/////////////////////////////////////////////////////// CLOSING ORDER ////////////////////////////////////////////////////////
	public function report_item_order_update_close(){	
		date_default_timezone_set("Asia/Bangkok");							
		$data = array(
			'id' => $this->input->post('id'),
			'ad_username' => $this->input->post('ad_username'),
			'close_date' => date("Y-m-d"),
			'close_time' => date("H:i"),
		);
		$this->ad_item_model->close_order($data);

		//------- Update Event @admain -------
		$data2 = array(
			'status' => 'ปิดงาน',
			'request_type' => 'ยืมของ',
			'request_id' => $this->input->post('id'),
			'accept_by' => $this->input->post('ad_username'),
			'date' => date("Y-m-d"),
			'time' => date('H:i'),
		);
		$this->db->insert('event_request',$data2);

		//---------- Update product unit and item_id ----------
		$req_detail = $this->input->post('req_detail');
		$this->ad_item_model->item_restock($req_detail);

		echo json_encode('');           		
	}
	
	/////////////////////////////////////////////////////////// EMAIL ////////////////////////////////////////////////////////
	public function send_email(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_item($id);
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
		$this->email->subject('ระบบสารสนเทศ - ยืมของ');		
		$message = 'รายการยืมของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request. ' ทำการส่งของคืนเป็นที่เรียบร้อยแล้ว รบกวนช่วยประเมินผลการทำงานด้วยครับ - '.'<a href="'.$reqid.'">'.'คลิ้กที่นี่'.'</a>';	
		$this->email->message($message);
		$this->email->print_debugger();
		$this->email->send();
	}

	/////////////////////////////////////////////////////////// COMPLETE ////////////////////////////////////////////////////////
	public function ad_item_com(){						
		$data['item_com'] = $this->ad_item_model->fecth_item_com();
		$this->load->view('admin/item/ad_item_com',$data);
	}		
	public function report_item_com(){
		$id = $this->input->post('id');						
		$data = $this->ad_item_model->fetch_item_report_com($id);		
		$data['item_list'] = $this->ad_item_model->report_inproc_item_list($id);
		$data['item_detail'] = $this->ad_item_model->report_inproc_item_list_detail($id);
		$this->load->view('admin/item/report_item_com',$data);	
	}

	/////////////////////////////////////////////////////////// CANCLE ORDER ////////////////////////////////////////////////////////
	public function ad_item_cancle(){					
		$data['item_order'] = $this->ad_item_model->fecth_item_cancle();
		$this->load->view('admin/item/ad_item_cancle',$data);		
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
		$this->ad_item_model->cancle_order($data);
		echo json_encode('');           		
	}	
	
	public function report_item_cancle(){		
		$id = $this->input->post('id');								
		$data = $this->ad_item_model->fetch_item_order_cancle($id);	
		$data['item_list'] = $this->ad_item_model->report_inproc_item_list($id);
		$this->load->view('admin/item/report_item_cancle',$data);	
	}

	public function email_cancle_order(){
		$id = $this->input->post('id');
		$this->load->model('send_email');
		$data = $this->send_email->send_email_item($id);
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
		$this->email->subject('ระบบสารสนเทศ - ยืมของ');		
		$message = 'รายการยืมของที่คุณ'.$firstname.' '.$lastname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.' ได้ถูกยกเลิกรายการเนื่องจาก'.$cancle_detail.'<br>';		 
		$this->email->message($message);
		$this->email->send();
	}	

	//----------------------------------------------------------- วัสดุ (item_db_product) -----------------------------------------------------------------------
	//------- Main page-------
	public function item_product(){	
		$data['item_product'] = $this->ad_item_model->product_list();
		$this->load->view('admin/item/pd/ad_item_product',$data);
	}
	//------- Add item -------
	public function item_product_add(){		
		$this->form_validation->set_rules('item_name','item_name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]|is_unique[item_db_product.item_name]',
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
		$this->form_validation->set_rules('item_units','หน่วย','trim|required|regex_match[/^[ก-๏a-zA-Zเ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวอักษรเท่านั้น',
		));
		if($this->form_validation->run()){
			$ad_username = $this->input->post('ad_username');
			$item_name = $this->input->post('item_name');
			$item_units = $this->input->post('item_units');
			$item_unit = $this->input->post('item_unit');
			$data = array(
				'item_type' => 'วัสดุ',
				'item_name' => $item_name,
				'item_units' => $item_units,
				'item_unit_all' => $item_unit,
				'item_unit_remain' => $item_unit,
			);
			$this->db->insert('item_db_product',$data);
			$this->ad_item_model->pd_insert_log_add($ad_username,$item_name,$item_unit);			
			echo json_encode($data);
		}else{	
			$error_name = form_error('item_name');
			$error_unit = form_error('item_unit');
			$error_units = form_error('item_units');
			$error = array(
				'error_name' => $error_name,
				'error_unit' => $error_unit,
				'error_units' => $error_units,
			);
			echo json_encode($error);
		}				
	}
	//---------------------------- Edit and Delete page ---------------------------
	public function item_product_editndel(){	
		$data['item_product'] = $this->ad_item_model->product_list();
		$this->load->view('admin/item/pd/ad_item_product_editndel',$data);
	}
	public function item_product_edit(){
		$this->form_validation->set_rules('item_name','item_name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
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
		$this->form_validation->set_rules('item_units','หน่วย','trim|required|regex_match[/^[ก-๏a-zA-Zเ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวอักษรเท่านั้น',
		));
		if($this->form_validation->run()){
			$id = $this->input->post('item_id');
			$item_name = $this->input->post('item_name');
			$item_units = $this->input->post('item_units');
			$item_unit_all = $this->input->post('item_unit');
			$ad_name = $this->input->post('ad_username');
			$this->ad_item_model->product_edit_updatedata($id,$item_name,$item_unit_all,$ad_name,$item_units);					
			echo json_encode('0');
		}else{	
			$error_name = form_error('item_name');
			$error_unit = form_error('item_unit');
			$error_units = form_error('item_units');
			$error = array(
				'error_name' => $error_name,
				'error_unit' => $error_unit,
				'error_units' => $error_units,
			);
			echo json_encode($error); 
		}		
	}
	public function item_product_del(){
		//---- Input ----
		$id = $this->input->post('item_id');
		$ad_username = $this->input->post('ad_username');
		$item_name = $this->input->post('item_name');
		$item_unit = $this->input->post('item_unit'); 
		//---- Del ----
		$this->db->where('id',$id);
		$this->db->delete('item_db_product');
		//---- INSERT LOG (Del) ------      		  
		$this->ad_item_model->pd_insert_log_del($id,$ad_username,$item_name,$item_unit);	

		echo json_encode('');
	}

	//----------------------------------------------------- ครุภัณฑ์ (item_db_product_id) ---------------------------------------------------------------
	//------- Main page-------
	public function item_product_id(){	
		$data['item_product_id'] = $this->ad_item_model->product_id_list();
		$this->load->view('admin/item/pd_id/ad_item_product_id',$data);
	}
	//------- Add item -------
	public function item_product_id_add(){		
		$this->form_validation->set_rules('item_name','ชื่อวัสดุ','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
                'is_unique'     => 'ชื่อวัสดุซ้ำ'
		));
		$this->form_validation->set_rules('item_id','จำนวน','trim|required|regex_match[/^[ก-๏a-zA-Z0-9-\s]+$/]|is_unique[item_db_product_id.item_id]',
        array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุอักษรภาษาอังกฤษหรือตัวเลข',
			'is_unique'     => 'ชื่อครุภัณฑ์ซ้ำ'
		));
		$this->form_validation->set_rules('f_year','ปีงบประมาณ','trim|required|regex_match[/^[0-9-]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวเลขเท่านั้น',
		));
		$this->form_validation->set_rules('n_request','ผู้เบิก','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
		));
		$this->form_validation->set_rules('place','สถานที่ติดตั้ง','trim|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
		));
		if($this->form_validation->run()){
			$ad_username = $this->input->post('ad_username');
			$item_name = $this->input->post('item_name');
			$item_id = $this->input->post('item_id');
			$f_year = $this->input->post('f_year');
			$n_request = $this->input->post('n_request');
			$place = $this->input->post('place');
			$data = array(
				'item_type' => 'ครุภัณฑ์',
				'item_name' => $item_name,
				'item_id' => $item_id,
				'f_year' => $f_year,
				'n_request' => $n_request,
				'place' => $place
			);
			$this->db->insert('item_db_product_id',$data);
			$this->ad_item_model->pdid_insert_log_add($item_name,$item_id,$ad_username);
			echo json_encode($data);
		}else{	
			$error_name = form_error('item_name');
			$error_id = form_error('item_id');
			$error_f_year = form_error('f_year');
			$error_n_request = form_error('n_request');
			$error_place = form_error('place');
			$error = array(
				'error_name' => $error_name,
				'error_id' => $error_id,
				'error_f_year' => $error_f_year,
				'error_n_request' => $error_n_request,
				'error_place' => $error_place
			);
			echo json_encode($error);
		}	
	}
	//---------------------------- Edit and Delete page ---------------------------
	public function item_product_id_editndel(){	
		$data['item_product_id'] = $this->ad_item_model->product_id_list();
		$this->load->view('admin/item/pd_id/ad_item_product_id_editndel',$data);
	}
	public function item_product_id_edit(){
		$this->form_validation->set_rules('item_name','item_name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
		array(
				'required'      => 'โปรดระบุ',
				'regex_match'      => 'โปรดระบุอักษรหรือตัวเลข',
				'is_unique'     => 'ชื่อวัสดุซ้ำ'
		));
		// $this->form_validation->set_rules('item_id','จำนวน','trim|required|regex_match[/^[ก-๏a-zA-Z0-9-\s]+$/]|is_unique[item_db_product_id.item_id]',
		$this->form_validation->set_rules('item_id','จำนวน','trim|required|regex_match[/^[ก-๏a-zA-Z0-9-\s]+$/]',
		array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุอักษรภาษาอังกฤษหรือตัวเลข',
			'is_unique'     => 'ชื่อครุภัณฑ์ซ้ำ'
		));
		$this->form_validation->set_rules('f_year','ปีงบประมาณ','trim|required|regex_match[/^[0-9-]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวเลขเท่านั้น',
		));
		$this->form_validation->set_rules('n_request','ผู้เบิก','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'required'      => 'โปรดระบุ',
                'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
		));
		$this->form_validation->set_rules('place','สถานที่ติดตั้ง','trim|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]',
        array(
                'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
		));
		if($this->form_validation->run()){
			//---- Input -----
			$id = $this->input->post('id');
			$item_name = $this->input->post('item_name');
			$item_id = $this->input->post('item_id');
			$f_year = $this->input->post('f_year');
			$n_request = $this->input->post('n_request');
			$place = $this->input->post('place');
			//---- Update DB -----
			$data = array(
				'item_name' => $item_name,
				'item_id' => $item_id,
				'f_year' => $f_year,
				'n_request' => $n_request,
				'place' => $place
			);
			$this->db->where('id',$id);
			$this->db->update('item_db_product_id',$data);
			//-------------------- Insert LOG ---------------------
			$default_name = $this->input->post('df_name');
			$default_item_id = $this->input->post('df_item_id');
			$new_item_name = $this->input->post('item_name');
			$new_item_id = $this->input->post('item_id');
			$ad_username = $this->input->post('ad_username');			
			$this->ad_item_model->pdid_insert_log_edit($default_name,$default_item_id,$new_item_name,$new_item_id,$ad_username);

			echo json_encode($data);
		}else{	
			$error_name = form_error('item_name');
			$error_id = form_error('item_id');
			$error_f_year = form_error('f_year');
			$error_n_request = form_error('n_request');
			$error_place = form_error('place');
			$error = array(
				'error_name' => $error_name,
				'error_id' => $error_id,
				'error_f_year' => $error_f_year,
				'error_n_request' => $error_n_request,
				'error_place' => $error_place
			);
			echo json_encode($error); 
		}		
	}
	public function item_product_id_del(){
		//----- Input -----
		$id = $this->input->post('id');
		$ad_username = $this->input->post('ad_username');
		$item_name = $this->input->post('item_name');
		$item_id = $this->input->post('item_id');
		//----- Delete -----
		$this->db->where('id',$id);
		$this->db->delete('item_db_product_id');
		//---- INSERT LOG (Del) ------      		  
		$this->ad_item_model->pdid_insert_log_del($ad_username,$item_name,$item_id);
		echo json_encode('');
	}	
	//----------------------------------------------------- item_product_LOG ---------------------------------------------------------------
	public function item_product_log(){	
		$data['product_log'] = $this->ad_item_model->item_product_log();
		$this->load->view('admin/item/pd/ad_item_product_log',$data);
	}	
	public function item_product_id_log(){	
		$data['product_id_log'] = $this->ad_item_model->item_product_id_log();
		$this->load->view('admin/item/pd_id/ad_item_product_id_log',$data);
	}			
	//---------------------------------------------------------- History ---------------------------------------------------------------
	public function history_pd(){
		$item_name = $this->input->get('item_name');
		$data['item_name'] = $item_name;
		$data['history_list'] = $this->ad_item_model->pd_history_list($item_name);
		$this->load->view('admin/item/pd/ad_item_product_history',$data);
	}
	public function history_pdid(){
		$item_id = $this->input->get('item_id');
		$data['item_id'] = $item_id;
		$data['history_list'] = $this->ad_item_model->pdid_history_list($item_id);
		$data['item_info'] = $this->db->select('*')->from('item_db_product_id')->where('item_id',$item_id)->get()->result_array();
		// print_r($data['item_info']);
		$this->load->view('admin/item/pd_id/ad_item_product_id_history',$data);
	}
	/*------------------------------------ Watching same page in the same time then someone ACCEPT ORDER -------------------------------------------*/
	public function watch_accept_status(){
		$id = $this->input->post('id');
		$status = $this->db->select('*')->from('request_item')->where('id',$id)->get()->result();
		echo json_encode($status);
	}
}	
?>
