<?php
class request_finger extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->view("user/request/request_finger");
    }
    public function error(){      
        // CHECK        
        $this->form_validation->set_rules('firstname','ชื่อ','trim|required');
        $this->form_validation->set_rules('lastname','นามสกุล','trim|required');       
        $this->form_validation->set_rules('phonenum','เบอร์ติดต่อส่วนตัว','trim|regex_match[/^[0-9-]+$/]');
        $this->form_validation->set_rules('phonein','เบอร์ติดต่อภายใน','trim|regex_match[/^[0-9-]+$/]');
        $this->form_validation->set_rules('userid','หมายเลขบัตรประชาชน','trim|required|regex_match[/^[0-9-]+$/]');        
        $this->form_validation->set_rules('email','อีเมล','trim|required|valid_email');
        $this->form_validation->set_rules('section','สังกัด/แผนก','required');              
        $this->form_validation->set_rules('rank','ตำแหน่ง','required');

        if($this->form_validation->run() == TRUE){                        
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),               
                'phonenum' => $this->input->post('phonenum'),
                'phonein' => $this->input->post('phonein'),
                'email' => $this->input->post('email'),
                'section' => $this->input->post('section'),                
                'rank' => $this->input->post('rank'),
                'userid' => $this->input->post('userid')
            );
            //print_r($data);
            echo json_encode($data);
        }else{
            $error = array(
                'firstname_error' => form_error('firstname'),
                'lastname_error' => form_error('lastname'),                
                'phonenum_error' => form_error('phonenum'),
                'phonein_error' => form_error('phonein'),
                'email_error' => form_error('email'),
                'section_error' => form_error('section'),
                'rank_error' => form_error('rank'),       
                'userid_error' => form_error('userid')        
            );
            //print_r($error);            
			echo json_encode($error);
        }
    }
    public function accept_data(){
        $md5id = md5(time()*rand(0,987)+rand(0,654)-rand(0,321));
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'phonenum'=>$this->input->post('phonenum'),
            'phonein'=>$this->input->post('phonein'),
            'email'=>$this->input->post('email'),
            'section'=>$this->input->post('section'),
            'rank'=>$this->input->post('rank'),
            'userid' => $this->input->post('userid'),
            'type'=>'สแกนนิ้ว',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid' => $md5id,
        );          
        $this->db->insert("request_finger", $data); 

        $data_noti = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'type' => 'สแกนนิ้ว',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid' => $md5id,
        );
        $this->load->model('notification_data');
        $this->notification_data->insert($data_noti);

        echo json_encode('');
    } 
    /* --------------------------------------------------- Line Notification ------------------------------------------------- */
    public function line_noti(){
        $this->load->model('line_noti_model');
        $msg = $this->input->post('msg');
        $this->line_noti_model->line_noti($msg);
        echo json_encode('');
    } 
}

