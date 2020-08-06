<?php
include 'Captcha.php';
class request_item extends CI_Controller
{
    public function __construct()
    {
       parent::__construct();
       date_default_timezone_set("Asia/Bangkok");
       $this->load->helper(array('form', 'url'));
       $this->load->library('form_validation');
    }
    public function index(){
        $this->load->view("user/request/request_item");
    }
    /* ------------------------------------------------ Check Edit Html (item select only) ------------------------------------------------ */
    public function item_v(){
        $sum = 0; // return key        
        $d = json_decode(file_get_contents('php://input'),true); // input axios post
        // ----- prepare item type for compare ------
        $item_type = Array();
        array_push($item_type,'0');
        array_push($item_type,'product');
        array_push($item_type,'product_id');
        // print_r($item_type);
        // ----- prepare pd_item name for compare ------
        $pd_name = Array();
        array_push($pd_name,'0');
        $item_pd_name = $this->db->select('item_name')->from('item_db_product')->get()->result();
        foreach($item_pd_name as $row){
            array_push($pd_name,$row->item_name);
        }
        // print_r($pd_name);
        // ----- prepare pdid_item name for compare ------
        $pdid_name = Array();
        array_push($pdid_name,'0');
        $item_pdid_name = $this->db->select('item_name')->from('item_db_product_id')->distinct()->get()->result(); //distinct เอาตัวซ้ำมาตัวเดียว
        foreach($item_pdid_name as $row){
            array_push($pdid_name,$row->item_name);
        }
        // print_r($pdid_name);
        // --------------------------------- Check -------------------------------       
        for($i=0;$i<count($d);$i++){
            // ---- check item_type ----
            if(in_array($d[$i][0],$item_type) == null){
                $sum++;
                // echo 'err0';
            }
            // ---- check item_unit ----
            switch($d[$i][0]){
                case '0':
                    $sum = 0;
                    break;
                case 'product':
                    if(in_array($d[$i][1],$pd_name) == null){
                        $sum++;     
                        // echo 'err1';                 
                    }
                    break;
                case 'product_id':
                    if(in_array($d[$i][1],$pdid_name) == null){
                        $sum++;
                        // echo 'err2';
                    }
                    break;
                default: // if item_type was edit 2 case upper will not working . this why 
                    $sum++;
                    // echo 'err3';
            }
            if($d[$i][1] == null){ $sum = 0; } // alert เลือกรายการซ้ำแล้วยังกด ยืนยัน
        }
        // echo 'sum = '.$sum;
        // print_r($d);
        echo json_encode($sum);
    }
    public function check_error(){      
        //------------ CHECK -----------        
        $this->form_validation->set_rules('firstname','ชื่อ','trim|required|alpha_thai');
        $this->form_validation->set_rules('lastname','นามสกุล','trim|required|alpha_thai');
        $this->form_validation->set_rules('phonenum','เบอร์ติดต่อ','trim|required|regex_match[/^[0-9-]+$/]|alpha_thai');
        $this->form_validation->set_rules('email','อีเมล','trim|required|valid_email|alpha_thai');
        $this->form_validation->set_rules('section','สังกัด/แผนก','required|alpha_thai');              
        $this->form_validation->set_rules('date','วันที่','trim|required|alpha_thai');
        $this->form_validation->set_rules('time','เวลา','trim|required|alpha_thai');      

        if($this->form_validation->run() == TRUE){                        
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'phonenum' => $this->input->post('phonenum'),
                'email' => $this->input->post('email'),
                'section' => $this->input->post('section'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
            );
            //print_r($data);
            echo json_encode($data);
        }else{
            $error = array(
                'firstname_error' => form_error('firstname'),
                'lastname_error' => form_error('lastname'),
                'phonenum_error' => form_error('phonenum'),
                'email_error' => form_error('email'),
                'section_error' => form_error('section'),
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
                $this->send_email_data();
                set_time_limit(4);
                $this->accept_data();                         
                $this->line_noti();
            }else{
                // echo 'U R BOT';
                redirect(base_url());
            }
        }       
    }
    /* ------------------------------------------------------------- Email ----------------------------------------------------------*/    
    private function send_email_data(){         
		$firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phonenum = $this->input->post('phonenum');
        $email = $this->input->post('email');
        $section = $this->input->post('section');
        $date = date('d-m-Y',strtotime($this->input->post('date')));
        $time = $this->input->post('time');
        $date_request = date('d-m-Y');
        $time_request = date('H:i');


        //--------------------------- convert array data to string text ---------------------
        $req_data = $this->input->post('req_data');
        $count = count($req_data);
        for($i=0;$i<=$count-1;$i=$i+2){
            if($req_data[$i][0]=='product'){ $type = 'วัสดุ'; }
            if($req_data[$i][0]=='product_id'){ $type = 'ครุภัณฑ์'; }
            $y[$i] = $type.' : '.$req_data[$i][1].' (จำนวน '.$req_data[$i][2].')<br>';
        }
        $req_data_string = implode($y); // แปลง array เป็น string (ข้อความ)      

		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'codeig.adm1n@gmail.com',
		    'smtp_pass' => 'Adminza1150',
		    // 'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
        );
        
		$this->load->library('email', $config);
        $this->email->set_newline("\r\n");	
        $this->email->set_mailtype("html");			     
		$this->email->from('codeig.adm1n@gmail.com','ICIT System');
		$this->email->to($email);
		$this->email->subject('ระบบสารสนเทศ - ยืมของ');		
        $message = 
            'ข้อมูลแบบฟอร์มยืมของที่คุณ'.$firstname.' ได้แจ้งไว้ ณ วันที่ '.$date_request.' เวลา '.$time_request.'<br>'.
            'ชื่อ-นามสกุล : '.$firstname.' '.$lastname.'<br>'.
            'เบอร์ติดต่อ : '.$phonenum.'<br>'.
            'อีเมลติดต่อ : '.$email.'<br>'.
            'สังกัด/แผนก : '.$section.'<br>'.
            'รายการขอยืม<br>'.
            $req_data_string.
            'กำหนดเวลาคืน : วันที่ '.$date.' เวลา '.$time.'<br>'           
        ;		
        $this->email->message($message);
        $this->email->send();
    }
    /* ------------------------------------------------------------- Insert Data ----------------------------------------------------------*/        
    private function accept_data(){        
        $md5id = md5(time()*rand(0,987)+rand(0,654)-rand(0,321));
        $req_data = $this->input->post('req_data');
        $total_row = count($req_data);

        //-------------- insert into item_list database --------------- 
        //i+2 becuz space between data row and error row
        for($i=0;$i<$total_row;$i=$i+2){
            $item_type = "";
            if($req_data[$i][0]=="product"){
                $item_type = "วัสดุ";
            }
            if($req_data[$i][0]=="product_id"){
                $item_type = "ครุภัณฑ์";
            }
            $data = array(
                'reqid' => $md5id,
                'item_type' => $item_type,
                'item_name' => $req_data[$i][1],
                'item_unit' => $req_data[$i][2],
            );              
            $this->db->insert('request_item_list',$data);
            //print_r($data);           
        }
             
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'phonenum'=>$this->input->post('phonenum'),
            'email'=>$this->input->post('email'),
            'section'=>$this->input->post('section'),
            'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
            'time'=>$this->input->post('time'),
            'type'=>'ยืมของ',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid'=>$md5id,
        );
        $this->db->insert('request_item',$data);

        
        $data_noti = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'type' => 'ยืมของ',
            'date_request'=>date('Y-m-d'),
            'time_request'=>date('H:i'),
            'reqid' => $md5id,
        );
        $this->load->model('notification_data');
        $this->notification_data->insert($data_noti);          
    }
    /* --------------------------------------------------- Line Notification ------------------------------------------------- */
    private function line_noti(){
        $this->load->model('line_noti_model');
        $msg = $this->input->post('msg');
        $this->line_noti_model->line_noti($msg);
        echo json_encode('OK');
    }

    //------------------------------------------------ Item Select ---------------------------------------------
    public function product_item(){  
        //-----------------ONCHANGE select<item_type>------------------             
        if($this->input->post('type')=='product' && $this->input->post('name')==null){   
            $data_product = $this->db->select('*')->from('item_db_product')->order_by('id','ASC')->get()->result();                         
            echo json_encode($data_product); 
        }
        if($this->input->post('type')=='product_id' && $this->input->post('name')==null){       
            $data_product_id = $this->db->select('item_name')->from('item_db_product_id')->order_by('id','ASC')->distinct()->get()->result();  
            /*foreach($data_product_id as $col){
                $name = $col->item_name;
                echo $name.'<br/>';
            };*/
            //print_r($data_product_id);              
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
            $data_unit = count($this->db->select('item_name')->from('item_db_product_id')->where('item_name',$name)->where('item_status',0)->get()->result()); 
            //echo $data_unit;
            //print_r($data_unit);
            echo json_encode($data_unit);
        }            
    }
}