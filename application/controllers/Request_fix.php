<?php
include 'Captcha.php';
class request_fix extends CI_Controller
{
    public function __construct()
    {
       parent::__construct();
       date_default_timezone_set("Asia/Bangkok"); 
       $this->load->helper(array('form', 'url'));
       $this->load->library('form_validation');  
       
    }
    private function get_db_val(){
        $data['fixlist'] = $this->db->select('*')->from('request_fix_fixlist')->get()->result();
        $data['building'] = $this->db->select('*')->from('request_fix_building')->get()->result();
        $data['floor'] = $this->db->select('*')->from('request_fix_floor')->get()->result();
        return $data;
    }
    public function index(){
        $data = $this->get_db_val();
        $this->load->view("user/request/request_fix",$data);
    }
    
    public function check_error(){        
        // print_r($_POST);
        // CHECK        
        $this->form_validation->set_rules('firstname','ชื่อ','trim|required');
        $this->form_validation->set_rules('lastname','นามสกุล','trim|required');
        $this->form_validation->set_rules('phonenum','เบอร์ติดต่อ','trim|required|regex_match[/^[0-9-]+$/]');
        $this->form_validation->set_rules('email','อีเมล','trim|required|valid_email');
        $this->form_validation->set_rules('fixlist','รายการแจ้ง','trim|in_list[แจ้งปัญหาระบบอินเทอร์เน็ต,แจ้งปัญหาเว็บไซต์,แจ้งปัญหาระบบเครือข่าย,แจ้งปัญหาปริ้นเตอร์,แจ้งอุปกรณ์ชำรุด,แจ้งปัญหาคอมพิวเตอร์]');
        $this->form_validation->set_rules('building','ตึก','trim|required|in_list[42,62,63,64,65,66,67,68,69,90,91,97]');
        $this->form_validation->set_rules('floor','ชั้น','trim|required|in_list[1,2,3,4,5,6,7,8,9,10]');
        $this->form_validation->set_rules('room','ห้อง','trim|required|regex_match[/^[0-9-]+$/]|max_length[4]');        
        $this->form_validation->set_rules('fixprob','อาการ','trim|required');
        $this->form_validation->set_rules('date','วันที่','trim|required');
        $this->form_validation->set_rules('time','เวลา','trim|required');

        if($this->form_validation->run() == TRUE){                        
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'phonenum' => $this->input->post('phonenum'),
                'email' => $this->input->post('email'),
                'fixlist' => $this->input->post('fixlist'),
                'building' => $this->input->post('building'),
                'floor' => $this->input->post('floor'),
                'room' => $this->input->post('room'),                
                'fixprob' => $this->input->post('fixprob'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
            );
            echo json_encode($data);
        }else{
            $error = array(
                'firstname_error' => form_error('firstname'),
                'lastname_error' => form_error('lastname'),
                'phonenum_error' => form_error('phonenum'),
                'email_error' => form_error('email'),
                'fixlist_error' => form_error('fixlist'),
                'building_error' => form_error('building'),
                'floor_error' => form_error('floor'),
                // 'fixlist_error' => "<p>โปรดระบุ</p>",
                // 'building_error' => "<p>โปรดระบุ</p>",
                // 'floor_error' => "<p>โปรดระบุ</p>",
                'room_error' => form_error('room'),
                'fixprob_error' => form_error('fixprob'),
                'date_error' => form_error('date'),
                'time_error' => form_error('time'),
               
            );
            //print_r($error);            
			echo json_encode($error);
        }
    }
    //---------------------------------------------------------- Captcha & Insert Data to DB -------------------------------------------------
    public function check(){
        if(isset($_POST)){
            $SecretKey = $this->input->post('k');
            function cap($SecretKey){
                $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
                $Return = json_decode($Response);
                return $Return;
            }
            $Return = cap($SecretKey);
            if($Return->success == 1 && $Return->score >= 0.5){
                // $this->accept_data();
                $this->send_email_data();
                // $this->line_noti();
            }else{
                // echo 'U R BOT';
                redirect(base_url());
            }
        }       
    }
    /* ------------------------------------------------------------- Email ----------------------------------------------------------*/
	private function send_email_data(){         
        // print_r($_POST);
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phonenum = $this->input->post('phonenum');
        $fixlist = $this->input->post('fixlist');
        $building = $this->input->post('building');
        $floor = $this->input->post('floor');
        $room = $this->input->post('room');         
        $fixprob = $this->input->post('fixprob');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $email = $this->input->post('email');
        $date_request = date('d-m-Y');
        $time_request = date('H:i');
		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'codeig.adm1n@gmail.com',
		    'smtp_pass' => 'Adminza1150',
		    // 'mailType'  => 'html',
            'charset'   => 'UTF-8',
        );        
        $this->load->library('email', $config);        
        $this->email->set_newline("\r\n");	
        $this->email->set_mailtype("html");	     
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - แจ้งซ่อม');		
        $message = 
            'ข้อมูลแบบฟอร์มแจ้งซ่อมที่คุณ'.$firstname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.'<br>'.
            'ชื่อ-นามสกุล : '.$firstname.' '.$lastname.'<br>'.
            'เบอร์ติดต่อ : '.$phonenum.'<br>'.
            'อีเมลติดต่อ : '.$email.'<br>'.
            'รายการที่แจ้ง : '.$fixlist.'<br>'.
            'สถานที่ : อาคาร '.$building.' ชั้น '.$floor.' ห้อง '.$room.'<br>'.
            'ปัญหาที่แจ้ง : '.$fixprob.'<br>'.
            'กำหนดเวลาซ่อม : วันที่ '.$date.' เวลา '.$time.'<br>'           
        ;		
		$this->email->message($message);
        $this->email->send();
        $this->accept_data();
    }
    /* ------------------------------------------------------------- Insert Data ----------------------------------------------------------*/    
    private function accept_data(){
        // print_r($_POST); 
        date_default_timezone_set("Asia/Bangkok");
        $md5id = md5(time()*rand(0,987)+rand(0,654)-rand(0,321));      
        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'phonenum'=>$this->input->post('phonenum'),
            'email'=>$this->input->post('email'),
            'fixlist'=>$this->input->post('fixlist'),
            'building'=>$this->input->post('building'),
            'floor'=>$this->input->post('floor'),
            'room'=>$this->input->post('room'),            
            'fixprob'=>$this->input->post('fixprob'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'type'=>'แจ้งซ่อม',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid'=>$md5id,
        );      
        $this->db->insert("request_fix",$data);
       
        $data_noti = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'type' => 'แจ้งซ่อม',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid' => $md5id,
        );
        $this->load->model('notification_data');
        $this->notification_data->insert($data_noti);
        
        $this->line_noti();
        // echo json_encode('');        
    }
    
    /* --------------------------------------------------- Line Notification ------------------------------------------------- */
    private function line_noti(){
        $msg = $this->input->post('msg');
        $this->load->model('line_noti_model');
        $this->line_noti_model->line_noti($msg);
        echo json_encode('OK');
    }
}