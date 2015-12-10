<?php

class Auth extends MY_Controller{

	public function __construct(){

		parent::__construct();
		if($this->session->userdata('logged_in') && $this->uri->segment(2) !='logout'){
			redirect('dashboard');
		}
		$this->load->model('User_model');
		$this->load->model('User_role_model');
	}


	public function signup(){

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

					$activation_link=site_url('auth/verify_email/'.$activation_code);
					$to=$this->input->post('email');
					$subject='Your Account has been created successfully';
					$message='Verify your email by clicking the link '.$activation_link;
					if($this->send_mail($to,$subject,$message)){
						$this->session->set_flashdata('success','Your Account has been created successfully');
						redirect('auth/login');

					}
				}else{
					$this->session->set_flashdata('error','Failed to create your account');
					redirect('auth/signup');
				}
			}

		}
		$this->load->view('auth/signup');
	}

	public function verify_email($code){
		$user=$this->User_model->get_user_by_code($code);
		if(empty($user)){
			$this->session->set_flashdata('error','Invalid code');
			redirect('auth/login');
		}else{
			$data=array(
				'activation_code'=>"",
				'activated'=>1,
				'activated_at'=>date('Y m d H:i s')
				);
			$this->User_model->update($data,$user->id);
			$this->session->set_flashdata('success','Email verified successfully');

			$to=$user->email;
			$subject='Account activation';
			$message='Your account activated successfully';
			$this->send_mail($to,$subject,$message);
			redirect('auth/login');
		}
	}


	public function login(){

		if($this->input->post()){
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

		
			if($this->form_validation->run() == TRUE){
				$email=$this->input->post('email');
				$password=$this->input->post('password');
				$user=$this->User_model->login($email,$password);
				// debug($this->User_model->db->last_query());
				if($user){
					$this->session->set_userdata('logged_in',true);
					$this->session->set_userdata('user_id',$user->id);
					$roles=$this->User_role_model->get_role_by_userid($user->id);
					foreach ($roles as $role) {
					    if($role->id ==1){
					    	$this->session->set_userdata('is_admin',1);
					    }
					}
					// var_dump($this->session->userdata('is_admin'));exit;
					$this->session->set_flashdata('success','Hello '. $user->first_name);
					($this->session->userdata('is_admin'))? redirect('admin/dashboard'):redirect('dashboard');;
					
				}else{
					$this->session->set_flashdata('error','Incorrect email or password');
					redirect('auth/login');
				}
			}
		}
		$this->load->view('auth/login');
	}

	public function forgot_password(){
		if($this->input->post()){
			$this->form_validation->set_rules('email','Email','required|valid_email');
			if($this->form_validation->run()==TRUE) {
				$user=$this->User_model->get_user_by_email($this->input->post('email'));
				if(empty($user)){
					$this->session->set_flashdata('error','Not registered');
					redirect_back();
				}else{
					if($user->activated==1){
						$reset_code=uniqid();
						$reset_link=site_url('auth/password_reset/'.$reset_code);
						$data=array(
							        'password_reset_code' => $reset_code
							        );
						$this->User_model->update($data,$user->id);
						$to=$user->email;
						$subject='Reset your password';
						$message='Someone has requested to reset your password.If you made this change reset your password by clicking the link '.$reset_link;
						$this->send_mail($to,$subject,$message);
						$this->session->set_flashdata('success','please check your email');
						redirect_back();
					}else{
						$this->session->set_flashdata('error','Email not verified');
						redirect_back();
					}
				}
			}       


		}
		$this->load->view('auth/forgot_password');
	}

//reset password
	public function password_reset($code){
		$user=$this->User_model->get_user_by_resetcode($code);
    if(empty($user)){
    	$this->session->set_flashdata('error','Invalid code');
    	redirect('auth/login');
    }else{
		if($this->input->post()){
			$this->form_validation->set_rules('password','Password','required|min_length[6]');
			$this->form_validation->set_rules('conpassword','Conformpassword','required|matches[password]');
			if($this->form_validation->run()==true){
                $data=array(
                             'password_reset_code'=>"",
                             'password'=>md5($this->input->post('password'))
                	);
             $this->User_model->update($data,$user->id);
             $this->session->set_flashdata('success','Your password has been changed successfully');
             $to=$user->email;
             $subject='Reset password';
             $message='Your password has been changed successfully';
             $this->send_mail($to,$subject,$message);
             redirect('auth/login');
			}
		}
	}

		$this->load->view('auth/password_reset');
	}

	public function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		redirect('auth/login');

	}
}
?>