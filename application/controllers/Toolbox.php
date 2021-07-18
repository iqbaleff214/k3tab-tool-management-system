<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toolbox extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Toolbox_model', 'toolbox');
    }

    public function index()
    {
        if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
        {
            $ids = $this->input->post('ids');
            $result = true;
            foreach ($ids as $id) $result = $result AND $this->toolbox->delete($id);
            echo $result;
            return $result;
        }

        $data['title'] = "Toolbox";
        $data['sidebar'] = "Toolbox";
        $data['toolboxs'] = $this->toolbox->getAll();
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('toolbox/index');
        $this->load->view('layout/footer');
    }

    public function view($id)
    {
        $data['title'] = "Toolbox";
        $data['sidebar'] = "Toolbox";
        $data['toolbox'] = $this->toolbox->get($id);
        $data['equipments'] = $this->toolbox->getEquipments($id);
        // $data['employee'] = $this->toolbox->getEmployee($id);
        // $data['employees'] = $this->toolbox->getEmployeeHistory($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('toolbox/view');
        $this->load->view('layout/footer');
    }

    public function add()
    {
        $data['title'] = "Add New Toolbox";
        $data['sidebar'] = "Toolbox";

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__add();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('toolbox/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Toolbox Data";
        $data['sidebar'] = "Toolbox";

        $data['toolbox'] = $this->toolbox->get($id);
        $data['equipments'] = $this->toolbox->getEquipments($id);

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__update();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('toolbox/edit');
            $this->load->view('layout/footer');
        }
    }

    public function delete($id)
    {
        $delete = $this->toolbox->delete($id);

        if ($delete) {
            pesan("Data deleted successfully", "success");
        } else {
            pesan("Data failed to delete", "error");
        }

        redirect('toolbox');
    }

    public function deleteEquipment()
    {
        $id = $this->input->post('id');
        $delete = $this->toolbox->deleteEquipment('id', $id);

        if ($delete) {
            $pesan = "success";
            pesan("Data deleted successfully", $pesan);
        } else {
            $pesan = "error";
            pesan("Data failed to delete", $pesan);
        }

        echo $pesan;
        // redirect('toolbox');
    }

    public function findEquipment()
    {
        $id = $this->input->post('id');
        $equipment = $this->toolbox->getEquipment($id);
        if ($equipment) {
            $equipmentName = $equipment['description'];
        } else {
            $equipmentName = '';
        }
        echo $equipmentName;
    }

    private function __valid()
    {
        $this->form_validation->set_rules('id', 'Toolbox ID', 'trim|required');
        $this->form_validation->set_rules('description', 'Description of Toolbox', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
    }

    private function __add()
    {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $note = $this->input->post('note');

        $ids = $this->input->post('id-e');

        $data = [
            'id' => $id,
            'description' => $description,
            'status' => $status,
            'note' => $note,
        ];

        $create = $this->toolbox->add($data, $ids);

        if ($create) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('toolbox');
    }

    private function __update()
    {
        $id = $this->input->post('id');
        $description = $this->input->post('description');
        $status = $this->input->post('status');
        $note = $this->input->post('note');

        $equipments = $this->input->post('id-e');

        $data = [
            'description' => $description,
            'status' => $status,
            'note' => $note,
        ];

        $create = $this->toolbox->update($id, $data, $equipments);

        if ($create) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('toolbox');
    }
}
