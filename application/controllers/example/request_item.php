<?php
class request_item extends CI_Controller
{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper(array('form', 'url'));
       $this->load->library('form_validation');
       $this->load->model('request_model');
    }
    public function index(){
        $this->load->view("request_item");
    }
    public function error(){        

        // CHECK        
        $this->form_validation->set_rules('firstname','ชื่อ','trim|required|alpha_thai');
        $this->form_validation->set_rules('lastname','นามสกุล','trim|required|alpha_thai');
        $this->form_validation->set_rules('phonenum','เบอร์ติดต่อ','trim|required|regex_match[/^[0-9-]+$/]|alpha_thai');
        $this->form_validation->set_rules('email','อีเมล','trim|required|valid_email|alpha_thai');
        $this->form_validation->set_rules('section','สังกัด/แผนก','required|alpha_thai');              
        $this->form_validation->set_rules('item_list','รายการอุปกรณ์','required|alpha_thai');
        $this->form_validation->set_rules('date','วันที่','trim|required|alpha_thai');
        $this->form_validation->set_rules('time','เวลา','trim|required|alpha_thai');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if($this->input->post('firstname')){
            $firstname = $this->input->post('firstname');
        }else{
            $firstname = "";
        }
            
        if($this->input->post('lastname')){
            $lastname = $this->input->post('lastname');
        }else{
            $lastname = "";
        }

        if($this->input->post('phonenum')){
            $phonenum = $this->input->post('phonenum');
        }else{
            $phonenum = "";
        } 

        if($this->input->post('email')){
            $email = $this->input->post('email');
        }else{
            $email = "";
        } 

        if($this->input->post('section')){
            $section = $this->input->post('section');
        }else{
            $section = "";
        } 

        if($this->input->post('item_list')){
            $item_list = $this->input->post('item_list');
        }else{
            $item_list = "";
        } 

        if($this->input->post('date')){
            $date = $this->input->post('date');
        }else{
            $date = "";
        } 

        if($this->input->post('time')){
            $time = $this->input->post('time');
        }else{
            $time = "";
        } 

        $this->session->getItem_data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'item_list' => $item_list,
            'date' => $date,
            'time' => $time
        );        

        if($this->form_validation->run() == TRUE){                        
            $this->load->view('request_item_success');
        }else{
            $this->load->view('request_item');
        }
    }
    public function accept_data(){
        $md5id = md5(time()*rand(0,987)+rand(0,654)-rand(0,321));
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'phonenum'=>$this->input->post('phonenum'),
            'email'=>$this->input->post('email'),
            'section'=>$this->input->post('section'),
            'item_list'=>$this->input->post('item_list'),
            'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
            'time'=>$this->input->post('time'),
            'type'=>'เบิกของ',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid'=>$md5id,
        );
        $this->load->model("request_model");              
        $this->request_model->item_insertdata($data);

        $data_noti = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'type' => 'เบิกของ',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid' => $md5id,
        );
        $this->load->model('notification_data');
        $this->notification_data->insert($data_noti);

        $this->load->view('success',$data);
    }
    //------------------------------------------------ Item Select ---------------------------------------------
    public function product_item(){  
        //-----------------ONCHANGE select<item_type>------------------             
        if($this->input->post('type')=='product' && $this->input->post('name')==null){   
            $data_product = $this->db->select('*')->from('item_db_product')->order_by('id','ASC')->get()->result();                         
            echo json_encode($data_product); 
        }
        if($this->input->post('type')=='product_id' && $this->input->post('name')==null){       
            $data_product_id = $this->db->select('*')->from('item_db_product_id')->order_by('id','ASC')->get()->result();                 
            echo json_encode($data_product_id);
        }

        //-----------------ONCHANGE select<item_name>------------------ 
        if($this->input->post('type')=='product' && $this->input->post('name')!=null){
            $name = $this->input->post('name'); 
            if($name == "0"){
                echo json_encode('');
            } 
            //echo $name;
            $data_unit = $this->db->select('item_unit_remain')->from('item_db_product')->where('item_name',$name)->get()->result();  
            echo json_encode($data_unit);
        }   

        if($this->input->post('type')=='product_id' && $this->input->post('name')!=null){
            $name = $this->input->post('name'); 
            if($name == "0"){
                echo json_encode('');
            } 
            //echo $name;
            $data_unit = $this->db->select('item_unit_remain')->from('item_db_product')->where('item_name',$name)->get()->result();  
            echo json_encode($data_unit);
        }            
    }
}