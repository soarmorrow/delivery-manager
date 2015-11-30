<?php
class User_model extends CI_Model{

	protected $table='users';
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//insert
	public function insert($data){
		return $this->db->insert($this->table,$data);
	}

	public function get_user_by_code($code){
		return $this->db
		            ->get_where($this->table,array('activation_code' =>$code))
		            ->row();
	}

	public function get_user_by_id($id){
		return $this->db
		            ->get_where($this->table,array('id' =>$id))
		            ->row();
	}


//update 
	public function update($data,$id){
		return $this->db
		            ->update($this->table,$data,array('id'=>$id));
	}

//login
	public function login($email,$password){
		return $this->db
					->select('*')
					->from($this->table)
					->group_start()
						->where('email', $email)
						->or_where('username', $email)
					->group_end()
					->where('password', md5($password))
					->get()
					->row();

					// SELECT * FROM users WHERE (email = 'parameter1' OR  username = 'parameter1') AND password = 'parameter2';
	}

	//get user details using email

	public function get_user_by_email($email){
		return $this->db
		            ->get_where($this->table,array('email' =>$email))
		            ->row();
	}

	public function get_user_by_resetcode($code){
		return $this->db
		            ->get_where($this->table,array('password_reset_code' =>$code))
		            ->row();
	}

}
?>