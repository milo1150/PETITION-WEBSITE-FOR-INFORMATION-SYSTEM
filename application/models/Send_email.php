<?php
Class send_email extends CI_Model{ 
    public function send_email_fix($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_fix');
        $result = $query->result();
        foreach($result as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $email = $row->email;
            $reqid = $row->reqid;
        }
        $data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'reqid' => $reqid,
        );
        return $data;
    } 
    public function send_email_item($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_item');
        $result = $query->result();
        foreach($result as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $email = $row->email;
            $reqid = $row->reqid;
        }
        $data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'reqid' => $reqid,
        );
        return $data;
    }
    public function send_email_itemotp($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_itemotp');
        $result = $query->result();
        foreach($result as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $email = $row->email;
            $reqid = $row->reqid;
        }
        $data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'reqid' => $reqid,
        );
        return $data;
    }
    public function send_email_email($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_email');
        $result = $query->result();
        foreach($result as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $email = $row->email;
        }
        $data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
        );
        return $data;
    } 
    public function send_email_finger($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('request_finger');
        $result = $query->result();
        foreach($result as $row){
            $id = $row->id;
            $date_request = $row->date_request;
            $time_request = $row->time_request;
            $firstname = $row->firstname;															
            $lastname = $row->lastname;
            $email = $row->email;
        }
        $data = array(
            'id' => $id,
            'date_request' => $date_request,
            'time_request' => $time_request,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
        );
        return $data;
    }
}