<?php
require_once('include.php');
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
        <title>即将上线敬请期待</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./styles/common.css">
        <link rel="stylesheet" type="text/css" href="./styles/header.css">
        <link rel="stylesheet" type="text/css" href="./styles/footer.css">
        <link rel="stylesheet" type="text/css" href="./styles/comingSoon.css">
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
                <a href="comingSoon.php" class="fl"><img id="search" src="./images/search.png" alt="搜索"/></a>
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
                    <li class="fl header-icon"><a href="personal_info.php" title="个人中心"><span style="top: 5px; font-size: 21px;" class="icon">&#xf015;</span></a></li>
                    <li class="fl line">|</li>
                    <li class="fl" id="user-login"><?php echo $_SESSION['username'];?></li>
                    <li class="fl" id="quit"><a href="doAction.php?act=userOut">退出</a></li>
                    <?php else:?>
                    <li class="fl" id="login"><a href="./login.html" id="header-login">登录</a></li>
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
                <li class="fl" style="padding-left: 3px;"><a href="index.php">首页</a></li>
            <?php foreach($cates as $cate):?>
                <li class="fl"><a href="index.php#<?php echo $cate['cName'];?>"><?php echo $cate['cName'];?></a></li>
            <?php endforeach;?>
            </ul>
        </nav>

        <!--敬请期待-->
        <div id="comingSoon">
            <img id="forward-img" src="./images/lookforward/lookforward_img1.png" alt="" class="animation bounce"/>
            <p class="animation slideInDown"> 服务即将上线 敬请期待!!</p>
        </div>


        <!--页脚-->
        <footer>
                <div class="footer-box01">
                    <ul class="quality">
                        <li>
                            <img src="./images/footer/icon1.png" alt=""/>
                            <p>品质保障</p>
                        </li>
                        <li>
                            <img src="./images/footer/icon2.png" alt=""/>
                            <p>私人定制</p>
                        </li>
                        <li>
                            <img src="./images/footer/icon3.png" alt=""/>
                            <p>学生特供</p>
                        </li>
                        <li>
                            <img src="./images/footer/icon4.png" alt=""/>
                            <p>专属特权</p>
                        </li>
                    </ul>
                </div>
                <div class="footer-box02">
                    <p id="p1">有问题或建议请联系：前端(<a>643342586@qq.com</a>)&nbsp;&nbsp;&nbsp;后端(<a href="#">1165394984@qq.com</a>)</p>
                    <p id="p2">Copyright&nbsp;&copy;&nbsp;2018</p>
                </div>
            </footer>

        </body>
    </html>
