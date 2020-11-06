<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model', 'request');
    }

    public function index()
    {
        $data['title'] = "Request";
        $data['sidebar'] = "Request";

        $this->__requestValid();

        if ($this->form_validation->run()) {
            $this->__request();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('request/index');
            $this->load->view('layout/footer');
        }
    }

    public function history()
    {
        $data['title'] = "Request History";
        $data['sidebar'] = "History";

        //konfigurasi pagination
        $config['base_url'] = base_url('request/history');
        $config['total_rows'] = $this->request->countAllRequestHistory();
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['equipments'] = $this->request->getAllRequestHistory($config['per_page'], $data['page'])->result_array();

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/navbar');
        $this->load->view('layout/sidebar');
        $this->load->view('request/history');
        $this->load->view('layout/footer');
    }

    public function return()
    {
        $data['title'] = "Return";
        $data['sidebar'] = "Return";

        $this->__returnValid();

        if ($this->form_validation->run()) {
            $this->__return();
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('layout/navbar');
            $this->load->view('layout/sidebar');
            $this->load->view('request/return');
            $this->load->view('layout/footer');
        }
    }

    public function findRequest()
    {
        $id = $this->input->post('id');
        $request = $this->request->getRequest($id);
        if ($request) {
            $return = '';
            foreach ($request as $item) {
                if ($item) {
                    $return .= $item . '$';
                }
            }
            echo $return;
        } else {
            $id = $this->request->getEquipmentsByToolbox($id, "In Use");
            $ids = [];
            foreach ($id as $item) {
                array_push($ids, $item['id']);
            }
            if ($ids) {
                $request = $this->request->getRequestByToolbox($ids);
                if ($request) {
                    $return = '';
                    foreach ($request as $req) {
                        if ($req) {
                            foreach ($req as $item) {
                                if ($item) {
                                    $return .= $item . '$';
                                }
                            }
                            $return .= '%%';
                        }
                    }
                    echo $return;
                } else {
                    echo '';
                }
            } else {
                echo '';
            }
        }
    }

    public function findEquipment()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $equipment = $this->request->getEquipment($id, $status);
        if ($equipment) {
            $equipmentName = $equipment['description'] . "%%equipment";
        } else {
            $equipment = $this->request->getToolbox($id, $status);
            if ($equipment) {
                $equipmentName = $equipment['description'] . "%%toolbox";
            } else {
                $equipmentName = '';
            }
        }
        echo $equipmentName;
    }

    public function findEmployee()
    {
        $id = $this->input->post('id');
        $employee = $this->request->getEmployee($id);
        if ($employee) {
            $employeeName = $employee['name'];
        } else {
            $employeeName = '';
        }
        echo $employeeName;
    }

    public function findEmployeeId()
    {
        $name = $this->input->post('name');
        $employee = $this->request->getEmployeeByName($name);
        if ($employee) {
            $employeeId = $employee['id'];
        } else {
            $employeeId = '';
        }
        echo $employeeId;
    }

    public function get_autocomplete()
    {
        if (isset($_POST['name'])) {
            $result = $this->request->getEmployeeName($_POST['name']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->name;
                echo json_encode($arr_result);
            }
        }
    }

    private function __requestValid()
    {
        $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required');
        $this->form_validation->set_rules('employee_name', 'Employee Name', 'trim|required');
        // $this->form_validation->set_rules('id[]', 'ID', 'trim|required');
        // $this->form_validation->set_rules('name[]', 'ID', 'trim|required');
    }


    private function __request()
    {
        $em_id = $this->input->post('employee_id');
        $date = $this->input->post('date_picker');

        $ids = $this->input->post('id');
        $names = $this->input->post('name');

        $tool = $this->input->post('tool');

        $dataEquipment = [];
        $dataToolbox = [];
        $validId = [];

        $index = 0;

        foreach ($ids as $id) {
            if ($names[$index]) {
                array_push($validId, $id);
                if ($tool[$index] == "equipment") {
                    array_push($dataEquipment, array(
                        'employee' => $em_id,
                        'equipment' => $id,
                        'booking_date' => $date,
                    ));
                } else {
                    array_push($dataToolbox, $id);
                }
            }
            $index++;
        }

        $create = $this->request->borrow($dataEquipment, $validId, $dataToolbox, $em_id, $date);

        if ($create) {
            pesan("Equipment(s) borrowed successfully", "success");
        } else {
            pesan("Equipment(s) failed to lend", "error");
        }

        redirect('request/history');
    }

    private function __returnValid()
    {
        $this->form_validation->set_rules('description[]', 'ID', 'trim');
        $this->form_validation->set_rules('employee[]', 'ID', 'trim');
        // $this->form_validation->set_rules('employee[]', 'ID', 'trim|required');
        // $this->form_validation->set_rules('description[]', 'Description', 'trim|required');
    }

    private function __return()
    {
        $ids = $this->input->post('tr-id'); //array - id request

        $return = $this->input->post('return'); // array date
        $equipments = $this->input->post('id'); // array id equipment
        $conditions = $this->input->post('condition'); // array condition

        $tool = $this->input->post('tool'); //array toolbox/equipment

        $dataEquipment = [];
        $idToolbox = [];
        $idEquipment = [];

        $index = 0;
        foreach ($ids as $id) {
            if ($tool[$index]) {
                array_push($idEquipment, $equipments[$index]);
                if ($tool[$index] == 'equipment') {
                    array_push($dataEquipment, array(
                        'id' => $id, // id request
                        'return_date' => $return[$index], // return date
                        'status' => $conditions[$index] // status - Good or Damaged
                    ));
                } elseif ($tool[$index] == 'toolbox') {
                    array_push($idToolbox, $equipments[$index]);
                    $new_id = explode("#", $id);
                    for ($i = 1; $i < count($new_id); $i++) {
                        array_push($dataEquipment, array(
                            'id' => $new_id[$i], // id request list
                            'return_date' => $return[$index], // return date
                            'status' => $conditions[$index] // status - Good or Damaged
                        ));
                    }
                }
            }
            $index++;
        }

        $return = $this->request->returnRequest($dataEquipment, $idEquipment, $idToolbox);
        if ($return) {
            pesan("Equipment(s) returned successfully", "success");
        } else {
            pesan("Equipment(s) failed to return", "error");
        }

        redirect('request/history');
    }
}
