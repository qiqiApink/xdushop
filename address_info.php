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
    <title>地址信息</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="stylesheet" type="text/css" href="./styles/footer.css">
    <link rel="stylesheet" type="text/css" href="./styles/personal_info.css">
    <link rel="stylesheet" type="text/css" href="./styles/address_info.css">

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


    <!--订单部分-->
    <div class="addr">
        <div id="sidebox" class="fl">
            <dl>
                <dt id="info-tag" class="open">
                    <span class="icon">&#xf007;</span>账号管理
                    <img src="./images/myOrder/myOrder2.png" alt="" />
                </dt>
                <dd>
                    <a href="./personal_info.php">个人资料</a>
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
                    <a href="./binding.php">账号绑定</a>
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
            <div class="addr-title">
                收货地址管理
            </div>
            <form action="doAction.php?act=addAddress&id=<?php echo $_SESSION['userId'];?>" method="post" autocomplete="off">
                <div class="addr-pro">
                    <div class="inside-border">
                        <div class="receiver">
                            <span class="fl label"><span class="star">*</span>收货人：</span>
                            <input type="text" name="name" id="rname" />
                            <span id="recv-msg"></span>
                        </div>
                        <div class="region">
                            <span class="fl label"><span class="star">*</span>所在地区：</span>
                            <span class="fl addr-tag">省：</span>
                            <select id="province" class="fl" name="province" onchange="showCity(this)" onclick="showCity(this)">
                                <option value="-1">--请选择--</option>
                            </select>
                            <span class="fl addr-tag">市：</span>
                            <select id="city" class="fl" name="city" onchange="showArea(this)" onclick="showArea(this)">
                            </select>
                            <span class="fl addr-tag">区/县：</span>
                            <select id="area" class="fl" name="district"></select>
                        </div>
                        <div class="specific">
                            <span class="fl label"><span class="star">*</span>详细地址：</span>
                            <textarea class="fl" name="address" id="specific-addr" cols="60" rows="4" placeholder="请输入详细地址信息"></textarea>
                            <span id="detail-msg"></span>
                        </div>
                        <div class="r-tel">
                            <span class="fl label"><span class="star">*</span>收件人手机号：</span>
                            <input type="text" name="tel" id="r-tel"/>
                            <span id="tel-msg"></span>
                        </div>
                        <div class="postcode">
                            <span class="fl label">邮政编码：</span>
                            <input type="text" name="postcode" id="postcode" />
                        </div>
                        <div class="category">
                            <span class="fl label">地址分类名称：</span>
                            <input type="text" class="fl" name="cate" id="category" />
                            <button type="button" class="fl c-button" value="Home">Home</button>
                            <button type="button" class="fl c-button" value="School">School</button>
                            <button type="button" class="fl c-button" value="Office">Office</button>
                        </div>
                        <input class="add-addr" id="add-addr" type="submit" value="添加地址信息"/>
                        <span id="add-msg"></span>
                    </div>
                </div>
            </form>

            <div class="all-addr">
                <div class="inside-border">
                    <div class="all-addr-header">
                        <ul>
                            <li class="fl c-name">分类名称</li>
                            <li class="fl recv">收件人</li>
                            <li class="fl d-addr">详细地址</li>
                            <li class="fl tel">联系电话</li>
                            <li class="fl op">操作</li>
                        </ul>
                    </div>
                <?php
                    $id = $_SESSION['userId'];
                    $rows = getAddressByUserId($link, $id);
                    foreach($rows as $row):
                ?>
                    <div class="addr-content selected">
                        <ul>
                        <div class="fl classify default"><?php echo $row['cate'];?></div>
                        <div class="fl rev-name"><?php echo $row['name'];?></div>
                        <div class="fl detail"><?php echo $row['address'];?></div>
                        <div class="fl mobile"><?php echo $row['tel'];?></div>
                            <div class="fl operation"><a href="#">修改</a>|<a href="#">删除</a></div>
                            <div class="fl cancel">取消默认</div>
                        </ul>
                    </div>
                <?php endforeach;?>
                </div>

            </div>
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
    <script src="./scripts/address_info.js"></script>
</body>

</html>
