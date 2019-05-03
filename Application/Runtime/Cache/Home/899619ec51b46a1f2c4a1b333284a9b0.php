<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0" />
    <title>观看视频</title>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css" />
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" /> -->
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/videos.css" />
    <script language="javascript" src="http://imgcache.qq.com/tencentvideo_v1/tvp/js/tvp.player_v2.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo HomeJsUrl;?>/jquery-3.1.1.min.js"></script>
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
<div class="videos-container">
    <div class="tabs">
        <div class="title active">品牌</div>
        <div class="title">产品</div>
        <div class="title">接线</div>
    </div>
    <div class="videos-con">
        <div class="line videos">
            <div class="one">
                    <div class="con-player" id="player9" data-id="f0752boa23k" data-img="vi-jiaju.jpg"></div>
                    <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-jiaju.jpg" alt="">-->
                    <!--<div class="icon"><i class="fa fa-play-circle-o fa-lg"></i></div>-->
                <p class="video-des">家居电气宣传片</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player10" data-id="v0194ehhp7d" data-img="vi-diya.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-diya.jpg" alt="">-->
                <!--<div class="icon"><i class="fa fa-play-circle-o fa-lg"></i></div>-->
                <p class="video-des">西门子低压电气发展史</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player11" data-id="d0859xcdgya" data-img="vi-fazhanshi.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-fazhanshi.jpg" alt="">-->
                <!--<div class="icon"><i class="fa fa-play-circle-o fa-lg"></i></div>-->
                <p class="video-des">西门子中国发展史</p>
            </div>
        </div>
    </div>
    <div class="videos-con">
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player1" data-id="x0861oqbnf5" data-img="vi-ruizhi.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-ruizhi.jpg" alt="">-->
                <p class="video-des">睿智系列</p>
            </div>
            <div class="one">
                <div class="con-player" id="player2" data-id="v0859ji2vs3" data-img="vi-haorui.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-haorui.jpg" alt="">-->
                <p class="video-des">皓睿系列</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player3" data-id="z08247ooc1o" data-img="vi-ruiyi.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-ruiyi.jpg" alt="">-->
                <!--<div class="icon"><i class="fa fa-play-circle-o fa-lg "></i></div>-->
                <p class="video-des">睿绎系列</p>
            </div>
            <div class="one">
                <div class="con-player" id="player4" data-id="b0856gjjxae" data-img="vi-lingyun.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-lingyun.jpg" alt="">-->
                <p class="video-des">灵蕴系列</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player5" data-id="j0859xhotuw" data-img="vi-X1.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-X1.jpg" alt="">-->
                <p class="video-des">风逸X1系列插线板</p>
            </div>
            <div class="one">
                <div class="con-player" id="player6" data-id="u0718i4n37m" data-img="vi-xirui.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-xirui.jpg" alt="">-->
                <p class="video-des">西睿空气检测仪</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player7" data-id="j0859zvpp6p" data-img="vi-60.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-60.jpg" alt="">-->
                <p class="video-des">绿色断路器系列(60s)</p>
            </div>
            <div class="one">
                <div class="con-player" id="player8" data-id="s0727b4moy8" data-img="vi-180.jpg"></div>
                <!--<img class="cover" src="<?php echo HomeImgUrl;?>/vi-180.jpg" alt="">-->
                <p class="video-des">绿色断路器系列(180s)</p>
            </div>
        </div>
    </div>
</div>

<!--<script type="text/javascript" src="<?php echo HomeJsUrl;?>/jquery-3.1.1.min.js"></script>-->

<script type="text/javascript" src="<?php echo HomeJsUrl;?>/videos.js"></script>
<script type="text/javascript">
//    tvp.$.getScript('https://m.v.qq.com/tvp/setting.js?t=' + (+new Date()), function () {
//window.onload=function(){
//    var video = new tvp.VideoInfo();
//    video.setVid('f0752boa23k');
//    var player = new tvp.Player();
//    player.create({
//        width: 144,
//        height: 80,
//        video: video,
//        playerType: 'html5',
//        modId: 'player9',
//        autoplay: 0,
//        isHtml5ShowPosterOnStart: true
        // pic:'http://m.qpic.cn/psb?/V11PpG8F27FnBO/XnpjNxPwcljUr6N*envv.B34qXBcaeNb5yYEC6c0Yng!/b/dFMBAAAAAAAA&bo=gwJoAQAAAAARF8g!&rf=viewer_4&t=5'
//        });
//    })
//    player.onwrite = function () {
//        player.play()
//    }
//    function player9() {
//        var player9=document.getElementById('player9')
//        var video2=player9.getElementsByTagName('video');
//        video2.play()
//    }


//     player.onwrite = function () {
//         player.play();
//     }
//    player.oninit = function () {
//        player.play();
//    }
//}
//var player9=document.getElementById('player9')
//var video2=player9.getElementsByTagName('video');
//video2.play()
//    (function(){
//        var video, output;
//        var scale = 0.8;
//        var initialize = function() {
//            output = document.getElementById("output");
//            video = document.getElementById("video");
//            video.addEventListener('loadeddata',captureImage);
//        };
//
//        var captureImage = function() {
//            var canvas = document.createElement("canvas");
//            canvas.width = video.videoWidth * scale;
//            canvas.height = video.videoHeight * scale;
//            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
//
//            var img = document.createElement("img");
//            img.crossOrigin="anonymous";
//            img.src = canvas.toDataURL("image/png");
//            output.appendChild(img);
//        };
//
//        initialize();
//    })();
</script>
</body>

</html>