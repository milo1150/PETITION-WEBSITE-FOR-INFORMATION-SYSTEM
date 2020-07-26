<?php
Class ad_itemotp_model extends CI_Model{
    ///////////////////////////////////////////////////// ad_itemotp_order ////////////////////////////////////////////////
    function fecth_item_order(){    
        $item = $this->db->select('*')->from('request_itemotp')->where('order_status',0)->get()->result(); 
        return $item;
    }    
    function fetch_item_report($id){
        $report  = $this->db->select('*')->from('request_itemotp')->where('id',$id)->get()->result();
        // change OBJ to array
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
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
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type
        );
        return $report_data;
    }
    //------------------------------- report_item_order item information (get item list with md5) ------------------------------
    function report_item_list($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_itemotp')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_itemotp_list')->where('reqid',$md5id)->get()->result();
        return $item_list;
    }

    //////////////////////////////////////////////////////// ad_itemotp_close_order /////////////////////////////////////////////////////////////
    function accept_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('admin_close_date',$data['accept_date'])->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('admin_close_time',$data['accept_time'])->where('id',$data['id'])->update('request_itemotp');
    }
    //------------------------------update item_remain & item_out-----------------------------------
    function item_recount($item_type,$item_name,$item_unit){
        if($item_type == "วัสดุ"){
            //---- product_item_remain ----
            $remain = $this->db->select('item_unit_remain')->from('itemotp_db_product')->where('item_type',$item_type)->where('item_name',$item_name)->get()->result();
            foreach($remain as $col){
                $remain = $col->item_unit_remain;
            }
            $item_unit_remain = $remain - $item_unit;

            $this->db->set('item_unit_remain',$item_unit_remain)->where('item_type',$item_type)->where('item_name',$item_name)->update('itemotp_db_product');
        }
    }
    //------------------------------ update request information -----------------------------------
    function item_information_update($id,$req_data){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_itemotp')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };

        //------------ Update request_item_list_detail -------------
        $max_req_data = count($req_data);
		for($i=0;$i<$max_req_data;$i++){
			if($req_data[$i]!=null){
                $item_type = $req_data[$i][0];
                //--------------------- $item_type = product_otp ------------------------
                if($item_type == "วัสดุ"){   
                    $item_name = $req_data[$i][1];                
                    $item_unit = $req_data[$i][2];
                    $this->db->set('item_get',$item_unit)->where('item_name',$item_name)->where('reqid',$md5id)->update('request_itemotp_list');
                }                
            }
        }
        
        //print_r($select_data);
    }
    
    ///////////////////////////////////////////////////////////// ad_item_com ////////////////////////////////////////////////////////////////////
    function fecth_item_com(){
        $item = $this->db->select('*')->where('order_status','2')->from('request_itemotp')->get()->result();     
        return $item;
    }
    function fetch_item_report_com($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_itemotp');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
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
            'phonenum' => $phonenum,
            'email' => $email,
            'section' => $section,
            'date_request' => $date_request,
            'time_request' => $time_request,            
            'type' => $type,
            'admin_close_name' => $admin_close_name,
            'admin_close_date' => $admin_close_date,
            'admin_close_time' => $admin_close_time
        );
        return $report_data;
    }
    //------------------------------- report_itemotp complete item information (get item list with md5) ------------------------------
    function report_itemotp_com_list($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_itemotp')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_itemotp_list')->where('reqid',$md5id)->get()->result();
        return $item_list;
    }

    ///////////////////////////////////////////////////// ad_item_cancle ////////////////////////////////////////////////
    function fecth_item_cancle(){
        $item = $this->db->select('*')->where('order_status','3')->from('request_itemotp')->get()->result();      
        return $item;
    }

    ///////////////////////////////////////////////////// ad_item_cancle_order ////////////////////////////////////////////////
    function cancle_order($data){
        $this->db->set('order_status','3')->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('cancle_admin',$data['cancle_admin'])->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('cancle_date',$data['cancle_date'])->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('cancle_time',$data['cancle_time'])->where('id',$data['id'])->update('request_itemotp');
        $this->db->set('cancle_detail',$data['cancle_detail'])->where('id',$data['id'])->update('request_itemotp');
    }
    function fetch_item_order_cancle($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_itemotp');
        $report = $query->result();
        foreach($report as $row){
            $id = $row->id;            
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $phonenum = $row->phonenum;
            $email = $row->email;
            $section = $row->section;
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
    function product_list(){
        $data = $this->db->select('*')->from('itemotp_db_product')->get()->result();
        return $data;
    }
    //--------------------------------------------------------------- item_product_id LOG ---------------------------------------------------------
    function itemotp_log(){
        $data = $this->db->select('*')->from('itemotp_db_product_log')->get()->result();
        return $data;
    }
    //---------------------- INSERT LOG (ADD & DELETE) --------------------
    //----------- INSERT LOG (Add) ----------
    function itemotp_insert_log_add($ad_username,$item_name,$item_unit){                           
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'เพิ่ม',  
            'item_id' => '-',          
            'item_name' => $item_name,
            'item_unit' => $item_unit,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('itemotp_db_product_log',$data);
    }
    //----------- INSERT LOG (Del) ----------
    function itemotp_insert_log_del($item_id,$ad_username,$item_name,$item_unit){                           
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'ลบ',  
            'item_id' => $item_id,          
            'item_name' => $item_name,
            'item_unit' => $item_unit,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('itemotp_db_product_log',$data);
    }
    //----------- INSERT LOG (Edit) ----------
    function itemotp_insert_log_edit($item_id,$ad_username,$item_old_name,$item_new_name,$item_old_unit,$item_new_unit){                           
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'แก้ไข',  
            'item_id' => $item_id,          
            'item_name' => $item_old_name.' > '.$item_new_name,
            'item_unit' => $item_old_unit.' > '.$item_new_unit,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('itemotp_db_product_log',$data);
    }
    //----------------------------------------------------------- History ---------------------------------------------------------
    function otp_history_list($item_name){
        $query1 = $this->db->select('reqid')->where('item_name',$item_name)->from('request_itemotp_list')->get()->result_array();
        //print_r($query1);
        //foreach เพราะ วนลูปข้างใน $query1 (result_array) ใส่เข้า $data
        $i=0;
        $data = array();
        foreach($query1 as $query1){
            $reqid = $query1['reqid'];
            $query2 = $this->db->select('*')->where('reqid',$reqid)->from('request_itemotp')->get()->result();
            $data[$i] = $query2;
            $i++;
        }
        //print_r($data);
        return $data;
    }
























}
?>