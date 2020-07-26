<?php

class dashfix extends CI_Controller{
	function index (){
		/*$this->load->model('dashfix_model');*/
		$this->load->view('dashfix');
	}
/*
	function addInfo(){
		
		$name = $this->input->post('name');
		$pNum = $this->input->post('pNum');
		$place = $this->input->post('place');
		$item = $this->input->post('item');
		$info = $this->input->post('info');
		$day = $this->input->post('day');
		$time = $this->input->post('time');
		$comment = $this->input->post('comment');

		$data = array(
			'name'=>$name,
			'pNum'=>$pNum,
			'place'=>$place,
			'item'=>$item,
			'info'=>$info,
			'day'=>$day,
			'time'=>$time,
			'comment'=>$comment,
		);
	$this->db->insert('dashfix',$data);
	return redirect('dashuser');
	}
*/
}