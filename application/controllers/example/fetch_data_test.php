<?php
class fetch_data_test extends CI_Controller
{
    /*public function index(){        
        $this->load->model("dashmodel");
        $data["fetch_data"]=$this->dashmodel->fetch_data();
        $this->load->view('ad_alert_all_fetch_test');
    } */

    /* public function index()
    {
        $this->load->model('dashmodel');
        $data = $this->dashmodel->getuser();
        $this->load->view("ad_alert_test",$data);
    }*/

    public function index()
    {
        /*
        $query = $this->db->query('select * from dashfix');
        $rows = $query->result();
        $data = array(
            'result' => $rows
        );
        
        $this->load->view('ad_alert_test',$data);
        */

        $this->load->view("ad_alert_test");
    }

    /* public function dashtest(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules("first_name","box",'required|alpha');
        $this->form_validation->set_rules("last_name","box",'required|alpha');
        if($this->form_validation->run()){
            $this->load->model("dashmodel");
            $data = array(
                "first_name"=>$this->input->post("first_name"),
                "last_name"=>$this->input->post("last_name")
            );
            
            $this->dashmodel->insertdata($data);
            
            //redirect(base_url()."index.php/main/inserted");
        } 
        else
        {
            $this->index();
        }
    }
    public function inserted(){
        $this->index();
    }
    */

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
    }*/



}