<?php
Class notification extends CI_Controller{
    public function __construct() {
        parent::__construct();

        		
	}	
    public function noti_val(){
        $ad_username = $this->input->post('ad_username');
        //NUMBER FOR BELL
        $count = count($this->db->select('*')->from('noti_list')->where('username',$ad_username)->where('noti_status','0')->get()->result());
        $select_id = $this->db->select('id')->from('noti_list')->where('username',$ad_username)->where('noti_status','0')->get()->result();
        //DATA FOR NOTI
        $noti_data = $this->db->select('*')->from('noti_list')->where('username',$ad_username)->where('read_status','0')->order_by('id','DESC')->limit('100')->get()->result();  
        $output = '';
    
        if($noti_data != null){
            foreach($noti_data as $col){
                $output .='
                        <!--<li class="noti-banner">แจ้งเตือน</li>-->
                        <div class="container noti-data">
                            <div class="noti-data" type="submit" id='.$col->reqid.'  '.'name='.$col->type.' '.'onclick="noti_info(id)">
                                <li style="padding-top:10px;">'.$col->type.'</li><br>    
                                <li>'.$col->time_request." | ".$col->date_request.'</li><hr style="margin-bottom:1px;">
                            </div>
                        </div>'

                ;            
            };
        }
        else{
            $output .='
                <!--<li class="noti-banner">แจ้งเตือน</li>-->
                <li class="pt-4 pb-4">ไม่มีแจ้งเตือน</li>';
        }
             
        
        $data = array(
            'notification'=>'<li class="noti-banner">แจ้งเตือน</li>'.$output,
            'unreadnoti'=>$count
        );        
        echo json_encode($data);
        $this->session->id_data = $select_id;
    }

    /*---SET STATUS 0(unread) > 1(read)---*/
    public function set_one(){
        $x = $this->session->id_data;
        foreach($x as $row){
            $id = $row->id;
            $this->db->set('noti_status','1');
            $this->db->where('id',$id);
            $this->db->update('noti_list');
        }     
        $this->session->unset_userdata('id_data');       
    }

    //------------------------------------------------------CLICK ON NOTI TO INFORMATION------------------------------------------------
    //--------------------------Convert MD5 to ID and get all data---------------------------
    public function show_info(){
        $this->load->model('notification_data');
        $reqid = $this->input->post('reqid');        
        $data = $this->notification_data->noti_data($reqid);
        echo json_encode($data);      

        // DISSMISS NOTIFICATION
        $ad_username = $this->input->post('ad_username');
        $this->db->set('read_status','1');
        $this->db->where('reqid',$reqid)->where('username',$ad_username);
        $this->db->update('noti_list');
    }
    //-----------------------------------request_fix data-------------------------------------              
    public function request_fix_report(){
        $data = $this->input->post('data');
        $this->session->report_fix_notidata = $data;  // ต้องส่งข้อมูลมาแล้ว ออกหน้า report เลย ฝั่ง หน้าหลักไม่สามารถออกได้ 
    } 
    public function report_fix_order(){        
        $fix_data = $this->session->report_fix_notidata;
        $data = array(
            'id' => $fix_data['id'],
            'date_request' => $fix_data['date_request'],
            'time_request' => $fix_data['time_request'],
            'firstname' => $fix_data['firstname'],
            'lastname' => $fix_data['lastname'],
            'phonenum' => $fix_data['phonenum'],
            'fixlist' => $fix_data['fixlist'],
            'fixprob' => $fix_data['fixprob'],
            'type' => $fix_data['type'],
            'email' => $fix_data['email'],
            'building' => $fix_data['building'],
            'floor' => $fix_data['floor'],
            'room' => $fix_data['room'],           
            'date' => $fix_data['date'],
            'time' => $fix_data['time'],
        );
        $this->load->view('report_fix_order',$data);     
    }
    //-----------------------------------request_item data-------------------------------------
    public function request_item_report(){
        $data = $this->input->post('data');        
        $this->session->report_item_notidata = $data;         
    } 
    public function report_item_order(){        
        $item_data = $this->session->report_item_notidata;
        //--------- Information ----------
        $data = array(
            'id' => $item_data['id'],
            'firstname' => $item_data['firstname'],
            'lastname' => $item_data['lastname'],
            'phonenum' => $item_data['phonenum'],
            'email' => $item_data['email'],
            'section' => $item_data['section'],
            'date' => $item_data['date'],
            'time' => $item_data['time'],
            'date_request' => $item_data['date_request'],
            'time_request' => $item_data['time_request'],
            'type' => $item_data['type'],
        );
        //--------- item_list product + avaliable product_id  ----------
        $id = $data['id'];
        $this->load->model('ad_item_model');
        $data['item_list'] = $this->ad_item_model->report_item_list($id);
        $data['product_id'] = $this->ad_item_model->report_item_list_pd_id($id);
        //print_r($data);
        $this->load->view('report_item_order',$data);     
    }    
    //-----------------------------------request_email data-------------------------------------
    public function request_email_report(){
        $data = $this->input->post('data');
        $this->session->report_email_notidata = $data;         
    } 
    public function report_email_order(){        
        $email_data = $this->session->report_email_notidata;
        $data = array(
            'id' => $email_data['id'],            
            'firstname' => $email_data['firstname'], 
            'lastname' => $email_data['lastname'], 
            'firstnameth' => $email_data['firstnameth'], 
            'lastnameth' => $email_data['lastnameth'], 
            'phonenum' => $email_data['phonenum'], 
            'phonein' => $email_data['phonein'], 
            'email' => $email_data['email'], 
            'section' => $email_data['section'],             
            'rank' => $email_data['rank'],       
            'date_request' => $email_data['date_request'], 
            'time_request' => $email_data['time_request'],       
            'type' => $email_data['id'], 
        );
        $this->load->view('report_email_order',$data);     
    }
    //-----------------------------------request_finger data-------------------------------------
    public function request_finger_report(){
        $data = $this->input->post('data');
        $max_id = $this->input->post('max_id');
        $this->session->report_finger_notidata = $data;  
        $this->session->max_id = $max_id;       
    } 
    public function report_finger_order(){        
        $finger_data = $this->session->report_finger_notidata;
        $max_id = $this->session->max_id;
        $data = array(
            'id' => $finger_data['id'],            
            'firstname' => $finger_data['firstname'],
            'lastname' => $finger_data['lastname'],
            'phonenum' => $finger_data['phonenum'],
            'phonein' => $finger_data['phonein'],
            'email' => $finger_data['email'],
            'section' => $finger_data['section'],            
            'rank' => $finger_data['rank'],      
            'date_request' => $finger_data['date_request'],
            'time_request' => $finger_data['time_request'],      
            'type' => $finger_data['type'],  
            'max_id' => $max_id['id_scan']+1, 
        );
        $this->load->view('report_finger_order',$data);     
    }
    //-----------------------------------request_otp_item data-------------------------------------
    public function request_itemotp_report(){
        $data = $this->input->post('data');       
        $this->session->report_itemotp_notidata = $data;         
    } 
    public function report_itemotp_order(){        
        $item_data = $this->session->report_itemotp_notidata;
        //--------- Information ----------
        $data = array(
            'id' => $item_data['id'],
            'firstname' => $item_data['firstname'],
            'lastname' => $item_data['lastname'],
            'phonenum' => $item_data['phonenum'],
            'email' => $item_data['email'],
            'section' => $item_data['section'],
            'date_request' => $item_data['date_request'],
            'time_request' => $item_data['time_request'],
            'type' => $item_data['type'],
        );
        //--------- item_list product + avaliable product_id  ----------
        $id = $data['id'];
        $this->load->model('ad_itemotp_model');
        $data['itemotp_list'] = $this->ad_itemotp_model->report_item_list($id);
        //print_r($data);
        $this->load->view('report_itemotp_order',$data);     
    }
}
?>