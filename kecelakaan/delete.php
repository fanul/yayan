<?php

if (isset($_GET['id'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    $id_kegiatan = $_GET['id'];
    $exec = mysql_query("DELETE from laporan_kecelakaan where id_laporan_kecelakaan='$id_kegiatan'") or die(mysql_error());

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/kecelakaan/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
