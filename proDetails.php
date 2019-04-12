<?php
require_once("include.php");
$link = connect('dog', '123456');
$id = $_REQUEST['id'];
$cates = getAllCate($link);
$proInfo = getProById($link, $id);
$proImgs = getProImgsById($link, $id);
if(!($proImgs && is_array($proImgs)))
{
    alertMes("商品图片错误", "index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title><?php echo $proInfo['pName'];?>详情页</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./styles/common.css">
        <link rel="stylesheet" type="text/css" href="./styles/header.css">
        <link rel="stylesheet" type="text/css" href="./styles/footer.css">
        <link rel="stylesheet" type="text/css" href="./styles/product-details.css">
        <link type="text/css" rel="stylesheet" media="all" href="styles/jquery.jqzoom.css"/>
        <script src="scripts/jquery-1.6.js" type="text/javascript"></script>
        <script src="scripts/jquery.jqzoom-core.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('.jqzoom').jqzoom({
                zoomType: 'standard',
                lens:true,
                preloadImages: false,
                alwaysOn:false,
                title:false,
                zoomWidth:410,
                zoomHeight:410
            });
        });
        </script>
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
                <li class="fl" style="padding-left: 3px;"><a href="./index.php">首页</a></li>
            <?php foreach($cates as $cate):?>
                <li class="fl"><a href="index.php#<?php echo $cate['cName'];?>"><?php echo $cate['cName'];?></a></li>
            <?php endforeach;?>
            </ul>
        </nav>


        <!--商品详细信息-->
        <div id="all-info">
            <div id="shop-detail">
                <div id="detail-top">
                    <!--左侧缩略图-->
                    <div id="header-left" class="fl">
                        <div id="bigImage">
                        <a href="image_800/<?php echo $proImgs[0]['albumPath'];?>" class="jqzoom" rel='gal1'  title="triumph" >
                        <img id="placeholder" src="image_350/<?php echo $proImgs[0]['albumPath'];?>" height="455" width="470" title="triumph"/>
                        </a>
                        </div>
                        <div id="img-display">
                            <ul>
                            <?php foreach($proImgs as $key => $proImg):?>
                                <li class="fl">
                                <a class="<?php echo $key==0?"zoomThumbActive":"";?> active" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'image_350/<?php echo $proImg['albumPath'];?>',largeimage: 'image_800/<?php echo $proImg['albumPath'];?>'}"><img src="image_50/<?php echo $proImg['albumPath'];?>" alt=""/></a>
                                </li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                    </div>

                    <!--右侧-->
                    <div id="header-right">
                    <h1><?php echo $proInfo['pName'];?></h1>
                    <h3><?php echo $proInfo['pDesc'];?></h3>
                        <div id="price">
                        <div id="mprice" style="font-size:14px;">市场价：￥<?php echo $proInfo['mPrice'];?></div>
                        <div id="stu-price">学子商城特惠：<span>￥<?php echo $proInfo['xduPrice'];?></span></div>
                            <div id="discount">*促销活动：电子产品满1000立减20元，满2000元减50元，满4000元减120元</div>
                        </div>
                        <div id="choose-color">
                            <span class="fl" style="margin-top: 4px;">选择颜色：</span>
                            <ul>
                                <li class="fl onblur-color" id="black">颜色1</li>
                                <li class="fl onblur-color" id="golden">颜色2</li>
                                <li class="fl onblur-color" id="silver">颜色3</li>
                                <li class="fl onblur-color" id="grey">颜色4</li>
                            </ul>
                        </div>
                        <div id="choose-size">
                            <span class="fl" style="margin-top: 4px;">规格：</span>
                            <ul>
                                <li class="fl onblur-color" id="size1">规格1</li>
                                <li class="fl onblur-color" id="size2">规格2</li>
                                <li class="fl onblur-color" id="size3">规格3</li>
                            </ul>
                        </div>
                        <div id="choose-num">
                            <span class="fl" style="margin-top: 4px;">数量：&nbsp;&nbsp;</span>
                            <span class="reduce fl">&nbsp;-&nbsp;</span>
                            <input type="text" name="num-input" class="fl" id="num-input" value="1"/>
                            <span class="plus fl">&nbsp;+&nbsp;</span>
                        </div>
                        <div id="buttons">
                        <button id="buy-it" onclick="addOrder(<?php echo $id;?>)">立即购买</button>
                            <button id="into-cart" onclick="addCart(<?php echo $id;?>)">加入购物车</button>
                            <button id="fav-it" onclick="addFavourite(<?php echo $id;?>)" title="加入收藏夹"><span class="icon">&#xf004;</span></button>
                        </div>
                    </div>
                </div>
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

        <script src="./scripts/common.js"></script>
        <script src="./scripts/product_details.js"></script>
        <script type="text/javascript">
        function addCart(id)
        {
            window.location = "doAction.php?act=addCart&id="+id;
        }
        function addFavourite(id)
        {
            window.location = "doAction.php?act=addFavourite&id="+id;
        }
        function addOrder(id)
        {
            window.location = "doAction.php?act=addOrder&id="+id;
        }
        </script>
    </html>
