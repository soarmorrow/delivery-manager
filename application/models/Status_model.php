<?php
class Status_model extends CI_Model{

	protected $table='status';
	public function __construct(){
		parent::__construct();
	}

	public function get_all($id=null)
	{
		if ($id) {
			return $this->db->get_where($this->table, array('id'=>$id));
		}

		return $this->db->get($this->table)->result();
	}

}
?>