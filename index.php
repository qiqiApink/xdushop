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
        <title>西电学子商城首页</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./styles/common.css">
        <link rel="stylesheet" type="text/css" href="./styles/header.css">
        <link rel="stylesheet" type="text/css" href="./styles/footer.css">
        <link rel="stylesheet" type="text/css" href="./styles/slide.css">
        <link rel="stylesheet" type="text/css" href="./styles/home.css">
        <meta http-equiv="X-UA-Compatible" content="IE-edge,chrome=1"/>
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
                <a href="search.php" class="fl"><img id="search" src="./images/search.png" alt="搜索"/></a>
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

        <!--Banner-->
        <div class="ck-slide">
            <ul class="ck-slide-wrapper">
                <li>
                    <a href="./comingSoon.php"><img src="./images/itemCat/itemCat_banner1.png" alt=""></a>
                </li>
                <li style="display:none">
                    <a href="./comingSoon.php"><img src="./images/itemCat/itemCat_banner2.png" alt=""></a>
                </li>
                <li style="display:none">
                    <a href="./comingSoon.php"><img src="./images/itemCat/itemCat_banner3.png" alt=""></a>
                </li>
                <li style="display:none">
                    <a href="./comingSoon.php"><img src="./images/itemCat/itemCat_banner4.png" alt=""></a>
                </li>
                <li style="display:none">
                    <a href="./comingSoon.php"><img src="./images/itemCat/itemCat_banner1.png" alt=""></a>
                </li>
            </ul>
            <a href="javascript:;" class="ctrl-slide ck-prev">上一张</a> <a href="javascript:;" class="ctrl-slide ck-next">下一张</a>
            <div class="ck-slidebox">
                <div class="slideWrap">
                    <ul class="dot-wrap">
                        <li class="current"><em>1</em></li>
                        <li><em>2</em></li>
                        <li><em>3</em></li>
                        <li><em>4</em></li>
                        <li><em>5</em></li>
                    </ul>
                </div>
            </div>
        </div>
<div id="home">
    <?php foreach($cates as $cate):?>
    <div class="electronic-title" id="<?php echo $cate['cName'];?>"><span class="icon" style="font-size:19px;">&#xf02c;</span> &nbsp;<?php echo $cate['cName'];?></div>
        <div class="electronic">
        <?php
            $pros = getProsByCid($link, $cate['id']);
            if($pros && is_array($pros)):
        ?>
            <div class="elec-top">
            <div class="pic01" style="background-image: url(image_350/<?php $proImg = getProImgById($link, $pros[0]['id']); echo $proImg['albumPath'];?>); background-repeat: no-repeat; background-position: 300px 10px; background-size: 320px 350px;">
                    <div class="pic01-detail">
                    <div class="pic01-name fl"><?php echo $pros[0]['pName'];?></div>
                    <div class="pic01-pro fl"><?php echo $pros[0]['pDesc'];?></div>
                    <div class="pic01-price fl">￥<?php echo $pros[0]['xduPrice'];?></div>
                    <a href="proDetails.php?id=<?php echo $pros[0]['id'];?>" target="_blank"><button class="pic01-button fl">查看详情</button></a>
                    </div>
                </div>
                <div class="pic02" style="background-image: url(image_220/<?php $proImg = getProImgById($link, $pros[1]['id']); echo $proImg['albumPath'];?>);background-repeat: no-repeat;background-position: 200px 140px; background-size: 182px 220px;">
                    <div class="pic02-detail">
                    <div class="pic01-name fl"><?php echo $pros[1]['pName'];?></div>
                    <div class="pic01-pro fl"><?php echo $pros[1]['pDesc'];?></div>
                    <div class="pic01-price fl">￥<?php echo $pros[1]['xduPrice'];?></div>
                    <a href="proDetails.php?id=<?php echo $pros[1]['id'];?>" target="_blank"><button class="pic01-button fl">查看详情</button></a>
                    </div>
                </div>
            </div>

            <div class="elec-bottom">
                <div class="classify">
                    <div class="classify-title">
                    <span class="ct"><?php echo $cate['cName'];?></span>
                    </div>
                    <div>
                        <p class="c-t1">分类一</p>
                        <ul class="c-ul">
                            <li class="fl c-d1"><a href="#">类型1</a></li>
                            <li class="fl c-d1"><a href="#">类型2</a></li>
                            <li class="fl c-d1"><a href="#">类型3</a></li>
                            <li class="fl c-d1"><a href="#">类型4</a></li>
                            <li class="fl c-d1"><a href="#">类型5</a></li>
                        </ul>
    
                        <p class="c-t2">分类二</p>
                        <ul class="c-ul">
                            <li class="fl c-d2"><a href="#">类型1</a></li>
                            <li class="fl c-d2"><a href="#">类型2</a></li>
                            <li class="fl c-d2"><a href="#">类型3</a></li>
                            <li class="fl c-d2"><a href="#">类型4</a></li>
                            <li class="fl c-d2"><a href="#">类型5</a></li>
                        </ul>
    
                        <p class="c-t3">分类三</p>
                        <ul class="c-ul">
                            <li class="fl c-d3"><a href="#">类型1</a></li>
                            <li class="fl c-d3"><a href="#">类型2</a></li>
                            <li class="fl c-d3"><a href="#">类型3</a></li>
                            <li class="fl c-d3"><a href="#">类型4</a></li>
                            <li class="fl c-d3"><a href="#">类型5</a></li>
                            <li class="fl c-d3"><a href="#">类型6</a></li>
                        </ul>
                    </div>
                </div>
            <?php
                $prosSmall = getSmallProsByCid($link, $cate['id']);
                if($prosSmall && is_array($prosSmall)):
                    foreach($prosSmall as $proSmall):
                        $proSmallImg = getProImgById($link, $proSmall['id']);
            ?>
                <div class="pic03">
                <img class="bottom-img" src="./image_220/<?php echo $proSmallImg['albumPath'];?>" alt="" width="150" height="150"/>
                    <div class="pic03-name"><?php echo $proSmall['pName'];?></div>
                    <div class="pic03-price">￥<?php echo $proSmall['xduPrice'];?></div>
                    <a href="proDetails.php?id=<?php echo $proSmall['id'];?>" target="_blank"><button class="pic03-button">查看详情</button></a>
                </div>
            <?php
                endforeach;
                endif;
            ?>
            </div>
        <?php
            endif;        
        ?>
        </div>
    <?php endforeach;?>
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
        <script src="./scripts/slide.js"></script>
        <script>
            $('.ck-slide').ckSlide({
                autoPlay: true,//默认为不自动播放，需要时请以此设置
                dir: 'x',//默认效果淡隐淡出，x为水平移动，y 为垂直滚动
                interval:3000//默认间隔2000毫秒
            });
        </script>

    </body>
</html>
