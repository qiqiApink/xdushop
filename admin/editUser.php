<?php
require_once('../include.php');
checkLogined();
$id = $_REQUEST['id'];
$link = connect('root', 'xiaoniu33c3');
$sql = "select id,username,password,email from xdushop_user where id={$id}";
$row = fetchOne($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>编辑用户</h3>
<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    <tr>
        <td align="right">用户名</td>
        <td><input type="text" name="username" value="<?php echo $row['username'];?>"/></td>
    </tr>
    <tr>
        <td align="right">密码</td>
        <td><input type="password" name="password"  value="<?php echo $row['password'];?>"/></td>
    </tr>
    <tr>
        <td align="right">邮箱</td>
        <td><input type="text" name="email" value="<?php echo $row['email'];?>"/></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit"  value="编辑用户"/></td>
    </tr>

</table>
</form>
</body>
</html>
