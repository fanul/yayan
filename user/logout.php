<?php
session_start();
session_destroy();

$loc = 'http://localhost/titipan/yayan/home.php';
echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$loc.'">';
exit;
?>
