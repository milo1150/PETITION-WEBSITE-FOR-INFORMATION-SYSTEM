<?php
Class News extends CI_Controller {
    function index(){
        $data['data0'] = $this->db->select('*')->from('news')->where('status',1)->limit('8')->order_by('id','ASC')->get()->result();
        $data['data1'] = $this->db->select('*')->from('news')->where('type','ข่าวทั่วไป')->where('status',1)->limit('8')->order_by('id','ASC')->get()->result();
        $data['data2'] = $this->db->select('*')->from('news')->where('type','ข่าวมหาวิทยาลัย')->where('status',1)->limit('8')->order_by('id','ASC')->get()->result();
        $data['data3'] = $this->db->select('*')->from('news')->where('type','ข่าวสารสนเทศ')->where('status',1)->limit('8')->order_by('id','ASC')->get()->result();
        $data['data4'] = $this->db->select('*')->from('news')->where('type','อื่นๆ')->where('status',1)->limit('8')->order_by('id','ASC')->get()->result();
        $this->load->view('user/news/news_main',$data);
    }
    /*------------- Onclick redirect to Content --------------*/
    function con(){
        $title = $this->input->get('title');
        $data = $this->db->select('*')->from('news')->where('title',$title)->get()->result_array();
        $data = array(
            'id' => $data[0]['id'],
            'title' => $data[0]['title'],
            'img_name' => $data[0]['img_name'],
            'content' => $data[0]['content'],
            'post_date' => $data[0]['post_date'],
            'post_time' => $data[0]['post_time']
        );
        $this->load->view('user/news/news_contents',$data);
    }
    /* ------------------------------- All news -------------------------------- */    
    function allnews(){
       
        $limit = 5; // limit max news for show in single page
        if(!isset($_GET['page'])){
            $data['data'] = $this->db->select('*')->from('news')->where('status',1)->limit($limit)->order_by('id','ASC')->get()->result();  // limit fot FAST query
            $data['news_count'] = count($this->db->select('*')->from('news')->get()->result());
            $data['pagi_active'] = 1;
            $this->load->view('user/news/news_all_contents',$data);
        }        
        //----- 1 Controller pagination ------- 
        else{  
            $page = $this->input->get('page');         
            if($page == 1){ redirect(base_url().'news/allnews'); }            
            $offset_d = ($page-1)*$limit; // *** จำนวน news_id ที่ต้องข้าม select
            $data['data'] = $this->db->select('*')->from('news')->where('status',1)->limit($limit,$offset_d)->get()->result();
            $data['news_count'] = count($this->db->select('*')->from('news')->get()->result());
            $data['pagi_active'] = $page;
            $this->load->view('user/news/news_all_contents',$data);
        }     
    }
    /* --------------------------------------------------------- News Search ---------------------------------------------------------- */
    function n_filter(){
        //print_r($_GET);
        $month = $this->input->get('m');
        $year = $this->input->get('y');
        $text = $this->input->get('t');
        $page = $this->input->get('page');
        $limit = 2; // limit max news for show in single page
        $offset = ($page-1)*$limit; // จำนวน news ที่ข้าม **เลือกแค่ข่าวที่ต้องการจะโชว์ในหน้านั้นจริงๆ เพื่อความเร็ว


        /* ----------------------------------------------- On click Search -------------------------------------------- */
        /* onclick pagination จะมีค่า $_GET['page'] ส่งมา this why CHECK isset */
        if(!isset($_GET['page'])){          
            // 000
            if($month == '00' && $year == '00' && $text == null){
                redirect('news/allnews');
            }
            // 001
            if($month == '00' && $year == '00' && $text != null){
                $data['data'] = $this->db->select('*')->from('news')->where(" title LIKE '%$text%' ")->get()->result();
                $data['news_count'] = count($data['data']);
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 010
            if($month == '00' && $year != '00' && $text == null){
                $month_start = $year.'-01-01';
                $month_end = $year.'-12-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }       
            // 011
            if($month == '00' && $year != '00' && $text != null){
                $month_start = $year.'-01-01';
                $month_end = $year.'-12-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }     
            // 100
            if($month != '00' && $year == '00' && $text == null){
                $cur_year = date('Y',strtotime('this year'));
                $month_start = $cur_year.'-'.$month.'-01';
                $month_end = $cur_year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 101
            if($month != '00' && $year == '00' && $text != null){
                $cur_year = date('Y',strtotime('this year'));
                $month_start = $cur_year.'-'.$month.'-01';
                $month_end = $cur_year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 110
            if($month != '00' && $year != '00' && $text == null){
                $month_start = $year.'-'.$month.'-01';
                $month_end = $year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 111
            if($month != '00' && $year != '00' && $text != null){
                $month_start = $year.'-'.$month.'-01';
                $month_end = $year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result();
                $data['news_count'] = count($data['data']);            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = 1;
                $this->load->view('user/news/news_all_filter',$data);
            }

            
        }
        /* ----------------------------------------------- On click Pagination -------------------------------------------- */
        else{
            // 001
            if($month == '00' && $year == '00' && $text != null){
                $data['data'] = $this->db->select('*')->from('news')->where(" title LIKE '%$text%' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where(" title LIKE '%$text%' ")->get()->result());
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }           
            // 010
            if($month == '00' && $year != '00' && $text == null){
                $month_start = $year.'-01-01';
                $month_end = $year.'-12-31';              
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result());            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 011
            if($month == '00' && $year != '00' && $text != null){
                $month_start = $year.'-01-01';
                $month_end = $year.'-12-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result());            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            } 
            // 100
            if($month != '00' && $year == '00' && $text == null){
                $cur_year = date('Y',strtotime('this year'));
                $month_start = $cur_year.'-'.$month.'-01';
                $month_end = $cur_year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result()); 
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 101
            if($month != '00' && $year == '00' && $text != null){
                $cur_year = date('Y',strtotime('this year'));
                $month_start = $cur_year.'-'.$month.'-01';
                $month_end = $cur_year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result());            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 110
            if($month != '00' && $year != '00' && $text == null){
                $month_start = $year.'-'.$month.'-01';
                $month_end = $year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' ")->get()->result());            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }
            // 111
            if($month != '00' && $year != '00' && $text != null){
                $month_start = $year.'-'.$month.'-01';
                $month_end = $year.'-'.$month.'-31';
                $data['data'] = $this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->limit($limit,$offset)->get()->result();
                $data['news_count'] = count($this->db->select('*')->from('news')->where("post_date BETWEEN '$month_start' AND '$month_end' AND title LIKE '%$text%' ")->get()->result());            
                $data['m'] = $month; $data['y'] = $year; $data['t'] = $text; $data['pagi_active'] = $page;
                $this->load->view('user/news/news_all_filter',$data);
            }            
        }
    }
    /* --------------------------------------------------------- Downlaod ---------------------------------------------------------- */
    function files(){
        if(!isset($_GET['grp'])){
            $data['files'] = $this->db->select('*')->from('pdf_file')->get()->result();
            $data['group_data'] = $this->db->select('*')->from('pdf_category')->get()->result();
            $this->load->view('user/news/news_download',$data);
        }else{
            $grp = $this->input->get('grp');
            if($grp == '0'){
                redirect(base_url().'News/files');
            }
            $data['files'] = $this->db->select('*')->from('pdf_file')->where(" category LIKE '%$grp%' ")->get()->result();
            $data['group_data'] = $this->db->select('*')->from('pdf_category')->get()->result();
            $data['fil_default'] = $grp;
            $this->load->view('user/news/news_download',$data);                    
        }       
        
    }










    
}
?>