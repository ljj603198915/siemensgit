<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0"/>
    <title>专享服务</title>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css"/>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/font-awesome.min.css"/>
    <!-- <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" /> -->
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/home.css"/>

    <style>


        @media only screen and (min-width: 768px) {
            input {
                margin-top: 5px;
            }
        }


    </style>
</head>

<body>
<div class="logo-container">
    <div class="logo">
        <img src="<?php echo Homessy;?>/logo.png" alt="SIEMENS">
    </div>
</div>
<div class="wrapper">
    <div class="item1 item">
        <a id="prodesc" href="http://www.wawechat.siemens.com.cn/index.php/Home/Checkproduct/proDesc.html">
            <div class="icon"><i class="fa fa-map fa-lg"></i></div>
            <div class="text">
                <p class="chi">产品说明书</p>
                <!--<p class="eng">Product specification</p>-->
                <p class="eng">Product specification</p>
            </div>
        </a>
    </div>
    <div class="item2 item">
        <a id="checkproduct" href="<?php echo U('Checkproduct/checkproduct'); ?>">
            <div class="icon">
                <!--<i class="fa fa-search fa-lg"></i>-->
                <i class="fa fa-search fa-lg " style="position: absolute;top: 0;left: 10px;"></i>
                <i class="fa fa-check fa-lg " style="
    position: absolute;
    left: 17px;
    top: 0px;
    font-size: 28px;"></i>
                <!--<span class="fa-stack fa-lg">-->
                <!---->
                <!---->
                <!--</span>-->
            </div>
            <div class="text" style="margin-left: -45%;">
                <p class="chi">产品验真</p>
                <p class="eng">Product verification</p>
            </div>
        </a>

    </div>
    <div class="item3 item">
        <a id="nearshop" href="http://www.wawechat.siemens.com.cn/Home/Nearshop/shop">
            <div class="icon"><i class="fa fa-home fa-lg"></i></div>
            <div class="text">
                <p class="chi">附近店铺</p>
                <p class="eng">Nearby shops</p>
            </div>
        </a>
    </div>
    <div class="item4 item">
        <a id="onshop" href="http://www.wawechat.siemens.com.cn/Home/Onshop/onshop">
            <div class="icon"><i class="fa fa-shopping-cart fa-lg"></i></div>
            <div class="text">
                <p class="chi">在线购买</p>
                <p class="eng">Online Purchase</p>
            </div>
        </a>
    </div>
    <div class="item5 item">
        <a id="logistics" href="http://www.wawechat.siemens.com.cn/Home/Checkproduct/logistics">
            <div class="icon"><i class="fa fa-truck fa-lg"></i></div>
            <div class="text">
                <p class="chi">物流查询</p>
                <p class="eng">Logistics inquiry</p>
            </div>
        </a>
    </div>
    <div class="item6 item">
        <a id="joinus" href="./joinus.html">
            <div class="icon"><i class="fa fa-users fa-lg"></i></div>
            <div class="text">
                <p class="chi">申请加盟</p>
                <p class="eng">Join us</p>
            </div>
        </a>
    </div>
    <div class="item7 item">
        <a id="advice" href="./advices.html">
            <div class="icon"><i class="fa fa-pencil-square-o fa-lg"></i></div>
            <div class="text">
                <p class="chi">投诉建议</p>
                <p class="eng">Complaint suggestion</p>
            </div>
        </a>
    </div>
    <div class="item8 item">
        <a id="electric"
           href="https://mp.weixin.qq.com/mp/homepage?__biz=MzIxNDcxMzgzNg==&hid=2&sn=15e9fb9389ed13b5ffe50a73f4b3f1ec">
            <div class="icon"><i class="fa fa-lightbulb-o fa-lg" style="
    position: absolute;
    top: 4px;
    left: 22px;
"></i></div>
            <div class="text">
                <p class="chi">电气贴士</p>
                <p class="eng">Electrical tips</p>
            </div>
        </a>
    </div>
    <div class="item9 item">
        <a id="400help" href="tel://400-616-2020">
            <div class="icon" style="font-size: 25px;right: 14px;"><i class="fa fa-volume-control-phone fa-lg"></i></div>
            <div class="text">
                <p class="chi">400关爱热线</p>
                <p class="eng">400 Care Hotline</p>
            </div>
        </a>
    </div>
    <div class="item10 item">
        <a id="jingcai" href="http://m61f75ea0f92213d8.wxvote.youtoupiao.com/page/show/id/4df493c2a7bac73e.html">
            <div class="icon"><i class="fa fa-gift fa-lg"></i></div>
            <div class="text">
                <p class="chi">精彩乐惠</p>
                <p class="eng">Enjoy privileges</p>
            </div>
        </a>
    </div>
    <div class="item11 item">
        <a id="problem" href="./questions.html">
            <div class="icon">
                <!--<i class="fa fa-question-circle fa-lg"></i>-->
                    <i class="fa fa-square fa-lg " style="
    font-size: 42px;
"></i>
                    <i class="fa fa-question fa-lg fa-inverse " style="
    position: absolute;
    left: 22px;
    top: 6px;
    font-size: 33px;
    color: #cfcfcf;
"></i>
            </div>
            <div class="text">
                <p class="chi">答疑解惑</p>
                <p class="eng">FQA</p>
            </div>
        </a>
    </div>
    <div class="item12 item">
        <a id="video" href="videos.html">
            <div class="icon"><i class="fa fa-play-circle-o fa-lg"></i></div>
            <div class="text" style="margin-left: -45%;">
                <p class="chi">观看视频</p>
                <p class="eng">Watch videos</p>
            </div>
        </a>
    </div>
    <div class="item13 item">
        <a id="cyclopaedia" href="http://site.0000park.com/book/?from=groupmessage&isappinstalled=0">
            <div class="icon"><i class="fa fa-book fa-lg"></i></div>
            <div class="text" style="margin-left: -45%;">
                <p class="chi">百科全书</p>
                <p class="eng">Cyclopaedia</p>
            </div>
        </a>
    </div>
</div>
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/home.js"></script>

</body>

</html>