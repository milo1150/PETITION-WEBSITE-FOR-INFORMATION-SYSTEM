<?php
Class notification_data extends CI_Model{
    //INSERT DATA INTO NOTIFICATION DATABASE
    function insert($data){
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $type = $data['type'];
        $date_request = $data['date_request'];
        $time_request = $data['time_request'];
        $reqid = $data['reqid'];
        $username = $this->db->select('username')->from('admin_login')->get()->result();
        //READ AND WRITE FOR EACH ADMIN
        foreach($username as $row){
            $name = $row->username;
            $data_noti = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'type' => $type,
                'date_request'=> $date_request,
                'time_request'=> $time_request,
                'username' => $name,
                'reqid' => $reqid,
            );       
            $this->db->insert('noti_list',$data_noti);         
        }
    }

    function noti_data($reqid){
        $data = array(
            'data_fix' => $this->db->select('*')->from('request_fix')->where('reqid',$reqid)->get()->result(),
            'data_item' => $this->db->select('*')->from('request_item')->where('reqid',$reqid)->get()->result(),
            'data_email' => $this->db->select('*')->from('request_email')->where('reqid',$reqid)->get()->result(),
            'data_finger' => $this->db->select('*')->from('request_finger')->where('reqid',$reqid)->get()->result(),
            'max_id' => $this->db->select_max('id_scan')->from('request_finger')->get()->result(),
            'data_itemotp' => $this->db->select('*')->from('request_itemotp')->where('reqid',$reqid)->get()->result(),
        );                 
        return $data;
    }    
}
?>