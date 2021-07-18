<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{

    private $table = 'transaction';

    public function getAllRequestHistory($start=null)
    {
        $this->db->select('transaction.*');
        $this->db->select('equipment.description, equipment.manufacture, equipment.material, equipment.type, equipment.unit, equipment.toolbox');
        $this->db->select('employee.name, employee.phone');
        $this->db->from($this->table);
        $this->db->join('equipment', 'equipment.id = transaction.equipment');
        $this->db->join('employee', 'employee.id = transaction.employee');
        $this->db->order_by('transaction.id', 'DESC');
        if ($start === "today") {
            $this->db->where("transaction.booking_date >= curdate()");
            $this->db->where("transaction.return_date <= curdate()");
        }
        return $this->db->get();
    }

    public function getAllRequestHistoryAvailable()
    {
        $this->db->where('deleted IS NULL');
        return $this->getAllRequestHistory();
    }

    public function deleteRequest($id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['deleted' => 1]);
    }

    public function countAllRequestHistory()
    {
        return $this->getAllRequestHistory("semua", null)->num_rows();
    }

    public function borrow($data, $ids, $idToolbox, $emid, $date)
    {
        if ($idToolbox) {
            $this->db->where_in('toolbox', $idToolbox);
            $idEq = $this->db->get('equipment')->result_array();

            foreach ($idEq as $id) {
                array_push($data, array(
                    'equipment' => $id['id'],
                    'employee' => $emid,
                    'booking_date' => $date,
                ));
                array_push($ids, $id['id']);
            }
        }

        $insert = $this->db->insert_batch($this->table, $data);

        $this->db->set('status', 'In Use');
        $this->db->where_in('id', $ids);
        $updateEquipment = $this->db->update('equipment');

        if ($idToolbox) {
            $this->db->set('status', 'In Use');
            $this->db->where_in('id', $ids);
            $updateToolbox = $this->db->update('toolbox');
        } else {
            $updateToolbox = true;
        }

        return $insert && $updateEquipment && $updateToolbox;
    }

    public function getEquipment($id, $status)
    {
        return $this->db->get_where('equipment', ['id' => $id, 'status' => $status, 'toolbox' => null])->row_array();
    }

    public function getEquipmentsByToolbox($id, $status)
    {
        // $this->db->where('status', $status);
        $this->db->select('id');
        $this->db->where('toolbox', $id);
        return $this->db->get('equipment')->result_array();
    }

    public function getToolbox($id, $status)
    {
        return $this->db->get_where('toolbox', ['id' => $id, 'status' => $status])->row_array();
    }

    public function getEmployee($id)
    {
        return $this->db->get_where('employee', ['id' => $id])->row_array();
    }

    public function getEmployeeByName($name)
    {
        return $this->db->get_where('employee', ['name' => $name])->row_array();
    }

    public function getEmployeeName($name)
    {
        $this->db->like('name', $name);
        $this->db->order_by('name', 'ASC');
        $this->db->limit(10);
        return $this->db->get('employee')->result();
    }

    public function getRequest($id)
    {
        return $this->db->get_where($this->table, ['equipment' => $id, 'return_date' => null])->row_array();
    }

    public function getRequestByToolbox($id)
    {
        $this->db->where_in('equipment', $id);
        $this->db->where('return_date', null);
        return $this->db->get($this->table)->result_array();
    }

    public function returnRequest($data, $ids, $idToolbox)
    {

        $return = $this->db->update_batch($this->table, $data, 'id');

        $this->db->set('status', 'Available');
        $this->db->where_in('id', $ids);
        $update = $this->db->update('equipment');

        if ($idToolbox) {
            $this->db->set('status', 'Available');
            $this->db->where_in('id', $idToolbox);
            $toolbox = $this->db->update('toolbox');

            $this->db->set('status', 'Available');
            $this->db->where_in('toolbox', $idToolbox);
            $equipment = $this->db->update('equipment');

            $updateToolbox = $toolbox && $equipment;
        } else {
            $updateToolbox = true;
        }

        return $return && $update && $updateToolbox;
    }
}
