<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
    $db = new DB_Class();
    $nama_proyek = $_POST['nama_proyek'];
    $exec = mysql_query("INSERT INTO proyek(NAMA_PROYEK)
                                   values('" . mysql_real_escape_string($nama_proyek)."'
                                           )") or die(mysql_error());
    if($exec)
    {
        $loc = 'http://localhost/titipan/yayan/proyek/';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$loc.'">';    
        exit;
    }
    else
    {
        
    }
} else
{
    echo "anda tidak diperkenankan untuk mengakses halaman ini secara langsung";
}
?>
