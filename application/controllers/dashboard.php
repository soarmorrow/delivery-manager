<?php
class Dashboard extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('error','Please login to continue');
			redirect('auth/login');
		}
		$this->load->model('user_model');
		$this->load->model('detail_model');
	}

	public function index(){
		$data['view_page']='dashboard/index';
		$user_id=$this->session->userdata('user_id');
		$data['user']=$this->user_model->get_user_by_id($user_id);
		$data['details']=$this->detail_model->get_details_by_id($user_id);
		$this->load->view('layout/template',$data);
	}

	public function add(){
		$data['view_page']='dashboard/add';
		$user_id=$this->session->userdata('user_id');
		$data['user']=$this->user_model->get_user_by_id($user_id);
		if($this->input->post()){
			$this->form_validation->set_rules('name','Name','required|alpha');
			$this->form_validation->set_rules('email','email','required|valid_email');
			$this->form_validation->set_rules('address','Address','required');
			$this->form_validation->set_rules('location','Location','required');
			$this->form_validation->set_rules('pin','PIN','required|numeric');
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
				$this->detail_model->insert($data);
				$this->session->set_flashdata('success','New details added');
				redirect('dashboard');
			} 
		}
		$this->load->view('layout/template',$data);
	}

	public function edit($id){
		$user_id=$this->session->userdata('user_id');
		$details=$this->detail_model->get_details($id);
		$data['details']=$details;

		if($this->input->post()){
			$this->form_validation->set_rules('name','Name','required|alpha');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('address','Address','required');
			$this->form_validation->set_rules('location','Location','required');
			$this->form_validation->set_rules('pin','PIN','required|numeric');
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
				$this->detail_model->update($data,$id);
				$this->session->set_flashdata('success','Updated');
				redirect('dashboard');
			}
		}

		$data['view_page']='dashboard/edit';
		$data['user']=$this->user_model->get_user_by_id($user_id);
		$this->load->view('layout/template',$data);
	}

	public function view($id){
		$user_id=$this->session->userdata('user_id');
        $details=$this->detail_model->get_details($id);
        $data['details']=$details;
		$data['view_page']='dashboard/view';
		$data['user']=$this->user_model->get_user_by_id($user_id);
		$this->load->view('layout/template',$data);
	}

	public function delete($id){
		$user_id=$this->session->userdata('user_id');
		$details=$this->detail_model->get_details($id);

		if($details->user_id != $user_id){
			$this->session->set_flashdata('error', 'You are not authorized to do this action');
			redirect('dashboard');
		}
		$this->detail_model->delete($id);
		$this->session->set_flashdata('success',"Item <b><i>".$details->name.'</i></b> has been deleted');
		redirect_back();

	}
}
?>