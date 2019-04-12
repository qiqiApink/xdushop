<?php
require_once('include.php');
checkUserLogined();
$link = connect('dog', '123456');
$cates = getAllCate($link);
if(!($cates && is_array($cates)))
{
    alertMes("网站维护中，请谅解", "comingSoon.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>我的资料</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="stylesheet" type="text/css" href="./styles/footer.css">
    <link rel="stylesheet" type="text/css" href="./styles/personal_info.css">
</head>

<body>
        <!--页头-->
        <header id="header">
        <div id="in-header">
            <div id="logo" class="fl">
                <a href="index.php"><img src="images/logo.png" alt="西电学子商城首页"/></a>
            </div>
            <div id="header-search" class="fl">
                <input id="input-search" type="text" class="fl" placeholder="请输入您要搜索的内容"/>
                <a href="comingSoon.php" class="fl" id=""><img id="search" src="./images/search.png" alt="搜索"/></a>
            </div>
            <div id="header-table" class="fr">
                <ul class="fl">
                    <?php if($_SESSION['userId']):?>
                    <li class="fl header-icon"><a href="favourites.php" title="我的收藏"><span style="top: 5px; font-size: 20px;" class="icon">&#xf004;</span></a></li>
                    <li class="fl line">|</li>
                    <li class="fl header-icon"><a href="orders.php" title="我的订单"><span style="top: 5px; font-size: 20px;" class="icon">&#xf02c;</span></a></li>
                    <li class="fl line">|</li>
                    <li class="fl header-icon"><a href="cart.php" title="我的购物车"><span style="top: 5px; font-size: 20px;" class="icon">&#xf07a;</span></a></li>
                    <li class="fl line">|</li>
                    <li class="fl header-icon"><a href="personal_info.php" title="个人中心"><span style="top:5px;font-size:21px;" class="icon">&#xf015;</span></a></li>
                    <li class="fl line">|</li>
                    <li class="fl" id="user-login"><?php echo $_SESSION['username'];?></li>
                    <li class="fl" id="quit"><a href="doAction.php?act=userOut">退出</a></li>
                    <?php else:?>
                    <li class="fl" id="user-login"><a href="./login.html" id="header-login">登录</a></li>
                    <li class="fl line">|</li>
                    <li class="fl" id="register"><a href="./register.html" id="header-register">注册</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        </header>


    <!--导航条-->
    <nav id="nav">
        <ul>
            <li class="fl" style="padding-left: 3px;"><a href="./index.php">首页</a></li>
        <?php foreach($cates as $cate):?>
            <li class="fl"><a href="index.php#<?php echo $cate['cName'];?>"><?php echo $cate['cName'];?></a></li>
        <?php endforeach;?>
        </ul>
    </nav>

   

    <!--订单部分-->
    <div class="info">
        <div id="sidebox" class="fl">
            <dl>
                <dt id="info-tag" class="open">
                    <span class="icon">&#xf007;</span>账号管理
                    <img src="./images/myOrder/myOrder2.png" alt="" />
                </dt>
                <dd>
                    <a href="#">个人资料</a>
                </dd>
                <dd>
                    <a href="./address_info.php">收货地址
                        <span>
                        </span>
                    </a>
                </dd>
            </dl>

            <dl class="security">
                <dt id="security-tag" class="close">
                    <span class="icon">&#xf023;</span>安全设置
                    <img src="./images/myOrder/myOrder1.png" alt="" />
                </dt>
                <dd>
                    <a href="./change_pwd.php">修改密码</a>
                </dd>
                <dd>
                    <a href="./comingSoon.php">账号绑定</a>
                </dd>
            </dl>

            <dl class="history">
                <dt id="history-tag" class="close">
                    <span class="icon">&#xf07a;</span>购物历史
                    <img src="./images/myOrder/myOrder1.png" alt="" />
                </dt>
                <dd>
                    <a href="./comingSoon.php">我的足迹</a>
                </dd>
                <dd>
                    <a href="./comingSoon.php">购买记录</a>
                </dd>
            </dl>

        </div>

        <div id="right-side">
            <div class="info-title">
                个人资料
                <span class="edit fr">编辑</span>
            </div>
            <form action="#" method="post" autocomplete="off">
                <div class="info-pro">
                    <div class="inside-border">
                        <!--设置头像-->
                        <div class="head-portrait">
                            <div class="info-name fl">我的头像：</div>
                            <img src="./images/personage/touxiang.png" alt="" id="icon" class="fl" width="50px" height="50px" />
                            <input type="hidden" name="iconPic" value="" id="iconPic">
                            <div class="change-portrait fl" data-toggle="modal" data-target="#avatar-modal">修改头像</div>
                        </div>
                        <!--设置昵称-->
                        <div class="set-nickname">
                            <span class="info-name fl">我的昵称：</span>
                            <span class="ur-nickname fl">这里是昵称</span>
                            <input class="new-nickname fl" value="" name="new-nickname" id="new-nickname"/>
                        </div>
                        <!--性别-->
                        <div class="set-gender">
                            <span class="info-name fl">性别：</span>
                            <span class="ur-gender">男</span>
                            <div id="edit-g">
                                <input type="radio" name="sex" id="male" checked="checked" />
                                <label for="male">男</label>
                                <input type="radio" name="sex" id="female" />
                                <label for="female">女</label>
                            </div>
                        </div>
                        <!--生日-->
                        <div class="set-birthday">
                            <span class="info-name fl">生日：</span>
                            <span class="ur-birthday fl">2018-10-20</span>
                            <div id="edit-b">
                                <span class="label">年:</span>
                                <select name="year" id="year" onchange="getDays()"></select>
                                <span class="label">月:</span>
                                <select name="month" id="month" onchange="getDays()"></select>
                                <span class="label">日:</span>
                                <select name="day" id="day"></select>
                            </div>
                        </div>
                        <!--家乡-->
                        <div class="set-hometown">
                            <span class="info-name fl">家乡：</span>
                            <span class="ur-hometown fl">陕西省西安市长安区</span>
                            <div id="edit-h">
                                <span>省:</span>
                                <select id="province" onchange="showCity(this)" onclick="showCity(this)">
                                    <option value="-1">--请选择--</option>
                                </select>
                                <span>市:</span>
                                <select id="city" onchange="showArea(this)" onclick="showArea(this)">
                                </select>
                                <span>区县:</span>
                                <select id="area"></select>
                            </div>
                        </div>
                        <!--保存-->
                        <input type="submit" name="save" id="save" value="保存修改" />
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!--页脚-->
    <footer>
        <div class="footer-box01">
            <ul class="quality">
                <li>
                    <img src="./images/footer/icon1.png" alt="" />
                    <p>品质保障</p>
                </li>
                <li>
                    <img src="./images/footer/icon2.png" alt="" />
                    <p>私人定制</p>
                </li>
                <li>
                    <img src="./images/footer/icon3.png" alt="" />
                    <p>学生特供</p>
                </li>
                <li>
                    <img src="./images/footer/icon4.png" alt="" />
                    <p>专属特权</p>
                </li>
            </ul>
        </div>
        <div class="footer-box02">
            <p id="p1">有问题或建议请联系：前端(<a>643342586@qq.com</a>)&nbsp;&nbsp;&nbsp;后端(<a href="#">1165394984@qq.com</a>)</p>
            <p id="p2">Copyright&nbsp;&copy;&nbsp;2018</p>
        </div>
    </footer>


    <script src="./scripts/jquery-3.1.1.min.js"></script>
    <script src="./scripts/personal_info.js"></script>
    <script src="./scripts/date.js"></script>
    <script src="./scripts/address.js"></script>
</body>

</html>
