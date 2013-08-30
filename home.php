<?php
session_start();
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
                        <li><a href="http://localhost/titipan/yayan/home.php" class="active"><span>Home</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/proyek/"><span>Proyek</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kegiatan/"><span>Kegiatan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/pekerja/"><span>Pekerja</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kecelakaan/"><span>Kecelakaan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kondisi/" ><span>Kondisi</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/laporan/"><span>Laporan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/random/"><span>Random</span></a></li>
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
                            <h2 class="left">Home</h2>
                            <div class="right">
                            </div>
                        </div>
                        <!-- End Box Head -->	

                        <p>
                            <pre>
                                <h2>
                                    Selamat datang, silahkan memilih menu untuk melakukan aksi lebih lanjut.
                                </h2>
                            </pre>
                        </p>

                    </div>
                    <!-- End Box -->
                    <!-- End Content -->



                    <div class="cl">&nbsp;</div>			
                </div>
                <!-- Main -->
            </div>
        </div>
        <!-- End Container -->

    </body>
</html>