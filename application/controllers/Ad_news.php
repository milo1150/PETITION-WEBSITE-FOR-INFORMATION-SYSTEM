<?php
Class ad_news extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(['form', 'url']);
		$this->load->model('news_model');
		date_default_timezone_set("Asia/Bangkok");
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
    function index(){			
		$this->ad_news_all();
	}
	function ad_news_add(){
		$data['ntype'] = $this->news_model->select_subject();
		$this->load->view('admin/manage_news/ad_news_add',$data);
	}
	function ad_news_all(){		
		$data['ndata'] = $this->news_model->fetch_ndata();
		//print_r($data);
		$this->load->view('admin/manage_news/ad_news_all',$data);
	}

	//------------------------- Add news ------------------------
	public function do_upload(){ // if had print_r . function can't return json 

		//------- Config image -------
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
		//$config['max_size']             = 1000;
        $config['max_width']            = 1024;
		$config['max_height']           = 1024;
		$config['file_name']			= time();

		$this->load->library('upload', $config);
		$img_file_name = $_FILES['n_image']['name'];
		$img_file_name = substr($img_file_name,-4); //get .jpg or .png file
		//print_r($img_file_name);

		//------- Data ------
		$data = array(
			'type' => $this->input->post('ntype'),
			'title' => $this->input->post('title'),
			'content' => $this->input->post('txtEditor'),
			'img_name' => $config['file_name'].$img_file_name,
			'post_date' => date("Y-m-d"),
			'post_time' => date("H:i"),
		);

		//------ Upload Image ------
		if($this->upload->do_upload('n_image') == TRUE){
			$this->db->insert('news',$data);
			echo json_encode('');
		}
	}

	//--------------------- change news status ----------------------
	public function news_status(){
		//print_r($_POST);
		$id = $this->input->post('id');
		$new_status = $this->input->post('u_status');
		$this->db->set('status',$new_status)->where('id',$id)->update('news');
	}
	//---------------------- edit news -----------------------
	public function news_edit(){
		//print_r($_POST);
		$id = $this->input->post('id');
		$data = $this->db->select('*')->from('news')->where('id',$id)->get()->result_array();
		//print_r($data);
		$data = array(
			'id' => $data[0]['id'],	
			'type' => $data[0]['type'],
			'title' => $data[0]['title'],
			'img_name' => $data[0]['img_name'],
			'content' => $data[0]['content'],
		);
		//print_r($data);
		//echo $data[0]['id'];
		$this->load->view('admin/manage_news/ad_news_edit',$data);
	}
	public function news_edit_conf(){
		$data = array(
			'type' => $this->input->post('ntype'),
			'title' => $this->input->post('title'),
			'content' => $this->input->post('txtEditor'),
		);
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$this->db->update('news',$data);
		echo json_encode('');
	}

	//---------------------- Del News ----------------------
	public function news_del(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('news');
		echo json_encode('');
	}

}
?>