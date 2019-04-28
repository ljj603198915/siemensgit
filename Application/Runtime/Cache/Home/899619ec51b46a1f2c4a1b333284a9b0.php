<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0" />
    <title>观看视频</title>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css" />
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" /> -->
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/videos.css" />
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
                <div class="con-player" id="player9" data-id="f0752boa23k"></div>
                <p class="video-des">家居电气宣传片</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player10" data-id="v0194ehhp7d"></div>
                <p class="video-des">西门子低压电气发展史</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player11" data-id="d0859xcdgya"></div>
                <p class="video-des">西门子中国发展史</p>
            </div>
        </div>
    </div>
    <div class="videos-con">
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player1" data-id="x0861oqbnf5"></div>
                <p class="video-des">睿智系列</p>
            </div>
            <div class="one">
                <div class="con-player" id="player2" data-id="v0859ji2vs3"></div>
                <p class="video-des">皓睿系列</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player3" data-id="z08247ooc1o"></div>
                <p class="video-des">睿绎系列</p>
            </div>
            <div class="one">
                <div class="con-player" id="player4" data-id="b0856gjjxae"></div>
                <p class="video-des">灵蕴系列</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player5" data-id="j0859xhotuw"></div>
                <p class="video-des">风逸X1系列插线板</p>
            </div>
            <div class="one">
                <div class="con-player" id="player6" data-id="u0718i4n37m"></div>
                <p class="video-des">西睿空气检测仪</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player7" data-id="j0859zvpp6p"></div>
                <p class="video-des">绿色断路器系列(60s)</p>
            </div>
            <div class="one">
                <div class="con-player" id="player8" data-id="s0727b4moy8"></div>
                <p class="video-des">绿色断路器系列(180s)</p>
            </div>
        </div>
    </div>
</div>

<!--<video poster=""
       controls="controls" src="http://ips.ifeng.com/video19.ifeng.com/video09/2017/03/02/2335458-102-009-091204
       .mp4?vid=cc2f2f25-e8af-407f-979c-99d0ac3cd4a3&amp;uid=1555558230049_mjqrk97023&amp;from=v_Free&amp;pver=vHTML5Player_v2.0.0&amp;sver=&amp;
       &lt;!&ndash;se=印度技术宅&amp;cat=140-141&amp;ptype=140&amp;platform=pc&amp;sourceType=h5&amp;dt=1484582400000&amp;gid=GlCSwWoufu4Q&amp;sign=60b35d3c004de26b2d5c3f5f6ff6c90d&amp;tm=1555558231594"></video>-->
<script language="javascript" src="http://imgcache.qq.com/tencentvideo_v1/tvp/js/tvp.player_v2_mobile.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo HomeJsUrl;?>/videos.js"></script>
<script type="text/javascript">
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