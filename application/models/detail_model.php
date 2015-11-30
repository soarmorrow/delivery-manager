<?php
class Detail_model extends CI_Model{
	protected $table='details';
	public function __construct(){
		parent::__construct();
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}
	public function get_details_by_id($user_id){
		return $this->db
		            ->get_where($this->table,array('user_id'=>$user_id))
		            ->result();

	}

	public function delete($id){
		return $this->db->delete($this->table,array('id'=>$id));
	}

	public function get_details($id){
		return $this->db->get_where($this->table,array('id'=>$id))->row();
	}
}
?>