<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model', 'dashboard');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['sidebar'] = "Dashboard";

		$data['graphs'] = $this->dashboard->getUsedEquipment();
		$data['monthGraphs'] = $this->dashboard->getMonthChart();
		$data['equipments'] = $this->dashboard->getInUseEquipment();


		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('layout/footer');
	}

	public function report()
	{
		$data['title'] = "Daily Report";
		$data['sidebar'] = "Report";
		$data['reports'] = $this->dashboard->getTodayReport('booking_date');
		// var_dump($data['reports']);
		// die;
		$data['reports_return'] = $this->dashboard->getTodayReport('return_date');

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('dashboard/report');
		$this->load->view('layout/footer');
	}

	public function notFound()
	{
		$data['title'] = "Not Found";
		$data['sidebar'] = "";

		$this->load->view('layout/header', $data);
		$this->load->view('layout/navbar');
		$this->load->view('layout/sidebar');
		$this->load->view('errors/err_404');
		$this->load->view('layout/footer');
	}

	public function resetData()
	{
		$delete = $this->dashboard->resetAll();

		if ($delete) {
			pesan("Data deleted successfully", "success");
		} else {
			pesan("Data failed to delete", "error");
		}

		redirect($_SERVER['HTTP_REFERER']);
		// redirect('toolbox');
	}

	public function exportHistory($time)
	{
		$this->load->model('Request_model', 'request');
		if ($time == "today") {
			$history = $this->request->getAllRequestHistory("semua", $time)->result_array();
			$filename = "TMS_-_equipment_request_" . date('d_m_Y', time());
		} else {
			$history = $this->request->getAllRequestHistory("semua", null)->result_array();
			$filename = "TMS_-_equipment_request_history";
		}
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$styleArrayFirstRow = [
			'font' => [
				'bold' => true,
			]
		];

		$sheet->getStyle('A1:M1')->applyFromArray($styleArrayFirstRow);

		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Request Date');
		$sheet->setCellValue('C1', 'Return Date');
		$sheet->setCellValue('D1', 'Employee ID');
		$sheet->setCellValue('E1', 'Employee Name');
		$sheet->setCellValue('F1', 'Phone');
		$sheet->setCellValue('G1', 'Equipment ID');
		$sheet->setCellValue('H1', 'Equipment Description');
		$sheet->setCellValue('I1', 'Material');
		$sheet->setCellValue('J1', 'Manufacture');
		$sheet->setCellValue('K1', 'Type');
		$sheet->setCellValue('L1', 'Unit');
		$sheet->setCellValue('M1', 'Condition');

		$no = 1;
		$x = 2;
		foreach ($history as $report) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $report['booking_date']);
			$sheet->setCellValue('C' . $x, $report['return_date']);
			$sheet->setCellValue('D' . $x, $report['employee']);
			$sheet->setCellValue('E' . $x, $report['name']);
			$sheet->setCellValue('F' . $x, $report['phone']);
			$sheet->setCellValue('G' . $x, $report['equipment']);
			$sheet->setCellValue('H' . $x, $report['description']);
			$sheet->setCellValue('I' . $x, $report['material']);
			$sheet->setCellValue('J' . $x, $report['manufacture']);
			$sheet->setCellValue('K' . $x, $report['type']);
			$sheet->setCellValue('L' . $x, $report['unit']);
			$sheet->setCellValue('M' . $x, $report['status']);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function exportExcel($code)
	{
		if ($code == 1) {
			$reports = $this->dashboard->getTodayReport('booking_date');
			$filename = "TMS_-_equipment_request_report_" . date('d_m_Y', time());
		} else if ($code == 2) {
			$reports = $this->dashboard->getTodayReport('return_date');
			$filename = "TMS_-_equipment_return_report_" . date('d_m_Y', time());
		} else {
			$reports = $this->dashboard->getTodayReport();
			$filename = "TMS_-_report_" . date('d_m_Y', time());
		}

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$styleArrayFirstRow = [
			'font' => [
				'bold' => true,
			]
		];

		$sheet->getStyle('A1:K1')->applyFromArray($styleArrayFirstRow);

		$sheet->setCellValue('A1', 'No');
		if ($code == 1) {
			$sheet->setCellValue('B1', 'Request Date');
		} else {
			$sheet->setCellValue('B1', 'Return Date');
		}
		$sheet->setCellValue('C1', 'Employee ID');
		$sheet->setCellValue('D1', 'Employee Name');
		$sheet->setCellValue('E1', 'Phone');
		$sheet->setCellValue('F1', 'Equipment ID');
		$sheet->setCellValue('G1', 'Equipment Description');
		$sheet->setCellValue('H1', 'Material');
		$sheet->setCellValue('I1', 'Manufacture');
		$sheet->setCellValue('J1', 'Type');
		$sheet->setCellValue('K1', 'Unit');

		$no = 1;
		$x = 2;
		foreach ($reports as $report) {
			$sheet->setCellValue('A' . $x, $no++);
			if ($code == 1) {
				$sheet->setCellValue('B' . $x, $report['booking_date']);
			} else {
				$sheet->setCellValue('B' . $x, $report['return_date']);
			}
			$sheet->setCellValue('C' . $x, $report['employee']);
			$sheet->setCellValue('D' . $x, $report['name']);
			$sheet->setCellValue('E' . $x, $report['phone']);
			$sheet->setCellValue('F' . $x, $report['equipment']);
			$sheet->setCellValue('G' . $x, $report['description']);
			$sheet->setCellValue('H' . $x, $report['material']);
			$sheet->setCellValue('I' . $x, $report['manufacture']);
			$sheet->setCellValue('J' . $x, $report['type']);
			$sheet->setCellValue('K' . $x, $report['unit']);
			$x++;
		}
		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function mainSearch()
	{
		$keyword = $this->input->post('keyword');

		$equipments = $this->dashboard->getEquipment($keyword);

		if ($equipments) {
			$equipmentTag = '<div class="search-header">Equipment</div>';
			foreach ($equipments as $equipment) {
				$equipmentTag .= '<div class="search-item"><a href="' . base_url('equipment/view/' . $equipment['id']) . '">' . $equipment['description'] . '</a></div>';
			}
		} else {
			$equipmentTag = '';
		}

		$employees = $this->dashboard->getEmployee($keyword);

		if ($employees) {
			$employeeTag = '<div class="search-header">Employee</div>';
			foreach ($employees as $employee) {
				$employeeTag .= '<div class="search-item"><a href="' . base_url('employee/view/' . $employee['id']) . '">' . $employee['name'] . '</a></div>';
			}
		} else {
			$employeeTag = '';
		}

		if (($employeeTag != '') || ($equipmentTag != '')) {
			echo $equipmentTag . $employeeTag;
		} else {
			echo '<div class="search-item"><a>Not found!</a></div>';
		}
	}
}
