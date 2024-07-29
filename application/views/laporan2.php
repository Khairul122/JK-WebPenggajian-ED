<?php
// Pastikan memuat library Pdf
require_once(APPPATH . 'libraries/Pdf.php');

// Inisialisasi PDF
$pdf = new Pdf();
$pdf->AddPage('P', [210, 330]); // Ukuran F4 dalam milimeter
$pdf->SetFont('Arial', '', 11);

// Konten halaman pertama
$pdf->MultiCell(0, 10, "Menimbang : Bahwa Pegawai Negeri Sipil yang namanya tersebut dalam keputusan ini, memenuhi syarat dan dipandang cakap untuk dinaikkan pangkatnya setingkat lebih tinggi;", 0, 'J');
$pdf->Ln(5);
$pdf->MultiCell(0, 10, "Mengingat :", 0, 'J');
$pdf->MultiCell(0, 10, "1. Undang-Undang Nomor 3 Tahun 2009 tentang Perubahan Kedua Atas Undang-Undang Nomor 14 Tahun 1985 tentang Mahkamah Agung;", 0, 'J');
$pdf->MultiCell(0, 10, "2. Undang-Undang Nomor 48 Tahun 2009 tentang Kekuasaan Kehakiman;", 0, 'J');
$pdf->MultiCell(0, 10, "3. Undang-Undang Nomor 49 Tahun 2009 tentang Perubahan Kedua Atas Undang-Undang Nomor 2 Tahun 1986 tentang Peradilan Umum;", 0, 'J');
$pdf->MultiCell(0, 10, "4. Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;", 0, 'J');
$pdf->MultiCell(0, 10, "5. Peraturan Pemerintahan Nomor 41 Tahun 2002 tentang Kenaikan Jabatan dan Pangkat Hakim;", 0, 'J');
$pdf->MultiCell(0, 10, "6. Peraturan Pemerintahan Nomor 9 Tahun 2003 tentang Wewenang Pengangkatan, Pemindahan dan Pemberhentian Pegawai Negeri Sipil;", 0, 'J');
$pdf->MultiCell(0, 10, "7. Peraturan Pemerintahan Nomor 94 Tahun 2012 tentang Hak Keuangan dan Fasilitas Hakim Yang Berada di Bawah Mahkamah Agung;", 0, 'J');
$pdf->MultiCell(0, 10, "8. Peraturan Pemerintahan Nomor 34 Tahun 2014 tentang Perubahan Keenam Belas Atas Peraturan Pemerintahan Nomor 7 Tahun 1977 tentang Peraturan Gaji Pegawai Negeri Sipil;", 0, 'J');
$pdf->MultiCell(0, 10, "9. Keputusan Ketua Mahkamah Agung RI Nomor 125/KMA/SK/IX/2009 tanggal 2 September 2009 tentang Pendelegasian Sebagian Wewenang Kepada Para Pejabat Eselon I dan Ketua Pengadilan Tingkat Banding di Lingkungan Mahkamah Agung untuk Penandatanganan  di Bidang Kepegawaian;", 0, 'J');
$pdf->MultiCell(0, 10, "Memperhatikan : Persetujuan Teknis Kepala Badan Kepegawaian Negara Nomor " . $no . " Tanggal " . date_indo($tglpersetujuan) . ".", 0, 'J');

// Konten halaman kedua
$pdf->AddPage('P', [210, 330]); // Ukuran F4 dalam milimeter
$pdf->MultiCell(0, 10, "Ditetapkan di Jakarta pada tanggal " . date_indo(date('Y-m-d')) . "\nDIREKTUR JENDERAL BADAN PERADILAN UMUM, \nttd.\n" . $direkturjendral . "\nDIREKTUR PEMBINA TENAGA TEKNIS PERADILAN UMUM, \nttd.\n" . $direkturpembina, 0, 'C');

$pdf->Output('SK_Kenaikan_Pangkat.pdf', 'I');
?>
