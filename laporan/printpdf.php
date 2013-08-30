<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/titipan/yayan/include/pdf/'.'dompdf_config.inc.php';

//ob_start();


$url = 'http://localhost/titipan/yayan/laporan/'.'outreport.php?id_proyek='.$_GET['id_proyek'].'&bulan='.$_GET['bulan'].'&tahun='.$_GET['tahun'];
//require ($url);
$dompdf = new DOMPDF();
$dompdf->load_html_file($url);
//$dompdf->load_html('hello');
$dompdf->render();
$dompdf->stream("laporan.pdf");

?>

