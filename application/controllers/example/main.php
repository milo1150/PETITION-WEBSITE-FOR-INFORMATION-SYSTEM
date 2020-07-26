<?php
class Main extends CI_Controller
{
    public function index(){
        $this->load->view('newtablefix');
    }
    /*public function index(){
        $this->load->view("dashfix");
    }
    public function dashtest(){        
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
            redirect(base_url()."index.php/main/inserted");
        } 
        else
        {
            $this->index();
        }
    }
    public function inserted(){
        $this->index();
    }       
    public function ad_fix(){
        $this->load->view('ad_fix');
    }
    */
    /*
    public function update_data(){
        $user_id = $this->url->segment(2);
        $this->load->model('main_model');
        $data['user_data'] = $this->main_model->fetch_single_data($user_id);
        $data['fetch_data'] = $this->main_model->fetch_data();      
        $this->load->view('report_all_fix',$data);  
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
    }
    */



}