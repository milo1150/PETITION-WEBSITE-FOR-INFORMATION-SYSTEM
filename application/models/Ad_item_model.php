<?php
Class ad_item_model extends CI_Model{ 
    ///////////////////////////////////////////////////// ad_item_order ////////////////////////////////////////////////
    function fecth_item_order(){    
        $item = $this->db->select('*')->from('request_item')->where('order_status',0)->get()->result(); 
        return $item;
    }    
    function fetch_item_report($id){
        $report  = $this->db->select('*')->from('request_item')->where('id',$id)->get()->result();
        // change OBJ to array
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
    //------------------------------- report_item_order item information (get item list with md5) ------------------------------
    function report_item_list($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_item')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };
        //echo $md5id;

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_item_list')->where('reqid',$md5id)->get()->result();
        return $item_list;
    }
    //-------------------------------report_item_order get product_id with md5 ------------------------------
    function report_item_list_pd_id($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_item')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_item_list')->where('reqid',$md5id)->get()->result();

        //---- select product_id ------
        $name = array();
        $i = 0;
        foreach($item_list as $col){
            if($col->item_type == "ครุภัณฑ์"){
                $item_type = $col->item_type;
                $item_name = $col->item_name;                
                $pd_id = $this->db->select('item_id')->from('item_db_product_id')->where('item_type',$item_type)->where('item_name',$item_name)->where('item_status',0)->get()->result_array();
                //echo $item_type;
                //echo $item_name;                                                        
                //echo '<br/>';
                //print_r($pd_id);
                
                //echo $count;               

                //---- $count != '0' เพื่อเอาแค่ ครุภัณฑ์ ที่มีเลขเท่านั้น ----
                $count = count($pd_id);
                if($count != '0'){
                    for($j=0;$j<$count;$j++){                    
                        $name[$i][$j] = $pd_id[$j];                    
                    }
                    $i++;
                }                
                 
                
            } 
                       
        }
        //print_r($name);
        return $name;
        
    }
    


    ///////////////////////////////////////////////////// ad_item_accept_order ////////////////////////////////////////////////
    function accept_order($data){
        $this->db->set('order_status','1')->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_name',$data['ad_username'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_date',$data['accept_date'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_accept_time',$data['accept_time'])->where('id',$data['id'])->update('request_item');
    }
    //------------------------------update item_remain & item_out-----------------------------------
    function item_recount($item_type,$item_name,$item_unit){
        if($item_type == "วัสดุ"){
            //---- product_item_remain ----
            $remain = $this->db->select('item_unit_remain')->from('item_db_product')->where('item_type',$item_type)->where('item_name',$item_name)->get()->result();
            foreach($remain as $col){
                $remain = $col->item_unit_remain;
            }
            $item_unit_remain = $remain - $item_unit;

            //---- product_item_out ----
            $out = $this->db->select('item_unit_out')->from('item_db_product')->where('item_type',$item_type)->where('item_name',$item_name)->get()->result();
            foreach($out as $col){
                $out = $col->item_unit_out;
            }
            $item_unit_out = $out + $item_unit;
            $this->db->set('item_unit_remain',$item_unit_remain)->where('item_type',$item_type)->where('item_name',$item_name)->update('item_db_product');
            $this->db->set('item_unit_out',$item_unit_out)->where('item_type',$item_type)->where('item_name',$item_name)->update('item_db_product');
        }
    }
    //------------------------------ update request information -----------------------------------
    function item_information_update($id,$req_data,$select_data){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_item')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };

        //------------ Update request_item_list_detail -------------
        $max_req_data = count($req_data);
        $j = 0; //ไว้นอก loop if($req_data[$i]!=null)
		for($i=0;$i<$max_req_data;$i++){
			if($req_data[$i]!=null){
                $item_type = $req_data[$i][0];
                //--------------------- $item_type = product ------------------------
                if($item_type == "วัสดุ"){
                    $data = array(
                        'reqid' => $md5id,
                        'item_type' => $req_data[$i][0],
                        'item_name' => $req_data[$i][1],
                        'item_unit' => $req_data[$i][2],                       
                    );
                    $this->db->insert('request_item_list_detail',$data);
                }
                //-------------------- $item_type = product_id ---------------------                
                if($item_type == "ครุภัณฑ์"){                    
                    $item_name = $req_data[$i][1];
                    $item_unit = $req_data[$i][2];                         
                    $select_data_length = count($select_data); // ขนาดของ select_data
                    //echo $select_data_length;    
                    if($j < $select_data_length){
                        $select_data_positionJ_length = count($select_data[$j]); // ตำแหน่งทั้งหมดใน $select_data ตำแหน่งที่ $j
                        for($k=0;$k<$select_data_positionJ_length;$k++){ //ไล่ที่ละตำแหน่งใน $select_data $j loop นอก &k loop ใน                           
                            $data = array(
                                'reqid' => $md5id,
                                'item_type' => $item_type,
                                'item_name' => $item_name,
                                'item_id' => $select_data[$j][$k],
                            );
                            //print_r($data);
                            $this->db->insert('request_item_list_detail',$data);
                        }                        
                    }                     
                    $j++;
               }
            }
        }
        
        //print_r($select_data);
    }

    ///////////////////////////////////////////////////// ad_item_inproc ////////////////////////////////////////////////
    function fecth_item_inproc(){     
        $item = $this->db->select('*')->from('request_item')->where('order_status','1')->get()->result();
        return $item;
    }
    function fetch_item_report_inproc($id){
        $report = $this->db->select('*')->from('request_item')->where('id',$id)->get()->result();
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
    //------------------------------- report_item_inproc item information (get item list with md5) ------------------------------
    function report_inproc_item_list($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_item')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };
        //echo $md5id;

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_item_list')->where('reqid',$md5id)->get()->result();
        return $item_list;
    }
    function report_inproc_item_list_detail($id){
        //---- get md5 order from request_item table ----
        $reqid = $this->db->select('reqid')->from('request_item')->where('id',$id)->get()->result();
        foreach($reqid as $row){
            $md5id = $row->reqid;
        };
        //echo $md5id;

        //---- select all item list by md5 ----
        $item_list = $this->db->select('*')->from('request_item_list_detail')->where('reqid',$md5id)->get()->result();
        return $item_list;
    }
    ///////////////////////////////////////////////////// ad_item_close_order ////////////////////////////////////////////////
    function close_order($data){
        $this->db->set('order_status','2')->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_name',$data['ad_username'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_date',$data['close_date'])->where('id',$data['id'])->update('request_item');
        $this->db->set('admin_close_time',$data['close_time'])->where('id',$data['id'])->update('request_item');
    }
    //------------------------------update item_remain & item_out-----------------------------------
    function item_restock($req_detail){
        $req_detail_length = count($req_detail);
        for($i=0;$i<$req_detail_length;$i++){
            $item_type = $req_detail[$i][0];
            //--------------------------- product -----------------------------
            if($item_type == "วัสดุ"){
                $item_name = $req_detail[$i][1];
                $item_unit = $req_detail[$i][2];
                //----- product_item_remain ------
                $remain = $this->db->select('item_unit_remain')->from('item_db_product')->where('item_type',$item_type)->where('item_name',$item_name)->get()->result();
                foreach($remain as $col){
                    $remain = $col->item_unit_remain;
                }
                $item_unit_remain = $remain + $item_unit;
    
                //----- product_item_out -----
                $out = $this->db->select('item_unit_out')->from('item_db_product')->where('item_type',$item_type)->where('item_name',$item_name)->get()->result();
                foreach($out as $col){
                    $out = $col->item_unit_out;
                }
                $item_unit_out = $out - $item_unit;

                //----- Update new value to DB -----
                $this->db->set('item_unit_remain',$item_unit_remain)->where('item_type',$item_type)->where('item_name',$item_name)->update('item_db_product');
                $this->db->set('item_unit_out',$item_unit_out)->where('item_type',$item_type)->where('item_name',$item_name)->update('item_db_product');           
            }
            //--------------------------- product_id -----------------------------
            if($item_type == "ครุภัณฑ์"){
                $item_name = $req_detail[$i][1];
                $item_id = $req_detail[$i][2];
                $this->db->set('item_status',0)->where('item_id',$item_id)->where('item_name',$item_name)->update('item_db_product_id');
            }
        }
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
    //--------------------------------------------------------------- item product LOG ---------------------------------------------------------
    function item_product_log(){
        $data = $this->db->select('*')->from('item_db_product_log')->get()->result();
        return $data;
    }
    //---------------------- INSERT LOG (ADD & DELETE) --------------------
    //----------- INSERT LOG (Add) ----------
    function pd_insert_log_add($ad_username,$item_name,$item_unit){                           
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
        $this->db->insert('item_db_product_log',$data);
    }
    //----------- INSERT LOG (Del) ----------
    function pd_insert_log_del($id,$ad_username,$item_name,$item_unit){
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'ลบ',
            'item_id' => $id,
            'item_name' => $item_name,
            'item_unit' => $item_unit,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('item_db_product_log',$data);        
    }
    //----------- update new item_unit_all & item_unit_remain **ต้องคำนวณเพราะอาจจะทำให้ระบบบัค ---------  
    function product_edit_updatedata($id,$item_name,$item_unit_all,$ad_name,$item_units){    
        //----- เอาค่าเก่ามาประกาศเทียบกับค่าใหม่ ----
        $old_item_name_fetch = $this->db->select('item_name')->where('id',$id)->from('item_db_product')->get()->result_array();
        $old_item_unit_fetch = $this->db->select('item_unit_all')->where('id',$id)->from('item_db_product')->get()->result_array(); 
        $old_item_name = $old_item_name_fetch[0]['item_name'];
        $old_item_unit = $old_item_unit_fetch[0]['item_unit_all']; 
        $new_name_edit = $item_name;
        $new_unit_edit = $item_unit_all;
        //--------------------- select item_out from db for calculate new item_remain ------------------  
		$item_remain_query = $this->db->select('item_unit_out')->from('item_db_product')->where('id',$id)->get()->result_array();
		$item_remain = $item_remain_query[0]['item_unit_out'];
        $item_remain = $item_unit_all-$item_remain;
        $this->db->set('item_name',$new_name_edit)->where('id',$id)->update('item_db_product');
        $this->db->set('item_units',$item_units)->where('id',$id)->update('item_db_product');
		$this->db->set('item_unit_all',$new_unit_edit)->where('id',$id)->update('item_db_product');
        $this->db->set('item_unit_remain',$item_remain)->where('id',$id)->update('item_db_product');
        
        //---------------------- INSERT LOG --------------------                     
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'แก้ไข',
            'item_id' => $id,
            'item_name' => $old_item_name.' > '.$new_name_edit,
            'item_unit' => $old_item_unit.' > '.$new_unit_edit,
            'ad_name' => $ad_name,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('item_db_product_log',$data);
    }
    
    //------------------------------------------------------------- (ครุภัณ)ITEM PRODUCT ID ------------------------------------------------------
    //----------- Item Product List -------------
    function product_id_list(){
        $data = $this->db->select('*')->from('item_db_product_id')->get()->result();
        return $data;
    }
    //--------------------------------------------------------------- item_product_id LOG ---------------------------------------------------------
    function item_product_id_log(){
        $data = $this->db->select('*')->from('item_db_product_id_log')->get()->result();
        return $data;
    }
    //---------------------- INSERT LOG (ADD & DELETE) --------------------
    //----------- INSERT LOG (Add) ----------
    function pdid_insert_log_add($item_name,$item_id,$ad_username){                           
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'เพิ่ม',            
            'item_name' => $item_name,
            'item_id' => $item_id,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('item_db_product_id_log',$data);
    }
    //----------- INSERT LOG (Del) ----------
    function pdid_insert_log_del($ad_username,$item_name,$item_id){
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'ลบ',
            'item_name' => $item_name,
            'item_id' => $item_id,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('item_db_product_id_log',$data);        
    }
    //---- update new item_all & item_remain -----    
    function pdid_insert_log_edit($default_name,$default_item_id,$new_item_name,$new_item_id,$ad_username){    
        //---------------------- INSERT LOG --------------------                     
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
            'action' => 'แก้ไข',
            'item_name' => $default_name.' > '.$new_item_name,
            'item_id' => $default_item_id.' > '.$new_item_id,
            'ad_name' => $ad_username,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i'),
        );
        $this->db->insert('item_db_product_id_log',$data);
    }

    //----------------------------------------------------------- History ---------------------------------------------------------
    function pd_history_list($item_name){
        $query1 = $this->db->select('reqid')->where('item_name',$item_name)->from('request_item_list')->get()->result_array();
        
        //foreach เพราะ วนลูปข้างใน $query1 (result_array) ใส่เข้า $data
        $i=0;
        $data = array();
        foreach($query1 as $query1){
            $reqid = $query1['reqid'];
            $query2 = $this->db->select('*')->where('reqid',$reqid)->from('request_item')->get()->result();
            $data[$i] = $query2;
            $i++;
        }
        return $data;
    }
    function pdid_history_list($item_id){
        $query1 = $this->db->select('reqid')->where('item_id',$item_id)->from('request_item_list_detail')->get()->result_array();
        $i=0;
        $data = array();
        foreach($query1 as $query1){
            $reqid = $query1['reqid'];
            $query2 = $this->db->select('*')->where('reqid',$reqid)->from('request_item')->get()->result();
            $data[$i] = $query2;
            $i++;
        }
        return $data;
    }





}
?>