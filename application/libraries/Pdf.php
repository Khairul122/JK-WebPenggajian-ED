<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Include FPDF library only if not already included
if (!class_exists('FPDF')) {
    require(APPPATH . 'libraries/fpdf/fpdf.php');
}

class Pdf extends FPDF {
    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'MAHKAMAH AGUNG REPUBLIK INDONESIA', 0, 1, 'C');
        $this->Cell(0, 10, 'SALINAN KEPUTUSAN DIREKTUR JENDERAL BADAN PERADILAN UMUM', 0, 1, 'C');
        $this->Cell(0, 10, 'NOMOR 412343/DDFD/SK/FR54/2019', 0, 1, 'C');
        $this->Cell(0, 10, 'TENTANG', 0, 1, 'C');
        $this->Cell(0, 10, 'KENAIKAN PANGKAT PEGAWAI NEGERI SIPIL', 0, 1, 'C');
        $this->Cell(0, 10, 'DIREKTUR JENDERAL BADAN PERADILAN UMUM,', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}
?>
