<?php 
Class Admin_report_model extends CI_Model{ 
    /* ---------------------------------------------------------------- Single Report --------------------------------------------------------- */
    public function flexReport($post){
        // print_r($post);
        if($post['format'] == "date"){
            $username = $post['username'];
            $startDate = strtotime($post['start']);
            $diff = $post['diff'];

            $data = array();
            for($x=0;$x<=$diff;$x++){
                $data[$x][0] = date('Y-m-d',$startDate);
                $startDate = strtotime('+1 days',$startDate);
                /*---------------------- ACCEPT ORDER --------------------*/
                $fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_name',$username)->where('admin_accept_date',$data[$x][0])->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_name',$username)->where('admin_accept_date',$data[$x][0])->get()->result());
                $data[$x][1] = $fix_accept+$item_accept;  
                    /*---------------------- CLOSE ORDER --------------------*/
                $fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_date',$data[$x][0])->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where('admin_close_date',$data[$x][0])->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where('admin_close_date',$data[$x][0])->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_date',$data[$x][0])->get()->result());
                $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('admin_close_date',$data[$x][0])->get()->result());
                $data[$x][2] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close; 
            }
            return $data;
        }
        if($post['format'] == 'month'){
            $username = $post['username'];
            $diff = $post['diff'];
            $mArr = $post['mArr'];  

            $mRangeData = array();                                      
                for($x=0;$x<=$diff;$x++){                   
                    $start = $mArr[$x][0];
                    $end = $mArr[$x][1];
                    /*---------------------- ACCEPT ORDER --------------------*/
                    $fix_accept = count($this->db->select('*')->from('request_fix')->where("admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $item_accept = count($this->db->select('*')->from('request_item')->where("admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());                       
                    /*---------------------- CLOSE ORDER --------------------*/
                    $fix_close = count($this->db->select('*')->from('request_fix')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $item_close = count($this->db->select('*')->from('request_item')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $email_close = count($this->db->select('*')->from('request_email')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $finger_close = count($this->db->select('*')->from('request_finger')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                    $mRangeData[$x][0] = $start;
                    $mRangeData[$x][1] = $fix_accept+$item_accept;          
                    $mRangeData[$x][2] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close;                                  
                } 
            // print_r($mRangeData);
            return $mRangeData;
        }
    }
    /* ---------------------------------------------------------------- Overall Report --------------------------------------------------------- */
    public function flexReportAll($post){
        if($post['format'] == "date"){
            $startDate = strtotime($post['start']);
            $diff = $post['diff'];

            $data = array();
            for($x=0;$x<=$diff;$x++){
                $data[$x][0] = date('Y-m-d',$startDate);
                $startDate = strtotime('+1 days',$startDate);
                /*---------------------- ACCEPT ORDER --------------------*/
                $fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_date',$data[$x][0])->get()->result());
                $item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_date',$data[$x][0])->get()->result());
                $data[$x][1] = $fix_accept+$item_accept;  
                /*---------------------- CLOSE ORDER --------------------*/
                $fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_date',$data[$x][0])->get()->result());
                $item_close = count($this->db->select('*')->from('request_item')->where('admin_close_date',$data[$x][0])->get()->result());
                $email_close = count($this->db->select('*')->from('request_email')->where('admin_close_date',$data[$x][0])->get()->result());
                $finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_date',$data[$x][0])->get()->result());
                $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where('admin_close_date',$data[$x][0])->get()->result());
                $data[$x][2] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close; 
            }
            return $data;
        }
        if($post['format'] == 'month'){
            $diff = $post['diff'];
            $mArr = $post['mArr'];  
            
            $mRangeData = array();                                      
                for($x=0;$x<=$diff;$x++){                   
                    $start = $mArr[$x][0];
                    $end = $mArr[$x][1];
                    /*---------------------- ACCEPT ORDER --------------------*/
                    $fix_accept = count($this->db->select('*')->from('request_fix')->where("admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $item_accept = count($this->db->select('*')->from('request_item')->where("admin_accept_date BETWEEN '$start' AND '$end' ")->get()->result());                       
                    /*---------------------- CLOSE ORDER --------------------*/
                    $fix_close = count($this->db->select('*')->from('request_fix')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $item_close = count($this->db->select('*')->from('request_item')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $email_close = count($this->db->select('*')->from('request_email')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $finger_close = count($this->db->select('*')->from('request_finger')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());
                    $itemotp_close = count($this->db->select('*')->from('request_itemotp')->where("admin_close_date BETWEEN '$start' AND '$end' ")->get()->result());                               
                    $mRangeData[$x][0] = $start;
                    $mRangeData[$x][1] = $fix_accept+$item_accept;          
                    $mRangeData[$x][2] = $fix_close+$item_close+$email_close+$finger_close+$itemotp_close;                                  
                } 
            // print_r($mRangeData);
            return $mRangeData;
        }
    }































}
?>