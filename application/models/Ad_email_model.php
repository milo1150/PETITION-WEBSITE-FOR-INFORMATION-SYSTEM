<?php
Class ad_email_model extends CI_Model{ 
    ///////////////////////////////////////////////////// ad_email_order ////////////////////////////////////////////////
    function fecth_email_order(){
        $this->db->select('*');
        $this->db->where('order_status','0');
        $query = $this->db->get('request_email');
        $item = $query->result();        
        return $item;
    }
    function fetch_email_report($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_email');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $firstnameth = $row->firstnameth;															
            $lastnameth = $row->lastnameth;
            $phonenum = $row->phonenum;
            $phonein = $row->phonein;	
            $email = $row->email;
            $section = $row->section;            
            $rank = $row->rank;
            $date_request = $row->date_request;
			$time_request = $row->time_request;		
            $type = $row->type;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'firstnameth' => $firstnameth,
            'lastnameth' => $lastnameth,
            'phonenum' => $phonenum,
            'phonein' => $phonein,
            'email' => $email,
            'section' => $section,            
            'rank' => $rank,      
            'date_request' => $date_request,
            'time_request' => $time_request,      
            'type' => $type,
            
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_finger_accept_order ////////////////////////////////////////////////
    function accept_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_email');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_email');
        $this->db->set('admin_close_date',$data['accept_date'])->where('id',$data['id'])->update('request_email');
        $this->db->set('admin_close_time',$data['close_time'])->where('id',$data['id'])->update('request_email');
    }
    ///////////////////////////////////////////////////// ad_email_com ////////////////////////////////////////////////
    function fecth_email_com(){
        $this->db->select('*');
        $this->db->where('order_status','2');
        $query = $this->db->get('request_email');
        $item = $query->result();        
        return $item;
    }
    function report_email_com($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_email');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $firstnameth = $row->firstnameth;															
            $lastnameth = $row->lastnameth;
            $phonenum = $row->phonenum;
            $phonein = $row->phonein;	
            $email = $row->email;
            $section = $row->section;            
            $rank = $row->rank;
            $date_request = $row->date_request;
			$time_request = $row->time_request;		
            $type = $row->type;
            $admin_close_name = $row->admin_close_name;	
            $admin_close_date = $row->admin_close_date;
            $admin_close_time = $row->admin_close_time;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'firstnameth' => $firstnameth,
            'lastnameth' => $lastnameth,
            'phonenum' => $phonenum,
            'phonein' => $phonein,
            'email' => $email,
            'section' => $section,            
            'rank' => $rank,      
            'date_request' => $date_request,
            'time_request' => $time_request,      
            'type' => $type,
            'admin_close_name' => $admin_close_name,
            'admin_close_date' => $admin_close_date,
            'admin_close_time' => $admin_close_time
        );
        return $report_data;
    }
}
?>