function getQs(data) {
    $.ajax({
        url: "/Home/servicemenu/problem",
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
$('.i-con').click(function () {
        $(this).children("i").toggleClass("fa-rotate-90");
        $(this).parents(".ques").siblings(".ans").toggle(500);
    }
)
$(".logo .fa").click(function () {
    var value=$(this).parents(".logo").find(".inp-search").val();
    // console.log(value);
    var data={value:value,type:"search"}
    getQs(data)
})
//getQs({type:"all"});