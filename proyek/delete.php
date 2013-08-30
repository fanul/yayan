<?php

if (isset($_GET['id'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    $id_proyek = $_GET['id'];
    $exec = mysql_query("DELETE from proyek where ID_PROYEK='$id_proyek'");

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/proyek/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
