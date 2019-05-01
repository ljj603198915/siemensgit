function getQs(data) {
    $.ajax({
        url: "/index.php/Home/ServiceMenu/problem",
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if (data.code == '1') {
                var Qs = data.list;
                var _html = "";
                $(Qs).each(function (index, ele) {
                    // console.log("未转义："+ele.answer)
                    // var ans=ele.answer.replace(new RegExp("&amp;","g"),"<").replace(new RegExp("&amp;gt;","g"),">")
                    //     .replace(new RegExp("lt;","g"),"<")
                    var ans = ele.answer;
                    if (ans.length == 0) return "";
                    ans = ans.replace(new RegExp("&amp;", "g"), "&");
                    ans = ans.replace(new RegExp("&amp;", "g"), "&");
                    ans = ans.replace(new RegExp("&amp;", "g"), "&");
                    ans = ans.replace(/&lt;/g, "<");
                    ans = ans.replace(/&gt;/g, ">");
                    // console.log(ans)
                    ans = ans.replace(/&nbsp;/g, " ");
                    ans = ans.replace(/&#39;/g, "\'");
                    ans = ans.replace(/&quot;/g, "\"");
                    // console.log("转义后："+ans)
                    _html += '<div class="one-Q"><div class="ques"><span class="text">' + ele.problem_name + '</span>' +
                        '<span class="i-con"><i class="fa fa-angle-right fa-lg"></i></span></div>' +
                        '<div class="ans">' + ans + '</div><input type="text" class="pro" data-type="' +
                        ele.problem_type + '" data-id="' + ele.id + '"/></div>'
                })
                $(".ques-container").empty().html(_html);

            }

        }
    })
}
//点击题干
$('.ques-container').on("click", ".i-con", function (event) {
        $(this).children("i").toggleClass("fa-rotate-90");
        $(this).parents(".ques").siblings(".ans").toggle(500);
        if ($(this).parents(".ques").hasClass("show")) {
            $(this).parents(".ques").removeClass("show")
        } else {
            $(this).parents(".ques").addClass("show")
            var qid = $(this).parents(".one-Q").find('input').attr('data-id')
            stat(qid)
        }
        event.stopPropagation();

    }
)
$('.ques-container').on("click", ".ques", function (event) {
        $(this).find(".i-con").children("i").toggleClass("fa-rotate-90");
        $(this).find(".i-con").parents(".ques").siblings(".ans").toggle(500);
        if ($(this).hasClass("show")) {
            $(this).removeClass("show")
        } else {
            $(this).addClass("show")
            var qid = $(this).parents(".one-Q").find('input').attr('data-id')
            stat(qid)
        }
    }
)

function stat(qid) {
    var data = {
        type: 'questions',
        problem_id: qid
    }
    $.ajax({
        url: "/index.php/Home/ServiceMenu/statis",
        type: 'post',
        data: data,
        // dataType: 'json',
        success: function (msg) {
            // if (msg.code == '1') {
            //     alert("提交成功！")
            //     //location.reload();
            //
            // } else {
            //     alert("提交失败！")
            // }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.status);
            // 状态
            console.log(XMLHttpRequest.readyState);
            // 错误信息
            console.log(textStatus);
        }
    })
}
//点击搜索
$(".logo .fa").click(function () {
    var value = $(this).parents(".logo").find(".inp-search").val();
    // console.log(value);
    var data = {"search": value, "problem_type": 1}
    getQs(data)
})


// 点击tabs
$(".tabs .title").click(function () {
    $(this).siblings(".title").removeClass("active");
    $(this).addClass("active");

    var value = $(".inp-search").val();//搜索框内容
    var type_id = $(this).index() + 1;//问题类型
    if (value != "") {
        //搜索中
        var data = {"search": value, "problem_type": type_id}
    } else {
        //未搜索
        var data = {"search": "", "problem_type": type_id}
    }
    // console.log(id);

    getQs(data);
})
// tabs end
//init
getQs({"search": "", "problem_type": 1});
//init end
