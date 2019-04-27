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
            <input type="text" class="cus-kind" disabled>
            <span class="i-con"><i class="fa fa-caret-down fa-lg"></i></span>
            <ul>
                <li data-id="1">消&nbsp费&nbsp者</li>
                <li data-id="2">代&nbsp理&nbsp商</li>
                <li data-id="3">公&nbsp&nbsp司</li>
            </ul>
        </div>
        <div class="line">
            <span class="label name">*姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span>
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
            <input type="text" class="com-kind" disabled>
            <span class="i-con"><i class="fa fa-caret-down fa-lg"></i></span>
            <ul>
                <li data-id="1">服&nbsp&nbsp务</li>
                <li data-id="2">质&nbsp&nbsp量</li>
                <li data-id="3">售&nbsp&nbsp假</li>
                <li data-id="4">建&nbsp&nbsp议</li>
                <li data-id="5">其&nbsp&nbsp它</li>
            </ul>
        </div>
        <div class="line">
            <span class="label mail">上传图片</span>
            <!--dom结构部分-->
            <div id="filePicker" id="uploader-container">
                <!--用来存放item-->
                <div class="webUploader-picker">选择图片</div>
                <div class="webUploader-picker1">确认上传</div>
                <div id="fileList" class="uploader-list"></div>

            </div>
            <div style="clear: both"></div>
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