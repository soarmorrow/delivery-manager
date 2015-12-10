<?php
class Admin extends CI_Controller{

	public function __construct(){

		parent::__construct();
		// cehck for login
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('error','Please login to continue');
			redirect('auth/login');
		}

		// check the user is admin, if not redirect him to dashboard 
		if(!$this->session->userdata('is_admin')){
			$this->session->set_flashdata('error','Unauthorized access');
			redirect('dashboard');
		}

		$this->load->model('User_model');
		$this->load->model('Detail_model');
		$this->load->model('Status_model');
	}

	public function dashboard(){
		// if($this->input->get()){
		// 	debug($this->input->get('search_select'));
		// }
        $order_status=$this->input->get('search_status');
		$search=$this->input->get('search');
		$select=$this->input->get('search_select');
		$data['user_details']=$this->User_model->getAll(null);
		$data['view_page']='admin/dashboard';
		$data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$data['order_status']=$this->Status_model->get_all();

		$total_rows=$this->Detail_model->get_users(null,null,$search,$select,$order_status);

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

		$data['details'] = $this->Detail_model->get_users($config['per_page'],$page - 1,$search,$select,$order_status);
		//debug($this->User_model->db->last_query());

		$this->load->view('layout/template',$data);

	}

	public function get_all_status(){
		$response = array();
		$status = $this->Status_model->get_all();
		if (empty($status)) {
			$response['code'] = 500;
			$response['data'] = "Empty Status List";
			echo json_encode($response);exit;
		}
		
		$order_status = array();
		foreach ($status as $value) {
			$editable = new stdClass();

			$editable->value = $value->id;
			$editable->text = $value->name;
			$order_status[] = $editable;

		}
		$response['code'] = 200;
		$response['data'] = $order_status;
		echo json_encode($response);exit;
	}



	public function update_status(){
		$detail_id = $this->input->post('pk');
		$status_id = $this->input->post('value');
		$data=array('status_id' =>$status_id );
		$this->Detail_model->update($data,$detail_id);
		exit();

	}
}
?>