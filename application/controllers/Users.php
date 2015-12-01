<?php

class Users extends MY_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('error','Please login to continue');
			redirect('auth/login');
		}
		$this->load->model('User_model');
		// $data['user']=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		
		$this->load->model('Detail_model');
	}

	public function index(){
		$user=$this->User_model->get_user_by_id($this->session->userdata('user_id'));
		$data['user']=$user;
		$data['user_details']=$this->User_model->getAll();
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
					$activation_link=site_url('auth/verify_email/'.$activation_code); 
					$content=array(
						'activation_link' => $activation_link,
						'username' => $username
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
      	if($this->form_validation->run() == TRUE){
      		$data=array(
      			        'first_name' => $this->input->post('first_name'),
      			        'last_name' => $this->input->post('last_name'),
      			        'username' => $this->input->post('username'),
      			        'email' => $this->input->post('email'));
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

	}
}
?>