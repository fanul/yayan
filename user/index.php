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
                        <li><a href="http://localhost/titipan/yayan/pekerja/"><span>Pekerja</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kecelakaan/"><span>Kecelakaan</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/kondisi/" ><span>Kondisi</span></a></li>
                        <li><a href="http://localhost/titipan/yayan/laporan/"><span>Laporan</span></a></li>
                        <?php if (isset($_SESSION['user_nama'])) { ?> <li><a href="http://localhost/titipan/yayan/user/" class="active"><span>User</span></a></li><?php } ?>
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
                                        <h2>Edit - <?php echo $_GET['nama'] ?> : <br> </h2>
                                    </div>
                                    <!-- End Box Head-->

                                    <div class="box-content">
                                        <form action="http://localhost/titipan/yayan/user/edit.php" method="post">
                                            <div class="form">
                                                <input type="hidden" name="user_id" value="<?php echo $_GET['id']; ?>">
                                                    <p>
                                                        Pilih hak akses
                                                        <select name="user_akses">
                                                            <option value="admin">admin</option>
                                                            <option value="user">user</option>
                                                        </select>
                                                    </p>
                                                    <p>
                                                        Masukan nama
                                                        <input type="text" class="field size2" name="user_nama" value="<?php echo $_GET['nama'] ?>"/>
                                                    </p>
                                                    <p>
                                                        Masukan password
                                                        <input type="text" class="field size2" name="user_password" value="<?php echo $_GET['plain'] ?>"/>
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
                            <?php
                            if (isset($_SESSION['user_nama']) && $_SESSION['user_akses'] == 'admin') {
                                ?>
                                <!-- Box -->
                                <div class="box">

                                    <!-- Box Head -->
                                    <div class="box-head">
                                        <h2>Tambah - Progres Pekerja</h2>
                                    </div>
                                    <!-- End Box Head-->

                                    <div class="box-content">
                                        <form action="http://localhost/titipan/yayan/user/tambah.php" method="post">
                                            <div class="form">
                                                <p>
                                                    Pilih hak akses
                                                    <select name="user_akses">
                                                        <option value="admin">admin</option>
                                                        <option value="user">user</option>
                                                    </select>
                                                </p>
                                                <p>
                                                    Masukan nama
                                                    <input type="text" class="field size2" name="user_nama" />
                                                </p>
                                                <p>
                                                    Masukan password
                                                    <input type="text" class="field size2" name="user_password" />
                                                </p>
                                            </div>
                                            <div class="buttons">
                                                <input type="submit" class="button" value="tambah" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Box -->
                            <?php } ?>
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
                                        <th>Nama user</th>
                                        <th>Password user</th>
                                        <?php
                                        if (isset($_SESSION['user_nama']) && $_SESSION['user_akses'] == 'admin') {
                                            ?>
                                            <th width="110" class="ac">Fungsi</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                    $index = 1;
                                    $result = mysql_query("SELECT * from user") or die("Query failed with error: " . mysql_error());
                                    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                                        ?>
                                        <tr <?php if ($index % 2 == 0)
                                        echo 'class="odd"'; ?>>
                                            <td><h3><?php $index++;
                                        echo $row['USER_NAMA'] ?></h3></td>
                                            <td><h3><?php echo $row['USER_PASSWORD'] ?></h3></td>
                                            <?php
                                            if (isset($_SESSION['user_nama']) && $_SESSION['user_akses'] == 'admin') {
                                                ?>
                                                <td>
                                                    <a href="<?php echo 'http://localhost/titipan/yayan/user/delete.php?id=' . $row['USER_ID']; ?>" class="ico del">Delete</a>
                                                    <a href="
                                                    <?php
                                                    echo 'http://localhost/titipan/yayan/user/index.php?id=' .
                                                    $row['USER_ID'] . '&nama=' . $row['USER_NAMA']
                                                    . '&plain=' . $row['USER_PLAIN']
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