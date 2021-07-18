<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Equipment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Equipment_model', 'equipment');
    }

    public function index()
    {
        $cari = $this->input->post('cari');
        $data['title'] = "Equipment";
        $data['sidebar'] = "Equipment";

        if ($cari) {
            $data['equipments'] = $this->equipment->getWhere($cari);
            $data['keyword'] = $cari;
        } else {
            $data['equipments'] = $this->equipment->getAll();
        }
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('equipment/index');
        $this->load->view('layout/footer');
    }

    public function view($id)
    {
        $data['title'] = "Equipment";
        $data['sidebar'] = "Equipment";
        $data['equipment'] = $this->equipment->get($id);
        $data['employee'] = $this->equipment->getEmployee($id);
        $data['employees'] = $this->equipment->getEmployeeHistory($id);
        if ($data['equipment']['toolbox']) {
            $this->load->model('Toolbox_model', 'toolbox');
            $data['toolbox'] = $this->toolbox->get($data['equipment']['toolbox']);
        }
        // $data['equipments'] = $this->equipment->getEquipmentHistory($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('equipment/view');
        $this->load->view('layout/footer');
    }

    public function add()
    {
        $data['title'] = "Add New Equipment";
        $data['sidebar'] = "Equipment";

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__add();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('equipment/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Equipment's Data";
        $data['sidebar'] = "Equipment";
        $data['equipment'] = $this->equipment->get($id);

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__update($id);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('equipment/edit');
            $this->load->view('layout/footer');
        }
    }

    public function delete($id)
    {
        $delete = $this->equipment->delete($id);

        if ($delete) {
            pesan("Data deleted successfully", "success");
        } else {
            pesan("Data failed to delete", "error");
        }

        redirect('equipment');
    }

    private function __valid()
    {
        $this->form_validation->set_rules('id', 'Equipment ID', 'trim|required');
        $this->form_validation->set_rules('description', 'Description of Technical Object', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
    }

    private function __add()
    {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $manufacture = $this->input->post('manufacture');
        $material = $this->input->post('material');
        $type = $this->input->post('type');
        $unit = $this->input->post('unit');
        $status = $this->input->post('status');

        $data = [
            'id' => $id,
            'description' => $description,
            'manufacture' => $manufacture ?: '-',
            'material' => $material ?: '-',
            'type' => $type ?: '-',
            'unit' => $unit ?: 'unit',
            'status' => $status,
        ];

        $create = $this->equipment->add($data);
        if ($create) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('equipment');
    }

    private function __update($id)
    {
        $data = $this->input->post();

        $update = $this->equipment->update($id, $data);
        if ($update) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('equipment');
    }
}
