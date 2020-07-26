<?php
Class ad_finger_model extends CI_Model{ 
    ///////////////////////////////////////////////////// ad_finger_order ////////////////////////////////////////////////
    function fecth_finger_order(){
        $this->db->select('*');
        $this->db->where('order_status','0');
        $query = $this->db->get('request_finger');
        $item = $query->result();        
        return $item;
    }
    function fetch_finger_report($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_finger');        
        $report = $query->result();
        foreach($report as $row){           
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $phonein = $row->phonein;	
            $email = $row->email;
            $section = $row->section;            
            $rank = $row->rank;
            $date_request = $row->date_request;
			$time_request = $row->time_request;
            $type = $row->type;
            $userid = $row->userid;
        }
        $max_id = $this->db->select_max('id_scan')->from('request_finger')->get()->result();
        foreach($max_id as $row){
            $id_scan = $row->id_scan;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'phonein' => $phonein,
            'email' => $email,
            'section' => $section,            
            'rank' => $rank,      
            'date_request' => $date_request,
            'time_request' => $time_request,      
            'type' => $type,  
            'max_id' => $id_scan+1,       
            'userid' => $userid   
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_finger_accept_order ////////////////////////////////////////////////
    function check_id_scan($id_scan){
        $check = $this->db->select('id_scan')->where('id_scan',$id_scan)->from('request_finger')->get()->num_rows();
        if($check > 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function accept_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_finger');
        $this->db->set('id_scan',$data['id_scan'])->where('id',$data['id'])->update('request_finger');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_finger');
        $this->db->set('admin_close_date',$data['accept_date'])->where('id',$data['id'])->update('request_finger');
        $this->db->set('admin_close_time',$data['close_time'])->where('id',$data['id'])->update('request_finger');
    }

    ///////////////////////////////////////////////////// ad_finger_com ////////////////////////////////////////////////
    function fecth_finger_com(){
        $this->db->select('*');
        $this->db->where('order_status','2');
        $query = $this->db->get('request_finger');
        $item = $query->result();        
        return $item;
    }
    function report_finger_com($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_finger');        
        $report = $query->result();
        foreach($report as $row){           
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $phonein = $row->phonein;	
            $email = $row->email;
            $section = $row->section;            
            $rank = $row->rank;
            $date_request = $row->date_request;
			$time_request = $row->time_request;
            $type = $row->type;
            $id_scan = $row->id_scan;
            $admin_close_name = $row->admin_close_name;
            $admin_close_date = $row->admin_close_date;
            $admin_close_time = $row->admin_close_time;
            $userid = $row->userid;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'phonein' => $phonein,
            'email' => $email,
            'section' => $section,            
            'rank' => $rank,      
            'date_request' => $date_request,
            'time_request' => $time_request,      
            'type' => $type,         
            'id_scan' => $id_scan,
            'admin_close_name' => $admin_close_name,
            'admin_close_date' => $admin_close_date,
            'admin_close_time' => $admin_close_time,
            'userid' => $userid 
        );
        return $report_data;
    }

    //------------------------------------------------------- Finger Report --------------------------------------------------------------------
    public function finger_report(){
        $data = $this->db->select('*')->from('request_finger')->where('order_status',2)->get()->result();
        return $data;
    }
}
?>