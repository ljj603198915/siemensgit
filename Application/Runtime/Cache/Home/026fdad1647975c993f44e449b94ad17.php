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
    <div class="videos">
        <div class="line videos">
            <div class="one">
                <video  poster="" controls="controls" src="<?php echo HomeCssUrl;?>/../vi.mp4"></video>
                <div ></div>
            </div>
            <div class="one">
                <video  poster="" controls="controls" src="<?php echo HomeCssUrl;?>/../vi.mp4"></video>
                <div ></div>
            </div>
        </div>

    </div>
</div>

<!--<video poster=""
       controls="controls" src="http://ips.ifeng.com/video19.ifeng.com/video09/2017/03/02/2335458-102-009-091204
       .mp4?vid=cc2f2f25-e8af-407f-979c-99d0ac3cd4a3&amp;uid=1555558230049_mjqrk97023&amp;from=v_Free&amp;pver=vHTML5Player_v2.0.0&amp;sver=&amp;
       &lt;!&ndash;se=印度技术宅&amp;cat=140-141&amp;ptype=140&amp;platform=pc&amp;sourceType=h5&amp;dt=1484582400000&amp;gid=GlCSwWoufu4Q&amp;sign=60b35d3c004de26b2d5c3f5f6ff6c90d&amp;tm=1555558231594"></video>-->
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