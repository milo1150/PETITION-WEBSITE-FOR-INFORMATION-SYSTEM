<?php
Class Admin_upload extends CI_Controller {
	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
    function index(){		
		$this->file();
	}
	/* --------------------------------------------------- File Upload  ---------------------------------------------- */
	// -------- Manage File ---------
	function file(){
		$data['file_data'] = $this->db->select('*')->from('pdf_file')->get()->result();
		$data['group_data'] = $this->db->select('*')->from('pdf_category')->get()->result();
		$this->load->view('admin/manage_files/ad_filesUp_file',$data);
	}
	// ----------- Check PDF Name -----------
	function check_pdf(){
		$x = array();
		for($i=0;$i<count($_POST['pdf_name']);$i++){
			if(file_exists('./files_download/'.$_POST['pdf_name'][$i])){
				$x[$i][0] = '1';
				$x[$i][1] = $_POST['pdf_name'][$i];
			}else{
				$x[$i][0] = '0';
				$x[$i][1] = $_POST['pdf_name'][$i];
			}
		}
		echo json_encode($x);
	}



	// ----------- Upload PDF File  -----------
	function pdf(){		
		/* ----------- Config ---------- */
        $config['upload_path']          = './files_download/';
        $config['allowed_types']        = 'pdf';
		$this->load->library('upload', $config);
		//---- upload file ----
		$f_count = count($_FILES);
		for($i=0;$i<$f_count;$i++){
			$this->upload->do_upload('pdf'.$i);
		}
		echo json_encode('');
	}
	// ------------- Update File Data to DB ---------------
	function file_name_cate(){
		// print_r($_POST);echo '<br>';
		$d_cate = $this->input->post('cate_data');
		$d_name = $this->input->post('files_n_data');
		$f_count = count($d_name);
		for($i=0;$i<$f_count;$i++){
			$s_cate = implode(',',$d_cate); // Array to String
			$data = array(
				'file_name' => $d_name[$i],
				'category' => $s_cate,
				'date'=>date('Y-m-d'),
            	'time'=>date('H:i'),
 			);
			$this->db->insert('pdf_file',$data);
		}
		echo json_encode('');

	}

	// ---------------------------- Edit File ---------------------------
	// ---- On click Edit btn -> get Grp Data ----
	function get_grp(){
		$data_grp = $this->db->select('category')->from('pdf_category')->get()->result();
		echo json_encode($data_grp);
	}
	// ----- Onclick Confirm Button -----
	function u_file_info(){
		// Set Values
		$id = $this->input->post('id');
		$old_name = $this->db->select('file_name')->from('pdf_file')->where('id',$id)->get()->result_array()[0]['file_name'];
		$new_name = $this->input->post('f_name');
		$grp_val = $this->input->post('cate_v');
		$new_cate =  implode(",",$grp_val);
		
		// Update DB & Rename File
		rename("./files_download/".$old_name,"./files_download/".$new_name);
		$data = array(
			'file_name' => $new_name,
			'category' => $new_cate
		);
		$this->db->where('id',$id);
		$this->db->update('pdf_file',$data);
		echo json_encode('');
	}

	// ---------------------------- Delete File -------------------------
	function del_file(){
		// $this->load->helper('file');
		$id = $this->input->post('id');
		$f_name = $this->input->post('f_name');
		
		unlink('./files_download/'.$f_name);
		$this->db->where('id',$id);
		$this->db->delete('pdf_file');
		echo json_encode('');
	}

	/* --------------------------------------------------------- Category ------------------------------------------------------------ */
	// -------- Manage Category --------
	function category(){
		$data['grp_data'] = $this->db->select('*')->from('pdf_category')->get()->result();
		$this->load->view('admin/manage_files/ad_filesUp_group',$data);
	}
	// ----------- Add new Cate & Validate Category Name ----------
	function val_grp_name(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('grp_name','category name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]|is_unique[pdf_category.category]',
        array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
			'is_unique'     => 'ชื่อหมวดหมู่ซ้ำ'
		));
		if($this->form_validation->run()){
			$grp_name = $this->input->post('grp_name');
			$data = array(
				'category' => $grp_name,
			);
			$this->db->insert('pdf_category',$data);
			echo json_encode('0');
		}else{
			$error_name = form_error('grp_name');
			$error = array(
				'error_name' => $error_name,
			);
			echo json_encode($error);
		}
	}
	// --------------- Rename Category & Validate Category Name -------------
	function rename_grp(){
		$this->load->library('form_validation');
		// echo $this->input->post('grp_name');
		$this->form_validation->set_rules('n_grp_name','category name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9-\s]+$/]|is_unique[pdf_category.category]',
        array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
			'is_unique'     => 'ชื่อหมวดหมู่ซ้ำ'
		));
		if($this->form_validation->run()){
			$id = $this->input->post('id');
			$n_grp_name = $this->input->post('n_grp_name');
			$o_grp_name = $this->input->post('o_grp_name');
			// ------------------------------------- Rename Category Every File in DB ---------------------------------
			$o_data = $this->db->select('*')->from('pdf_file')->where("category LIKE '%$o_grp_name%'")->get()->result(); // select specifiy data
			foreach($o_data as $row){ // loop each file
				$x = explode(",",$row->category); // string to array
				$y = array_search($o_grp_name,$x); // find array => return index
				unset($x[$y]); // delete array[$y]
				array_push($x,$n_grp_name); // push new cate name
				$z = implode(',',$x); // array to string
				$data = array(
					'category' => $z
				);
				$this->db->where('id',$row->id);
				$this->db->update('pdf_file',$data);				
			}
			// ----------------------------------------- Update Category Name --------------------------------
			$data = array(
				'category' => $n_grp_name
			);	
			$this->db->where('id',$id);
			$this->db->update('pdf_category',$data);
			echo json_encode('0');
		}else{
			$error_name = form_error('n_grp_name');
			$error = array(
				'error_name' => $error_name,
			);
			echo json_encode($error);
		}
	}
	// --------------- Remove Category -------------
	function del_grp(){
		print_r($_POST);
		$id = $this->input->post('id');
		$grp_name = $this->input->post('grp_name');

		// ------------------------------------- Remove Category Every File in DB ---------------------------------
		$e_data = $this->db->select('*')->from('pdf_file')->where("category LIKE '%$grp_name%'")->get()->result(); // select specifiy data
		foreach($e_data as $row){ // loop each file
				$x = explode(',',$row->category);
				$index = array_search($grp_name,$x);
				unset($x[$index]);
				$z = implode(',',$x);
				$data = array(
					'category' => $z
				);
				$this->db->where('id',$row->id);
				$this->db->update('pdf_file',$data);
				// echo json_encode('');
				// print_r($z);		
		}
		$this->db->where('id',$id)->delete('pdf_category');
		echo json_encode('');
	}
	/* ------------------------------------------------------- Filter Category ---------------------------------------------- */
	function fil_grp(){
		$grp = $this->input->get('grp');
		if($grp == '0'){
			redirect(base_url().'Admin_upload');
		}
		$data['file_data'] = $this->db->select('*')->from('pdf_file')->where(" category LIKE '%$grp%' ")->get()->result();
		$data['group_data'] = $this->db->select('*')->from('pdf_category')->get()->result();
		$data['fil_default'] = $grp;
		$this->load->view('admin/manage_files/ad_filesUp_file',$data);
		// print_r($_GET);
	}
	
	


}
?>