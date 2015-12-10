<?php
class Dashboard extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('error','Please login to continue');
			redirect('auth/login');
		}
		$this->load->model('User_model');
		$this->load->model('Detail_model');
	}

	public function index(){

		$search = $this->input->get('search');
		

		$data['view_page']='dashboard/index';
		$user_id=$this->session->userdata('user_id');
		$data['user']=$this->User_model->get_user_by_id($user_id);

		$total_rows =$this->Detail_model->get_paginate_count($user_id, $search);

		// Adding pagination
		$this->load->library('pagination');

		$config['base_url'] = site_url('dashboard/index'); //dashboard/index/2
		$config['total_rows'] = $total_rows;
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
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 5;


		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$data['details'] = $this->Detail_model->paginate_details($user_id, $search, $config['per_page'], $page - 1 );

		$this->load->view('layout/template',$data);
	}

	public function add(){
		$data['view_page']='dashboard/add';
		$user_id=$this->session->userdata('user_id');
		$data['user']=$this->User_model->get_user_by_id($user_id);
		if($this->input->post()){
			$this->form_validation->set_rules('name','Name','required|alpha_numeric_spaces');
			$this->form_validation->set_rules('email','email','valid_email');
			$this->form_validation->set_rules('address','Address','required');
			$this->form_validation->set_rules('location','Location','required');
			$this->form_validation->set_rules('pin','PIN','numeric');
			$this->form_validation->set_rules('website','Website','valid_url');
			$this->form_validation->set_rules('phone','Phone number','required');

			if($this->form_validation->run() == TRUE){
				$data=array(
					'name'=>$this->input->post('name'),
					'email'=>$this->input->post('email'),
					'address'=>$this->input->post('address'),
					'location'=>$this->input->post('location'),
					'pin'=>$this->input->post('pin'),
					'website'=>$this->input->post('website'),
					'phone'=>$this->input->post('phone'),
					'user_id'=>$user_id
					);
				$this->Detail_model->insert($data);
				$this->session->set_flashdata('success','New details added');
				redirect('dashboard');
			} 
		}
		$this->load->view('layout/template',$data);
	}

	public function edit($id){
		$user_id=$this->session->userdata('user_id');
		$details=$this->Detail_model->get_details($id);
		$data['details']=$details;

		if($this->input->post()){
			$this->form_validation->set_rules('name','Name','required|alpha_numeric_spaces');
			$this->form_validation->set_rules('email','Email','valid_email');
			$this->form_validation->set_rules('address','Address','required');
			$this->form_validation->set_rules('location','Location','required');
			$this->form_validation->set_rules('pin','PIN','numeric');
			$this->form_validation->set_rules('website','Website','valid_url');
			$this->form_validation->set_rules('phone','Phone number','required');
			if($this->form_validation->run() ==TRUE){
				$data=array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'location' => $this->input->post('location'),
					'pin' => $this->input->post('pin'),
					'website' => $this->input->post('website'),
					'phone' => $this->input->post('phone'),
					);
				$this->Detail_model->update($data,$id);
				$this->session->set_flashdata('success','Updated');
				redirect('dashboard');
			}
		}

		$data['view_page']='dashboard/edit';
		$data['user']=$this->User_model->get_user_by_id($user_id);
		$this->load->view('layout/template',$data);
	}

	public function view($id){
		$user_id=$this->session->userdata('user_id');
		$details=$this->Detail_model->get_details($id);
		$data['details']=$details;
		$data['view_page']='dashboard/view';
		$data['user']=$this->User_model->get_user_by_id($user_id);
		$this->load->view('layout/template',$data);
	}

	public function delete($id){
		$user_id=$this->session->userdata('user_id');
		$details=$this->Detail_model->get_details($id);
		if(($details->user_id != $user_id ) && $this->session->userdata('is_admin') != 1 ){
			$this->session->set_flashdata('error', 'You are not authorized to do this action');
			redirect('dashboard');
		}
		
		$this->Detail_model->delete($id);
		$this->session->set_flashdata('success',"Item <b><i>".$details->name.'</i></b> has been deleted');
		redirect_back();

	}

	public function profile($mode = 'view'){

		if ($mode == 'edit') {
			$user=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
			if($this->input->post()){

				$this->form_validation->set_rules('first_name','First Name','required|alpha_numeric_spaces');
				$this->form_validation->set_rules('last_name','Last Name','required|alpha');
				$this->form_validation->set_rules('username','Username','required|is_unique[users.username]|alpha_numeric');
				$this->form_validation->set_rules('email','Email','valid_email');
				$this->form_validation->set_rules('password','Password','min_length[6]');
				$this->form_validation->set_rules('conpassword','Confirm Password','matches[password]');
				if($this->form_validation->run() == TRUE ){
					$data=array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password')) 
						);
     
					if(isset($_FILES['file']['name'])){
                        $path="uploads/profile_pic/".$user->id;
						if(!file_exists($path)){
							mkdir($path,0777,true);
						}
						$config['upload_path']=$path;
						$config['allowed_types']='jpg|gif|png';
						$this->load->library('upload',$config);
						$this->data['upload_error']=null;
						if($this->upload->do_upload('file')){
                          $upload_data=$this->upload->data();

                          $path=$path.'/'.$upload_data['file_name'];
                          $data['profile_image'] =$path;
						}else{
							$this->data['upload_error'] =$this->upload->display_errors();
						}
					}
					if(is_null($this->data['upload_error'])){

					$this->User_model->update($data,$user->id);
					$this->session->set_flashdata('success','Profile has been updated successfully');
					redirect('dashboard');
				}
				}
			}
			$data['view_page'] ='dashboard/profile_edit';

			$data['user']=$user;
			$this->load->view('layout/template',$data);
		}else{
			$user=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
			$data['view_page'] ='dashboard/profile';

			$data['user']=$user;
			$this->load->view('layout/template',$data);
		}
	}

}
?>