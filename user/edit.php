<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    
    $user_id = $_POST['user_id'];
    $user_nama = $_POST['user_nama'];
    $user_password = md5($_POST['user_password']);
    $user_plain = $_POST['user_password'];
    $user_akses = $_POST['user_akses'];
    
    
    $exec = mysql_query("UPDATE user
                        SET user_nama = '$user_nama',
                        user_password = '$user_password', 
                        user_plain = '$user_plain',
                        user_akses = '$user_akses' 
                         where user_id ='$user_id'") or die(mysql_error());

    if ($exec) {
        $loc = 'http://localhost/titipan/yayan/user/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
    else
    {
        $_SESSION['error'] = mysql_error();
        $loc = 'http://localhost/titipan/yayan/user/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $loc . '">';
        exit;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
