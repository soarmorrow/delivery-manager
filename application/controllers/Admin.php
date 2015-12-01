<?php
class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Detail_model');
	}

	public function dashboard(){

		$data['view_page']='admin/dashboard';
		$data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$data['details']=$this->Detail_model->get_users();
		// debug($data['details']);
		$this->load->view('layout/template',$data);
	}
}
?>