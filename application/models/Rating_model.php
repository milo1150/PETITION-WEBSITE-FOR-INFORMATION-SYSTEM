<?php
Class rating_model extends CI_Model {
	function rating_insertdata($data){
		$this->db->update('request_fix',$data,array('reqid'=>$data['reqid']));
		$this->db->update('request_item',$data,array('reqid'=>$data['reqid']));
		$this->db->update('request_itemotp',$data,array('reqid'=>$data['reqid']));
	}
}
?>