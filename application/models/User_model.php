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
		->where('username', $email)
		->where('password', md5($password))
		->get()
		->row();
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

	public function getAll($search,$limit=null,$offset=null){
		if(!is_null($limit) && !is_null($offset)){
			$this->db->limit($limit,$limit*$offset);
		}
		if($search){
			$this->db->group_start()
			->like('email',$search)
			->or_like('username',$search);

			// search for first and last name even if it is a combined string

			$exploded = explode(' ', $search);

			foreach ($exploded as $value) {
				$this->db->or_like('first_name',$value);
				$this->db->or_like('last_name',$value);
			}

			$this->db->group_end();
		}
		return $this->db
		->select('CONCAT(first_name," ",last_name ) as name,id,username,email,created_at')
		->from($this->table)
		->get()
		->result();

	}

	public function delete($user_id){
		$this->db->delete($this->table,array('id' => $user_id));
	}

}
?>