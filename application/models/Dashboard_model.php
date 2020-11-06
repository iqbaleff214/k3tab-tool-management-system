<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getUsedEquipment()
    {
        // SELECT equipment, count(*) as total FROM `transaction` GROUP BY equipment
        $this->db->group_by('transaction.equipment');
        $this->db->select('equipment.id as id, equipment.description as equipment');
        $this->db->select('count(*) as total');
        $this->db->from('transaction');
        $this->db->join('equipment', 'equipment.id = transaction.equipment');
        return $this->db->get()->result_array();
    }

    public function getInUseEquipment()
    {
        $this->db->where('status', "In Use");
        return $this->db->get("equipment")->result_array();
    }

    public function getMonthChart()
    {
        return $this->db->query("SELECT DAY(booking_date) as date, count(*) as total FROM `transaction` WHERE MONTH(booking_date) = MONTH(CURDATE()) GROUP BY booking_date")->result_array();
    }

    public function getTodayReport($date = null)
    {
        $this->db->select('transaction.*');
        $this->db->select('equipment.*');
        $this->db->select('employee.name, employee.phone');
        $this->db->from('transaction');
        $this->db->join('equipment', 'equipment.id = transaction.equipment');
        $this->db->join('employee', 'employee.id = transaction.employee');
        if ($date) {
            $this->db->where('transaction.' . $date . ' = curdate()');
        }
        return $this->db->get()->result_array();
    }

    public function getEquipment($search)
    {
        $this->db->like('description', $search);
        $this->db->limit(3);
        return $this->db->get('equipment')->result_array();
    }

    public function getEmployee($search)
    {
        $this->db->like('name', $search);
        $this->db->limit(3);
        return $this->db->get('employee')->result_array();
    }

    public function resetAll()
    {
        $equipment = $this->db->empty_table('equipment');
        $toolbox = $this->db->empty_table('toolbox');
        $employee = $this->db->empty_table('employee');
        $transaction = $this->db->empty_table('transaction');

        return $equipment && $toolbox && $employee && $transaction;
    }
}
