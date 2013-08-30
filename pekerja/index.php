<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/titipan/yayan/' . 'config.php';
$db = new DB_Class();
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
                        <li><a href="http://localhost/titipan/yayan/proyek/"><span>Proyek</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kegiatan/"><span>Kegiatan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/pekerja/" class="active"><span>Pekerja</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kecelakaan/"><span>Kecelakaan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kondisi/" ><span>Kondisi</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/laporan/"><span>Laporan</span></a></li>
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
                <?php
                if (isset($_SESSION['error'])) {
                    ?>
                    <div class="msg msg-error">
                        <p><strong><?php echo $_SESSION['error'] ?></strong></p>
                        <a href="#" class="close">close</a>
                    </div>
                <?php } unset($_SESSION['error']); ?>

                <!-- Main -->
                <div id="main">
                    <div class="cl">&nbsp;</div>

                    <?php
                    if (isset($_SESSION['user_nama'])) {
                        ?>
                        <!-- Sidebar 1 -->
                        <div id="sidebar">

                            <?php
                            if (isset($_SESSION['user_nama']) && isset($_GET['id'])) {
                                ?>
                                <!-- Sidebar2 -->

                                <!-- Box -->
                                <div class="box">

                                    <!-- Box Head -->
                                    <div class="box-head">
                                        <h2>Edit - kegiatan : <br> </h2>
                                        <span style="color: #000">
                                            <?php
                                            echo $_GET['nama'] . ' di ' . $_GET['proyek'] . '<br> @ ' . $_GET['tanggal'];
                                            ?>
                                        </span>
                                    </div>
                                    <!-- End Box Head-->

                                    <div class="box-content">
                                        <form action="http://localhost/titipan/yayan/pekerja/edit.php" method="post">
                                            <div class="form">
                                                <p><br><input type="hidden" name="id_kegiatan" value="<?php echo $_GET['id']; ?>"></p>
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
                                                                Pilih Progress
                                                                <select name="nama_kegiatan">
                                                                    <option value="jumlah hari kerja">Jumlah hari kerja</option>
                                                                    <option value="jumlah jam kerja">jumlah jam kerja</option>
                                                                    <option value="jumlah tenaga kerja">jumlah tenaga kerja</option>
                                                                    <option value="jumlah kehilangan jam kerja">jumlah kehilangan jam kerja</option>
                                                                </select>
                                                            </p>
                                                            <p>
                                                                Masukan tanggal dengan format: yyyy-mm-dd
                                                                <input type="text" class="field size2" name="tanggal_kegiatan" value="<?php echo $_GET['tanggal'] ?>"/>
                                                            </p>
                                                            <p>
                                                                Masukan jumlah
                                                                <input type="text" class="field size2" name="jumlah_kegiatan" value="<?php echo $_GET['jumlah'] ?>"/>
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
                                                                <h2>Tambah - Progres Pekerja</h2>
                                                            </div>
                                                            <!-- End Box Head-->

                                                            <div class="box-content">
                                                                <form action="http://localhost/titipan/yayan/pekerja/tambah.php" method="post">
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
                                                                            Pilih Progress
                                                                            <select name="nama_kegiatan">
                                                                                <option value="Jumlah hari kerja">Jumlah hari kerja</option>
                                                                                <option value="jumlah jam kerja">jumlah jam kerja</option>
                                                                                <option value="jumlah tenaga kerja">jumlah tenaga kerja</option>
                                                                                <option value="jumlah kehilangan jam kerja">jumlah kehilangan jam kerja</option>
                                                                            </select>
                                                                        </p>
                                                                        <p>
                                                                            Masukan tanggal dengan format: yyyy-mm-dd
                                                                            <input type="text" class="field size2" name="tanggal_kegiatan"/>
                                                                        </p>
                                                                        <p>
                                                                            Masukan jumlah
                                                                            <input type="text" class="field size2" name="jumlah_kegiatan"/>
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
                                                                <h2 class="left">Daftar kegiatan</h2>
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
                                                                        <th>Nama Perusahaan</th>
                                                                        <th>Nama kegiatan</th>
                                                                        <th>Tanggal input</th>
                                                                        <th>Jumlah</th>
                                                                        <?php
                                                                        if (isset($_SESSION['user_nama'])) {
                                                                            ?>
                                                                            <th width="110" class="ac">Fungsi</th>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                    <?php
                                                                    $index = 1;
                                                                    $result = mysql_query("SELECT * from progress_tenaga_kerja") or die("Query failed with error: " . mysql_error());
                                                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                                                        ?>
                                                                        <tr <?php if ($index % 2 == 0)
                                                                        echo 'class="odd"'; ?>>
                                                                            <td><?php echo $index++; ?></td>
                                                                            <td><h3>
                                                                                    <?php
                                                                                    $id_proyek_r = $row['ID_PROYEK'];
                                                                                    $result2 = mysql_query("SELECT * from proyek WHERE id_proyek='$id_proyek_r'") or die("Query failed with error: " . mysql_error());
                                                                                    while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                                                                                        $pr = $row2['NAMA_PROYEK'];
                                                                                        echo $row2['NAMA_PROYEK'];
                                                                                    }
                                                                                    ?>
                                                                                </h3></td>
                                                                            <td><h3><?php echo $row['NAMA_PROGRES_TENAGA_KERJA'] ?></h3></td>
                                                                            <td><h3><?php echo $row['TANGGAL_PROGRES_TENAGA_KERJA'] ?></h3></td>
                                                                            <td><h3><?php echo $row['JUMLAH_PROGRES_TENAGA_KERJA'] ?></h3></td>
                                                                            <?php
                                                                            if (isset($_SESSION['user_nama'])) {
                                                                                ?>
                                                                                <td>
                                                                                    <a href="<?php echo 'http://localhost/titipan/yayan/pekerja/delete.php?id=' . $row['ID_PROGRES_TENAGA_KERJA']; ?>" class="ico del">Delete</a>
                                                                                    <a href="
                                                                                    <?php
                                                                                    echo 'http://localhost/titipan/yayan/pekerja/index.php?id=' .
                                                                                    $row['ID_PROGRES_TENAGA_KERJA'] . '&nama=' . $row['NAMA_PROGRES_TENAGA_KERJA']
                                                                                    . '&tanggal=' . $row['TANGGAL_PROGRES_TENAGA_KERJA']
                                                                                    . '&jumlah=' . $row['JUMLAH_PROGRES_TENAGA_KERJA']
                                                                                    . '&proyek=' . $pr;
                                                                                    ;
                                                                                    ?>" class="ico edit">Edit</a>
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