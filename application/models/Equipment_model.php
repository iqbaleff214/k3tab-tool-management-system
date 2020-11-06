<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Equipment_model extends CI_Model
{

    private $table = 'equipment';

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getEmployee($id)
    {
        $this->db->select('employee.name');
        $this->db->from($this->table);
        $this->db->join('transaction', 'transaction.equipment = equipment.id');
        $this->db->join('employee', 'transaction.employee = employee.id');
        $this->db->where('transaction.equipment', $id);
        $this->db->order_by('transaction.id', 'DESC');
        return $this->db->get()->row_array();
    }

    public function getEmployeeHistory($id)
    {
        $this->db->select('transaction.*');
        $this->db->select('employee.name');
        $this->db->where('transaction.equipment', $id);
        $this->db->from('transaction');
        $this->db->join('employee', 'employee.id = transaction.employee');
        $this->db->order_by('transaction.id', 'desc');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function getWhere($where)
    {
        $this->db->like('id', $where);
        $this->db->or_like('description', $where);
        $this->db->or_like('manufacture', $where);
        $this->db->or_like('material', $where);
        $this->db->or_like('type', $where);
        $this->db->or_like('unit', $where);
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
}
