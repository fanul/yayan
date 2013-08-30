<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();

    $user_nama = $_POST['user_nama'];
    $user_password = md5($_POST['user_password']);
    $user_plain = $_POST['user_password'];
    $user_akses = $_POST['user_akses'];
    
    $exec = mysql_query("INSERT INTO user(user_nama,user_password,user_plain,user_akses)
                                   values('" . mysql_real_escape_string($user_nama) . "',
                                          '" . mysql_real_escape_string($user_password) . "',
                                          '" . mysql_real_escape_string($user_plain) . "',
                                          '" . mysql_real_escape_string($user_akses) . "'
                                           )") or die(mysql_error());
    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/user/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    } else {
        
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
