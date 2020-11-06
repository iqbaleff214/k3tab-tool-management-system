<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    private $table = 'employee';

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getWhere($where)
    {
        $this->db->like('id', $where);
        $this->db->or_like('name', $where);
        $this->db->or_like('class', $where);
        $this->db->or_like('birthdate', $where);
        $this->db->or_like('email', $where);
        $this->db->or_like('phone', $where);
        return $this->db->get($this->table)->result_array();
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function getEquipmentHistory($id)
    {
        $this->db->select('transaction.*');
        $this->db->select('equipment.description');
        $this->db->where('transaction.employee', $id);
        $this->db->from('transaction');
        $this->db->join('equipment', 'equipment.id = transaction.equipment');
        $this->db->order_by('transaction.id', 'desc');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }
}
