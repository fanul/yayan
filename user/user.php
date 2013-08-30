<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/titipan/yayan/'.'config.php';
 
class User
{
    //Database connect
    public function __construct()
    {
    $db = new DB_Class();
    }
    //Registration process
    public function register_user($username, $password)
    {
        $password = md5($password);
        $sql = mysql_query("SELECT user_id from user WHERE user_nama = '$username'");
        $no_rows = mysql_num_rows($sql);
        if ($no_rows == 0)
        {
            $result = mysql_query("INSERT INTO user(user_nama,user_password,)
                                   values ('" . mysql_real_escape_string($username)."',
                                           '" . mysql_real_escape_string(md5($password))."'
                                           )") or die(mysql_error());
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
    // Login process
    public function check_login($username, $password)
    {
        $password = md5($password);
        $result = mysql_query("SELECT * from user WHERE user_nama = '$username' and user_password = '$password'");
        if($result)
        {
            $user_data = mysql_fetch_array($result);
            $no_rows = mysql_num_rows($result);
            if ($no_rows == 1)
            {
                $_SESSION['login'] = true;
                $_SESSION['user_nama'] = $user_data['USER_NAMA'];
                $_SESSION['user_akses'] = $user_data['USER_AKSES'];
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
            return false;
    }
}
?>