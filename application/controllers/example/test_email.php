<?php
class test_email extends CI_Controller {

	function index() {
		$this->load->view('email');
	}

	function send(){		
		$config = Array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
		    'smtp_host' => 'smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 's5703051623011@email.kmutnb.ac.th',
		    'smtp_pass' => 'Trojanvpk121',
		    'mailtype'  => 'html',
		    'charset'   => 'UTF-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('oosamuoo03@hotmail.com','ICIT System');
		$this->email->to('oosamuoo02@gmail.com');
		$this->email->subject('ระบบสารสนเทศ');		
		$message = 'รายการ xxx ที่ได้คุณ xxx แจ้งไว้  ขณะนี้ดำเนินการเสร็จเป็นที่เรียบร้อยแล้ว<br>
					รบกวนช่วยประเมินผลการทำงานด้วยครับ - <a href="http://localhost/codeig/test_rating?">คลิ๊กที่นี่</a>
					';
		$this->email->message($message);
		$this->email->send();

		$this->load->view('request');
	}
}