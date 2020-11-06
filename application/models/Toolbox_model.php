<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toolbox_model extends CI_Model
{

    private $table = 'toolbox';

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getEquipments($id)
    {
        return $this->db->get_where('equipment', ['toolbox' => $id])->result_array();
    }

    public function getAll($where = null)
    {
        $this->db->select($this->table . ".*");
        $this->db->from($this->table);
        if ($where) {
            $this->db->like($this->table . ".id", $where);
            $this->db->or_like($this->table . ".description", $where);
        }
        return $this->db->get()->result_array();
    }
    public function getEquipment($id)
    {
        return $this->db->get_where('equipment', ['id' => $id, 'toolbox' => null, 'status' => 'Available'])->row_array();
    }

    public function add($data, $ids)
    {
        $toolbox = $this->db->insert($this->table, $data);

        $this->db->set('toolbox', $data['id']);
        $this->db->where_in('id', $ids);
        $equipment = $this->db->update('equipment');

        return $toolbox && $equipment;
    }

    public function delete($id)
    {
        $delete = $this->db->delete($this->table, ['id' => $id]);

        $update = $this->deleteEquipment('toolbox', $id);

        return $delete && $update;
    }

    public function deleteEquipment($field, $id)
    {
        $this->db->set('toolbox', null);
        $this->db->where($field, $id);
        return $this->db->update('equipment');
    }

    public function update($id, $data, $equipments)
    {
        $update = true;

        if ($equipments) {
            $this->db->set('toolbox', $id);
            $this->db->where_in('id', $equipments);
            $update = $this->db->update('equipment');
        }



        $this->db->where('id', $id);
        return $this->db->update($this->table, $data) && $update;
    }
}
