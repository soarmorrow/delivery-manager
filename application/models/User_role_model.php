<?php
class User_role_model extends CI_Model{

	protected $table='user_roles';
	public function __construct(){
		parent::__construct();
	}

	public function get_role_by_userid($user_id){
		return $this->db->get_where($this->table,array('user_id'=>$user_id))->result();
	}

	public function get_role_by_id($id){
		return $this->db->get_where($this->table,array('id' =>$id))->row();
	}

}
?>