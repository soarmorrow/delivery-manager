<?php

class Detail_model extends CI_Model
{
    protected $table = 'details';

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_details_by_id($user_id)
    {
        return $this->db
            ->get_where($this->table, array('user_id' => $user_id))
            ->result();

    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }

    public function get_details($id)
    {
        return $this->db->select('d.*,s.name as status, s.label, u.google_place_id as origin_place_id')
            ->from('details d')
            ->join('users u', 'u.id=d.user_id', 'left')
            ->join('status s', 'd.status_id=s.id', 'left')
            ->where('d.id', $id)
            ->get()
            ->row();

    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    public function get_All($limit = null, $offset = null)
    {

        $this->db->order_by('created_at', 'desc');

        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $limit * $offset);
        }


        return $this->db
            ->select('*')
            ->from($this->table)
            ->get()
            ->result();
    }

    public function get_users($limit = null, $offset = null, $search = null, $select = null, $order = null)
    {
        if (!is_null($limit) && !is_null($offset)) {
            $this->db->limit($limit, $limit * $offset);
        }

        if ($search) {
            $this->db->group_start()
                ->like('d.name', $search)
                ->or_like('d.address', $search)
                ->or_like('d.email', $search)
                ->or_like('d.website', $search)
                ->or_like('d.phone', $search)
                ->or_like('d.pin', $search)
                ->or_like('d.location', $search);


            $exploded = explode(' ', $search);
            foreach ($exploded as $value) {
                $this->db->or_like('u.first_name', $value)
                    ->or_like('u.last_name', $value);
            }
            $this->db->group_end();
        }

        if ($select) {
            $this->db->where('d.user_id', $select);
        }
        if ($order) {
            $this->db->where('d.status_id', $order);
        }

        $details = $this->db
            ->select('u.first_name,u.last_name ,d.*, s.name as status, s.label')
            ->from('details d')
            ->join('users u', 'u.id=d.user_id', 'left')
            ->join('status s', 'd.status_id = s.id', 'left')
            ->order_by('d.created_at', 'desc')
            ->get()
            ->result();

        foreach ($details as $k => $v) {
            $v->created_by = $v->first_name . ' ' . $v->last_name;
            $details[$k] = $v;
        }

        return $details;

    }

    public function get_paginate_count($user_id, $search = null)
    {

        $this->db->select('count(*) as count')
            ->from('details')
            ->where('user_id', $user_id);

        if ($search) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('address', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('website', $search);
            $this->db->or_like('phone', $search);
            $this->db->or_like('pin', $search);
            $this->db->or_like('location', $search);
            $this->db->group_end();
        }

        $result = $this->db->get()->row();


        return $result->count;
    }

    public function paginate_details($user_id, $search = null, $limit, $offset)
    {
        $this->db->select('d.*,s.name as status, s.label')
            ->from('details d')
            ->join('status s', 'd.status_id=s.id', 'left')
            ->where('user_id', $user_id);


        if ($search) {
            $this->db->group_start();
            $this->db->like('d.name', $search);
            $this->db->or_like('d.address', $search);
            $this->db->or_like('d.email', $search);
            $this->db->or_like('d.website', $search);
            $this->db->or_like('d.phone', $search);
            $this->db->or_like('d.pin', $search);
            $this->db->or_like('d.location', $search);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'desc');

        return $this->db->limit($limit, $offset * $limit)->get()->result();
    }

    public function get_all_count()
    {
        $result = $this->db->select('count(*) as count')
            ->from($this->table)
            ->get()
            ->row();

        return $result->count;

    }
}

?>