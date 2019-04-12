<?php
require_once('../include.php');
$username = $_POST['username'];
$username = addslashes($username);
$password = md5($_POST['password']);
$verify = strtolower($_POST['verify']);
$verify1 = strtolower($_SESSION['verify']);
$autoFlag = $_POST['autoFlag'];

if($verify === $verify1)
{
    $link = connect('root', 'xiaoniu33c3');
    $sql = "select * from xdushop_admin where username = '{$username}' and password = '{$password}'";    
    $row = checkAdmin($link, $sql);
    if($row)
    {
        // 如果选择了一周内自动登录
        if($autoFlag)
        {
            setcookie("adminId", $row['id'], time()+7*24*3600);
            setcookie("adminName", $row['username'], time()+7*24*3600);
        }
        $_SESSION['adminName'] = $row['username'];
        $_SESSION['adminId'] = $row['id'];
        alertMes('Login success.', './index.php');
    }
    else
    {
        alertMes('Login failed, please try again.', './login.html');
    }
}
else
{
    alertMes('incorrect capture', './login.html');
}
