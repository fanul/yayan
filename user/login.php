<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/user/' . 'user.php';
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $user->check_login($_POST['username'], $_POST['password']);
    if ($login) {
        // Login Success
        $loc = 'http://localhost/titipan/yayan/home.php';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$loc.'">';    
        exit;
        //redirect($loc);
        //header("refresh: " . $loc);
        //echo "berhasil ".$loc;
    } else {
        $loc = 'http://localhost/titipan/yayan/home.php?error=login';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$loc.'">'; 
        //redirect($loc);
        //header("Location: " . $loc);
        //echo "gagal ".$loc;
    }
} else {
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
    //$loc = $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/home.php';
    //header("location: " . $loc);
}
?>