<?php
Class ad_admanage extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));	   
		$this->load->library('form_validation');
		$this->load->model('Admin');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
		if($this->session->userdata('rank') != 'super_admin'){		
			redirect(base_url().'ad_main');
		} 
    }
	function index() {		
		$this->ad_list();
	}
	//--------------------------------------------------------------- Manage Admin ----------------------------------------------------------------
	function ad_list() {	
		// print_r($_SESSION);	
		$data['query'] = $this->Admin->showdata();
		$this->load->view('admin/manage_admin/ad_admin_list', $data);

		/*if ($this->session->userdata('username') != '') {
			$username = $this->session->userdata('username');
			$rank = 'super_admin';
			if($this->admin->permission($username, $rank)){
				$data['query'] = $this->admin->showdata();
				$this->load->view('ad_min', $data);
			}else{
				$this->load->view('ad_main');
			}
		} else {
			redirect(base_url() . 'ad_login');
		}*/		
	}

	function ad_add() {
		if ($this->session->userdata('username') != '') {	
			// $username = $this->session->userdata('username');
			$rank = $this->session->userdata('rank');
			if($rank = 'super_admin'){
				$this->load->view('admin/manage_admin/ad_admin_add');
			}else{
				$this->ad_list();
			}
		} else {
			redirect(base_url() . 'ad_login');
		}
	}	

	function validation(){
		$this->form_validation->set_rules('username','ชื่อผู้ใช้','trim|required|regex_match[/^[A-Za-z0-9]+$/]|is_unique[admin_login.username]',
        array(
                'required'      => 'โปรดระบุชื่อผู้ใช้',
                'regex_match'      => 'โปรดระบุอักษรภาษาอังกฤษหรือตัวเลข',
                'is_unique'     => 'ชื่อผู้ใช้ซ้ำ'
        ));
		$this->form_validation->set_rules('password', 'รหัส', 'required',
        array(
                'required'      => 'โปรดระบุรหัสผ่าน'
        ));
        $this->form_validation->set_rules('user_id','ไอดีพนักงาน','trim|required|regex_match[/^[0-9-]+$/]|is_unique[admin_login.user_id]',
        array(
                'required'      => 'โปรดระบุไอดีพนักงาน',
                'regex_match'      => 'โปรดระบุตัวเลข',
                'is_unique'     => 'ไอดีพนักงานซ้ำ'
        ));
		$this->form_validation->set_rules('email','อีเมล','trim|required|valid_email|is_unique[admin_login.email]',
        array(
                'required'      => 'โปรดระบุอีเมล',
                'valid_email'   => 'รูปแบบอีเมลผิด',
                'is_unique'     => 'อีเมลซ้ำ'
        ));
		
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'user_id' => $this->input->post('user_id'),
				'email' => $this->input->post('email')
				);
		
		if($this->form_validation->run()){
			$this->Admin->add_insert($data);
			$status = 1;
			echo json_encode($status);
		}else{
			$error_username = form_error('username');
			$error_password = form_error('password');
			$error_userid = form_error('user_id');
			$error_email = form_error('email');
			$error = array(
				'status' => 0,
				'error_username' => $error_username,
				'error_password' => $error_password,
				'error_userid' => $error_userid,
				'error_email' => $error_email,
			);
			echo json_encode($error);
		}
	}
	function edit(){				
		$id = $this->input->post('id');			 
		$data = $this->Admin->fetch_edit($id);		
		$this->load->view('admin/manage_admin/ad_admin_detail',$data);			
	}
	function update(){
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$rank = $this->input->post('rank');
		$this->Admin->update_data($id, $email, $rank);
		echo json_encode('');
	}
	function del(){
		$id = $this->input->post('id');
		$rem = $this->Admin->deldata($id);
		if($rem){
			echo "1";
		}else{
			echo "0";
		}
	}
	
}
?>