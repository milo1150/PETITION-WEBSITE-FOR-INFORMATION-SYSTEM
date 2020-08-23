<?php
Class Image extends CI_Controller {
    function index() {
        $this->load->view('admin/Image/Images');
    }
    /* ----------------------------------------------- Category ------------------------------------------------ */
    function folderList(){
        $query = $this->db->select('*')->from('image_category')->get()->result();
        echo json_encode($query);
    }

    /* ----------------------------------------------- Category ------------------------------------------------ */
    function cateCheck() {
		$cateName = $this->input->post('cateName');
        $this->load->library('form_validation');
		$this->form_validation->set_rules('cateName','category name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]|is_unique[image_category.category]',
        array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
			'is_unique'     => 'ชื่ออัลบั้มซ้ำ'
		));
		if($this->form_validation->run()){			
			$data = array(
				'category' => $cateName,
			);
			$this->db->insert('image_category',$data);
			mkdir('./image_db/'.$cateName);
			echo json_encode(true);
		}else{
			$error_name = form_error('cateName');
			$error = array(
				'error_name' => $error_name,
			);
			echo json_encode($error);
		}
	}
	// ------------------------------------- Fecth Image (on click folder) ----------------------------------------
	function fetchAlbum() {
		$post = json_decode(file_get_contents('php://input'),true);
		$query = $this->db->select('*')->from('image_database')->where('category',$post['folderName'])->get()->result_array();
		echo json_encode($query);
	}

	// ------------------------------------- Upload IMG File  -----------------------------------
	// ---------------------- Validate --------------------------
	function imgCheck(){
		$post = json_decode(file_get_contents('php://input'),true);
		$errorValue = 0;
		$errorMsg = [];
		// -------- If not select image -----------
		if(count($post['imgName']) == 0){
			$data = array(
				'status' => false,
				'text' => 'กรุณาเลือกรูปภาพ'
			);
			echo json_encode($data);
			return;
		}
		// -------- Image Duplicate in $post['folderName'] folder -------
		foreach($post['imgName'] as $img){
			if(file_exists('./image_db/'.$post['folderName'].'/'.$img)){
				$errorValue++;
				array_push($errorMsg,$img.' มีอยู่ในอัลบั้มนี้แล้ว');
			}
		}
		// ------ Return State -------
		if($errorValue != 0){
			$data = array(
				'status' => 'imgError',
				'error' => $errorMsg
			);			
			echo json_encode($data);
		}else{
			$data = array(
				'status' => true,
			);
			echo json_encode($data);
		}
	}

	// ---------------------- Upload File ----------------------------
	function imgUpload() {
		// print_r($_POST);
		// print_r($_FILES);
		$folderName = $this->input->post('folderName');
		/* ----------- Config ---------- */
        $config['upload_path']          = './image_db/'.$folderName.'/';
        $config['allowed_types']        = 'png|jpg|jpeg|gif';
		$this->load->library('upload', $config);
		$count = count($_FILES);
		for($i=0;$i<$count;$i++){
			$this->upload->do_upload('img'.$i);
			$img = 'img'.$i;
			$imgName = $_FILES[$img]['name'];
			$data = array(
				'name' => $imgName,
				'category' => $folderName
			);
			$this->db->insert('image_database',$data);
		}
		echo json_encode('');
	}
}
