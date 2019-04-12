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
        <title>我的订单</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./styles/common.css">
        <link rel="stylesheet" type="text/css" href="./styles/header.css">
        <link rel="stylesheet" type="text/css" href="./styles/footer.css">
        <link rel="stylesheet" type="text/css" href="./styles/orders.css">
    
        <script src="./scripts/jquery-3.1.1.min.js"></script>
        <script src="./scripts/orders.js"></script>
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
                <li class="fl" style="padding-left: 3px;"><a href="index.php">首页</a></li>
            <?php foreach($cates as $cate):?>
                <li class="fl"><a href="index.php#<?php echo $cate['cName'];?>"><?php echo $cate['cName'];?></a></li>
            <?php endforeach;?>
            </ul>
        </nav>

        <!--订单部分-->
        <div class="orders">
            <div id="sidebox" class="fl">
                <dl class="all-orders">
                    <dt id="all-tag" class="open">
                        <span class="icon">&#xf0ca;</span>我的订单
                        <img src="images/myOrder/myOrder2.png" alt=""/>
                    </dt>
                    <dd>
                        <a href="#">全部订单
                            <span id="all-count"></span>
                        </a>
                    </dd>
                    <dd>
                        <a href="comingSoon.php">待付款
                            <span><!--待付款数量--></span>
                        </a>
                    </dd>
                    <dd>
                        <a href="comingSoon.php">待收货
                            <span><!--待收货数量--></span>
                        </a>
                    </dd>
                    <dd>
                        <a href="comingSoon.php">待评价
                            <span><!--待评价数量--></span>
                        </a>
                    </dd>
                    <dd>
                        <a href="comingSoon.php">退款/售后</a>
                    </dd>
                </dl>

                <dl class="coupon">
                    <dt id="coupon-tag" class="close">
                        <span class="icon">&#xf06b;</span>我的优惠券
                        <img src="images/myOrder/myOrder1.png" alt=""/>
                    </dt>
                    <dd>
                        <a href="comingSoon.php">全部优惠券</a>
                    </dd>
                    <dd>
                        <a href="comingSoon.php">获取优惠券</a>
                    </dd>
                </dl>

            </div>

            <div id="right-side">
                <div class="o-header">
                    <div id="o-pro" class="o-tags fl">商品</div>
                    <div id="o-price" class="o-tags fl">单价（元）</div>
                    <div id="o-num" class="o-tags fl">数量</div>
                    <div id="o-money" class="o-tags fl">实付款（元）</div>
                    <div id="o-deal" class="o-tags fl">交易状态</div>
                    <div id="o-op" class="o-tags fl">操作</div>
                </div>

            <?php
                $id = $_SESSION['userId'];
                $rows = getOrdersByUserId($link, $id);
                foreach($rows as $row):
                    $proImg = getProImgById($link, $row['proId']);
                    $proInfo = getProById($link, $row['proId']);
            ?>
                <div class="order-item">
                    <div class="o-title">
                    <span class="fl o-number">订单编号：<span><?php echo $row['time'];?></span></span>
                    <span class="fl o-time">下单时间：<span><?php echo date("Y-m-d H:i:s", $row['time']);?></span></span>
                    </div>
                    <div class="o-details">
                        <ul>
                            <li class="fl i-pro">
                                <div class="pro-img fl">
                                <a href="#"><img src="image_50/<?php echo $proImg['albumPath'];?>" alt="" onclick="show(<?php echo $row['proId'];?>)"/></a>
                                </div>
                                <div class="pro-pro fl"><a href="proDetails.php?id=<?php echo $row['proId'];?>"><?php echo $proInfo['pName'];?></a></div>
                                <div class="pro-color fl">颜色：默认</div>
                            </li>
                            <li class="fl i-price">
                                <?php echo $proInfo['xduPrice'];?>
                            </li>
                            <li class="fl i-num"><?php echo $row['num'];?></li>
                            <li class="fl i-money">￥<?php echo $row['num']*$proInfo['xduPrice']?></li>
                            <li class="fl i-deal">
                                <div>
                                    <a href="#">订单详情</a>
                                </div>
                                <div>
                                    <a href="#">查看物流</a>
                                </div>
                            </li>
                            <li class="fl i-op">
                                <a href="#"><button class="fl">催货</button></a>
                                <a href="#"><button class="fl">确认收货</button></a>
                                <a href="#"><button class="fl">去评价</button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach;?>
            </div>
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
    <script>
    function show(id)
    {
        window.location = "proDetails.php?id="+id;
    }
    </script>
</html>
