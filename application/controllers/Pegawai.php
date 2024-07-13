<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in_admin') !== TRUE){
            redirect('login');
		}
		$this->load->model('M_pegawai');
    }
	public function index()
	{
		$data['sidebar']="#mn2";
		$data['pegawai']=$this->M_pegawai->getAllPegawai();
        $this->load->view('header');
        $this->load->view('pegawai', $data);
		$this->load->view('footer', $data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric|max_length[18]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'xss_clean');
		$this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'required|xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'xss_clean');
		$this->form_validation->set_rules('ket', 'Keterangan', 'xss_clean');
		if($this->form_validation->run()==FALSE){
			$data['sidebar']="#mn2";
			$this->load->view('header');
			$this->load->view('tambah');
			$this->load->view('footer', $data);
		}else{
			$this->M_pegawai->tambahDataPegawai();
			$this->session->set_flashdata('pegawai', 'Ditambahkan');
			redirect('pegawai');
		}
	}

	public function detailPegawai($id){
		$data['pegawai']=$this->M_pegawai->getPegawaiById($id);
		$data['gol_darah']=['A','B','AB','O'];
		$data['jk']=['Laki-laki','Perempuan'];
		$data['agama']=['Islam','Protestan','Katholik','Hindu','Budha'];
	
		$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric|max_length[18]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|xss_clean');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|xss_clean');
		$this->form_validation->set_rules('gol_darah', 'Golongan Darah', 'required|xss_clean');
		$this->form_validation->set_rules('agama', 'Agama', 'required|xss_clean');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|xss_clean');
		$this->form_validation->set_rules('ket', 'Keterangan', 'required|xss_clean');
		
		if($this->form_validation->run()==FALSE){
			$data['sidebar']="#mn2";
			$this->load->view('header');
			$this->load->view('profil',$data);
			$this->load->view('footer', $data);
		}else{
			$this->M_pegawai->ubahDataPegawai();
			$this->session->set_flashdata('pegawai', 'Diubah');
			redirect('pegawai');
		}
	}

	public function hapusPegawai($nip){
		$this->M_pegawai->hapusDataPegawai($nip);
		$this->session->set_flashdata('pegawai', 'Dihapus');
		redirect('pegawai');
	}

	public function resetPassword(){
		$this->form_validation->set_rules('nip', 'NIP', 'required|xss_clean|numeric');
		if($this->form_validation->run()==FALSE){
			//redirect('pegawai',refresh);
			echo "gagal!";
		}else{
			$this->M_pegawai->resetPass();
			$this->session->set_flashdata('pegawai', 'Direset');
			redirect('pegawai');
		}
	}

	public function setting(){
		$data['ketua']=$this->M_pegawai->ketua();
		$this->form_validation->set_rules('pb','Password Baru','required|xss_clean');
		$this->form_validation->set_rules('kpb','Konfirmasi Password','required|xss_clean|matches[pb]');
		if($this->form_validation->run()==FALSE){
			$data['sidebar']="#mn5";
			$this->load->view('header');
			$this->load->view('setting',$data);
			$this->load->view('footer', $data);
		}else{
			$this->M_pegawai->ubahPassword();
			$this->session->set_flashdata('pegawai', 'Diubah');
			redirect('setting');
		}
	}
	
	public function upKetua(){
		$data['ketua']=$this->M_pegawai->ketua();
		$this->form_validation->set_rules('namaK','Nama Ketua BPKD Kota Padang Panjang','required|xss_clean');
		$this->form_validation->set_rules('nipK','NIP Ketua BPKD Kota Padang Panjang','required|xss_clean|max_length[18]');
		if($this->form_validation->run()==FALSE){
			$data['sidebar']="#mn5";
			$this->load->view('header');
			$this->load->view('setting',$data);
			$this->load->view('footer', $data);
		}else{
			$this->M_pegawai->resetKetua();
			$this->session->set_flashdata('ketua', 'Diubah');
			redirect('setting');
		}
	}

	

	public function export() {
        $data['pegawai'] = $this->M_pegawai->getAllPegawai();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator("codeXV");
        $spreadsheet->getProperties()->setLastModifiedBy("codeXV");
        $spreadsheet->getProperties()->setTitle("Data Pegawai");
        $spreadsheet->getProperties()->setSubject("codeXV");
        $spreadsheet->getProperties()->setDescription("Data Pegawai BPKD Kota Padang Panjang");

        $spreadsheet->setActiveSheetIndex(0);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'Tanggal Lahir');
        $sheet->setCellValue('G1', 'Golongan Darah');
        $sheet->setCellValue('H1', 'Agama');
        $sheet->setCellValue('I1', 'No Telpon');
        $sheet->setCellValue('J1', 'Email');
        $sheet->setCellValue('K1', 'Alamat');
        $sheet->setCellValue('L1', 'Keterangan');

        $baris = 2;
        $x = 1;

        foreach ($data['pegawai'] as $p) {
            $sheet->setCellValue('A' . $baris, $x);
            $sheet->setCellValue('B' . $baris, $p['nip']);
            $sheet->setCellValue('C' . $baris, $p['nama']);
            $sheet->setCellValue('D' . $baris, $p['jenis_kelamin']);
            $sheet->setCellValue('E' . $baris, $p['tempat_lahir']);
            $sheet->setCellValue('F' . $baris, $p['tgl_lahir']);
            $sheet->setCellValue('G' . $baris, $p['golongan_darah']);
            $sheet->setCellValue('H' . $baris, $p['agama']);
            $sheet->setCellValue('I' . $baris, $p['no_telp']);
            $sheet->setCellValue('J' . $baris, $p['email']);
            $sheet->setCellValue('K' . $baris, $p['alamat']);
            $sheet->setCellValue('L' . $baris, $p['keterangan']);
            $x++;
            $baris++;
        }

        $filename = "Data Pegawai BPKD Kota Padang Panjang " . date('d-m-Y') . '.xlsx';

        $sheet->setTitle('Data Pegawai');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        exit;
    }
}