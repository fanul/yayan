<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();

    $id_proyek = $_POST['id_proyek'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $jumlah_kegiatan = $_POST['jumlah_kegiatan'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
    
    $exec = mysql_query("INSERT INTO progress_tenaga_kerja(id_proyek,nama_progres_tenaga_kerja,jumlah_progres_tenaga_kerja,tanggal_progres_tenaga_kerja)
                                   values('" . mysql_real_escape_string($id_proyek) . "',
                                          '" . mysql_real_escape_string($nama_kegiatan) . "',
                                          '" . mysql_real_escape_string($jumlah_kegiatan) . "',
                                          '" . mysql_real_escape_string($tanggal_kegiatan) . "'
                                           )") or die(mysql_error());
    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/pekerja/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    } else {
        
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
