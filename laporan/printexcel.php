<?php
include_once 'query.php';
$q = new Query();

$nama_bulan = array(
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember"
);

//ndapetin nama proyek
$id = $_GET['id_proyek'];
$temp = mysql_query("select * from proyek where id_proyek='$id'");
$nm = mysql_fetch_array($temp);

//BUAT TENAGA KERJA
$rx = $q->getReportTenagaKerja($_GET['id_proyek'], $_GET['bulan'] . '-' . $_GET['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kerja[$rowx['nama_progres_tenaga_kerja']] = $rowx;
}

//BUAT KEGIATAN
$rx = $q->getReportKegiatan($_GET['id_proyek'], $_GET['bulan'] . '-' . $_GET['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kegiatan[$rowx['nama_progres_kegiatan']] = $rowx;
}

//BUAT KECELAKAAN
$rx = $q->getReportKecelakaan($_GET['id_proyek'], $_GET['bulan'] . '-' . $_GET['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kecelakaan[$rowx['nama_laporan_kecelakaan']] = $rowx;
}

//BUAT KONDISI
$rx = $q->getReportKondisi($_GET['id_proyek'], $_GET['bulan'] . '-' . $_GET['tahun']);
while ($rowx = mysql_fetch_array($rx)) {
    $kondisi[$rowx['nama_kondisi']] = $rowx;
}

require_once $_SERVER['DOCUMENT_ROOT'].'/titipan/yayan/include/excel/'. 'PHPExcel.php';
$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();

$sheet->setCellValue('A1', 'LAPORAN BULANAN');
$sheet->mergeCells('A1:N1');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('A3', 'NO');
$sheet->mergeCells('A3:B3');
$sheet->setCellValue('A4', 'PROYEK');
$sheet->mergeCells('A4:B4');

$sheet->setCellValue('C3', ':1');
$sheet->setCellValue('C4', $nm['NAMA_PROYEK']);

$sheet->setCellValue('G3', 'LAPORAN BULAN');
$sheet->mergeCells('G3:I3');
//$sheet->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('J3', ':');
$sheet->getStyle('J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('J4', ':');
$sheet->getStyle('J4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);


$sheet->setCellValue('K3', $nama_bulan[$_GET['bulan']].' '.$_GET['tahun']);
$sheet->mergeCells('K3:M3');
//$sheet->getStyle('K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('G4', 'LAPORAN KE');
$sheet->mergeCells('G4:I4');
//$sheet->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);

$sheet->setCellValue('A6', 'A. Kegiatan Safety');
$sheet->mergeCells('A6:N6');

$sheet->setCellValue('D7', 's/d bln lalu');
$sheet->setCellValue('E7', 'bln ini');
$sheet->setCellValue('F7', 's/d bln ini');

$sheet->setCellValue('K7', 's/d bln lalu');
$sheet->mergeCells('K7:L7');
$sheet->setCellValue('M7', 'bln ini');
$sheet->setCellValue('N7', 's/d bln ini');


if (isset($kegiatan['safety talk']))
    $val1 = $kegiatan['safety talk']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['safety talk']))
    $val2 = $kegiatan['safety talk']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['safety talk']))
    $val3 = $kegiatan['safety talk']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('B8', 'A1');
$sheet->setCellValue('C8', 'Safety Talk');
$sheet->setCellValue('D8', $val1);
$sheet->setCellValue('E8', $val2);
$sheet->setCellValue('F8', $val3);

if (isset($kegiatan['inspeksi k3']))
    $val1 = $kegiatan['inspeksi k3']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['inspeksi k3']))
    $val2 = $kegiatan['inspeksi k3']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['inspeksi k3']))
    $val3 = $kegiatan['inspeksi k3']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('B9', 'A2');
$sheet->setCellValue('C9', 'inspeksi k3');
$sheet->setCellValue('D9', $val1);
$sheet->setCellValue('E9', $val2);
$sheet->setCellValue('F9', $val3);

if (isset($kegiatan['safety patrol']))
    $val1 = $kegiatan['safety patrol']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['safety patrol']))
    $val2 = $kegiatan['safety patrol']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['safety patrol']))
    $val3 = $kegiatan['safety patrol']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('B10', 'A3');
$sheet->setCellValue('C10', 'safety patrol');
$sheet->setCellValue('D10', $val1);
$sheet->setCellValue('E10', $val2);
$sheet->setCellValue('F10', $val3);

if (isset($kegiatan['safety meeting']))
    $val1 = $kegiatan['safety meeting']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['safety meeting']))
    $val2 = $kegiatan['safety meeting']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['safety meeting']))
    $val3 = $kegiatan['safety meeting']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('B11', 'A4');
$sheet->setCellValue('C11', 'safety meeting');
$sheet->setCellValue('D11', $val1);
$sheet->setCellValue('E11', $val2);
$sheet->setCellValue('F11', $val3);

if (isset($kegiatan['laporan']))
    $val1 = $kegiatan['laporan']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['laporan']))
    $val2 = $kegiatan['laporan']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['laporan']))
    $val3 = $kegiatan['laporan']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('H8', 'A5');
$sheet->setCellValue('I8', 'laporan');
$sheet->mergeCells('I8:J8');
$sheet->setCellValue('K8', $val1);
$sheet->mergeCells('K8:L8');
$sheet->setCellValue('M8', $val2);
$sheet->setCellValue('N8', $val3);

if (isset($kegiatan['SIP']))
    $val1 = $kegiatan['SIP']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['SIP']))
    $val2 = $kegiatan['SIP']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['SIP']))
    $val3 = $kegiatan['SIP']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('H9', 'A6');
$sheet->setCellValue('I9', 'SIP');
$sheet->mergeCells('I9:J9');
$sheet->setCellValue('K9', $val1);
$sheet->mergeCells('K9:L9');
$sheet->setCellValue('M9', $val2);
$sheet->setCellValue('N9', $val3);

if (isset($kegiatan['SIB']))
    $val1 = $kegiatan['SIB']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['SIB']))
    $val2 = $kegiatan['SIB']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['SIB']))
    $val3 = $kegiatan['SIB']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('H10', 'A7');
$sheet->setCellValue('I10', 'SIB');
$sheet->mergeCells('I10:J10');
$sheet->setCellValue('K10', $val1);
$sheet->mergeCells('K10:L10');
$sheet->setCellValue('M10', $val2);
$sheet->setCellValue('N10', $val3);

if (isset($kegiatan['pelatihan']))
    $val1 = $kegiatan['pelatihan']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kegiatan['pelatihan']))
    $val2 = $kegiatan['pelatihan']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kegiatan['pelatihan']))
    $val3 = $kegiatan['pelatihan']['jumlah_total']; 
else
    $val3 = 0;
$sheet->setCellValue('H11', 'A8');
$sheet->setCellValue('I11', 'pelatihan');
$sheet->mergeCells('I11:J11');
$sheet->setCellValue('K11', $val1);
$sheet->mergeCells('K11:L11');
$sheet->setCellValue('M11', $val2);
$sheet->setCellValue('N11', $val3);

$sheet->setCellValue('A13', 'B. JUMLAH TENAGA KERJA DAN JAM KERJA');
$sheet->mergeCells('A13:N13');

$sheet->setCellValue('H14', 's/d bln lalu');
$sheet->mergeCells('H14:I14');
$sheet->setCellValue('K14', 'bln ini');
$sheet->setCellValue('M14', 's/d bln ini');
$sheet->mergeCells('M14:N14');

if (isset($kerja['jumlah hari kerja']))
    $val1 = $kerja['jumlah hari kerja']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kerja['jumlah hari kerja']))
    $val2 = $kerja['jumlah hari kerja']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kerja['jumlah hari kerja']))
    $val3 = $kerja['jumlah hari kerja']['jumlah_total']; 
else
    $val4 = 0;
$sheet->setCellValue('B15', 'B1');
$sheet->setCellValue('C15', 'Jumlah hari kerja (akumulatif)');
$sheet->mergeCells('C15:E15');
$sheet->setCellValue('H15', $val1);
$sheet->mergeCells('H15:I15');
$sheet->setCellValue('J15', '+');
$sheet->getStyle('J15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K15', $val2);
$sheet->setCellValue('L15', '=');
$sheet->getStyle('L15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M15', $val3);
$sheet->mergeCells('M15:N15');

if (isset($kerja['jumlah jam kerja']))
    $val1 = $kerja['jumlah jam kerja']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kerja['jumlah jam kerja']))
    $val2 = $kerja['jumlah jam kerja']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kerja['jumlah jam kerja']))
    $val3 = $kerja['jumlah jam kerja']['jumlah_total']; 
else
    $val4 = 0;
$sheet->setCellValue('B16', 'B2');
$sheet->setCellValue('C16', 'jumlah jam kerja (akumulatif)');
$sheet->mergeCells('C16:E16');
$sheet->setCellValue('H16', $val1);
$sheet->mergeCells('H16:I16');
$sheet->setCellValue('J16', '+');
$sheet->getStyle('J16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K16', $val2);
$sheet->setCellValue('L16', '=');
$sheet->getStyle('L16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M16', $val3);
$sheet->mergeCells('M16:N16');

if (isset($kerja['jumlah tenaga kerja']))
    $val1 = $kerja['jumlah tenaga kerja']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kerja['jumlah tenaga kerja']))
    $val2 = $kerja['jumlah tenaga kerja']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kerja['jumlah tenaga kerja']))
    $val3 = $kerja['jumlah tenaga kerja']['jumlah_total']; 
else
    $val4 = 0;
$sheet->setCellValue('B17', 'B3');
$sheet->setCellValue('C17', 'jumlah tenaga kerja (akumulatif)');
$sheet->mergeCells('C17:E17');
$sheet->setCellValue('H17', $val1);
$sheet->mergeCells('H17:I17');
$sheet->setCellValue('J17', '+');
$sheet->getStyle('J17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K17', $val2);
$sheet->setCellValue('L17', '=');
$sheet->getStyle('L17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M17', $val3);
$sheet->mergeCells('M17:N17');

if (isset($kerja['jumlah kehilangan jam kerja']))
    $val1 = $kerja['jumlah kehilangan jam kerja']['jumlah_bulan_lalu']; 
else
    $val1 = 0;
if (isset($kerja['jumlah kehilangan jam kerja']))
    $val2 = $kerja['jumlah kehilangan jam kerja']['jumlah_bulan_ini']; 
else
    $val2 = 0;
if (isset($kerja['jumlah kehilangan jam kerja']))
    $val3 = $kerja['jumlah kehilangan jam kerja']['jumlah_total']; 
else
    $val4 = 0;
$sheet->setCellValue('B18', 'B4');
$sheet->setCellValue('C18', 'jumlah kehilangan jam kerja (akumulatif)');
$sheet->mergeCells('C18:E18');
$sheet->setCellValue('H18', $val1);
$sheet->mergeCells('H18:I18');
$sheet->setCellValue('J18', '+');
$sheet->getStyle('J18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K18', $val2);
$sheet->setCellValue('L18', '=');
$sheet->getStyle('L18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M18', $val3);
$sheet->mergeCells('M18:N18');

$sheet->setCellValue('A20', 'C. KECELAKAAN KERJA');
$sheet->mergeCells('A20:N20');

$sheet->setCellValue('B21', 'faktor penyebab terjadinya kecelakaan kerja');
$sheet->mergeCells('B21:F21');

$sheet->setCellValue('H21', 's/d bln lalu');
$sheet->mergeCells('H21:J21');
$sheet->setCellValue('K21', 'bln ini');
$sheet->setCellValue('L21', 's/d bln ini');
$sheet->mergeCells('L21:N21');

$sumCelaka['bulan_lalu'] = 0; $sumCelaka['bulan_ini'] = 0; $sumCelaka['total'] = 0;

if (isset($kecelakaan['manusia'])) {
    $val1 = $kecelakaan['manusia']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['manusia']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kecelakaan['manusia'])) {
    $val2 = $kecelakaan['manusia']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['manusia']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kecelakaan['manusia'])) {
    $val3 = $kecelakaan['manusia']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['manusia']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B22', 'C1');
$sheet->setCellValue('C22', 'manusia');
$sheet->mergeCells('C22:G22');
$sheet->setCellValue('I22', $val1);
$sheet->setCellValue('J22', '+');
$sheet->getStyle('J22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K22', $val2);
$sheet->setCellValue('L22', '=');
$sheet->getStyle('L22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M22', $val3);
$sheet->setCellValue('N22', 'kasus');

if (isset($kecelakaan['konstruksi'])) {
    $val1 = $kecelakaan['konstruksi']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['konstruksi']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kecelakaan['konstruksi'])) {
    $val2 = $kecelakaan['konstruksi']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['konstruksi']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kecelakaan['konstruksi'])) {
    $val3 = $kecelakaan['konstruksi']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['konstruksi']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B23', 'C2');
$sheet->setCellValue('C23', 'konstruksi');
$sheet->mergeCells('C23:G23');
$sheet->setCellValue('I23', $val1);
$sheet->setCellValue('J23', '+');
$sheet->getStyle('J23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K23', $val2);
$sheet->setCellValue('L23', '=');
$sheet->getStyle('L23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M23', $val3);
$sheet->setCellValue('N23', 'kasus');

if (isset($kecelakaan['alat kerja'])) {
    $val1 = $kecelakaan['alat kerja']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['alat kerja']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kecelakaan['alat kerja'])) {
    $val2 = $kecelakaan['alat kerja']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['alat kerja']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kecelakaan['alat kerja'])) {
    $val3 = $kecelakaan['alat kerja']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['alat kerja']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B24', 'C3');
$sheet->setCellValue('C24', 'alat kerja');
$sheet->mergeCells('C24:G24');
$sheet->setCellValue('I24', $val1);
$sheet->setCellValue('J24', '+');
$sheet->getStyle('J24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K24', $val2);
$sheet->setCellValue('L24', '=');
$sheet->getStyle('L24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M24', $val3);
$sheet->setCellValue('N24', 'kasus');

if (isset($kecelakaan['lingkungan kerja'])) {
    $val1 = $kecelakaan['lingkungan kerja']['jumlah_bulan_lalu'];
    $sumCelaka['bulan_lalu']+=$kecelakaan['lingkungan kerja']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kecelakaan['lingkungan kerja'])) {
    $val2 = $kecelakaan['lingkungan kerja']['jumlah_bulan_ini'];
    $sumCelaka['bulan_ini']+=$kecelakaan['lingkungan kerja']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kecelakaan['lingkungan kerja'])) {
    $val3 = $kecelakaan['lingkungan kerja']['jumlah_total'];
    $sumCelaka['total']+=$kecelakaan['lingkungan kerja']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B25', 'C4');
$sheet->setCellValue('C25', 'lingkungan kerja');
$sheet->mergeCells('C25:G25');
$sheet->setCellValue('I25', $val1);
$sheet->setCellValue('J25', '+');
$sheet->getStyle('J25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K25', $val2);
$sheet->setCellValue('L25', '=');
$sheet->getStyle('L25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M25', $val3);
$sheet->setCellValue('N25', 'kasus');

$sheet->setCellValue('B26', 'C5');
$sheet->setCellValue('C26', 'jumlah kecelakaan kerja (C1+C2+C3+C4)');
$sheet->mergeCells('C26:G26');
$sheet->setCellValue('I26', $sumCelaka['bulan_lalu']);
$sheet->setCellValue('J26', '+');
$sheet->getStyle('J26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K26', $sumCelaka['bulan_ini']);
$sheet->setCellValue('L26', '=');
$sheet->getStyle('L26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M26', $sumCelaka['total']);
$sheet->setCellValue('N26', 'kasus');

$sheet->setCellValue('A28', 'D. KONDISI KORBAN KECELAKAAN');
$sheet->mergeCells('A28:N28');

$sheet->setCellValue('B29', 'kondisi korban');
$sheet->mergeCells('B29:F29');

$sheet->setCellValue('H29', 's/d bln lalu');
$sheet->mergeCells('H29:J29');
$sheet->setCellValue('K29', 'bln ini');
$sheet->setCellValue('L29', 's/d bln ini');
$sheet->mergeCells('L29:N29');

$sumKondisi['bulan_lalu'] = 0; $sumKondisi['bulan_ini'] = 0; $sumKondisi['total'] = 0;

if (isset($kondisi['luka ringan'])) {
    $val1 = $kondisi['luka ringan']['jumlah_bulan_lalu'];
    $sumKondisi['bulan_lalu']+=$kondisi['luka ringan']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kondisi['luka ringan'])) {
    $val2 = $kondisi['luka ringan']['jumlah_bulan_ini'];
    $sumKondisi['bulan_ini']+=$kondisi['luka ringan']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kondisi['luka ringan'])) {
    $val3 = $kondisi['luka ringan']['jumlah_total'];
    $sumKondisi['total']+=$kondisi['luka ringan']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B30', 'D1');
$sheet->setCellValue('C30', 'luka ringan');
$sheet->mergeCells('C30:G30');
$sheet->setCellValue('I30', $val1);
$sheet->setCellValue('J30', '+');
$sheet->getStyle('J30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K30', $val2);
$sheet->setCellValue('L30', '=');
$sheet->getStyle('L30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M30', $val3);
$sheet->setCellValue('N30', 'orang');

if (isset($kondisi['luka berat'])) {
    $val1 = $kondisi['luka berat']['jumlah_bulan_lalu'];
    $sumKondisi['bulan_lalu']+=$kondisi['luka berat']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kondisi['luka berat'])) {
    $val2 = $kondisi['luka berat']['jumlah_bulan_ini'];
    $sumKondisi['bulan_ini']+=$kondisi['luka berat']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kondisi['luka berat'])) {
    $val3 = $kondisi['luka berat']['jumlah_total'];
    $sumKondisi['total']+=$kondisi['luka berat']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B31', 'D2');
$sheet->setCellValue('C31', 'luka berat');
$sheet->mergeCells('C31:G31');
$sheet->setCellValue('I31', $val1);
$sheet->setCellValue('J31', '+');
$sheet->getStyle('J31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K31', $val2);
$sheet->setCellValue('L31', '=');
$sheet->getStyle('L31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M31', $val3);
$sheet->setCellValue('N31', 'orang');

if (isset($kondisi['meninggal'])) {
    $val1 = $kondisi['meninggal']['jumlah_bulan_lalu'];
    $sumKondisi['bulan_lalu']+=$kondisi['meninggal']['jumlah_bulan_lalu'];
} else
    $val1 = 0;
if (isset($kondisi['meninggal'])) {
    $val2 = $kondisi['meninggal']['jumlah_bulan_ini'];
    $sumKondisi['bulan_ini']+=$kondisi['meninggal']['jumlah_bulan_ini'];
} else
    $val2 = 0; 
if (isset($kondisi['meninggal'])) {
    $val3 = $kondisi['meninggal']['jumlah_total'];
    $sumKondisi['total']+=$kondisi['meninggal']['jumlah_total'];
} else
    $val3 = 0; 
$sheet->setCellValue('B32', 'D3');
$sheet->setCellValue('C32', 'meninggal');
$sheet->mergeCells('C32:G32');
$sheet->setCellValue('I32', $val1);
$sheet->setCellValue('J32', '+');
$sheet->getStyle('J32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K32', $val2);
$sheet->setCellValue('L32', '=');
$sheet->getStyle('L32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M32', $val3);
$sheet->setCellValue('N32', 'orang');

$sheet->setCellValue('B33', 'D4');
$sheet->setCellValue('C33', 'jumlah korban kecelakaan (D1+D2+D3)');
$sheet->mergeCells('C33:G33');
$sheet->setCellValue('I33', $sumCelaka['bulan_lalu']);
$sheet->setCellValue('J33', '+');
$sheet->getStyle('J33')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('K33', $sumCelaka['bulan_ini']);
$sheet->setCellValue('L33', '=');
$sheet->getStyle('L33')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue('M33', $sumCelaka['total']);
$sheet->setCellValue('N33', 'kasus');

$styleUnderline = array(
  'font' => array(
    'underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE
  )
);


$sheet->setCellValue('A35', 'E. TINGKAT KEKERAPAN (FR) DAN TINGKAT KEPARAHAN (SR) SAMPAI DENGAN BULAN INI');
$sheet->mergeCells('A35:N35');

$sheet->setCellValue('B36', 'Frequency Rate / FR (Tingkat Kekerapan)');
$sheet->mergeCells('B36:E36');

$sheet->setCellValue('B37', 'Jumlah Kecelakaan kerja (C5c)');
$sheet->mergeCells('B37:E37');
$sheet->getStyle('B37')->applyFromArray($styleUnderline);
$sheet->getStyle('B37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('B38', 'Jml Tenaga Kerja (B3c) x jml jam kerja (B2c)');
$sheet->mergeCells('B38:E38');
$sheet->getStyle('B38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('F37', 'x 1.000.000');
$sheet->mergeCells('F37:F38');
$sheet->getStyle('F37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('G37', '=');
$sheet->mergeCells('G37:G38');
$sheet->getStyle('G37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('H37', $sumCelaka['total']);
$sheet->mergeCells('H37:I37');
$sheet->getStyle('H37')->applyFromArray($styleUnderline);
$sheet->getStyle('H37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
    $tox = ($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']);
else $tox = 0;

$sheet->setCellValue('H38', $tox);
$sheet->mergeCells('H38:I38');
$sheet->getStyle('H38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('J37', 'x 1.000.000');
$sheet->mergeCells('J37:J38'); $sheet->mergeCells('J37:K38');
$sheet->getStyle('J37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('L37', '=');
$sheet->mergeCells('L37:L38');
$sheet->getStyle('L37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
$tox = (
          ($sumCelaka['total']/($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']))
          *1000000
       );
else $tox = 0;
$sheet->setCellValue('M37', $tox);
$sheet->mergeCells('M37:M38');
$sheet->getStyle('M37')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

/* ================= */

$sheet->setCellValue('B40', 'Saferity Rate / SR (Tingkat Keparahan)');
$sheet->mergeCells('B40:E40');

$sheet->setCellValue('B41', 'Jumlah kehilangan jam kerja (B4c)');
$sheet->mergeCells('B41:E41');
$sheet->getStyle('B41')->applyFromArray($styleUnderline);
$sheet->getStyle('B41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('B42', 'Jml Tenaga Kerja (B3c) x jml jam kerja (B2c)');
$sheet->mergeCells('B42:E42');
$sheet->getStyle('B42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('F41', 'x 1.000.000');
$sheet->mergeCells('F41:F42');
$sheet->getStyle('F41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('G41', '=');
$sheet->mergeCells('G42:G42');
$sheet->getStyle('G41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

if(isset($kerja['jumlah kehilangan jam kerja']))
    $toz =  $kerja['jumlah kehilangan jam kerja']['jumlah_total']; 
else $toz = 0;
$sheet->setCellValue('H41', $toz);
$sheet->mergeCells('H41:I41');
$sheet->getStyle('H41')->applyFromArray($styleUnderline);
$sheet->getStyle('H41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
    $tox = ($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']);
else $tox = 0;

$sheet->setCellValue('H42', $tox);
$sheet->mergeCells('H42:I42');
$sheet->getStyle('H42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('J41', 'x 1.000.000');
$sheet->mergeCells('J41:J42'); $sheet->mergeCells('J41:K42');
$sheet->getStyle('J41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->setCellValue('L41', '=');
$sheet->mergeCells('L41:L42');
$sheet->getStyle('L41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

if(isset($kerja['jumlah tenaga kerja']) && isset($kerja['jumlah jam kerja']))
$tox = (
          ($toz/($kerja['jumlah tenaga kerja']['jumlah_total'] * $kerja['jumlah jam kerja']['jumlah_total']))
          *1000000
       );
else $tox = 0;
$sheet->setCellValue('M41', $tox);
$sheet->mergeCells('M41:M42');
$sheet->getStyle('M41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="rekap_tahunan.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>