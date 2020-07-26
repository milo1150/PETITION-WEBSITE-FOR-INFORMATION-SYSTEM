<?php
Class ad_main_model extends CI_Model{
    public function remain_order(){
        $data_remain = array();
        $data_remain[0] = $this->db->select('*')->from('request_fix')->where('order_status',0)->get()->result();
        $data_remain[1] = $this->db->select('*')->from('request_item')->where('order_status',0)->get()->result();
        $data_remain[2] = $this->db->select('*')->from('request_email')->where('order_status',0)->get()->result();
        $data_remain[3] = $this->db->select('*')->from('request_finger')->where('order_status',0)->get()->result();
        $data_remain[4] = $this->db->select('*')->from('request_itemotp')->where('order_status',0)->get()->result();
        return $data_remain;
    }
    public function timeout_order($now_date,$now_time){
        //seperate to 2 data bcuz db only count present day and time
        //----------------- = Today ----------------
        $timeout[0] = $this->db->select('*')->from('request_fix')->where('order_status',1)->where(" date <= '$now_date' AND time <= '$now_time' ")->get()->result();
        $timeout[1] = $this->db->select('*')->from('request_item')->where('order_status',1)->where(" date <= '$now_date' AND time <= '$now_time' ")->get()->result();
        //----------------- < Today ----------------
        $timeout[2] = $this->db->select('*')->from('request_fix')->where('order_status',1)->where(" date < '$now_date' ")->get()->result();
        $timeout[3] = $this->db->select('*')->from('request_item')->where('order_status',1)->where(" date < '$now_date' ")->get()->result();
        return $timeout;
    }
    public function sidenav_order_count(){
        $sidenav_number = array();
        //------------------------------ รายการที่แจ้ง --------------------------
        $all_order = count($this->db->select('*')->from('request_fix')->where('order_status',0)->get()->result())
                +count($this->db->select('*')->from('request_item')->where('order_status',0)->get()->result())
                +count($this->db->select('*')->from('request_email')->where('order_status',0)->get()->result())
                +count($this->db->select('*')->from('request_finger')->where('order_status',0)->get()->result())
                +count($this->db->select('*')->from('request_itemotp')->where('order_status',0)->get()->result());
        $sidenav_number['request_all_order'] = $all_order;
        //------------------------------ รายการเกินเวลา ------------------------
        $now_date = date('Y-m-d',strtotime('now'));	$now_time = date('H:i');
        $timeout = count($this->db->select('*')->from('request_fix')->where('order_status',1)->where(" date <= '$now_date' AND time <= '$now_time' ")->get()->result())
                +count($this->db->select('*')->from('request_item')->where('order_status',1)->where(" date <= '$now_date' AND time <= '$now_time' ")->get()->result())
                +count($this->db->select('*')->from('request_fix')->where('order_status',1)->where(" date < '$now_date' ")->get()->result())
                +count($this->db->select('*')->from('request_item')->where('order_status',1)->where(" date < '$now_date' ")->get()->result());
        $sidenav_number['request_timeout'] =  $timeout;
        //------------------------------ แจ้งซ่อม ------------------------------
        $fix_order = count($this->db->select('*')->from('request_fix')->where('order_status',0)->get()->result());
        $fix_inproc = count($this->db->select('*')->from('request_fix')->where('order_status',1)->get()->result());
        $sidenav_number['fix_order'] = $fix_order;
        $sidenav_number['fix_inproc'] = $fix_inproc;
        //------------------------------ ยืมของ ------------------------------
        $item_order = count($this->db->select('*')->from('request_item')->where('order_status',0)->get()->result());
        $item_inproc = count($this->db->select('*')->from('request_item')->where('order_status',1)->get()->result());
        $sidenav_number['item_order'] = $item_order;
        $sidenav_number['item_inproc'] = $item_inproc;
        //------------------------------ เบิกของ ------------------------------
        $itemotp_order = count($this->db->select('*')->from('request_itemotp')->where('order_status',0)->get()->result());
        $sidenav_number['itemotp_order'] = $itemotp_order;
        //------------------------------ อีเมล์ ------------------------------
        $email_order = count($this->db->select('*')->from('request_email')->where('order_status',0)->get()->result());
        $sidenav_number['email_order'] = $email_order;
        //------------------------------ สแกนนิ้ว ------------------------------
        $finger_order = count($this->db->select('*')->from('request_finger')->where('order_status',0)->get()->result());
        $sidenav_number['finger_order'] = $finger_order;

        return $sidenav_number;
    }
}
?>