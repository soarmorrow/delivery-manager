<?php
class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Detail_model');
	}

	public function dashboard(){
		// if($this->input->get()){
		// 	debug($this->input->get('search_select'));
		// }

		$search=$this->input->get('search');
		$select=$this->input->get('search_select');
		$data['user_details']=$this->User_model->getAll(null);
		$data['view_page']='admin/dashboard';
		$data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$total_rows=$this->Detail_model->get_users(null,null,$search,$select);

		$config['base_url'] = site_url('admin/dashboard'); //dashboard/index/2
		$config['total_rows'] = count($total_rows);
		$config['per_page'] = 10;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$config['enable_query_strings'] = true;
		$config['reuse_query_string'] = true;
		$config['uri_segment'] = 3;
		$config['use_page_numbers']=true;
		$config['num_links'] = 5;


		$this->load->library('pagination', $config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

		$data['details'] = $this->Detail_model->get_users($config['per_page'],$page - 1,$search,$select);
		//debug($this->User_model->db->last_query());

		$this->load->view('layout/template',$data);

	}
}
?>