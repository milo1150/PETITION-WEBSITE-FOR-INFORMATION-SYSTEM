<?php
Class Banner extends CI_Controller {
    public function __construct() {
		parent::__construct();
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
	}
    function index(){
        $this->edit();
    }
    function edit(){
        $data['carousel'] = $this->db->select('*')->from('carousel')->get()->result();
        $this->load->view('/admin/Carousel/carousel-edit',$data);
    }
    function updateUrl(){
        $id = $this->input->post('id');
        $url = $this->input->post('url');
        $data = array(
            'img_name' => $url,
        );
        $this->db->where('id',$id);
        $this->db->update('carousel',$data);
        echo json_encode(true);
    }











}