<?php
class request_fix_test extends CI_Controller
{
    public function index(){
        $this->load->view("request_fix");        
    }
    
    public function checkdata(){
        if($_POST['firstname']){$firstname = $this->input->post('firstname');} else{$firstname = "";}    
        if($_POST['lastname']){$lastname = $this->input->post('lastname');} else{$lastname = "";}               
        $get_data = array(
            'firstname' => $firstname,
            'lastname' => $lastname
        );        
        echo $firstname;
        $this->session->get_data = $get_data; 
        session_destroy();        
        $this->load->library('form_validation');
        $this->load->helper('form','url');
        $this->form_validation->set_rules('firstname','firstname','required|alpha_thai');
        $this->form_validation->set_rules('lastname','lastname','required|alpha_thai');
        if($this->form_validation->run()){           
            
            
            
                     
            $this->load->view('request_fix');
        }
        else{                       
            $this->load->view('request_fix');
            //session_destroy();
        }
    


/*
        if(isset($_POST['firstname'])){
            $fname = $this->input->post('firstname');
            echo $fname;
        }
*/       

        /*$data = array(
            'firstname' => 'ddd',
        );*/
        //$this->session->get_data = $data;
        //$this->session->set_flashdata('firstname','firstname');
        


/* 
        $this->load->library('form_validation');
        $this->load->helper('form','url');
        $this->form_validation->set_rules('firstname','firstname','required|alpha_thai');
        $this->form_validation->set_rules('lastname','lastname','required|alpha_thai');
        if($this->form_validation->run()){
            if(!empty($_POST['firstname'])){
                $firstname = $this->input->post('firstname');
                echo $firstname;
            }
        }
        else{            
            $this->load->view('request_fix');
        }
    }
    
    /*
    public function kuy(){
        $this->load->view('request_fix');
    }
    */






//redirect(base_url() . 'request_fix');
/*       
        if(!empty($_POST['firstname'])){            
            if($this->form_validation->run() == TRUE){
                $fname = $this->input->post('firstname');
                echo $fname;
                $this->index();
            }
            else{
            echo 'kuy01+';                                         
            }                      
        }
        
        
        if(!empty($_POST['lastname'])){
            $lname = $this->input->post('lastname');
            echo $lname;
        }else{
            echo 'kuy02+';
        }
*/




/*
        if ($this->form_validation->run()){
            //echo '5555555555555555555555555';            
        }
        else{
            $this->index();
        }*/
        
        /*
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname')
        );
        */
        //echo print_r($data);

        
    
    }
}












    /*
    foreach($report as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $place = $row->place;
            $fixlist = $row->fixlist;
            $fixprob = $row->fixprob;
            $fixetc = $row->fixetc;
            $type = $row->type;
        }
        $report_data = array(
            'id' => $id,
            'date_request' => $date_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'place'=> $place,
            'fixlist' => $fixlist,
            'fixprob' => $fixprob,
            'fixetc' => $fixetc,
            'type' => $type
        );
    public function error(){        

        // CHECK        
        $this->load->library('form_validation');
        $this->load->helper('form','url');
        $this->form_validation->set_rules('firstname','ชื่อ','required|alpha_thai');
        $this->form_validation->set_rules('lastname','นามสกุล','required|alpha_thai');
        $this->form_validation->set_rules('phonenum','เบอร์โทรติดต่อ','required|alpha_thai');
        $this->form_validation->set_rules('email','อีเมลติดต่อ','required|valid_email|alpha_thai');
        $this->form_validation->set_rules('building','ตึก','required|alpha_thai');
        $this->form_validation->set_rules('floor','ชั้น','required|alpha_thai');
        $this->form_validation->set_rules('room','ห้อง','required|alpha_thai');
        $this->form_validation->set_rules('fixlist','รายการแจ้งซ่อม','required|alpha_thai');
        $this->form_validation->set_rules('fixprob','ลักษณะของปัญหา','required|alpha_thai');
        $this->form_validation->set_rules('date','กำหนดวันที่ซ่อม','required|alpha_thai');
        $this->form_validation->set_rules('time','กำหนดเวลาซ่อม','required|alpha_thai');
        $this->form_validation->set_rules('fixetc','แนะนำเพิ่มเติม');

        // INPUT DATA 
        if($this->form_validation->run()){  
            date_default_timezone_set("Asia/Bangkok");
            $data = array(
                "firstname"=>$this->input->post("firstname"),
                "lastname"=>$this->input->post("lastname"),
                "phonenum"=>$this->input->post("phonenum"),
                "email"=>$this->input->post("email"),
                "building"=>$this->input->post("building"),
                "floor"=>$this->input->post("floor"),
                "room"=>$this->input->post("room"),
                "fixlist"=>$this->input->post("fixlist"),
                "fixprob"=>$this->input->post("fixprob"),
                "date"=>$this->input->post("date"),
                "time"=>$this->input->post("time"),
                "fixetc"=>$this->input->post("fixetc"),
                "date_request"=>date('d/m/Y'),
                "time_request"=>date('G:i')               
            );
            $this->load->model("request_model");              
            $this->request_model->fix_insertdata($data);
            //$this->load->view('success');
            //redirect(base_url() . 'ad_main');
            
            
        }else{
             $data = array(
                'error' => true,
                'fname_error' => form_error('firstname'),
                'lname_error' => form_error('lastname'),
                'phone_error' => form_error('phonenum'),
                'email_error' => form_error('email'),
                'building_error' => form_error('building'),
                'floor_error' => form_error('floor'),
                'room_error' => form_error('room'),
                'flist_error' => form_error('fixlist'),
                'fprob_error' => form_error('fixprob'),
                'date_error' => form_error('date'),
                'time_error' => form_error('time')
                 );
         }
        echo json_encode($data);
        
    }
    public function success()
    {
        $this->load->view('success');
    }
    */

