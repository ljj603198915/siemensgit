$(".line.ul input,.line.ul .i-con").click(function () {
    // $(this).parents(".line").find("ul").toggle(function () {
    //         $(this).slideDown()
    // },
    // function () {
    //     $(this).slideUp()
    // })
    toggleUl(this)
})

$(".line.ul ul li").click(function () {
    var reg = new RegExp("&nbsp;","g");
    var val=$(this).html().replace(reg,"")
    var id=$(this).attr("data-id")
    $(this).parents(".line").find("input").val(val)
    $(this).parents(".line").find("input").attr("data-id",id)
    toggleUl($(this).parents("ul"));
})
function toggleUl(obj) {
    $(obj).parents(".line").find("ul").toggle(500)
}

// 上传图片begin
// 初始化Web Uploader
var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
    swf: '../js/Uploader.swf',

    // 文件接收服务端。
    server: 'http://webuploader.duapp.com/server/fileupload.php',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',

    // 只允许选择图片文件。
    accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,bmp,png',
        mimeTypes: 'image/*'
    }
});

// 当有文件添加进来的时候
uploader.on( 'fileQueued', function( file ) {
    var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
            '<img>' +
            '<div class="info">' + file.name + '</div>' +
            '</div>'
        ),
        $img = $li.find('img');


    // $list为容器jQuery实例
    $list.append( $li );

    // 创建缩略图
    // 如果为非图片文件，可以不用调用此方法。
    // thumbnailWidth x thumbnailHeight 为 100 x 100
    uploader.makeThumb( file, function( error, src ) {
        if ( error ) {
            $img.replaceWith('<span>不能预览</span>');
            return;
        }

        $img.attr( 'src', src );
    }, thumbnailWidth, thumbnailHeight );
});

// 文件上传过程中创建进度条实时显示。
uploader.on( 'uploadProgress', function( file, percentage ) {
    var $li = $( '#'+file.id ),
        $percent = $li.find('.progress span');

    // 避免重复创建
    if ( !$percent.length ) {
        $percent = $('<p class="progress"><span></span></p>')
            .appendTo( $li )
            .find('span');
    }

    $percent.css( 'width', percentage * 100 + '%' );
});

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
uploader.on( 'uploadSuccess', function( file ) {
    $( '#'+file.id ).addClass('upload-state-done');
});

// 文件上传失败，显示上传出错。
uploader.on( 'uploadError', function( file ) {
    var $li = $( '#'+file.id ),
        $error = $li.find('div.error');

    // 避免重复创建
    if ( !$error.length ) {
        $error = $('<div class="error"></div>').appendTo( $li );
    }

    $error.text('上传失败');
});

// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadComplete', function( file ) {
    $( '#'+file.id ).find('.progress').remove();
});
// 上传图片end

//提交 begin
$(".submit").click(function () {
    var cuskind=$(".info-container").find("input.cus-kind").attr("data-id");
    var name=$(".info-container").find("input.name").val();
    var tel=$(".info-container").find("input.tel").val();
    var mail=$(".info-container").find("input.mail").val();
    var comkind=$(".info-container").find("input.com-kind").attr("data-id");
    var comadvices=$(".info-container").find("textarea").val();
    if(cuskind == ""||name == ""||tel == ""||comkind == ""||comadvices == ""){
        alert("加*为必输项！")
    }else{
        var data = {
            customer_type:cuskind,
            advice_name:name,
            phone:tel,
            email:mail,
            advice_type:comkind,
            advice_content:comadvices
        }
        // console.log(data);
        $.ajax({
            url: "/index.php/Home/servicemenu/problem",
            type: 'post',
            data:data,
            dataType: 'json',
            success: function (data) {
                if(data.code == '1'){
                    alert("提交成功！")

                }else{alert("提交失败！")}

            }
        })
    }

})
// 提交 end


