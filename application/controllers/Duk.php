<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Duk extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_admin') !== TRUE){
            redirect('login');
		}
        $this->load->model('M_duk');
        $this->load->model('M_pegawai');
    }

    public function index()
	{
        $data['duk']=$this->M_duk->getAllDataDuk();
		$data['sidebar']="#mn4";
        $this->load->view('header');
        $this->load->view('data_duk',$data);
		$this->load->view('footer', $data);
    }
    
    public function data_duk($id){
        $data['pangkat']=[
            'Pembina Utama','Pembina Utama Madya','Pembina Utama Muda','Pembina Tingkat I','Pembina',
            'Penata Tingkat I','Penata','Penata Muda Tingkat I', 'Penata Muda',
            'Pengatur Tingkat I','Pengatur','Pengatur Muda Tingkat I','Pengatur Muda',
            'Juru Tingkat I','Juru','Juru Muda Tingkat I','Juru Muda'
        ];
        $data['gol']=[
            'IV/a','IV/b','IV/c','IV/d','IV/e',
            'III/a','III/b','III/c','III/d',
            'II/a','II/b','II/c','II/d',
            'I/a','I/b','I/c','I/d'
        ];
        $this->form_validation->set_rules('nip','NIP','required|xss_clean|numeric');
        $this->form_validation->set_rules('nama','Nama','required|xss_clean');
        $this->form_validation->set_rules('pangkat','Pangkat','required|xss_clean');
        $this->form_validation->set_rules('golongan','Golongan','required|xss_clean');
        $this->form_validation->set_rules('tmt_pangkat','TMT Pangkat','required|xss_clean');
        $this->form_validation->set_rules('jabatan','Jabatan','required|xss_clean');
        $this->form_validation->set_rules('tmt_jabatan','TMT Jabatan','required|xss_clean');
        $this->form_validation->set_rules('mkgt','Masa Kerja Golongan (Tahun)','required|xss_clean|numeric');
        $this->form_validation->set_rules('mkgb','Masa Kerja Golongan (Bulan)','required|xss_clean|numeric');
        $this->form_validation->set_rules('mkst','Masa Kerja Seluruhnya (Tahun)','required|xss_clean|numeric');
        $this->form_validation->set_rules('mksb','Masa Kerja Seluruhnya (Bulan)','required|xss_clean|numeric');
        $this->form_validation->set_rules('naik_pangkat','Naik Pangkat Yad','required|xss_clean');
        $this->form_validation->set_rules('naik_gaji','Naik Gaji Yad','required|xss_clean');
        $this->form_validation->set_rules('usia','Usia','required|xss_clean|numeric');
        $this->form_validation->set_rules('pendidikan','Pendidikan','required|xss_clean');
        $this->form_validation->set_rules('ket','Keterangan','required|xss_clean');
        $data['pegawai']=$this->M_pegawai->getPegawaiById($id);
        $data['duk']=$this->M_duk->getDataDukById($id);
        if($this->form_validation->run() == FALSE){
            $data['sidebar']="#mn4";
            $this->load->view('header');
            $this->load->view('duk',$data);
            $this->load->view('footer', $data);
        }else{
            $this->M_duk->updateDataDuk();
			$this->session->set_flashdata('duk', 'Diperbarui');
			redirect('duk');
        }
    }

	public function export() {
        $data['duk'] = $this->M_duk->getAllDataDuk();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator("codeXV");
        $spreadsheet->getProperties()->setLastModifiedBy("codeXV");
        $spreadsheet->getProperties()->setTitle("Data Duk");
        $spreadsheet->getProperties()->setSubject("codeXV");
        $spreadsheet->getProperties()->setDescription("Data Duk BPKD Kota Padang Panjang");

        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Pangkat');
        $sheet->setCellValue('E1', 'Golongan');
        $sheet->setCellValue('F1', 'TMT Pangkat');
        $sheet->setCellValue('G1', 'Jabatan');
        $sheet->setCellValue('H1', 'TMT Jabatan');
        $sheet->setCellValue('I1', 'Masa Kerja Golongan (Tahun)');
        $sheet->setCellValue('J1', 'Masa Kerja Golongan (Bulan)');
        $sheet->setCellValue('K1', 'Masa Kerja Keseluruhan (Tahun)');
        $sheet->setCellValue('L1', 'Masa Kerja Keseluruhan (Bulan)');
        $sheet->setCellValue('M1', 'Naik Pangkat YAD');
        $sheet->setCellValue('N1', 'Naik Gaji YAD');
        $sheet->setCellValue('O1', 'Usia');
        $sheet->setCellValue('P1', 'Pendidikan');
        $sheet->setCellValue('Q1', 'Keterangan');

        $baris = 2;
        $x = 1;

        foreach ($data['duk'] as $p) {
            $sheet->setCellValue('A' . $baris, $x);
            $sheet->setCellValue('B' . $baris, $p['nip']);
            $sheet->setCellValue('C' . $baris, $p['nama']);
            $sheet->setCellValue('D' . $baris, $p['pangkat']);
            $sheet->setCellValue('E' . $baris, $p['golongan']);
            $sheet->setCellValue('F' . $baris, $p['tmt_pangkat']);
            $sheet->setCellValue('G' . $baris, $p['jabatan']);
            $sheet->setCellValue('H' . $baris, $p['tmt_jabatan']);
            $sheet->setCellValue('I' . $baris, $p['masa_kerja_golongan_tahun']);
            $sheet->setCellValue('J' . $baris, $p['masa_kerja_golongan_bulan']);
            $sheet->setCellValue('K' . $baris, $p['masa_kerja_seluruh_tahun']);
            $sheet->setCellValue('L' . $baris, $p['masa_kerja_seluruh_bulan']);
            $sheet->setCellValue('M' . $baris, $p['naik_pangkat_yad']);
            $sheet->setCellValue('N' . $baris, $p['naik_gaji_yad']);
            $sheet->setCellValue('O' . $baris, $p['usia']);
            $sheet->setCellValue('P' . $baris, $p['pendidikan']);
            $sheet->setCellValue('Q' . $baris, $p['keterangan']);
            $x++;
            $baris++;
        }

        $filename = "Data Duk BPKD Kota Padang Panjang " . date('d-m-Y') . '.xlsx';

        $sheet->setTitle('Data Pegawai');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
}