$(".con-player").each(function (idx, ele) {
    var vid=$(ele).attr("data-id");
    var modId=$(ele).attr("id");
    initPlayer(vid,modId)
})
function initPlayer(vid,modId) {
    var video = new tvp.VideoInfo();
    video.setVid(vid);
    var player = new tvp.Player();
    player.create({
        video: video,
        modId: modId,
        autoplay: 0
    });
}

// 点击tabs
$(".tabs .title").click(function () {
    $(this).siblings(".title").removeClass("active");
    $(this).addClass("active");

    var idx=$(this).index()
// console.log($(this).index())
    $(".videos-con").hide()
    $(".videos-con").eq(idx).show()
})
