<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Gaji extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_admin') !== TRUE){
            redirect('login');
        }
        $this->load->model('M_gaji');
        $this->load->helper('nominal');
        $this->load->helper('text');
    }
	public function index()
	{
        $data['gaji']=$this->M_gaji->getAllDataGaji();
        $data['sidebar']="#mn3";
        $this->load->view('header');
        $this->load->view('gaji',$data);
        $this->load->view('footer', $data);
        
	}
    
    public function tambah()
    {
        $data['gol']=[
            'IV/a','IV/b','IV/c','IV/d','IV/e',
            'III/a','III/b','III/c','III/d',
            'II/a','II/b','II/c','II/d',
            'I/a','I/b','I/c','I/d'
        ];
        $this->form_validation->set_rules('gol', 'Golongan', 'required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'required|xss_clean');
        $this->form_validation->set_rules('gaji_pokok', 'Golongan', 'required|xss_clean|numeric');
    
        if($this->form_validation->run()==FALSE){
            $data['sidebar']="#mn3";
            $this->load->view('header');
            $this->load->view('tambah-gaji',$data);
            $this->load->view('footer', $data);
        }else{
            $this->M_gaji->tambahDataGaji();
			$this->session->set_flashdata('gaji', 'Ditambah');
			redirect('gaji');
        }
    }

    public function detailDataGaji($id){
        $data['gol']=[
            'IV/a','IV/b','IV/c','IV/d','IV/e',
            'III/a','III/b','III/c','III/d',
            'II/a','II/b','II/c','II/d',
            'I/a','I/b','I/c','I/d'
        ];
        $this->form_validation->set_rules('gol', 'Golongan', 'required|xss_clean');
        $this->form_validation->set_rules('masa_kerja', 'Masa Kerja', 'required|xss_clean');
        $this->form_validation->set_rules('gaji_pokok', 'Golongan', 'required|xss_clean|numeric');
        $data['gaji']=$this->M_gaji->getDataGajiById($id);
        if($this->form_validation->run()==FALSE){
            $data['sidebar']="#mn3";
            $this->load->view('header');
            $this->load->view('edit-gaji',$data);
            $this->load->view('footer', $data);
        }else{
            $this->M_gaji->updateDataGaji();
			$this->session->set_flashdata('gaji', 'Diperbarui');
			redirect('gaji');
        }
    }

    public function hapusDataGaji($id){
        $this->M_gaji->hapusGajiPegawai($id);
		$this->session->set_flashdata('gaji', 'Dihapus');
		redirect('gaji');
    }

    public function export() {
        $data['gaji'] = $this->M_gaji->getAllDataGaji();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator("codeXV");
        $spreadsheet->getProperties()->setLastModifiedBy("codeXV");
        $spreadsheet->getProperties()->setTitle("Tabel Gaji");
        $spreadsheet->getProperties()->setSubject("codeXV");
        $spreadsheet->getProperties()->setDescription("Tabel Gaji BPKD Kota Padang Panjang");

        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Golongan');
        $sheet->setCellValue('C1', 'Masa Kerja (Tahun)');
        $sheet->setCellValue('D1', 'Gaji Pokok');

        $baris = 2;
        $x = 1;

        foreach ($data['gaji'] as $p) {
            $sheet->setCellValue('A' . $baris, $x);
            $sheet->setCellValue('B' . $baris, $p['golongan']);
            $sheet->setCellValue('C' . $baris, $p['masa_kerja']);
            $sheet->setCellValue('D' . $baris, $p['gaji_pokok']);

            $x++;
            $baris++;
        }

        $filename = "Tabel Gaji BPKD Kota Padang Panjang " . date('d-m-Y') . '.xlsx';

        $sheet->setTitle('Data Pegawai');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
	}
