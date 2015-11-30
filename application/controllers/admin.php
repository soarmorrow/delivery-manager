<?php
class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('detail_model');
	}

	public function dashboard(){

		$data['view_page']='admin/dashboard';
		$data['user']=$this->user_model->get_user_by_id($this->session->userdata('user_id'));
		$data['details']=$this->detail_model->get_All();
		
		$this->load->view('layout/template',$data);
	}
}
?>