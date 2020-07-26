<?php
Class ad_fix_model extends CI_Model{ 
    ///////////////////////////////////////////////////// ad_fix_order ////////////////////////////////////////////////
    function fecth_fix_order(){
        $this->db->select('*');
        $this->db->where('order_status','0');
        $query = $this->db->get('request_fix');
        $fix = $query->result();        
        return $fix;
    }
    function fetch_fix_report($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_fix');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $fixlist = $row->fixlist;
            $fixprob = $row->fixprob;
            $type = $row->type;
            $email = $row->email;
            $building = $row->building;
            $floor = $row->floor;
            $room = $row->room;
            $date = $row->date;
            $time = $row->time;
        }
        $report_data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'fixlist' => $fixlist,
            'fixprob' => $fixprob,
            'type' => $type,
            'email' => $email,
            'building' => $building,
            'floor' => $floor,
            'room' => $room,           
            'date' => $date,
            'time' => $time,          
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_fix_accept_order ////////////////////////////////////////////////
    function accept_order($data){
        $this->db->set('order_status','1')->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_accept_name',$data['ad_username'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_accept_date',$data['accept_date'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_accept_time',$data['accept_time'])->where('id',$data['id'])->update('request_fix');
    }
    ///////////////////////////////////////////////////// ad_fix_inproc ////////////////////////////////////////////////
    function fecth_fix_inproc(){
        $this->db->select('*');
        $this->db->where('order_status','1');
        $query = $this->db->get('request_fix');
        $fix = $query->result();        
        return $fix;
    }
    function fetch_fix_report_inproc($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_fix');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $fixlist = $row->fixlist;
            $fixprob = $row->fixprob;
            $type = $row->type;
            $email = $row->email;
            $building = $row->building;
            $floor = $row->floor;
            $room = $row->room;
            $date = $row->date;
            $time = $row->time;
            $admin_accept_name = $row->admin_accept_name;
            $admin_accept_date = $row->admin_accept_date;
            $admin_accept_time = $row->admin_accept_time;
        }
        $report_data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'fixlist' => $fixlist,
            'fixprob' => $fixprob,
            'type' => $type,
            'email' => $email,
            'building' => $building,
            'floor' => $floor,
            'room' => $room,           
            'date' => $date,
            'time' => $time,      
            'admin_accept_name' => $admin_accept_name,
            'admin_accept_date' => $admin_accept_date,
            'admin_accept_time' => $admin_accept_time   
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_fix_close_order ////////////////////////////////////////////////
    function close_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_close_date',$data['close_date'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_close_time',$data['close_time'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('admin_comment',$data['ad_comment'])->where('id',$data['id'])->update('request_fix');
    }
    ///////////////////////////////////////////////////// ad_fix_com /////////////////////////////////////////////////////////
    function fecth_fix_com(){
        $this->db->select('*');
        $this->db->where('order_status','2');
        $query = $this->db->get('request_fix');
        $fix = $query->result();        
        return $fix;
    }
    function fetch_fix_report_com($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_fix');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $fixlist = $row->fixlist;
            $fixprob = $row->fixprob;
            $type = $row->type;
            $email = $row->email;
            $building = $row->building;
            $floor = $row->floor;
            $room = $row->room;
            $date = $row->date;
            $time = $row->time;
            $admin_accept_name = $row->admin_accept_name;
            $admin_accept_date = $row->admin_accept_date;
            $admin_accept_time = $row->admin_accept_time;
            $admin_close_name = $row->admin_close_name;	
            $admin_close_date = $row->admin_close_date;
            $admin_close_time = $row->admin_close_time;
            $admin_comment = $row->admin_comment;
        }
        $report_data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'fixlist' => $fixlist,
            'fixprob' => $fixprob,
            'type' => $type,
            'email' => $email,
            'building' => $building,
            'floor' => $floor,
            'room' => $room,           
            'date' => $date,
            'time' => $time,      
            'admin_accept_name' => $admin_accept_name,
            'admin_accept_date' => $admin_accept_date,
            'admin_accept_time' => $admin_accept_time,
            'admin_close_name' => $admin_close_name,
            'admin_close_date' => $admin_close_date,
            'admin_close_time' => $admin_close_time,
            'admin_comment' => $admin_comment
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_fix_cancle ////////////////////////////////////////////////
    function fecth_fix_cancle(){
        $item = $this->db->select('*')->from('request_fix')->where('order_status','3')->get()->result();        
        return $item;
    }
    ///////////////////////////////////////////////////// ad_fix_cancle_order ////////////////////////////////////////////////
    function cancle_order($data){
        $this->db->set('order_status','3')->where('id',$data['id'])->update('request_fix');
        $this->db->set('cancle_admin',$data['cancle_admin'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('cancle_date',$data['cancle_date'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('cancle_time',$data['cancle_time'])->where('id',$data['id'])->update('request_fix');
        $this->db->set('cancle_detail',$data['cancle_detail'])->where('id',$data['id'])->update('request_fix');
    }
    function fetch_fix_order_cancle($id){
        $query = $this->db->select('*')->from('request_fix')->where('id',$id)->get()->result();        
        foreach($query as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $fixlist = $row->fixlist;
            $fixprob = $row->fixprob;
            $type = $row->type;
            $email = $row->email;
            $building = $row->building;
            $floor = $row->floor;
            $room = $row->room;
            $date = $row->date;
            $time = $row->time;
            $cancle_detail = $row->cancle_detail;
            $cancle_admin = $row->cancle_admin;
            $cancle_date = $row->cancle_date;
            $cancle_time = $row->cancle_time;
        }
        $report_data = array(
            'id' => $id,    
            'date_request' => $date_request,
            'time_request' => $time_request,        
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'fixlist' => $fixlist,
            'fixprob' => $fixprob,
            'type' => $type,
            'email' => $email,
            'building' => $building,
            'floor' => $floor,
            'room' => $room,            
            'date' => $date,
            'time' => $time,                                   
            'cancle_detail' => $cancle_detail,
            'cancle_admin' => $cancle_admin,
            'cancle_date' => $cancle_date,
            'cancle_time' => $cancle_time           
        );
        return $report_data;
    }

    //---------------------------------------------------------- Filter Serch ----------------------------------------------------------------
    function filter_data($data){
        //---------------------- $data[0] = fixlist , $data[1] = builing , $data[2] = floor , $data[3] = room --------------------------------
        //0000
        if($data[0]==null && $data[1]==null && $data[2]==null && $data[3]==null){     
            $r_data = $this->db->select('*')->from('request_fix')->where("fixlist = '$data[0]' AND building = '$data[1]' AND floor = '$data[2]' AND room = '$data[3]' ")->get()->result();       
            //echo '0000';
            return $r_data;            
        }        
        //0001
        if($data[0]==null && $data[1]==null && $data[2]==null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('room',$data[3])->get()->result();
            //echo '0001';
            return $r_data;            
        }         
        //0010
        if($data[0]==null && $data[1]==null && $data[2]!=null && $data[3]==null){
            $r_data = $this->db->select('*')->from('request_fix')->where('floor',$data[2])->get()->result();
            //echo '0010';
            return $r_data;            
        }
        //0011
        if($data[0]==null && $data[1]==null && $data[2]!=null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('floor',$data[2])->where('room',$data[3])->get()->result();
            //echo '0011';
            return $r_data;            
        }
        //0100
        if($data[0]==null && $data[1]!=null && $data[2]==null && $data[3]==null){
            $r_data = $this->db->select('*')->from('request_fix')->where('building',$data[1])->get()->result();
            //echo '0100';
            return $r_data;            
        }
        //0101
        if($data[0]==null && $data[1]!=null && $data[2]==null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('building',$data[1])->where('room',$data[3])->get()->result();
            //echo '0101';
            return $r_data;            
        }
        //0110
        if($data[0]==null && $data[1]!=null && $data[2]!=null && $data[3]==null){
            $r_data = $this->db->select('*')->from('request_fix')->where('building',$data[1])->where('floor',$data[2])->get()->result();
            //echo '0110';
            return $r_data;            
        }
        //0111
        if($data[0]==null && $data[1]!=null && $data[2]!=null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('building',$data[1])->where('floor',$data[2])->where('room',$data[3])->get()->result();
            //echo '0111';
            return $r_data;            
        }
        //1000
        if($data[0]!=null && $data[1]==null && $data[2]==null && $data[3]==null){
            $r_data = $this->db->select('*')->from('request_fix')->where('fixlist',$data[0])->get()->result();
            //echo '1000';
            return $r_data;            
        }
        //1001
        if($data[0]!=null && $data[1]==null && $data[2]==null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('fixlist',$data[0])->where('room',$data[3])->get()->result();
            //echo '1001';
            return $r_data;            
        }
        //1010
        if($data[0]!=null && $data[1]==null && $data[2]!=null && $data[3]==null){
            $r_data = $this->db->select('*')->from('request_fix')->where('fixlist',$data[0])->where('floor',$data[2])->get()->result();
            //echo '1010';
            return $r_data;            
        }
        //1011
        if($data[0]!=null && $data[1]==null && $data[2]!=null && $data[3]!=null){
            $r_data = $this->db->select('*')->from('request_fix')->where('fixlist',$data[0])->where('floor',$data[2])->where('room',$data[3])->get()->result();
            //echo '1011';
            return $r_data;            
        }
        //1100
        if($data[0]!=null && $data[1]!=null && $data[2]==null && $data[3]==null){
            //echo '1100';
            $r_data = $this->db->select('*')->from('request_fix')->like('fixlist',$data[0])->like('building',$data[1])->get()->result();
            return $r_data;            
        }        
        //1101
        if($data[0]!=null && $data[1]!=null && $data[2]==null && $data[3]!=null){
            //echo '1101';
            $r_data = $this->db->select('*')->from('request_fix')->like('fixlist',$data[0])->like('building',$data[1])->where('room',$data[3])->get()->result();
            return $r_data;            
        } 
        //1110
        if($data[0]!=null && $data[1]!=null && $data[2]!=null && $data[3]==null){
            //echo '1110';
            $r_data = $this->db->select('*')->from('request_fix')->like('fixlist',$data[0])->like('building',$data[1])->where('floor',$data[2])->get()->result();
            return $r_data;            
        }
        //1111
        if($data[0]!=null && $data[1]!=null && $data[2]!=null && $data[3]!=null){
            //echo '1111';
            $r_data = $this->db->select('*')->from('request_fix')->like('fixlist',$data[0])->like('building',$data[1])->where('floor',$data[2])->where('room',$data[3])->get()->result();
            return $r_data;            
        }
                
    }
















}
?>