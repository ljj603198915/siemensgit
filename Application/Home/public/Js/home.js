$(".wrapper .item>a").click(function () {
    var type=$(this).attr("id")
    var data={"type":type}
    // console.log(data)
    putData(data)
})

function putData(data) {
    $.ajax({
        url: "/Home/servicemenu/statis",
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
