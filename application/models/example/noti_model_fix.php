<?php

class noti_model_fix extends CI_Model{
    public function __construct() {
        parent::__construct();
    } 
    
    public function fetch_data($v)
    {                      
        /*               
        $connect = new mysqli('localhost','root','','project');		
        $connect->set_charset('utf8mb4');
        if(isset($_POST['view']))
        {
            $query1 = "
            SELECT `firstname`,`lastname`,`date_request` FROM request_fix 
            UNION
            SELECT `firstname`,`lastname`,`date_request` FROM request_item
            ORDER BY `date_request` DESC 
            ";
            $query2 = "
            SELECT SELECT * FROM `admin_login` 
            WHERE admin_login.id = :admin_id
            AND admin_login.status = :status
            ";  
                   	
            $statement = $connect->prepare($query1,$query2);
            $statement->excute(
                array(
                    ':admin_id' => $_SESSION['admin_id'],
                    ':status'   => 'not_seen'
                )
            );
            $result  = $statement->fetchAll();
            $total_row = $statement->rowCount();
            $output = '';
            if($total_row > 0)
            {
                foreach($result->result() as $row)
                {
                    //var_dump($row);
                    $output .='<li><a href="#"> <strong>Subject: ' . $row->firstname. ' </strong> <br /> <small><em>Comment: '.$row->lastname.'</em></small></a> </li>';
                }            
            }
            else
            {                       
                $output .= '<li><a href="#" class="text-bold text-italic"> No Noti Found </a></li>'; 
            //                    
            }         
            $data = array(
                'notification' => $output,
                'unseen_notification' => $total_row
            );
            echo json_encode($data);
        }
        */


                   /*
                    if($v != '')
                    {
                        $this->db->set('comment_status','1');
                        $this->db->where('comment_status','0');                    
                        $this->db->update('request_fix');
                        echo '0';
                    } 
                    $this->db->select();
                    $this->db->from("request_fix");                                       
                    $this->db->order_by("id", "DESC");
                    $this->db->limit("4");

                    /*$query1 = $this->db->select()
                    ->from("request_fix")                                     
                    ->order_by('date_request','ASC')
                    ->limit("5")
                    ->get();
                    
                    $result = $this->db->get();                        
                    $output = '';          

                    if($result->num_rows() > 0)
                    { 
                        foreach($result->result() as $row)
                        {
                            //var_dump($row);
                            $output .='<li><a href="#"> <strong>Subject: ' . $row->firstname. ' </strong> <br /> <small><em>Comment: '.$row->lastname.'</em></small></a> </li>';
                        }
                    }
                    else
                    {                       
                        $output .= '<li><a href="#" class="text-bold text-italic"> No Noti Found </a></li>'; 
                    //                    
                    }                      
                    $this->db->select();
                    $this->db->from("request_fix");       
                    $this->db->where("comment_status", "0");
                    $result1 = $this->db->get();

                   
                    $count=$result1->num_rows();
                    $data = array('notification'=>$output,'unseen_notification'=>$count);          
                    return json_encode($data);
         
            */


                    if($v != '')
                    {
                        $this->db->set('noti_status','1');
                        $this->db->where('noti_status','0');                    
                        $this->db->update('request_fix');
                        echo '0';
                    } 

                    if($v != '')
                    {
                        $this->db->set('noti_status','1');
                        $this->db->where('noti_status','0');                    
                        $this->db->update('request_item');
                        echo '0';
                    }

                    if($v != '')
                    {
                        $this->db->set('noti_status','1');
                        $this->db->where('noti_status','0');                    
                        $this->db->update('request_email');
                        echo '0';
                    }

                    if($v != '')
                    {
                        $this->db->set('noti_status','1');
                        $this->db->where('noti_status','0');                    
                        $this->db->update('request_finger');
                        echo '0';
                    }

            
                    $query = $this->db->query("
                    SELECT `id`,`type`,`date_request` FROM request_fix 
                    UNION SELECT `id`,`type`,`date_request` FROM request_item
                    UNION SELECT `id`,`type`,`date_request` FROM request_email
                    UNION SELECT `id`,`type`,`date_request` FROM request_finger
                    ORDER BY `date_request` DESC LIMIT 6");                    
                    $result = $query;                        
                    $output = '';          

                    if($result->num_rows() > 0)
                    { 
                        foreach($result->result() as $row)
                        {
                            $output .='<li><a href="#">'.$row->type.'</a></li>'.
                            '<a>'.'# '.$row->id.'</a>'.
                            '<br/><a>'.$row->date_request.'</a>'.
                            '<hr class="" style="border-top:5px;">';
                        }
                    }
                    else
                    {                       
                        $output .= '<li><a href="#" class="text-bold text-italic">ไม่มีแจ้งเตือน</a></li>'; 
                    //                    
                    } 


                    //ALERT COUNT
                    $result1 = $this->db->query('
                    SELECT id FROM request_fix WHERE noti_status = 0
                    UNION SELECT id FROM request_item WHERE noti_status = 0
                    UNION SELECT id FROM request_email WHERE noti_status = 0
                    UNION SELECT id FROM request_finger WHERE noti_status = 0
                    ');
                   
                    $count=$result1->num_rows();
                    $data = array(
                        'notification'=>$output,
                        'unseen_notification'=>$count
                    );          
                    return json_encode($data);




    }
        
    
}
