<?php

class Users extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('error','Please login to continue');
			redirect('auth/login');
		}
		if($this->session->userdata('is_admin') !=1){
			$this->session->set_flashdata('error','You are not authorised to do this action');
			redirect('dashboard');
		}
		$this->load->model(array('User_model', 'User_role_model'));
		// $data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		
		$this->load->model('Detail_model');
	}

	public function index(){

		$search=$this->input->get('search');
		$user=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$data['user']=$user;
		// $data['user_details']=$this->User_model->getAll();
		$total_rows=count($this->User_model->getAll($search));

		$config['base_url'] = site_url('users/index'); //dashboard/index/2
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 5;
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
		// $config['num_links'] = 5;


		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$page=($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$data['user_details']=$this->User_model->getAll($search,$config['per_page'],$page-1);

		foreach ($data['user_details'] as $k => $user) {
			$roles = $this->User_role_model->get_role_by_userid($user->id);
			$is_admin = false;

			foreach ($roles as $role) {
				if ($role->role_id == 1) {
					$is_admin = true;
					break;
				}
			}

			$user->is_admin = $is_admin;
			$data['user_details'][$k] = $user;
		}

		$data['view_page']='user/manage_user';
		$this->load->view('layout/template',$data);

	}

	public function add(){
		
		$user=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$data['user']=$user;


		if($this->input->post()){


			$this->form_validation->set_rules('first_name','First name','required|alpha');
			$this->form_validation->set_rules('last_name','Last name','required|alpha');
			$this->form_validation->set_rules('username','User name','required|alpha_numeric_spaces');
			$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password','password','required|min_length[3]');
			$this->form_validation->set_rules('password_confirmation','Password confirmation','required|matches[password]');

			if($this->form_validation->run()==TRUE){
				$activation_code=uniqid();
				$data=array(
					'first_name' =>$this->input->post('first_name'),
					'last_name' =>$this->input->post('last_name'),
					'username' =>$this->input->post('username'),
					'email' =>$this->input->post('email'),
					'password' =>md5($this->input->post('password')),
					'activation_code'=>$activation_code);
				if($this->User_model->insert($data)){

             		//email
					$username=$this->input->post('username');
					$password=$this->input->post('password');
					$activation_link=site_url('auth/verify_email/'.$activation_code); 
					$content=array(
						'activation_link' => $activation_link,
						'username' => $username,
						'password' =>$password
						);
					
					$to=$this->input->post('email');
					$subject='Your Account has been created successfully';
					$message=$this->load->view('emails/email',$content,true);

					// $message='Verify your email by clicking the link '.$activation_link;
					if($this->send_mail($to,$subject,$message)){
						$this->session->set_flashdata('success','Account has been created successfully');
						redirect('users');

					}
				}else{
					$this->session->set_flashdata('error','Failed to create account');
					redirect('users');
				}
			}

		}

		$data['view_page']='user/add_user';
		$this->load->view('layout/template',$data);
	}



	

	public function view($id){

		$data['view_page']='user/view';
		$data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));;
		$data['user_details']=$this->User_model->get_user_by_id($id);
		$this->load->view('layout/template',$data);

	}

	public function edit($id){
		if($this->input->post()){
			$this->form_validation->set_rules('first_name','First name','required|alpha');
			$this->form_validation->set_rules('last_name','Last name','required|alpha');
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('password','Password','min_length[6]');
			$this->form_validation->set_rules('conpassword','Confirm password','matches[password]');
			if($this->form_validation->run() == TRUE){
				$data=array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password')));
				$this->User_model->update($data,$id);
				$this->session->set_flashdata('success','Updated user details');
				redirect('users');
			}
		}
		$data['user_details']=$this->User_model->get_user_by_id($id);
		$data['view_page']='user/edit';
		$data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));;
		$this->load->view('layout/template',$data);
	}

	public function delete($id){
		$user=$this->User_model->get_user_by_id($id);
		if (!$user) {
			$this->session->set_flashdata('error', 'Could not find user');
			redirect_back();
		}
		$this->User_model->delete($id);
		$this->session->set_flashdata('success', "<strong>".$user->first_name. '</strong> has been deleted successfully.');
		redirect_back();
	}
}
?>