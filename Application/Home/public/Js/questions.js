function getQs(data) {
    $.ajax({
        url: "/index.php/Home/servicemenu/problem",
        type: 'post',
        data:data,
        dataType: 'json',
        success: function (data) {
            if(data.code == '1'){
                var Qs=data.list;
                var _html="";
                $(Qs).each(function (index, ele) {
                    _html+='<div class="one-Q"><div class="ques"><span class="text">'+ele.problem_name+'</span>'+
                        '<span class="i-con"><i class="fa fa-angle-right fa-lg"></i></span></div>'+
                        '<div class="ans">'+ele.answer+'</div><input type="text" class="pro" data-type="'+
                        ele.problem_type+'" data-id="'+ele.id+'"/></div>'
                })
                $(".ques-container").empty().append(_html);

            }

        }
    })
}
//点击题干
$('.i-con').click(function () {
        $(this).children("i").toggleClass("fa-rotate-90");
        $(this).parents(".ques").siblings(".ans").toggle(500);
    }
)
//点击搜索
$(".logo .fa").click(function () {
    var value=$(this).parents(".logo").find(".inp-search").val();
    // console.log(value);
    var data={"search":value,"problem_type":""}
    getQs(data)
})


// tabs
$(".tabs .title").click(function () {
    $(this).siblings(".title").removeClass("active");
    $(this).addClass("active");
    var id=$(this).index()+1;
    // console.log(id);
    var data={"search":"","problem_type":id}
    getQs(data);
})
// tabs end
//init
getQs({"search":"","problem_type":1});
//init end
