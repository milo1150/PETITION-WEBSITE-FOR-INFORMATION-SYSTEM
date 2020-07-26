<?php 
Class ad_report_model extends CI_Model{ 
    function admin_list(){
        $this->db->select('*');
        $query = $this->db->get('admin_login');
        $list = $query->result();        
        return $list;
    }
    function order_alltime($username){    
        /*-------------------------- 30 Days Loop --------------------*/             
        $day_count = [];
        $data = [];
        $day = strtotime('today');
        for($x=0;$x<=30;$x++){
            $day_count[$x] = date('d/m/Y',$day);
            $day = strtotime('-1 day',$day);           
            $fix = count($this->db->select('*')->from('request_fix')->where('admin_accept_name',$username)->where('admin_accept_date',$day_count[$x])->get()->result());
            $item = count($this->db->select('*')->from('request_item')->where('admin_accept_name',$username)->where('admin_accept_date',$day_count[$x])->get()->result());
            $email = count($this->db->select('*')->from('request_email')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $finger = count($this->db->select('*')->from('request_finger')->where('admin_close_name',$username)->where('admin_close_date',$day_count[$x])->get()->result());
            $data[$x] = $fix+$item+$email+$finger;   
            echo $day_count[$x].'='.$data[$x].' ';    
        }
        /*-------------------------- All time Loop --------------------*/
        $fix_accept = count($this->db->select('*')->from('request_fix')->where('admin_accept_name',$username)->get()->result());
        $item_accept = count($this->db->select('*')->from('request_item')->where('admin_accept_name',$username)->get()->result());
        $email_accept = count($this->db->select('*')->from('request_email')->where('admin_close_name',$username)->get()->result());
        $finger_accept = count($this->db->select('*')->from('request_finger')->where('admin_close_name',$username)->get()->result());
        $fix_close = count($this->db->select('*')->from('request_fix')->where('admin_close_name',$username)->get()->result());
        $item_close = count($this->db->select('*')->from('request_item')->where('admin_close_name',$username)->get()->result());
        $email_close = count($this->db->select('*')->from('request_email')->where('admin_close_name',$username)->get()->result());
        $finger_close = count($this->db->select('*')->from('request_finger')->where('admin_close_name',$username)->get()->result());
        $num_data = array(
            'username' => $username,
            'fix_accept' => $fix_accept,
            'item_accept' => $item_accept,
            'email_accept' => $email_accept,
            'finger_accept' => $finger_accept,
            'fix_close' => $fix_close,
            'item_close' => $item_close,
            'email_close' => $email_close,
            'finger_close' => $finger_close
        );
        return $num_data;
    }

    /*
    //////////////////////////////////////// SINGLE REPORT ///////////////////////////////////////////////
    function fetch_data_fix($ad_username){
        $this->db->select('id,admin_close_name,type,admin_accept_date,admin_close_date');
        $this->db->where('admin_close_name',$ad_username);
        $query = $this->db->get('request_fix');
        $fix = $query->result();        
        return $fix;        
    }  
    function fetch_data_item($ad_username){
        $this->db->select('id,admin_close_name,type,admin_accept_date,admin_close_date');
        $this->db->where('admin_close_name',$ad_username);
        $query = $this->db->get('request_item');
        $item = $query->result();
        return $item;
    }
    function fetch_data_email($ad_username){        
        $this->db->select('id,admin_close_name,type,"-" as "admin_accept_date",admin_close_date');
        $this->db->where('admin_close_name',$ad_username);
        $query = $this->db->get('request_email');	
        $email = $query->result();
        return $email;
    }
    function fetch_data_finger($ad_username){
        $this->db->select('id,admin_close_name,type,"-" as "admin_accept_date",admin_close_date');
        $this->db->where('admin_close_name',$ad_username);
        $query = $this->db->get('request_finger');
        $finger = $query->result();
        return $finger;
    }

    //////////////////////////////////////// GROUP REPORT ///////////////////////////////////////////////
    function fetch_data_group_fix(){
        $group_fix = $this->db->query('SELECT `id`,`admin_close_name`,`type`,`admin_accept_date`,`admin_close_date` FROM request_fix WHERE admin_close_date');	               
        return $group_fix->result();         
    }
    function fetch_data_group_item(){
        $group_item = $this->db->query('SELECT `id`,`admin_close_name`,`type`,`admin_accept_date`,`admin_close_date` FROM request_item WHERE admin_close_date');	               
        return $group_item->result();         
    }
    function fetch_data_group_email(){
        $this->db->select('id,admin_close_name,type,"-" as "admin_accept_date",admin_close_date');
        $query = $this->db->get('request_email');	
        $group_email = $query->result();
        return $group_email;         
    }
    function fetch_data_group_finger(){
        $this->db->select('id,admin_close_name,type,"-" as "admin_accept_date",admin_close_date');
        $query = $this->db->get('request_finger');
        $group_finger = $query->result();
        return $group_finger;
    }
    */    
    
}
?>
