<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model', 'employee');
    }

    public function index()
    {
        $cari = $this->input->post('cari');
        $data['title'] = "Employee";
        $data['sidebar'] = "Employee";

        if ($cari) {
            $data['employees'] = $this->employee->getWhere($cari);
            $data['keyword'] = $cari;
        } else {
            $data['employees'] = $this->employee->getAll();
        }
        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('employee/index');
        $this->load->view('layout/footer');
    }

    public function view($id)
    {
        $data['title'] = "Employee";
        $data['sidebar'] = "Employee";
        $data['employee'] = $this->employee->get($id);
        $data['equipments'] = $this->employee->getEquipmentHistory($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('employee/view');
        $this->load->view('layout/footer');
    }

    public function add()
    {
        $data['title'] = "Add New Employee";
        $data['sidebar'] = "Employee";

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__add();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('employee/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Employee's Data";
        $data['sidebar'] = "Employee";
        $data['employee'] = $this->employee->get($id);

        $this->__valid();

        if ($this->form_validation->run()) {
            $this->__update($id);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('employee/edit');
            $this->load->view('layout/footer');
        }
    }

    public function delete($id)
    {
        $delete = $this->employee->delete($id);

        if ($delete) {
            pesan("Data deleted successfully", "success");
        } else {
            pesan("Data failed to delete", "error");
        }

        redirect('employee');
    }

    private function __valid()
    {
        $this->form_validation->set_rules('id', 'Employee ID', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('class', 'Class', 'trim|required');
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|required');
        $this->form_validation->set_rules('email', 'Phone Number', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
    }

    private function __add()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $class = $this->input->post('class');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $birthdate = $this->input->post('birthdate');

        $data = [
            'id' => $id,
            'name' => $name,
            'class' => $class,
            'phone' => $phone,
            'email' => $email,
            'birthdate' => $birthdate,
        ];

        $create = $this->employee->add($data);
        if ($create) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('employee');
    }

    private function __update($id)
    {
        $name = $this->input->post('name');
        $class = $this->input->post('class');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $birthdate = $this->input->post('birthdate');

        $data = [
            'name' => $name,
            'class' => $class,
            'phone' => $phone,
            'email' => $email,
            'birthdate' => $birthdate,
        ];

        $update = $this->employee->update($id, $data);
        if ($update) {
            pesan("Data saved successfully", "success");
        } else {
            pesan("Data failed to save", "error");
        }

        redirect('employee');
    }
}
