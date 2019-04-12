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
    <title>我的购物车</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="stylesheet" type="text/css" href="./styles/footer.css">
    <link rel="stylesheet" type="text/css" href="./styles/cart.css">
    <style>
    </style>
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

    <!--购物车-->
    <div id="all-cart">
        <div id="cart">
            <form name="" action="#" method="post">
                <div id="cart-title">
                    <ul>
                        <a href="#">
                            <li id="c-all" class="fl onclick-color">全部商品</li>
                        </a>
                        <a href="#">
                            <li id="c-drop" class="fl onblur-color">降价商品</li>
                        </a>
                    </ul>
                    <span class="fr">合计: <b class="c-money">0.00</b>元</span>
                    <span class="fr">已选<b class="c-count">0</b>件商品</span>
                </div>

                <div id="c-box">
                    <div id="info-top">
                        <div id="all" class="g-tags fl">
                            <span class="buy-all">
                                <img src="./images/cart/product_normal.png" alt="" />
                            </span>
                            <input type="hidden" name="choose-all" value="" />全选
                        </div>
                        <div id="g-pro" class="g-tags fl">商品</div>
                        <div id="g-price" class="g-tags fl">单价（元）</div>
                        <div id="g-num" class="g-tags fl">数量</div>
                        <div id="g-money" class="g-tags fl">金额</div>
                        <div id="g-del" class="g-tags fl">操作</div>
                    </div>
                <?php
                    $id = $_SESSION['userId'];
                    $rows = getCartByUserId($link, $id);
                    foreach($rows as $row):
                        $proImg = getProImgById($link, $row['proId']);
                        $proInfo = getProById($link, $row['proId']);
                ?>
                    <div class="prod">
                        <div class="pro-id" style="display:none;"><?php echo $row['proId'];?></div>
                        <div class="choose fl">
                            <span class="normal square">
                            <img src="./images/cart/product_normal.png" alt="" />
                            </span>
                            <input type="hidden" name="choose-one" value="">
                        </div>
                        <div class="prod-pro fl">
                            <img src="./image_50/<?php echo $proImg['albumPath'];?>" width="70" height="70" class="fl" />
                            <span class="detail fl"><?php echo $proInfo['pName'];?></span>
                            <span class="prod-color fl">颜色: 默认</span>
                        </div>
                        <div class="prod-price fl">￥<span class="price" value="<?php echo $proInfo['xduPrice'];?>"><?php echo $proInfo['xduPrice'];?></span></div>
                        <div class="prod-num fl">
                            <span class="reduce fl">&nbsp;-&nbsp;</span>
                            <input type="text" name="num-input" class="fl num-input" id="num-input" value="1" />
                            <span class="plus fl">&nbsp;+&nbsp;</span>
                        </div>
                        <div class="prod-money fl">￥<span class="money"><?php echo $proInfo['xduPrice'];?></span></div>
                        <a href="#"><div class="prod-del fl" onclick="delCart(<?php echo $row['id'];?>)">删除</div></a>
                    </div>
                <?php endforeach;?>
                    <div class="total">
                        <div id="all" class="g-tags fl">
                            <span class="buy-all">
                                <img src="./images/cart/product_normal.png" alt="" />
                            </span>
                            <input type="hidden" name="choose-all" value="" />全选
                        </div>
                        <div class="del fl" onclick="var ids = getId(); delCarts(ids);"><a href="#">删除</a></div>

                        <span onclick="var ids=getId(); var nums = getNum(); addOrders(ids,nums);" class="t-button fr">去结算</span>

                        <span class="fr t-money">合计: <b class="c-money">0.00</b>元</span>
                        <span class="fr t-count">已选<b class="c-count">0</b>件商品</span>
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
    <script src="./scripts/cart.js"></script>
    <script type="text/javascript">
    function delCart(id)
    {
        window.location = "doAction.php?act=delCart&id="+id;
    }
    function delCarts(ids)
    {
        window.location = "doAction.php?act=delCarts&id="+ids;
    }
    function addOrders(ids,nums){
        window.location = "doAction.php?act=addOrders&id="+ids+"&num="+nums;
    }
    function getId(){
        var arr = $(".selected");
        var ids = new Array();
        var p;
        for(var i=0;i<arr.length;i++){
            p = arr[i];
            var id = $(p).parent().siblings(".pro-id").html();
            ids.push(id);
        }
        return ids;
    }
    function getNum(){
        var arr = new Array();
        var ps = $(".selected");
        for(var i=0;i<ps.length;i++){
            var n = parseInt($(ps[i]).parent().siblings(".prod-num").children("#num-input").val());
            arr.push(n);
        }
        return arr;
    }
    </script>
</body>

</html>
