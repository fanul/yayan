<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    
    $id_kegiatan = $_POST['id_kegiatan'];
    $id_proyek = $_POST['id_proyek'];
    $nama_kegiatan= $_POST['nama_kegiatan'];
    $jumlah_kegiatan = $_POST['jumlah_kegiatan'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
    
    $exec = mysql_query("UPDATE laporan_kondisi
                        SET nama_kondisi = '$nama_kegiatan',
                        id_proyek = '$id_proyek', 
                        jumlah_kondisi = '$jumlah_kegiatan',
                        tanggal_kondisi = '$tanggal_kegiatan' 
                         where id_kondisi ='$id_kegiatan'") or die(mysql_error());

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/kondisi/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
    else
    {
        $_SESSION['error'] = mysql_error();
        $loc = 'http://localhost/titipan/yayan/kegiatan/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
