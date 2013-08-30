<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
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
                            echo '<br><a href="http://localhost/titipan/yayan/user/logout.php">Logout</a>';
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
                        <li><a href="http://localhost/titipan/yayan/proyek/" class="active"><span>Proyek</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kegiatan/"><span>Kegiatan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/pekerja/"><span>Pekerja</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kecelakaan/"><span>Kecelakaan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kondisi/" ><span>Kondisi</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/laporan/"><span>Laporan</span></a></li>
                        <?php if(isset ($_SESSION['user_nama'])) {?> <li><a href="http://localhost/titipan/yayan/user/"><span>User</span></a></li><?php } ?>
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

                    <?php
                    if (isset($_SESSION['user_nama'])) {
                        ?>
                        <!-- Sidebar 1 -->
                        <div id="sidebar">

                                                <?php
                    if (isset($_SESSION['user_nama']) && isset ($_GET['id'])) {
                        ?>
                        <!-- Sidebar2 -->

                            <!-- Box -->
                            <div class="box">

                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Edit - Proyek : <?php echo $_GET['nama'] ?></h2>
                                </div>
                                <!-- End Box Head-->
                                
                                <div class="box-content">
                                    <form action="http://localhost/titipan/yayan/proyek/edit.php" method="post">
                                        <div class="form">
                                            <p>
                                                Masukan nama Proyek
                                                <input type="text" class="field size2" name="nama_proyek" value="<?php echo $_GET['nama']; ?>"/>
                                                <input type="hidden" name="id_proyek" value="<?php echo $_GET['id']; ?>" />
                                            </p>
                                        </div>
                                        <div class="buttons">
                                            <input type="submit" class="button" value="edit" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Box -->
                        <!-- End Sidebar2 -->

                        <?php
                    }
                    ?>
                            
                            <!-- Box -->
                            <div class="box">

                                <!-- Box Head -->
                                <div class="box-head">
                                    <h2>Tambah - Proyek</h2>
                                </div>
                                <!-- End Box Head-->
                                
                                <div class="box-content">
                                    <form action="http://localhost/titipan/yayan/proyek/tambah.php" method="post">
                                        <div class="form">
                                            <p>
                                                Masukan nama Proyek
                                                <input type="text" class="field size2" name="nama_proyek"/>
                                            </p>
                                        </div>
                                        <div class="buttons">
                                            <input type="submit" class="button" value="tambah" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Box -->
                        </div>
                        <!-- End Sidebar 1-->

                        <?php
                    }
                    ?>

                    <!-- Content -->
                    <div id="content">
                        <!-- Box -->
                        <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                                <h2 class="left">Daftar Proyek</h2>
                                <div class="right">
                                </div>
                            </div>
                            <!-- End Box Head -->	

                            <!-- Table -->
                            <?php
                            $index = 1;
                            ?>
                            <div class="table">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th width="13">No</th>
                                        <th>Nama Proyek</th>
                                        <?php
                                        if (isset($_SESSION['user_nama'])) {
                                            ?>
                                            <th width="110" class="ac">Fungsi</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    $db = new DB_Class();
                                    $index = 1;
                                    $result = mysql_query("SELECT * from proyek") or die("Query failed with error: " . mysql_error());
                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                        ?>
                                        <tr <?php if ($index % 2 == 0)
                                        echo 'class="odd"'; ?>>
                                            <td><?php echo $index++; ?></td>
                                            <td><h3><a href="#"><?php echo $row['NAMA_PROYEK'] ?></a></h3></td>
                                            <?php
                                            if (isset($_SESSION['user_nama'])) {
                                                ?>
                                                <td>
                                                    <a href="<?php echo 'http://localhost/titipan/yayan/proyek/delete.php?id=' . $row['ID_PROYEK']; ?>" class="ico del">Delete</a>
                                                    <a href="<?php echo 'http://localhost/titipan/yayan/proyek/index.php?id=' . $row['ID_PROYEK'].'&nama='.$row['NAMA_PROYEK']; ?>" class="ico edit">Edit</a>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>

                            </div>
                            <!-- Table -->

                        </div>
                        <!-- End Box -->

                    </div>
                    <!-- End Content -->



                    <div class="cl">&nbsp;</div>			
                </div>
                <!-- Main -->
            </div>
        </div>
        <!-- End Container -->

    </body>
</html>