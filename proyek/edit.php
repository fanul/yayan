<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    $id_proyek = $_POST['id_proyek'];
    $nama_proyek = $_POST['nama_proyek'];
    $exec = mysql_query("UPDATE proyek SET nama_proyek = '$nama_proyek' where ID_PROYEK='$id_proyek'");

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/proyek/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
