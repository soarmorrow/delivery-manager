<?php
class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function send_mail($to,$subject,$message){
		$this->load->library('email');

		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = 'way2vinee@gmail.com'; 
		$config['smtp_pass'] = 'c0d3vineeth007';
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$config['wordwrap']=TRUE;

        $this->email->initialize($config);
		$this->email->from('noreply@collection.in','collection');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
	}
}
?>