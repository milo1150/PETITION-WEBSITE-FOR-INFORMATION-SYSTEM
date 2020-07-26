<?php
class dash_fix extends CI_Controller
{
    public function index(){
        $this->load->view("dashfix");
    }
    public function dashtest(){        

        // CHECK BOX 
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname','ชื่อ','required|alpha_thai');
        $this->form_validation->set_rules('lastname','นามสกุล','required|alpha_thai');
        $this->form_validation->set_rules('phonenum','เบอร์โทรติดต่อ','required|alpha_thai');
        $this->form_validation->set_rules('place','นามสกุล','required|alpha_thai');
        $this->form_validation->set_rules('fixlist','รายการแจ้งซ่อม','required|alpha_thai');
        $this->form_validation->set_rules('fixprob','ลักษณะของปัญหา','required|alpha_thai');
        $this->form_validation->set_rules('worktime','กำหนดเวลาซ่อม','required|alpha_thai');
        $this->form_validation->set_rules('fixetc','แนะนำเพิ่มเติม');

        // INPUT DATA 
        if($this->form_validation->run()){
            $this->load->model("dashmodel");
            $data = array(
                "firstname"=>$this->input->post("firstname"),
                "lastname"=>$this->input->post("lastname"),
                "phonenum"=>$this->input->post("phonenum"),
                "place"=>$this->input->post("place"),
                "fixlist"=>$this->input->post("fixlist"),
                "fixprob"=>$this->input->post("fixprob"),
                "fixetc"=>$this->input->post("fixetc")
            );            
            $this->dashmodel->insertdata($data);            
            redirect(base_url()."index.php/dash_fix/success");
        } 
        else
        {
            $this->index();
        }
    }
    public function success()
    {
        $this->load->view('success');
    }
    /*
    public function ad_fix(){
        $this->load->view('ad_fix');
    }
    */
}


/*
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','form'); 
        $this->load->model("dashmodel");
    }
    public function index()
    {
        $this->load->view('dashfix');
    }
    public function dashfix()
    {
        $save = array(
            'first_name'=>$this.input.post("first_name"),
            'last_name'=>$this.input.post("last_name")
        );
        $this->dashmodel->insertdashfix($save);
        //redirect('index.php/main');
    }
    */
