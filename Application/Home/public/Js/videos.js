// $(".cover,.icon").click(function () {
//     var video = $(this).parents(".con-img").find(".con-player");
//     var vid = $(video).attr("data-id");
//     var modId = $(video).attr("id");
//     $(this).parents(".con-img").find(".cover").hide();
//     $(this).parents(".con-img").find(".icon").hide();
//     initPlayer(vid, modId)
//
// })
$(".con-player").each(function (idx, ele) {
    var vid=$(ele).attr("data-id");
    var modId=$(ele).attr("id");
    var imgurl=$(ele).attr("data-img");
    initPlayer(vid,modId,imgurl)
})

// function startPlay(player) {
//     player.play();
// }
$(this).parents(".con-img").find(".cover").hide();
$(this).parents(".con-img").find(".icon").hide();
function initPlayer(vid, modId,imgurl) {
    tvp.$.getScript('https://m.v.qq.com/tvp/setting.js?t=' + (+new Date()), function () {

        var video = new tvp.VideoInfo();
        video.setVid(vid);
        var player = new tvp.Player();
        player.create({
            // width: 144,
            // height: 80,
            video: video,
            playerType: 'html5',
            modId: modId,
            autoplay: 0,
            isHtml5ShowPlayBtnOnPause: 1,
            isHtml5ShowPosterOnStart: true,
            pic:'../../../Application/Home/public/Images/'+imgurl
            // pic:'http://m.qpic.cn/psb?/V11PpG8F27FnBO/XnpjNxPwcljUr6N*envv.B34qXBcaeNb5yYEC6c0Yng!/b/dFMBAAAAAAAA&bo=gwJoAQAAAAARF8g!&rf=viewer_4&t=5'
        });
        // setTimeout(function () {
        //
        //     // $('#' + vidieid).find('video').attr('onpause', "palyover('" + vidieid + "')");
        //
        //     $('video')[0].play();
        //
        // }, 1500)
        // player.onwrite = function () {
        //     player.play();
        // }
        player.onplaying = function () {
            var videoDom = document.getElementsByTagName('video')[0];
            // alert('a')
            if(videoDom.requestFullscreen){

                return videoDom.requestFullscreen();

            }else if(videoDom.webkitRequestFullScreen){

                return videoDom.webkitRequestFullScreen();

            }else if(videoDom.mozRequestFullScreen){

                return videoDom.mozRequestFullScreen();

            }else{

                return videoDom.msRequestFullscreen();

            }
        }
        // video.addEventListener('ended', videoEnd, false);
        // video.play();
        // video.webkitEnterFullScreen();

    });
}
// initPlayer('f0752boa23k','player9')
// function initPlayer(vid,modId) {
//     var video = new tvp.VideoInfo();
//     video.setVid(vid);
//     var player = new tvp.Player();
//     player.create({
//         video: video,
//         modId: modId,
//         width:144,
//         height:80,
//         controls:0,
//         playerType:'html5',
//         // pic:"<?php echo HomeImgUrl;?>/vi-jiaju.jpg",
//         autoplay: true
//
//     });
//     // player.enterFullWindow();
// }

// 点击tabs
$(".tabs .title").click(function () {
    $(this).siblings(".title").removeClass("active");
    $(this).addClass("active");

    var idx = $(this).index()
// console.log($(this).index())
    $(".videos-con").hide()
    $(".videos-con").eq(idx).show()
})
var globalVideoID;
function videoEnd() {
    var video = document.getElementById(globalVideoID);
    video.webkitExitFullScreen();
}
function playVideo(videoID) {
    globalVideoID = videoID;
    var video = document.getElementById(videoID);
    video.addEventListener('ended', videoEnd, false);
    /*
     if(typeof(video.webkitEnterFullScreen)!='undefined')
     {
     setTimeout(function(){video.webkitEnterFullScreen();},500);
     }
     */
    video.play();
    video.webkitEnterFullScreen();
}
function palyover(vid) {

    $("#" + vid).html('');
}
// function newplayvideo(vidieid) {
//     var num = $('#' + vidieid).attr('vid');
//     // alert(num);return false;
//     num = "f0752boa23k"
//     $('#' + vidieid).html('');
//     $('.yc1').html('');
//     var video = new tvp.VideoInfo();
//     video.setVid(num);
//     video.setTitle("视频");
//     var player = new tvp.Player();
//     player.create({
//         width: 580,
//         height: 300,
//         video: video,
//         isVodFlashShowSearchBar: 0,
//         isVodFlashShowEnd: 0,
//         autoplay: 1,
//         controls: 0,
//         modId: vidieid
//     });
//     setTimeout(function () {
//         $('#' + vidieid).find('video').attr('onpause', "palyover('" + vidieid + "')");
//         $('video')[0].play();
//     }, 500)
//
// }