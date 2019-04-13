//声明全局变量
var cityName = ''; //城市名
var detailAddr = ''; //具体地址
var centerLatitude = 0;//中心点纬度
var centerLongitude = 0;//中心点经度
var label = '';//转换后的经纬度坐标

//允许定位的情况下直接获取位置
getLocation();

//点击选择城市
//加载城市事件
$('body').on('touchend', '#zone_ids,#gr_zone_ids', function () {
    if ($('.contain-citylist').is(":hidden")) {
        var zid = $(this).attr('id');
        $('.contain-citylist').show();
    } else {
        $('.contain-citylist').hide();
    }
});
//选择城市 start
$('body').on('click', '.city-list p', function () {
    var type = $('.contain-citylist').data('type');
    $('#zone_ids').html($(this).html()).attr('data-id', $(this).attr('data-id'));
    $('.cityName').html($(this).html()).attr('data-id', $(this).attr('data-id'));
    $('.contain-citylist').hide();
});
$('body').on('click', '.letter a', function () {
    var s = $(this).html();
    $(window).scrollTop($('#' + s + '1').offset().top);
});
//点击搜索
$('.search-nearshop').click(function () {
    cityName = $('.cityName').html().trim();
    detailAddr = $('.detail-address').val();
    if (cityName == '城市名') {
        alert('请选择城市');
        return;
    }
    //拼具体地址

    var address = cityName + detailAddr;
    getSearchLocation(address, cityName);
})


//根据搜索地址获取位置
function getSearchLocation(address, cityName) {
    // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint(address, function (point) {
        if (point) {
            // console.log(point);
            centerLatitude = Number(point.lat); // 纬度，浮点数，范围为90 ~ -90
            centerLongitude = Number(point.lng);
            getShop();
        } else {
            alert("您选择地址没有解析到结果!");
        }
    }, cityName);
}


//微信jssdk获取位置 程序起始
function getLocation() {
    wx.ready(function () {
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                centerLatitude = Number(res.latitude); // 纬度，浮点数，范围为90 ~ -90
                centerLongitude = Number(res.longitude); // 经度，浮点数，范围为180 ~ -180。
                //取得微信坐标
                var wxPoint = new BMap.Point(centerLongitude, centerLatitude)
                //地址转换
                var convertor = new BMap.Convertor();
                var pointArr = [];
                pointArr.push(wxPoint);
                convertor.translate(pointArr, 1, 5, translateCallback)

                //坐标转换完之后的回调函数
                function translateCallback(data) {
                    if (data.status === 0) {
                        var baiduPoint = data.points[0];
                        centerLatitude = baiduPoint.lat;
                        centerLongitude = baiduPoint.lng;
                        //百度逆地址解析
                        var geoc = new BMap.Geocoder();
                        // var pt =  new BMap.Point(centerLongitude,centerLatitude)
                        geoc.getLocation(baiduPoint, function (rs) {
                            //取得逆地址中文名
                            var addComp = rs.addressComponents;
                            cityName = addComp.city;
                            detailAddr = addComp.district + addComp.street + addComp.streetNumber;
                            $('.cityName').html(cityName);
                            $('.detail-address').val(detailAddr)
                            getShop(); //获取店铺
                        });
                    }
                }
            },
            cancel: function () {
                $('.cityName').html("北京市");
                centerLatitude = 39.915175;
                centerLongitude = 116.403906;
                getShop();
            }
        });
    });
}


//获取店铺
function getShop() {
    if (detailAddr == "") {
        var data = {"cityName": cityName,"searchType":"city"};
    } else {
        var data = {
            "centerLatitude": centerLatitude,
            "centerLongitude": centerLongitude,
            "searchType": "location",
            "cityName":cityName
        };
    }
    //发送请求
    $.ajax({
        url: "/index.php/Home/Nearshop/getShop",
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if (data.code == 1) {
                $('.block-nearShop .shopKind1 .contain-addr').empty();
                $('.block-nearShop .shopKind2 .contain-addr').empty();
                latlnts = [];
                console.log(data)
                centerLatitude = data.list['centerLatitude'];
                centerLongitude = data.list['centerLongitude'];
                getMap(latlnts);
                alert("您所在城市线下店铺待更新");
            } else {
                var _html1 = '';
                var _html2 = '';
                var latlnts = [];
                $('.block-nearShop .shopKind1 .contain-addr').empty();
                $('.block-nearShop .shopKind2 .contain-addr').empty();
                $(data.type_kind1).each(function (index, ele) {
                    _html2 += '<a href="' + ele.shop_url + '"><div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + ele.shop_name + '</span><br/><small class="span-shopAddr">地址：' + ele.shop_address + '</small></div></a>';
                    latlnts.push(ele.shop_latlnt)
                })
                $(data.type_kind2).each(function (index, ele) {
                    _html2 += '<a href="' + ele.shop_url + '"><div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + ele.shop_name + '</span><br/><small class="span-shopAddr">地址：' + ele.shop_address + '</small></div></a>';
                    latlnts.push(ele.shop_latlnt)
                })
                // var cityName = $('.select_gr').html();
                if (_html1 == '' && _html2 == '') {
                    alert("您所在城市线下店铺待更新");
                    return;
                }
                $('.block-nearShop .shopKind1 .contain-addr').append(_html1)
                $('.block-nearShop .shopKind2 .contain-addr').append(_html2)

                getMap(latlnts);
            }

        },
        error: function () {
            alert('请求失败');
            //测试数据
            // var _html1 = '';
            // var _html2 = '';
            // var latlnts = [];
            // $('.block-nearShop .shopKind1 .contain-addr').empty();
            // $('.block-nearShop .shopKind2 .contain-addr').empty();
            // $(data.type_kind1).each(function(index, ele) {
            //     _html1 += '<div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + ele.shop_name + '</span><br/><small class="span-shopAddr">地址：' + ele.shop_address + '</small><a class="goto" href="' + ele.shop_url + '"><img src="/Application/Home/public/img/goto.png"></a></div>';
            //     latlnts.push(ele.shop_latlnt)
            // })
            // $(data.type_kind2).each(function(index, ele) {
            //         _html2 += '<div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + ele.shop_name + '</span><br/><small class="span-shopAddr">地址：' + ele.shop_address + '</small><a class="goto" href="' + ele.shop_url + '"><img src="/Application/Home/public/img/goto.png"></a></div>';
            //         latlnts.push(ele.shop_latlnt)
            //     })
            //     // var cityName = $('.select_gr').html();
            // if (_html1 == '' && _html2 == '') {
            //     alert("您所在城市线下店铺待更新");
            //     return;
            // }
            // $('.block-nearShop .shopKind1 .contain-addr').append('<div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + '京东旗舰店' + '</span><br/><small class="span-shopAddr">地址：' + '天津市西青道民族旗舰店' + '</small><a class="goto" href="' + 'www.baidu.com' + '"><img src="/Application/Home/public/img/goto.png"></a></div>')
            // $('.block-nearShop .shopKind2 .contain-addr').append('<div class="one-addr"><i><img src="/Application/Home/public/img/site.png"></i><span class="span-shopName">' + '京东旗舰店' + '</span><br/><small class="span-shopAddr">地址：' + '天津市西青道民族旗舰店' + '</small><a class="goto" href="' + 'www.baidu.com' + '"><img src="/Application/Home/public/img/goto.png"></a></div>')
            // getMap(["117.138865,39.159706"]);

        }

    })
}
//获取地图
function getMap(latlnts) {
    //百度地图
    var map = new BMap.Map("allmap");
    var center_point = new BMap.Point(centerLongitude, centerLatitude);
    // var center_point = new BMap.Point(117.13886525296908, 39.15970579934384);

    map.centerAndZoom(center_point, 12);
    if (latlnts.length > 0) {
        //遍历加坐标
        for (var i = 0; i < latlnts.length; i++) {
            var arrPoint = latlnts[i].split(',')
            var point = new BMap.Point(Number(arrPoint[0]), Number(arrPoint[1]));
            addMarker(point);
        }
        // 编写自定义函数,创建标注
        function addMarker(point) {
            var marker = new BMap.Marker(point);
            map.addOverlay(marker);
        }
    }
}

