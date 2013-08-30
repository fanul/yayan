<?php

if (isset($_GET['id'])) {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    $user_id = $_GET['id'];
    $exec = mysql_query("DELETE from user where user_id='$user_id'") or die(mysql_error());

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/user/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
