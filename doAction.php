<?php
require_once('include.php');
$link = connect('dog', '123456');
$act = $_REQUEST['act'];
$id = $_REQUEST['id'];
$num = $_REQUEST['num'];
$old_pwd = $_REQUEST['old_pwd'];
$new_pwd = $_REQUEST['new_pwd'];
if($act === "reg")
{
    $mes = reg($link);
}
elseif($act === "login")
{
    $mes = login($link);
}
elseif($act === "userOut")
{
    checkUserLogined();
    userOut();
}
elseif($act === 'addCart')
{
    checkUserLogined();
    addCart($link, $id);
}
elseif($act === 'addFavourite')
{
    checkUserLogined();
    addFavourite($link, $id);
}
elseif($act === 'addAddress')
{
    checkUserLogined();
    addAddress($link, $id);
}
elseif($act === 'delCart')
{
    checkUserLogined();
    delCart($link, $id);
}
elseif($act === 'delFavourites')
{
    checkUserLogined();
    $ids = explode(",", $id);
    delFavourites($link, $ids);
}
elseif($act === 'addCarts')
{
    checkUserLogined();
    $ids = explode(",", $id);
    addCarts($link, $ids);
}
elseif($act === 'addOrder')
{
    checkUserLogined();
    addOrder($link, $id);
}
elseif($act === 'delCarts')
{
    checkUserLogined();
    $ids = explode(",", $id);
    delCarts($link, $ids);
}
elseif($act === 'addOrders')
{
    checkUserLogined();
    $ids = explode(",", $id);
    $nums = explode(",", $num);
    addOrders($link, $ids, $nums);
}
elseif($act === 'changePwd')
{
    checkUserLogined();
    changePwd($link, $id, $new_pwd, $old_pwd);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
if($mes)
{
    echo $mes;
}
?>
</body>
</html>
