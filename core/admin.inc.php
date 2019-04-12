<?php
// 检查是否是管理员
function checkAdmin($link, $sql)
{
    return fetchOne($link, $sql);
}

// 检查是否登陆
function checkLogined()
{
    if($_SESSION['adminId'] == '' && $_COOKIE['adminId'] == '')
    {
        alertMes("Please login first.", './login.html');
    }
}

// 退出登录
function logout()
{
    $_SESSION = array();
    if(isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(), "", time()-1);
    }
    if(isset($_COOKIE['adminName']))
    {
        setcookie('adminName', "", time()-1);
    }
    if(isset($_COOKIE['adminId']))
    {
        setcookie('adminId', "", time()-1);
    }
    session_destroy();
    header("Location:login.html");
}

// 添加管理员
function addAdmin($link)
{
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if(insert($link, "xdushop_admin", $arr))
    {
        $mes = "添加成功!</br><a href='addAdmin.php'>继续添加</a> | <a href='listAdmin.php'>查看管理员列表</a>";
    }
    else
    {
        $mes = "添加失败!</br><a href='addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

function getAllAdmin($link)
{
    $sql = "select id,username,email from xdushop_admin";
    $rows = fetchAll($link, $sql);
    return $rows;
}

// 编辑管理员
function editAdmin($link, $id)
{
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if(update($link, "xdushop_admin", $arr, "id={$id}"))
    {
        $mes = "编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }
    else
    {
        $mes = "编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
    }
    return $mes;
}

// 删除管理员
function delAdmin($link, $id)
{
    if(delete($link, "xdushop_admin", "id={$id}"))
    {
        $mes = "删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }
    else
    {
        $mes = "删除失败!<br/><a href='listAdmin.php'>重新删除</a>";
    }
    return $mes;
}

// 添加用户
function addUser($link)
{
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    $arr['regTime'] = time();
    if(insert($link, "xdushop_user", $arr))
    {
        $mes="添加成功!<br/><a href='addUser.php'>继续添加</a> | <a href='listUser.php'>查看用户列表</a>";
    }
    else
    {
        $mes="添加失败!<br/><a href='addUser.php'>重新添加</a>";
    }
    return $mes;
}

// 编辑用户
function editUser($link, $id)
{
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if(update($link, "xdushop_user", $arr, "id={$id}"))
    {
        $mes = "编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }
    else
    {
        $mes = "编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
    }
    return $mes;
}

// 删除用户
function delUser($link, $id)
{
    if(delete($link, "xdushop_user", "id={$id}"))
    {
        $mes = "删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }
    else
    {
        $mes = "删除失败!<br/><a href='listUser.php'>重新删除</a>";
    }
    return $mes;
}
