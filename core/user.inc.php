<?php
function reg($link)
{
    $arr['username'] = $_POST['username'];
    $arr['password'] = md5($_POST['password']);
    $arr['email'] = $_POST['email'];
    $arr['regTime'] = time();
    if(insert($link, "xdushop_user", $arr))
    {
        $mes="注册成功!<br/>3秒钟后跳转到登陆页面!<meta http-equiv='refresh' content='3;url=login.html'/>";
    }
    else
    {
        $mes="注册失败!<br/><a href='register.html'>重新注册</a> | <a href='index.php'>查看首页</a>";
    }
    return $mes;
}

function login($link)
{
    $username = $_POST['username'];
    $username=mysqli_real_escape_string($link, $username);
    $password=md5($_POST['password']);
    $verify = strtolower($_POST['verify']);
    $verify1 = strtolower($_SESSION['verify']);
    $autoFlag = $_POST['autoFlag'];

    if($verify === $verify1)
    {
        $sql="select * from xdushop_user where username='{$username}' and password='{$password}'";
        $row = fetchOne($link, $sql);
        if($row)
        {
            if($autoFlag)
            {
                setcookie("username", $row['username'], time()+7*24*3600);
                setcookie("userId", $row['id'], time()+7*24*3600);
            }
            $_SESSION['username'] = $row['username'];
            $_SESSION['userId'] = $row['id'];
            $mes = "登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
        }
        else
        {
            alertMes("登陆失败！请重新登录", "login.html");
        }
    }
    else
    {
        alertMes('incorrect capture', './login.html');
    }
    return $mes;
}

function userOut()
{
    $_SESSION = array();
    if(isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(), "", time()-1);
    }
    if(isset($_COOKIE['username']))
    {
        setcookie('username', "", time()-1);
    }
    if(isset($_COOKIE['userId']))
    {
        setcookie('userId', "", time()-1);
    }
    session_destroy();
    header("location:index.php");
}

function checkUserLogined()
{
    if($_SESSION['userId'] == '' && $_COOKIE['userId'] == '')
    {
        alertMes("Please login first.", './login.html');
    }
}

function addCart($link, $id)
{
    $arr['userId'] = $_SESSION['userId'];
    $arr['proId'] = $id;
    if(insert($link, "xdushop_cart", $arr))
    {
        alertMes("加入购物车成功", "cart.php");
    }
    else
    {
        alertMes("加入购物车失败，请重新添加", "proDetails.php?id={$id}");
    }
}

function addFavourite($link, $id)
{
    $arr['userId'] = $_SESSION['userId'];
    $arr['proId'] = $id;
    if(insert($link, "xdushop_favourite", $arr))
    {
        alertMes("收藏成功", "favourites.php");
    }
    else
    {
        alertMes("收藏失败，请重新收藏", "proDetails.php?id={$id}");
    }
}

function addAddress($link, $id)
{
    $arr['userId'] = $id;
    $arr['name'] = $_POST['name'];
    $arr['address'] = $_POST['address'];
    $arr['tel'] = $_POST['tel'];
    $arr['postcode'] = $_POST['postcode'];
    $arr['cate'] = $_POST['cate'];
    if(insert($link, "xdushop_address", $arr))
    {
        alertMes("添加成功", "address_info.php");
    }
    else
    {
        alertMes("添加失败，请重新添加", "address_info.php");
    }
}

function delCart($link, $id)
{
    if(delete($link, "xdushop_cart", "id={$id}"))
    {
        alertMes("删除成功", "cart.php");
    }
    else
    {
        alertMes("删除失败，请重新删除", "cart.php");
    }
    return $mes;
}

function delFavourites($link, $ids)
{
    foreach($ids as $id)
    {
        if(!delete($link, "xdushop_favourite", "proId={$id}"))
        {
            alertMes("删除失败，请重新删除", "favourites.php");
        }
    }
    alertMes("删除成功", "favourites.php");
}

function addCarts($link, $ids)
{
    $arr['userId'] = $_SESSION['userId'];
    foreach($ids as $id)
    {
        $arr['proId'] = $id;
        if(!insert($link, "xdushop_cart", $arr))
        {
            alertMes("加入购物车失败，请重新添加", "favourites.php");
        }
    }
    alertMes("加入购物车成功", "cart.php");
}

function addOrder($link, $id)
{
    $arr['userId'] = $_SESSION['userId'];
    $arr['proId'] = $id;
    $arr['time'] = time();
    if(insert($link, "xdushop_order", $arr))
    {
        alertMes("购买成功", "orders.php");
    }
    else
    {
        alertMes("购买失败，请重新购买", "proDetails.php?id={$id}");
    }
}

function delCarts($link, $ids)
{
    foreach($ids as $id)
    {
        if(!delete($link, "xdushop_cart", "proId={$id}"))
        {
            alertMes("删除失败，请重新删除", "cart.php");
        }
    }
    alertMes("删除成功", "cart.php");
}

function addOrders($link, $proIds, $nums)
{
    $arr['userId'] = $_SESSION['userId'];
    foreach($proIds as $key => $val)
    {
        $ps[$key][0] = $proIds[$key];
        $ps[$key][1] = $nums[$key];
    }
    foreach($ps as $p)
    {
        $arr['time'] = time();
        $arr['proId'] = $p[0];
        $arr['num'] = $p[1];
        if(!insert($link, "xdushop_order", $arr))
        {
            alertMes("结算失败，请重新结算", "cart.php");
        }
    }
    alertMes("结算成功", "orders.php");
}

function changePwd($link, $id, $new_pwd, $old_pwd)
{
    $arr['password'] = md5($new_pwd);
    $sql = "select * from xdushop_user where id={$id}";
    $row = fetchOne($link, $sql);
    if($row['password'] == md5($old_pwd))
    {
        if(update($link, "xdushop_user", $arr, "id={$id}"))
        {
            alertMes("修改成功，请重新登录", "login.html");
        }
        else
        {
            alertMes("修改失败，请重新修改", "change_pwd.php");
        }
    }
    else
    {
        alertMes("当前密码错误，请重新修改", "change_pwd.php");
    }
}
