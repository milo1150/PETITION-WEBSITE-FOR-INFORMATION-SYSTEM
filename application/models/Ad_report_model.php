<?php 
Class ad_report_model extends CI_Model{ 
    function admin_list(){
        $this->db->select('*');
        $query = $this->db->get('admin_login');
        $list = $query->result();        
        return $list;
    }
        
    function order_alltime($username){  
        /*---------------------------------------------------------- accept , close , rating  ------------------------------------------------------*/
        /*---ACCEPT ORDER---*/
        $a_fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_name',$username)->get()->result());
        $a_item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_name',$username)->get()->result());
        
        /*---CLOSE ORDER---*/
        $a_fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_name',$username)->get()->result());
        $a_item_close = count($this->db->select('*')->from('request_item')->where('admin_close_name',$username)->get()->result());
        $a_email_close = count($this->db->select('*')->from('request_email')->where('admin_close_name',$username)->get()->result());
        $a_finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_name',$username)->get()->result());
        $a_itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('admin_close_name',$username)->get()->result());

        /*---RATING---*/
        $rating = array();
        $rating[5] = count($this->db->select('id')->from('request_fix')->where('rating',5)->where('admin_close_name',$username)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',5)->where('admin_close_name',$username)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',5)->where('admin_close_name',$username)->get()->result());
        $rating[4] = count($this->db->select('id')->from('request_fix')->where('rating',4)->where('admin_close_name',$username)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',4)->where('admin_close_name',$username)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',4)->where('admin_close_name',$username)->get()->result());
        $rating[3] = count($this->db->select('id')->from('request_fix')->where('rating',3)->where('admin_close_name',$username)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',3)->where('admin_close_name',$username)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',3)->where('admin_close_name',$username)->get()->result());
        $rating[2] = count($this->db->select('id')->from('request_fix')->where('rating',2)->where('admin_close_name',$username)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',2)->where('admin_close_name',$username)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',2)->where('admin_close_name',$username)->get()->result());
        $rating[1] = count($this->db->select('id')->from('request_fix')->where('rating',1)->where('admin_close_name',$username)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',1)->where('admin_close_name',$username)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',1)->where('admin_close_name',$username)->get()->result());
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/
  
        /*--------------------------------------------------------------- 30 Days latest -------------------------------------------------------------*/             
        $day_count = [];
        $data_accept = [];
        $data_close = [];
        $day = strtotime('today');
        for($x=0;$x<=30;$x++){
            $day_count[$x] = date('Y-m-d',$day);
            $day = strtotime('-1 day',$day);               
            /*---------------------- ACCEPT ORDER --------------------*/
            $fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_name',$username)->where('admin_accept_date',$day_count[$x])->get()->result());
            $item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_name',$username)->where('admin_accept_date',$day_count[$x])->get()->result());
            $data_accept[$x] = $fix_accept+$item_accept;   
            /*---------------------- CLOSE ORDER --------------------*/
            $fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $item_close = count($this->db->select('*')->from('request_item')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $email_close = count($this->db->select('*')->from('request_email')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $data_close[$x] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close; 
            //echo $day_count[$x].'='.$data[$x].' ';    
        }
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/

        
        /*-------------------------------------------------------------- 12 Months latest ------------------------------------------------------------*/
        /*echo latest year*/
        $latest_year = date('Y',strtotime('this year'));       
        /*---------------------- ACCEPT ORDER --------------------*/
        $latestyear_data_accept = array();                                      
        $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $latest_year.'-'.date('m',$month).'-'.'01';
                $end = $latest_year.'-'.date('m',$month).'-'.'31'; 
                $fix_accept = count($this->db->select('*')->from('request_fix')->where(" admin_accept_name = '$username' AND admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where(" admin_accept_name = '$username' AND admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $latestyear_data_accept[$y] = $fix_accept+$item_accept;                                                    
                $month = strtotime('+1 month',$month);
            }            
        

        /*---------------------- CLOSE ORDER --------------------*/
        $latestyear_data_close = array();                                      
        $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $latest_year.'-'.date('m',$month).'-'.'01';
                $end = $latest_year.'-'.date('m',$month).'-'.'31'; 
                $fix_close = count($this->db->select('*')->from('request_fix')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                $latestyear_data_close[$y] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close;                                                    
                $month = strtotime('+1 month',$month);
            }            
        
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/

        
        /*-------------------------------------------------------------- Data for each year ------------------------------------------------------------*/
        $year_list = array();
        $year = '2020';
        for($x=2020;$x<=2025;$x++){
            $year_list[$x] = $year;
            $year = $year+1;
        }

        /*---------------------- ACCEPT ORDER --------------------*/
        $year_data_accept = array();                         
        for($x=2020;$x<=2025;$x++){             
            $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $year_list[$x].'-'.date('m',$month).'-'.'01';
                $end = $year_list[$x].'-'.date('m',$month).'-'.'31'; 
                $fix_accept = count($this->db->select('*')->from('request_fix')->where(" admin_accept_name = '$username' AND admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where(" admin_accept_name = '$username' AND admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_accept = count($this->db->select('*')->from('request_email')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_accept = count($this->db->select('*')->from('request_finger')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                $year_data_accept[$x][$y] = $fix_accept+$item_accept+$email_accept+$finger_accept;                                                    
                //echo $start.' '.$end.' '.$year_data_accept[$x][$y].'<br>';
                $month = strtotime('+1 month',$month);
            }            
        }

        /*---------------------- CLOSE ORDER --------------------*/
        $year_data_close = array();                         
        for($x=2020;$x<=2025;$x++){             
            $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $year_list[$x].'-'.date('m',$month).'-'.'01';
                $end = $year_list[$x].'-'.date('m',$month).'-'.'31'; 
                $fix_close = count($this->db->select('*')->from('request_fix')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where(" admin_close_name = '$username' AND admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                $year_data_close[$x][$y] = $fix_close+$item_close+$email_close+$finger_close;                                                    
                //echo $start.' '.$end.' '.$year_data_close[$x][$y].'<br>';
                $month = strtotime('+1 month',$month);
            }            
        }
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/
        
        /*---DATA OUTPUT---*/
        $single_data = array(
            'username' => $username,
            'fix_accept' => $a_fix_accept,
            'item_accept' => $a_item_accept,
            'fix_close' => $a_fix_close,
            'item_close' => $a_item_close,
            'email_close' => $a_email_close,
            'finger_close' => $a_finger_close,
            'itemotp_close' => $a_itemotp_close,
            'rating' => $rating,
            'data_accept' => $data_accept,
            'data_close' => $data_close,            
            'latestyear_data_accept' => $latestyear_data_accept,
            'latestyear_data_close' => $latestyear_data_close,
            'year_data_accept' => $year_data_accept,
            'year_data_close' => $year_data_close,
        );
        //print_r($single_data['rating']);
        return $single_data;
    }
    /*-------------------------------------------------------------------------------------------------------------------------------------------*/




    /*---------------------------------------------------------------OVERALL REPORT------------------------------------------------------------------*/
    function report_admin_overall(){
    /*---------------------------------------------------------- accept , close , rating  ------------------------------------------------------*/
        /*---ACCEPT ORDER---*/
        $o_fix_accept = count($this->db->select('*')->from('request_fix')->where('order_status !=',0)->get()->result());
        $o_item_accept = count($this->db->select('*')->from('request_item')->where('order_status !=',0)->get()->result());

        /*---CLOSE ORDER---*/
        $o_fix_close = count($this->db->select('*')->from('request_fix')->where('order_status =',2)->get()->result());
        $o_item_close = count($this->db->select('*')->from('request_item')->where('order_status =',2)->get()->result());
        $o_email_close = count($this->db->select('*')->from('request_email')->where('order_status =',2)->get()->result());
        $o_finger_close = count($this->db->select('*')->from('request_finger')->where('order_status =',2)->get()->result());
        $o_itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('order_status =',2)->get()->result());

        /*---RATING---*/
        $rating = array();
        $rating[5] = count($this->db->select('id')->from('request_fix')->where('rating',5)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',5)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',5)->get()->result());
        $rating[4] = count($this->db->select('id')->from('request_fix')->where('rating',4)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',4)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',4)->get()->result());
        $rating[3] = count($this->db->select('id')->from('request_fix')->where('rating',3)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',3)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',3)->get()->result());
        $rating[2] = count($this->db->select('id')->from('request_fix')->where('rating',2)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',2)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',2)->get()->result());
        $rating[1] = count($this->db->select('id')->from('request_fix')->where('rating',1)->get()->result()) 
                    +count($this->db->select('id')->from('request_item')->where('rating',1)->get()->result())
                    +count($this->db->select('id')->from('request_itemotp')->where('rating',1)->get()->result());
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/
        
        /*--------------------------------------------------------------- 30 Days latest -------------------------------------------------------------*/             
        $day_count = [];
        $data_accept = [];
        $data_close = [];
        $day = strtotime('today');
        for($x=0;$x<=30;$x++){
            $day_count[$x] = date('Y-m-d',$day);
            $day = strtotime('-1 day',$day);               
            /*---------------------- ACCEPT ORDER --------------------*/
            $fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_date',$day_count[$x])->get()->result());
            $item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_date',$day_count[$x])->get()->result());
            $data_accept[$x] = $fix_accept+$item_accept;   
            /*---------------------- CLOSE ORDER --------------------*/
            $fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_date',$day_count[$x])->get()->result());
            $item_close = count($this->db->select('*')->from('request_item')->where('admin_close_date',$day_count[$x])->get()->result());
            $email_close = count($this->db->select('*')->from('request_email')->where('admin_close_date',$day_count[$x])->get()->result());
            $finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_date',$day_count[$x])->get()->result());
            $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('admin_close_date',$day_count[$x])->get()->result());
            $data_close[$x] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close; 
            //echo $day_count[$x].'='.$data[$x].' ';    
        }
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/
        
        /*-------------------------------------------------------------- latest Year ----------------------------------------------------------------*/
        /*echo latest year*/
        $latest_year = date('Y',strtotime('this year'));       
        /*---------------------- ACCEPT ORDER --------------------*/
        $latestyear_data_accept = array();                                      
        $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $latest_year.'-'.date('m',$month).'-'.'01';
                $end = $latest_year.'-'.date('m',$month).'-'.'31'; 
                $fix_accept = count($this->db->select('*')->from('request_fix')->where(" admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where(" admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $latestyear_data_accept[$y] = $fix_accept+$item_accept;                                                    
                $month = strtotime('+1 month',$month);
            }            
        

        /*---------------------- CLOSE ORDER --------------------*/
        $latestyear_data_close = array();                                      
        $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $latest_year.'-'.date('m',$month).'-'.'01';
                $end = $latest_year.'-'.date('m',$month).'-'.'31'; 
                $fix_close = count($this->db->select('*')->from('request_fix')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result()); 
                $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                              
                $latestyear_data_close[$y] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close;                                                    
                $month = strtotime('+1 month',$month);
            }            
        
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------- Data for each year ------------------------------------------------------------*/
        $year_list = array();
        $year = '2020';
        for($x=2020;$x<=2025;$x++){
            $year_list[$x] = $year;
            $year = $year+1;
        }

        /*---------------------- ACCEPT ORDER --------------------*/
        $year_data_accept = array();                         
        for($x=2020;$x<=2025;$x++){             
            $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $year_list[$x].'-'.date('m',$month).'-'.'01';
                $end = $year_list[$x].'-'.date('m',$month).'-'.'31'; 
                $fix_accept = count($this->db->select('*')->from('request_fix')->where(" admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where(" admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_accept = count($this->db->select('*')->from('request_email')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_accept = count($this->db->select('*')->from('request_finger')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                $year_data_accept[$x][$y] = $fix_accept+$item_accept+$email_accept+$finger_accept;                                                    
                //echo $start.' '.$end.' '.$year_data_accept[$x][$y].'<br>';
                $month = strtotime('+1 month',$month);
            }            
        }

        /*---------------------- CLOSE ORDER --------------------*/
        $year_data_close = array();                         
        for($x=2020;$x<=2025;$x++){             
            $month = strtotime('january');
            for($y=1;$y<=12;$y++){                   
                $start = $year_list[$x].'-'.date('m',$month).'-'.'01';
                $end = $year_list[$x].'-'.date('m',$month).'-'.'31'; 
                $fix_close = count($this->db->select('*')->from('request_fix')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where(" admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                $year_data_close[$x][$y] = $fix_close+$item_close+$email_close+$finger_close;                                                    
                //echo $start.' '.$end.' '.$year_data_close[$x][$y].'<br>';
                $month = strtotime('+1 month',$month);
            }            
        }
        /*-------------------------------------------------------------------------------------------------------------------------------------------*/
              
        /*---OVERALL DATA OUTPUT---*/
        $overall_data = array(
            'fix_accept' => $o_fix_accept,
            'item_accept' => $o_item_accept,
            //'email_accept' => $o_email_accept,
            //'finger_accept' => $o_finger_accept,
            'fix_close' => $o_fix_close,
            'item_close' => $o_item_close,
            'email_close' => $o_email_close,
            'finger_close' => $o_finger_close,
            'itemotp_close' => $o_itemotp_close,            
            'rating' => $rating,
            'data_accept' => $data_accept,
            'data_close' => $data_close,            
            'latestyear_data_accept' => $latestyear_data_accept,
            'latestyear_data_close' => $latestyear_data_close,       
            'year_data_accept' => $year_data_accept,
            'year_data_close' => $year_data_close,
        );
        return $overall_data;
    }
    /*-------------------------------------------------------------------------------------------------------------------------------------------*/




    /*/////////////////////////////////////////////////////////////// MAIN PAGE /////////////////////////////////////////////////////////////////*/
    /*---INCOME ORDER---*/
    function ad_main_data(){
        /*--- NEW ORDER TODAY ---*/
        $x = date('yy-m-d',strtotime('today'));
        $fix_order = count($this->db->select('id')->from('request_fix')->where('date_request =',$x)->get()->result());
        $item_order = count($this->db->select('id')->from('request_item')->where('date_request =',$x)->get()->result());
        $itemotp_order = count($this->db->select('id')->from('request_itemotp')->where('date_request =',$x)->get()->result());
        $email_order = count($this->db->select('id')->from('request_email')->where('date_request =',$x)->get()->result());
        $finger_order = count($this->db->select('id')->from('request_finger')->where('date_request =',$x)->get()->result());
        /*------- 4 Banner ---------*/
        $data_banner = Array();
        $data_banner['order_all'] = count($this->db->select('id')->from('request_fix')->get()->result())
                         +count($this->db->select('id')->from('request_item')->get()->result())
                         +count($this->db->select('id')->from('request_email')->get()->result())
                         +count($this->db->select('id')->from('request_finger')->get()->result())
                         +count($this->db->select('id')->from('request_itemotp')->get()->result());
        $data_banner['order_done'] = count($this->db->select('id')->from('request_fix')->where('order_status',2)->get()->result())
                                    +count($this->db->select('id')->from('request_item')->where('order_status',2)->get()->result())
                                    +count($this->db->select('id')->from('request_email')->where('order_status',2)->get()->result())
                                    +count($this->db->select('id')->from('request_finger')->where('order_status',2)->get()->result())
                                    +count($this->db->select('id')->from('request_itemotp')->where('order_status',2)->get()->result());
        $data_banner['order_cancle'] = count($this->db->select('id')->from('request_fix')->where('order_status',3)->get()->result())
                                      +count($this->db->select('id')->from('request_item')->where('order_status',3)->get()->result())
                                      +count($this->db->select('id')->from('request_email')->where('order_status',3)->get()->result())
                                      +count($this->db->select('id')->from('request_finger')->where('order_status',3)->get()->result())
                                      +count($this->db->select('id')->from('request_itemotp')->where('order_status',3)->get()->result());
        $data_banner['order_remain'] = count($this->db->select('id')->from('request_fix')->where('order_status',0)->or_where('order_status',1)->get()->result())
                                      +count($this->db->select('id')->from('request_item')->where('order_status',0)->or_where('order_status',1)->get()->result())
                                      +count($this->db->select('id')->from('request_email')->where('order_status',0)->or_where('order_status',1)->get()->result())
                                      +count($this->db->select('id')->from('request_finger')->where('order_status',0)->or_where('order_status',1)->get()->result())
                                      +count($this->db->select('id')->from('request_itemotp')->where('order_status',0)->or_where('order_status',1)->get()->result());
        //print_r($data_banner);
        
    /*--------------------------------------------------------------- 7 Days latest -------------------------------------------------------------*/             
        $day_count = [];
        $data_accept = [];
        $data_close = [];
        $day = strtotime('today');
        for($x=0;$x<14;$x++){
            $day_count[$x] = date('Y-m-d',$day);
            $day = strtotime('-1 day',$day);               
            /*---------------------- INCOME ORDER (22 Apr update) --------------------*/
            $fix_accept = count($this->db->select('id')->from('request_fix')->where('date_request',$day_count[$x])->get()->result());
            $item_accept = count($this->db->select('id')->from('request_item')->where('date_request',$day_count[$x])->get()->result());
            $email_accept = count($this->db->select('id')->from('request_email')->where('date_request',$day_count[$x])->get()->result());
            $finger_accept = count($this->db->select('id')->from('request_finger')->where('date_request',$day_count[$x])->get()->result());
            $itemotp_accept = count($this->db->select('id')->from('request_itemotp')->where('date_request',$day_count[$x])->get()->result());
            $data_accept[$x] = $fix_accept+$item_accept+$email_accept+$finger_accept+$itemotp_accept;   
            /*---------------------- CLOSE ORDER --------------------*/
            $fix_close = count($this->db->select('id')->from('request_fix')->where('admin_close_date',$day_count[$x])->get()->result());
            $item_close = count($this->db->select('id')->from('request_item')->where('admin_close_date',$day_count[$x])->get()->result());
            $email_close = count($this->db->select('id')->from('request_email')->where('admin_close_date',$day_count[$x])->get()->result());
            $finger_close = count($this->db->select('id')->from('request_finger')->where('admin_close_date',$day_count[$x])->get()->result());
            $itemotp_close = count($this->db->select('id')->from('request_itemotp')->where('admin_close_date',$day_count[$x])->get()->result());
            $data_close[$x] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close; 
            //echo $day_count[$x].$data_accept[$x].'<br>';    
        }
        //print_r($data_accept);

        /*---------------------------------------- OUTPUT DATA ------------------------------------*/
        $mainpage_data = array(
            'fix_order' => $fix_order,
            'item_order' => $item_order,
            'itemotp_order' => $itemotp_order,
            'email_order' => $email_order,
            'finger_order' => $finger_order,
            'data_accept' => $data_accept,
            'data_close' => $data_close,
            'data_banner' => $data_banner
        );
        //print_r($mainpage_data);
        return $mainpage_data;     
    }
    /*-------------------------------------------------------------------------------------------------------------------------------------------*/

    

    /*------------------------------------------------------- Realtime (Noti Box) ----------------------------------------------------*/
    function rt_order(){
        //----- Select 10 request 
        $now_date = date('Y-m-d',strtotime('now'));
        $x = $this->db->query("
        SELECT id,firstname,lastname,type,date_request,time_request FROM request_fix WHERE date_request = '$now_date' 
        UNION SELECT id,firstname,lastname,type,date_request,time_request FROM request_item WHERE date_request = '$now_date'  
        UNION SELECT id,firstname,lastname,type,date_request,time_request FROM request_itemotp WHERE date_request = '$now_date' 
        UNION SELECT id,firstname,lastname,type,date_request,time_request FROM request_email WHERE date_request = '$now_date'
        UNION SELECT id,firstname,lastname,type,date_request,time_request FROM request_finger WHERE date_request = '$now_date'
        ORDER BY `time_request` DESC
        ")->result();
        return $x;
    }

    /*------------------------------------------------------- Realtime (Event Box) ----------------------------------------------------*/
    function rt_event(){
        $query1 = $this->db->select('*')->from('event_request')->order_by('id','DESC')->limit('20')->get()->result();
        return $query1;
    }

}    
?>






