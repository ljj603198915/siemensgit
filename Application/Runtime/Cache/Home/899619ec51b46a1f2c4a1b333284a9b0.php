<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0"/>
    <title>观看视频</title>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/reset.css"/>
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/font-awesome.min.css"/>
    <!-- <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/aa.css" /> -->
    <link rel="stylesheet" href="<?php echo HomeCssUrl;?>/videos.css"/>
    <script type="text/javascript" src="<?php echo HomeJsUrl;?>/jquery-3.1.1.min.js"></script>
    <style>


        @media only screen and (min-width: 768px) {
            input {
                margin-top: 5px;
            }
        }

        /*div[pseudo="-internal-media-controls-button-panel"] {*/
        /*display: none;*/
        /*}*/


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
            <div class="one" id="output">
                <div class="con-player" id="player9" data-id="f0752boa23k" data-vid="西门子家居电气宣传片.mp4"
                     data-img="vi-jiaju.jpg">
                    <!--<video id="video" src="http://www.wawechat.siemens.com.cn:8080/Public/v1.mp4"-->
                    <!--poster="<?php echo HomeImgUrl;?>/vi-jiaju.jpg"></video>-->
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-jiaju.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">家居电气宣传片</p>
            </div>

        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player10" data-id="v0194ehhp7d" data-img="vi-diya.jpg"
                     data-vid="fazhanshi.mp4">
                    <!--<iframe frameborder="0" src="https://v.qq.com/txp/iframe/player.html?vid=f0752boa23k" allowFullScreen="true"></iframe>-->

                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-diya.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">西门子低压电气发展史</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player11" data-id="d0859xcdgya" data-img="vi-fazhanshi.jpg"
                     data-vid="西门子中国发展史.mp4">
                    <!--<video controls src="<?php echo HomeImgUrl;?>/test-v.mp4"-->
                    <!--poster="<?php echo HomeImgUrl;?>/vi-jiaju.jpg">-->
                    <!--您的浏览器不支持 video 标签。-->
                    <!--</video>-->
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-fazhanshi.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">西门子中国发展史</p>
            </div>
        </div>
    </div>
    <div class="videos-con">
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player1" data-id="x0861oqbnf5" data-img="vi-ruizhi.jpg"
                     data-vid="睿致系列.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-ruizhi.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">睿致系列</p>
            </div>


        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player2" data-id="v0859ji2vs3" data-img="vi-haorui.jpg" data-vid="皓睿系列.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-haorui.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>

                <p class="video-des">皓睿系列</p>
            </div>
        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player3" data-id="z08247ooc1o" data-img="vi-ruiyi.jpg"
                     data-vid="睿绎系列.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-ruiyi.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>

                <p class="video-des">睿绎系列</p>
            </div>

        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player4" data-id="b0856gjjxae" data-img="vi-lingyun.jpg"
                     data-vid="ly.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-lingyun.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>

                <p class="video-des">灵蕴系列</p>
            </div>
        </div>

        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player5" data-id="j0859xhotuw" data-img="vi-X1.jpg" data-vid="风逸X1系列插线板.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-X1.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>

                <p class="video-des">风逸X1系列插线板</p>
            </div>

        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player6" data-id="u0718i4n37m" data-img="vi-xirui.jpg"
                     data-vid="西睿空气检测仪.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-xirui.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">西睿空气检测仪</p>
            </div>
        </div>

        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player7" data-id="j0859zvpp6p" data-img="vi-60.jpg" data-vid="绿色断路器系列（60s）.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-60.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>

                <p class="video-des">绿色断路器系列(60s)</p>
            </div>

        </div>
        <div class="line videos">
            <div class="one">
                <div class="con-player" id="player8" data-id="s0727b4moy8" data-img="vi-180.jpg" data-vid="绿色断路器系列（180s）.mp4">
                    <img class="cover" src="<?php echo HomeImgUrl;?>/vi-180.jpg" alt="">
                    <div class="icon"><img src="<?php echo HomeImgUrl;?>/play.svg" alt=""></div>
                </div>
                <p class="video-des">绿色断路器系列(180s)</p>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //    设置con-player高度
    $('.videos-con .con-player').each(function (idx, ele) {
        var height = $(ele).height();
        var width = $(ele).width();
        if (height > width / 1.79) {
            $(ele).height(width / 1.78);
        } else {
            $(ele).width(height * 1.78);
        }
    })
    $('.videos-con:eq(1)').hide();
    // 点击tabs
    $(".tabs .title").click(function () {
        $(this).siblings(".title").removeClass("active");
        $(this).addClass("active");

        var idx = $(this).index()
// console.log($(this).index())
        $(".videos-con").hide()
        $(".videos-con").eq(idx).show()
    })

    $(".con-player").on("click", ".icon", function () {
        var vidurl = $(this).parents(".con-player").attr("data-vid");
        var imgurl = $(this).parents(".con-player").attr("data-img");
        var _html = '<video src="http://www.wawechat.siemens.com.cn:8081/'+vidurl+'" poster="<?php echo HomeImgUrl;?>/' + imgurl + '"></video>'
        $(this).parents(".con-player").append(_html);
        $(this).hide()
        $(this).parents(".con-player").find("img").hide()
        bindVideos();
        $(this).parents(".con-player").find("video")[0].play()
    })


    function bindVideos() {
        var videos=document.getElementsByTagName("video");
        for(var i=0;i<videos.length;i++){
            videos[i].onclick=null;
            videos[i].onclick=function () {
                if(!this.paused){
                    this.parentNode.children[1].style.display="block"
                    this.parentNode.children[1].children[0].style.display="inline-block"
                    this.pause();
                }
            }
            videos[i].onpause=function () {
                this.parentNode.children[1].style.display="block"
                this.parentNode.children[1].children[0].style.display="inline-block"
            }
        }
    }


</script>
</body>

</html>