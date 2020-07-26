<?php
Class news_model extends CI_Model {
	function select_subject(){
		return $this->db->select('*')->from('news_type')->get()->result(); 
	}
	function fetch_ndata(){
		$query = $this->db->select('*')->from('news')->get()->result();
		return $query;
	}


	function add_insert($data){
		$this->db->insert('news', $data);
		return $this->db->insert_id();
	}
	function deldata($id){
		$this->db->where('id', $id);
		return $this->db->delete('news');
	}
}
?>