<?php
Class ad_item_model extends CI_Model{ 
    ///////////////////////////////////////////////////// ad_item_order ////////////////////////////////////////////////
    function fecth_item_order(){
        $this->db->select('*');
        $this->db->where('order_status','0');
        $query = $this->db->get('request_item');
        $item = $query->result();        
        return $item;
    }    
    function fetch_item_report($id){
        $report  = $this->db->select('*')->from('request_item')->where('id',$id)->get()->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
			$date = $row->date;
            $time = $row->time;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $type = $row->type;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'date' => $date,
            'time' => $time,
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_item_accept_order ////////////////////////////////////////////////
    function accept_order($data){
        $this->db->set('order_status','1')->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_name',$data['ad_username'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_date',$data['accept_date'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_time',$data['accept_time'])->where('id',$data['id'])->update('request_item');
    }

    ///////////////////////////////////////////////////// ad_item_inproc ////////////////////////////////////////////////
    function fecth_item_inproc(){
        $this->db->select('*');
        $this->db->where('order_status','1');
        $query = $this->db->get('request_item');
        $item = $query->result();        
        return $item;
    }
    function fetch_item_report_inproc($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_item');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
			$item_list = $row->item_list;
			$date = $row->date;
            $time = $row->time;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $type = $row->type;
            $admin_accept_name = $row->admin_accept_name;	
            $admin_accept_date = $row->admin_accept_date;
            $admin_accept_time = $row->admin_accept_time;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'item_list' => $item_list,
            'date' => $date,
            'time' => $time,
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type,
            'admin_accept_name' => $admin_accept_name,
            'admin_accept_date' => $admin_accept_date,
            'admin_accept_time' => $admin_accept_time
        );
        return $report_data;
    }
    ///////////////////////////////////////////////////// ad_item_close_order ////////////////////////////////////////////////
    function close_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_date',$data['close_date'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_time',$data['close_time'])->where('id',$data['id'])->update('request_item');
    }

    ///////////////////////////////////////////////////// ad_item_com ////////////////////////////////////////////////
    function fecth_item_com(){
        $this->db->select('*');
        $this->db->where('order_status','2');
        $query = $this->db->get('request_item');
        $item = $query->result();        
        return $item;
    }
    function fetch_item_report_com($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_item');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
			$item_list = $row->item_list;
			$date = $row->date;
            $time = $row->time;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $type = $row->type;
            $admin_accept_name = $row->admin_accept_name;	
            $admin_accept_date = $row->admin_accept_date;
            $admin_accept_time = $row->admin_accept_time;
            $admin_close_name = $row->admin_close_name;	
            $admin_close_date = $row->admin_close_date;
            $admin_close_time = $row->admin_close_time;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'item_list' => $item_list,
            'date' => $date,
            'time' => $time,
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type,
            'admin_accept_name' => $admin_accept_name,
            'admin_accept_date' => $admin_accept_date,
            'admin_accept_time' => $admin_accept_time,
            'admin_close_name' => $admin_close_name,
            'admin_close_date' => $admin_close_date,
            'admin_close_time' => $admin_close_time
        );
        return $report_data;
    }

    ///////////////////////////////////////////////////// ad_item_cancle ////////////////////////////////////////////////
    function fecth_item_cancle(){
        $this->db->select('*');
        $this->db->where('order_status','3');
        $query = $this->db->get('request_item');
        $item = $query->result();        
        return $item;
    }
    ///////////////////////////////////////////////////// ad_item_cancle_order ////////////////////////////////////////////////
    function cancle_order($data){
        $this->db->set('order_status','3')->where('id',$data['id'])->update('request_item');
        $this->db->set('cancle_admin',$data['cancle_admin'])->where('id',$data['id'])->update('request_item');
        $this->db->set('cancle_date',$data['cancle_date'])->where('id',$data['id'])->update('request_item');
        $this->db->set('cancle_time',$data['cancle_time'])->where('id',$data['id'])->update('request_item');
        $this->db->set('cancle_detail',$data['cancle_detail'])->where('id',$data['id'])->update('request_item');
    }
    function fetch_item_order_cancle($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_item');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
			$item_list = $row->item_list;
			$date = $row->date;
            $time = $row->time;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $type = $row->type;
            $cancle_detail = $row->cancle_detail;
            $cancle_admin = $row->cancle_admin;
            $cancle_date = $row->cancle_date;
            $cancle_time = $row->cancle_time;
        }
        $report_data = array(
            'id' => $id,            
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'item_list' => $item_list,
            'date' => $date,
            'time' => $time,
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type,
            'cancle_detail' => $cancle_detail,
            'cancle_admin' => $cancle_admin,
            'cancle_date' => $cancle_date,
            'cancle_time' => $cancle_time
            
        );
        return $report_data;
    }

    //------------------------------------------------------------- (วัสดุ) ITEM PRODUCT ------------------------------------------------------
    //----------- Item Product List -------------
    function product_list(){
        $data = $this->db->select('*')->from('item_db_product')->get()->result();
        return $data;
    }
    //------------------------------------------------------------- (ครุภัณ)ITEM PRODUCT ID ------------------------------------------------------
    //----------- Item Product List -------------
    function product_id_list(){
        $data = $this->db->select('*')->from('item_db_product_id')->get()->result();
        return $data;
    }











}
?>