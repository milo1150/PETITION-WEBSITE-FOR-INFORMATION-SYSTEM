<?php
Class admin extends CI_Model {
	/* ---------------------------- Login ----------------------------*/
	function can_login($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('admin_login');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	// function permission($username, $rank){
	// 	$this->db->where('username', $username);
	// 	$this->db->where('rank', $rank);
	// 	$query = $this->db->get('admin_login');
	// 	if ($query->num_rows() > 0) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }
	function ad_data($username){
		$q = $this->db->select('*')->from('admin_login')->where('username',$username)->get()->result_array();
		return $q;
	}

	function showdata(){
		$query = $this->db->get('admin_login');
		return $query->result();
	}
	function add_insert($data){
		$this->db->insert('admin_login', $data);
		return $this->db->insert_id();
	}
	function deldata($id){
		$this->db->where('id', $id);
		return $this->db->delete('admin_login');
	}
	
	function fetch_edit($id){
		$edit = $this->db->select('*')->from('admin_login')->where('id',$id)->get()->result();               
        foreach($edit as $row){
            $id = $row->id;
            $username = $row->username;
            $user_id = $row->user_id;
            $email = $row->email;
            $rank = $row->rank;
        }
        $edit_data = array(
            'id' => $id,
            'username' => $username,
            'user_id' => $user_id,
            'email' => $email,
            'rank' => $rank,    
        );
        return $edit_data;
	}
	function update_data($id, $email, $rank){
		$this->db->set('email', $email);
		$this->db->set('rank', $rank);
		$this->db->where('id', $id);
		$this->db->update('admin_login');
	}
}

?>