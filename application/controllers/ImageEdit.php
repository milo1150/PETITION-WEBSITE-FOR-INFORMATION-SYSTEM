<?php
Class ImageEdit extends CI_Controller {
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
        $this->load->library('form_validation');
		$this->form_validation->set_rules('cateName','category name','trim|required|regex_match[/^[ก-๏a-zA-Z0-9เ\s]+$/]|is_unique[image_category.category]',
        array(
			'required'      => 'โปรดระบุ',
			'regex_match'      => 'โปรดระบุตัวอักษรหรือตัวเลขเท่านั้น',
			'is_unique'     => 'ชื่ออัลบั้มซ้ำ'
		));
		if($this->form_validation->run()){
			$cateName = $this->input->post('cateName');
			$data = array(
				'category' => $cateName,
			);
			$this->db->insert('image_category',$data);
			echo json_encode(true);
		}else{
			$error_name = form_error('cateName');
			$error = array(
				'error_name' => $error_name,
			);
			echo json_encode($error);
		}
    }
}
?>