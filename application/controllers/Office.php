<?php
Class Office extends CI_Controller {
    function index(){
        redirect(base_url());
    }
    function identify(){
        if($this->session->userdata('username') == ''){
			redirect(base_url());
		}
    }

    // --------------------------------------------------------------- USER --------------------------------------------------------------------
    function about(){ // เกี่ยวกับสำนักงาน
        $data = $this->db->select('content')->from('office')->where('title_en','about')->get()->result_array();
        $data = array(
            'content' => $data[0]['content']
        );
        $this->load->view('user/news/structure',$data);
    }
    function organization(){ // โครงสร้างองค์กร
        $data = $this->db->select('content')->from('office')->where('title_en','organization')->get()->result_array();
        $data = array(
            'content' => $data[0]['content']
        );
        $this->load->view('user/news/structure',$data);
    }
    function actionplan(){ // นโยบาย
        $data = $this->db->select('content')->from('office')->where('title_en','actionplan')->get()->result_array();
        $data = array(
            'content' => $data[0]['content']
        );
        $this->load->view('user/news/structure',$data);
    }
    function personnel(){ // บุคลากร
        $data = $this->db->select('content')->from('office')->where('title_en','personnel')->get()->result_array();
        $data = array(
            'content' => $data[0]['content']
        );
        $this->load->view('user/news/structure',$data);
    }

    // --------------------------------------------------------------- ADMIN -------------------------------------------------------------------
    function edit(){
        $this->identify();
        $data['office'] = $this->db->select('*')->from('office')->get()->result();
        $this->load->view('/admin/Office/officeEdit',$data);
    }
    function content(){
        $id = $this->input->post('id');
        $data = $this->db->select('*')->from('office')->where('id',$id)->get()->result_array();
        $data = array(
            'id' => $data[0]['id'],
            'title_th' => $data[0]['title_th'],
            'title_en' => $data[0]['title_en'],
            'content' => $data[0]['content']
        );
        // print_r($data);
        $this->load->view('/admin/Office/contentEdit',$data);
    }
    function updateContent(){
        // print_r($_POST);
        $id = $this->input->post('id');
        $contentText = $this->input->post('txtEditor');
        $data = array(
            'content' => $contentText
        );
        $this->db->where('id',$id);
        $this->db->update('office',$data);
        $this->edit();
    }




























}