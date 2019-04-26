<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0" />
    <title>投诉建议</title>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css" />
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" /> -->
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/advices.css" />
    <!--引入上传图片CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo HomeCssUrl;?>/webuploader.css">



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
    <div class="hr"></div>
    <div class="info-container">
        <div class="line ul">
            <span class="label cus-kind">*客户类型</span>
            <input type="text" class="cus-kind">
            <span class="i-con"><i class="fa fa-caret-down fa-lg"></i></span>
            <ul>
                <li>消&nbsp费&nbsp者</li>
                <li>代&nbsp理&nbsp商</li>
                <li>公&nbsp&nbsp司</li>
            </ul>
        </div>
        <div class="line">
            <span class="label name">*姓名</span>
            <input type="text" class="name">
        </div>
        <div class="line">
            <span class="label tel">*联系电话</span>
            <input type="text" class="tel">
        </div>
        <div class="line">
            <span class="label mail">电子邮箱</span>
            <input type="text" class="mail">
        </div>
        <div class="line ul">
            <span class="label com-kind">*投诉类别</span>
            <input type="text" class="com-kind">
            <span class="i-con"><i class="fa fa-caret-down fa-lg"></i></span>
            <ul>
                <li id="1">服&nbsp&nbsp务</li>
                <li id="2">质&nbsp&nbsp量</li>
                <li id="3">售&nbsp&nbsp假</li>
                <li id="4">建&nbsp&nbsp议</li>
                <li id="5">其&nbsp&nbsp它</li>
            </ul>
        </div>
        <div class="line">
            <span class="label mail">上传图片</span>
            <!--dom结构部分-->
            <div id="uploader-container">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker webuploader-pick">选择图片</div>
            </div>

        </div>
        <div class="line">
            <span class="label com-advices">*投诉建议</span>
            <textarea class="com-advices" name="" id="" cols="30" rows="5"></textarea>
        </div>
    </div>
    <button class="submit sub-mar">提交</button>

<script type="text/javascript" src="<?php echo HomeJsUrl;?>/jquery-3.1.1.min.js"></script>
<!--引入上传图片JS-->
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/webuploader.custom.min.js"></script>
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/webuploader.min.js"></script>
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/advices.js"></script>
</body>

</html>