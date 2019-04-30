// $(".con-player").each(function (idx, ele) {
//     var vid=$(ele).attr("data-id");
//     var modId=$(ele).attr("id");
//     initPlayer(vid,modId)
// })
// function initPlayer(vid,modId) {
//     var video = new tvp.VideoInfo();
//     video.setVid(vid);
//     var player = new tvp.Player();
//     player.create({
//         video: video,
//         modId: modId,
//         autoplay: 0
//     });
// }
//
// 点击tabs
$(".tabs .title").click(function () {
    $(this).siblings(".title").removeClass("active");
    $(this).addClass("active");

    var idx=$(this).index()
// console.log($(this).index())
    $(".videos-con").hide()
    $(".videos-con").eq(idx).show()
})
var globalVideoID;
function videoEnd()
{
    var video = document.getElementById(globalVideoID);
    video.webkitExitFullScreen();
}
function playVideo(videoID){
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
function palyover(vid){

    $("#"+vid).html('');
}
function newplayvideo(vidieid){
    var num=$('#'+vidieid).attr('vid');
    // alert(num);return false;
    num ="f0752boa23k"
    $('#'+vidieid).html('');
    $('.yc1').html('');
    var video = new tvp.VideoInfo();
    video.setVid(num);
    video.setTitle("视频");
    var player = new tvp.Player();
    player.create({
        width:580,
        height:300,
        video:video,
        isVodFlashShowSearchBar:0,
        isVodFlashShowEnd:0,
        autoplay:1,
        controls:0,
        modId:vidieid
    });
    setTimeout(function(){
        $('#'+vidieid).find('video').attr('onpause',"palyover('"+vidieid+"')");
        $('video')[0].play();
    },500)

}