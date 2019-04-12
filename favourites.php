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
        <title>我的收藏夹</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./styles/common.css">
        <link rel="stylesheet" type="text/css" href="./styles/header.css">
        <link rel="stylesheet" type="text/css" href="./styles/footer.css">
        <link rel="stylesheet" type="text/css" href="./styles/favourites.css">
        <style>
        </style>
        <script>
    function getId(){
        var arr = new Array();
        arr = $(".checked");
        var ids = new Array();
        var p;
        for(var i=0;i<arr.length;i++){
            p = arr[i];
            var id = $(p).parent().siblings(".pro-id").html();
            ids.push(id);
        }
        return ids;
    }


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
                    <li class="fl header-icon"><a href="personal_info.php" title="我的账户"><span style="top: 5px; font-size: 21px;" class="icon">&#xf015;</span></a></li>
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
        <!--一些隐藏弹框-->
            <div class="modal display-none" id="modal">
                <div class="modal_dialog">
                    <div class="modal_header">
                        删除提醒
                        <img src="./images/model/model_img1.png" alt="" class="fr close"/>
                    </div>
                    <div class="modal_information">
                        <img src="./images/model/model_img2.png" alt=""/>
                        <span>确定删除您收藏的商品吗？</span>
                    </div>
                    <div class="yes op-no" id="del-no"><span>我再想想</span></div>
                    <div class="no op-yes" id="del-yes" onclick="var ids = getId();delFavourites(ids);"><span>删除</span></div>
                </div>
            </div>
            <div class="modalYi display-none" id="modalYi">
                <div class="modal_dialog">
                    <div class="modal_header">
                        操作提醒
                        <img src="./images/model/model_img1.png" alt="" class="fr close"/>
                    </div>
                    <div class="modal_information">
                        <img src="./images/model/model_img2.png" alt=""/>
                        <span>将您的宝贝移入购物车？</span>
                    </div>
                    <div class="yes op-yes" id="cart-yes" onclick="var ids = getId();addCarts(ids);"><span>确定</span></div>
                    <div class="no op-no" id="cart-no"><span>取消</span></div>
                </div>
            </div>
            <div class="modalNo display-none" id="modalNo">
                <div class="modal_dialog">
                    <div class="modal_header">
                        删除提示
                        <img src="./images/model/model_img1.png" alt="" class="fr close"/>
                    </div>
                    <div class="modal_information">
                        <img src="./images/model/model_img2.png" alt=""/>
                        <span>请选择商品</span>
                    </div>
                </div>
            </div>
            <div class="modalAdd display-none" id="modalAdd">
                <div class="modal_dialog">
                    <div class="modal_header">
                        添加提示
                        <img src="./images/model/model_img1.png" alt="" class="fr close"/>
                    </div>
                    <div class="modal_information">
                        <img src="./images/model/model_img2.png" alt=""/>
                        <span>请选择商品</span>
                    </div>
                </div>
            </div>
        <!--收藏夹-->
        <div id="all-fav">
            <div id="fav">
                <form action="#" method="post">
                    <section>
                        <div id="b-title">
                            <ul>
                                <a href="#"><li id="fav-goods" class="tb-onclick fl">收藏商品</li></a>
                                <a href="comingSoon.php"><li id="fav-stores" class="tb-onblur fl">收藏店家</li></a>
                            </ul>
                            <a href="#"><span id="fav-s-icon" class="icon fr">&#xf002;</span></a>
                            <input type="text" class="fav-search fr" name="fav-search" placeholder="搜索我的收藏夹"/>
                        </div>
                        <div id="s-title">
                            <ul>
                                <a href="#"><li id="all-goods" class="ts-onclick fl">所有商品</li></a>
                                <a href="comingSoon.php"><li id="unavailable" class="ts-onblur fl">已失效</li></a>
                                <a href="comingSoon.php"><li id="same-store" class="ts-onblur fl">同店商品</li></a>
                            </ul>
                            <a id="manage-button" class="normal fr">批量管理</a>
                            <ul id="s-hidden">
                                <li id="choose-all" class="fl">
                                    <span class="normal fl" id="all"> <img src="./images/myCollect/product_normal.png" alt=""/></span>
                                    <a><span class="h-tag">全选</span></a>
                                </li>
                                <a href="#"><li id="del" class="fl">删除商品</li></a>
                                <a href="#"><li id="add-to-cart" class="fl">加入购物车</li></a>
                            </ul>
                        </div>
                        <div id="contents">
                        <?php
                            $id = $_SESSION['userId'];
                            $rows = getFavouriteByUserId($link, $id);
                            foreach($rows as $row):
                                $proImg = getProImgById($link, $row['proId']);
                                $proInfo = getProById($link, $row['proId']);
                        ?>
                            <div class="f-good">
                                <div class="pro-id" style="display:none;"><?php echo $row['proId'];?></div>
                                <div class="img">
                                <img src="./image_220/<?php echo $proImg['albumPath'];?>" width="230" alt="" onclick="show(<?php echo $row['proId'];?>);"/>
                                </div>
                                <div class="fav-describe">
                                    <p><?php echo $proInfo['pName'];?></p>
                                    <span class="fl fav-price">￥<?php echo $proInfo['xduPrice'];?></span>
                                    <a href="#"><span class="fr fav-input" onclick="addCart(<?php echo $row['proId'];?>)">加入购物车</span></a>
                                </div>
                                <div class="mask">
                                    <div class="unchecked fr">
                                        <img src="./images/myCollect/product_normal_big.png" alt=""/>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?> 
                             <div style="clear: both;"></div>   
                        </div>
                    </section>
                </form>
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
    <script src="./scripts/jquery-3.1.1.min.js"></script>
    <script src="./scripts/favourites.js"></script>
    <script type="text/javascript">
    function show(id)
    {
        window.location = "proDetails.php?id="+id;
    }
    function addCart(id)
    {
        window.location = "doAction.php?act=addCart&id="+id;
    }
    function delFavourites(ids)
    {
        window.location = "doAction.php?act=delFavourites&id="+ids;
    }
    function addCarts(ids)
    {
        window.location = "doAction.php?act=addCarts&id="+ids;
    }
    </script>
</html>
