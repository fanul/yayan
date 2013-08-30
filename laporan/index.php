<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
$db = new DB_Class();
session_start();
$nama_bulan = array(
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember"
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Yayan</title>
        <link rel="stylesheet" href="http://localhost/titipan/yayan/css/style.css" type="text/css" media="all" />
    </head>
    <body>
        <!-- Header -->
        <div id="header">
            <div class="shell">
                <!-- Logo + Top Nav -->
                <div id="top">
                    <h1><a href="#">Welcome</a></h1>
                    <div id="top-navigation">
                        <?php
                        if (isset($_SESSION['user_nama'])) {
                            echo 'selamat datang - ' . $_SESSION['user_nama'];
                            echo '<br><a href=http:\\localhost\titipan\yayan\user\logout.php>Logout</a>';
                        } else {
                            if (isset($_GET['error'])) {
                                ?>
                                <div class="msg msg-error">
                                    <p><strong>Password / username salah</strong></p>
                                    <a href="#" class="close">close</a>
                                </div>
                                <?php
                            }
                            ?>
                            <form method="POST" action="http://localhost/titipan/yayan/user/login.php" name="login">
                                <input type="text" name="username"/>
                                <input type="password" name="password"/>
                                <input type="submit" class="button" value="Login"/>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- End Logo + Top Nav -->

                <!-- Main Nav -->
                <div id="navigation">
                    <ul>
                        <li><a href="http://localhost/titipan/yayan/home.php"><span>Home</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/proyek/"><span>Proyek</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kegiatan/"><span>Kegiatan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/pekerja/"><span>Pekerja</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kecelakaan/"><span>Kecelakaan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kondisi/" ><span>Kondisi</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/laporan/" class="active"><span>Laporan</span></a></li>
                        <?php if (isset($_SESSION['user_nama'])) { ?> <li><a href="http://localhost/titipan/yayan/user/"><span>User</span></a></li><?php } ?>
                    </ul>
                </div>
                <!-- End Main Nav -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Container -->
        <div id="container">
            <div class="shell">

                <!-- Main -->
                <div id="main">
                    <div class="cl">&nbsp;</div>

                    <!-- Content -->
                    <!-- Box -->
                    <div class="box">
                        <!-- Box Head -->
                        <div class="box-head">
                            <h2 class="left">Lihat Laporan</h2>
                            <div class="right">
                            </div>
                        </div>
                        <!-- End Box Head -->	

                        <p>
                            <form action="http://localhost/titipan/yayan/laporan/" method="post">
                                <div class="form">
                                    <p>
                                        Pilih Proyek
                                        <select name="id_proyek">
                                            <?php
                                            $result = mysql_query("SELECT * from proyek") or die("Query failed with error: " . mysql_error());
                                            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $row['ID_PROYEK']; ?>"> <?php echo $row['NAMA_PROYEK'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </p>
                                    <p>
                                        Pilih Bulan
                                        <select name="bulan">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">November</option>
                                            <option value="11">Desember</option>
                                        </select>
                                    </p>
                                    <p>
                                        Masukkan Tahun
                                        <input type="text" class="field size2" name="tahun"/>
                                    </p>
                                </div>
                                <div class="buttons">
                                    <input type="submit" class="button" value="lihat" />
                                </div>
                            </form>
                        </p>

                    </div>
                    <!-- End Box -->

                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['tahun'] != '') { ?>
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2 class="left">Laporan</h2>
                                <h2 class="right"> <?php echo $nama_bulan[$_POST['bulan']] . ' - ' . $_POST['tahun'] ?></h2>
                            </div>
                            <!-- End Box Head -->	

                            <!-- Table -->
                            <div class="table">
                                <?php include 'inbodyreport.php'; ?>
                            </div>
                            <!-- Table -->

                            <div class="buttons">
                                <a href="<?php echo 'printpdf.php?id_proyek='.$_POST['id_proyek'].'&bulan='.$_POST['bulan'].'&tahun='.$_POST['tahun']; ?>"><input type="button" class="button" value="cetak PDF" /></a>
                                <a href="<?php echo 'printexcel.php?id_proyek='.$_POST['id_proyek'].'&bulan='.$_POST['bulan'].'&tahun='.$_POST['tahun']; ?>"><input type="button" class="button" value="cetak Excel" /></a>
                            </div>    
                        </div>
                        <!-- End Box -->
                    <?php } ?>
                    <!-- End Content -->



                    <div class="cl">&nbsp;</div>			
                </div>
                <!-- Main -->
            </div>
        </div>
        <!-- End Container -->
    </body>
</html>