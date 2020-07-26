<?php
class rating extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('rating_model');
    }
	function index() {
		$this->load->view('rating');
	}
	function rated() {
		$data = array(
            'rating'=>$this->input->post('rating'),
			'comment'=>$this->input->post('comment'),
			'reqid'=>$this->input->post('reqid'),
		);
		$this->rating_model->rating_insertdata($data); 
		echo json_encode('');
	}
}