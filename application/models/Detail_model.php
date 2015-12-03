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

	public function update($data,$id){
		return $this->db->update($this->table,$data,array('id' => $id));
	}

	public function get_All($limit=null,$offset=null){

		$this->db->order_by('created_at', 'desc');

		if( !is_null($limit) && !is_null($offset)){
			$this->db->limit($limit,$limit*$offset);
		}


		return $this->db
		->select('*')
		->from($this->table)
		->get()
		->result();
	}

	public function get_users($limit=null, $offset=null){
		if(!is_null($limit) && !is_null($offset)){
			$this->db->limit($limit, $limit*$offset);
		}
		return $this->db
		->select('u.first_name as created_by,d.*')
		->from('details d')
		->join('users u','u.id=d.user_id')
		->order_by('d.created_at','desc')
		->get()
		->result();
	}

	public function get_paginate_count($user_id){
		$result = $this->db->select('count(*) as count')
		->from('details')
		->where('user_id', $user_id)
		->get()
		->row();

		return $result->count;
	}

	public function paginate_details($user_id, $limit, $offset){
		return $this->db->order_by('created_at', 'desc')
		->limit($limit, $offset * $limit)
		->get_where('details', array('user_id'=> $user_id))
		->result();
	}

	public function get_all_count(){
		$result=$this->db->select('count(*) as count')
		->from($this->table)
		->get()
		->row();

		return $result->count;
	
	}
}
?>