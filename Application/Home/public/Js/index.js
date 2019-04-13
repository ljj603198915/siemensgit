$(function () {
    var imgUrl = '/Application/Home/public/img';
    var typeNum = ''; //type1
    var typeNum2 = '';
     //1-1或1-1-1
    var series = 7;
    // var typeNum3 = ''; //typw1-1-1
    var arrtype1 = [];
    var data = {
        "type1": {
            "按系列": ["睿致","皓睿","映彩","睿绎","点晶","悦动","远景","品宜","灵致","灵动","地插"],
            "按颜色": ["白", "银", "金", "黑", "其他"],
            "按材质": ["PC", "铝制(边框)", "玻璃(边框)"]
        }

        ,
        "type2": {
            "按款式": ["USB", "常规"],
            "按颜色": ["黑色", "白色"]
        }

        ,
        "type3": {
            "空气开关": 0,
            "漏电保护断路器": 0,
            "配电箱": 0,
            "浪涌保护器": 0
        },
        "type4": {
            "配线箱": 0,
            "产品模块": 0,
            "电视分配器": 0,
            "套装": 0
        }
    }

    var data1 = {
        "type1": ["按系列", "按颜色", "按材质"],
        "type2": ["按款式", "按颜色"],
        "type3": ["空气开关", "漏电保护断路器", "配电箱", "浪涌保护器"],
        "type4": ["配线箱", "产品模块", "电视分配器", "套装"]
    }

    var data2 = {
        "type1": {
            "type1-1": ["睿致","皓睿","映彩","睿绎","点晶","悦动","远景","品宜","灵致","灵动","地插"],
            "type1-2": ["白色", "银色", "金色", "黑色", "其他"],
            "type1-3": ["PC", "铝制(边框)", "玻璃(边框)"]
        },
        "type2": {
            "type2-1": ["USB", "常规"],
            "type2-2": ["黑色", "白色"]
        }
    }

    //按颜色数据
    var data3 = {
    	/*白色*/
        "color-1": {
            "colorImg": [{
                'img': '1',
                'seriesId': '7'
            },{
                'img':'27',
                'seriesId':'14'
            },{
            	'img':'26',
            	'seriesId':'13'
            }, {
                'img': '30',
                'seriesId': '15'
            }, {
                'img': '2',
                'seriesId': '6'
            }, {
                'img': '3',
                'seriesId': '5'
            }, {
                'img': '4',
                'seriesId': '4'
            }, {
                'img': '5',
                'seriesId': '2'
            }, {
                'img': '6',
                'seriesId': '3'
            }, {
                'img': '7',
                'seriesId': '1'
            }],
            "bacImg-1": "1"
        },/*银色*/
        "color-2": {
            "colorImg": [{
                'img': '8',
                'seriesId': '7'
            }, {
                'img': '28',
                'seriesId': '14'
            }, {
                'img': '22',
                'seriesId': '13'
            }, {
                'img': '31',
                'seriesId': '15'
            }, {
                'img': '9',
                'seriesId': '6'
            }, {
                'img': '10',
                'seriesId': '5'
            }, {
                'img': '11',
                'seriesId': '4'
            }, {
                'img': '12',
                'seriesId': '2'
            }],
            "bacImg": "2"
        },/*金色*/
        "color-3": {
            "colorImg": [{
                'img': '13',
                'seriesId': '7'
            }, {
                'img': '29',
                'seriesId': '14'
            }, {
                'img': '23',
                'seriesId': '13'
            },  {
                'img': '32',
                'seriesId': '15'
            }, {
                'img': '14',
                'seriesId': '5'
            }, {
                'img': '15',
                'seriesId': '2'
            }, {
                'img': '16',
                'seriesId': '3'
            }, {
                'img': '17',
                'seriesId': '1'
            }],
            "bacImg": "3"
        },/*黑色*/
        "color-4": {
            "colorImg": [
            {
                'img': '24',
                'seriesId': '13'
            },{
                'img': '18',
                'seriesId': '6'
            }, {
                'img': '19',
                'seriesId': '4'
            }],
            "bacImg": "4"
        },
        /*其他*/
        "color-5": {
            "colorImg": [{
                'img': '25',
                'seriesId': '13'
            },{
                'img': '20',
                'seriesId': '6'
            }],
            "bacImg": "5"
        }
    }

    //按材质数据
    var data4 = {
        "material-1": {
            "mImg": [{
                'img': '1',
                'seriesId': '7'
            },{
                'img':'18',
                'seriesId':'14'
            },{
            	'img':'17',
            	'seriesId':'13'
            }, {
                'img': '19',
                'seriesId': '15'
            },  {
                'img': '2',
                'seriesId': '6'
            }, {
                'img': '3',
                'seriesId': '5'
            }, {
                'img': '4',
                'seriesId': '4'
            }, {
                'img': '5',
                'seriesId': '2'
            }, {
                'img': '6',
                'seriesId': '3'
            }, {
                'img': '7',
                'seriesId': '1'
            }],
            "bacImg-1": "1"
        },
        "material-2": {
            "mImg": [{
                'img': '8',
                'seriesId': 'dianjing'
            }, {
                'img': '9',
                'seriesId': 'dianjing'
            }],
            "bacImg": "2"
        },
        "material-3": {
            "mImg": [{
                'img': '10',
                'seriesId': 'dianjing'
            }, {
                'img': '11',
                'seriesId': 'dianjing'
            }, {
                'img': '12',
                'seriesId': 'dianjing'
            }, {
                'img': '13',
                'seriesId': 'dianjing'
            }, {
                'img': '14',
                'seriesId': 'dianjing'
            }, {
                'img': '15',
                'seriesId': 'dianjing'
            }],
            "bacImg": "3"
        }
    }

    function changetypes() {

        typeNum = '1'; //type1
        typeNum2 = '1-1';
        ; //type1-1
        typeNum3 = '1-1-1'; //typw1-1-1
        arrtype1 = data1.type1;

        //遍历四个大类
        $('.li-nearPro').click(function () {
            /* Act on the event */
            _html = '';
            if ($(this).attr('id').substring(4) == '0') return; //点击"选择分类"的时候
            //清空已选的series和color_id
            color_id = colorArr[0];
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            typeNum = $(this).attr('id').substring(4);
            if (typeNum == 1) {
                typeNum2 = '1-1';
            }
            $('.li-select').removeClass('active');//让选择分类按钮变色
            arrtype1 = data1['type' + typeNum];
            if (typeNum == '0') return; //去除“选择分类”按钮

            //展示第一层nav
            var forI = 1;
            for (var name in arrtype1) {
                if (typeNum == 2) {
                    _html += '<span class="span-types" id="type' + typeNum + '-' + forI + '">' + arrtype1[name].substring(1) + '</span>'
                } else {
                    _html += '<span class="span-types" id="type' + typeNum + '-' + forI + '">' + arrtype1[name] + '</span>'
                }
                forI++;
            }
            $('.types').empty();
            $('.types').append(_html);
            changeNavStyle(1);//改变nav样式为一行

            //切换着陆页
            $('section').hide();
            $('section.index-' + typeNum).show();
            isIndex = true;
            isDetail = false;


        });

        var ajaxData = {}
        var dataArr = []; //用于临时存储的数组
        //遍历第二层
        $('.types').on('click', '.span-types', function (event) {
            $('.li-select').addClass('active');//让"选择分类"按钮变色
            typeNum2 = $(this).attr('id').substring(4); //获取第二层id序号
            $(this).siblings().removeClass('active');
            $(this).addClass('active')

            //第2种在第二、三层发送请求
            if (typeNum == '2') {
                dataArr = $(this).attr('id').substring(4).split('-');
                //如果是第二层
                if (typeNum2.length == 3) {
                    dataArr.push(1);
                    if (dataArr[1] == '1') {
                        //按款式
                        ajaxData = {
                            'type': typeNum,
                            'style': Number(dataArr[2]) + 2
                        }
                    } else {
                        //按颜色
                        ajaxData = {
                            'type': typeNum,
                            'color': Number(dataArr[2]) + 2
                        }
                    }
                    ajaxMobile(ajaxData);

                    //如果是第三层
                } else if (typeNum2.length > 3) {
                    if (dataArr[1] == '1') {
                        ajaxData = {
                            'type': typeNum,
                            'style': Number(dataArr[2]) + 2
                        }
                    } else {
                        ajaxData = {
                            'type': typeNum,
                            'color': Number(dataArr[2]) + 2
                        }
                    }

                    ajaxMobile(ajaxData);

                    return; //return是让他不再进行后面的nav填充
                }

            }
            ;

            //第3种在第二层发送请求
            if (typeNum == '3') {
                dataArr = $(this).attr('id').substring(4).split('-');
                //标识第二层
                if (typeNum2.length == 3) {
                    // ajaxData.push(1);
                    var othersData = {
                        "type": typeNum,
                        "kind": dataArr[1]
                    }
                    ajaxOthers(othersData);
                    return;
                }
            }
            ;

            //第4种在第二层发送请求
            if (typeNum == '4') {
                var jiajuArr = []
                dataArr = $(this).attr('id').substring(4).split('-');
                //标识第二层
                if (typeNum2.length == 3) {
                    // ajaxData.push(1);
                    var othersData = {
                        "type": typeNum,
                        "kind": Number(dataArr[1]) + 3
                    }
                    ajaxOthers(othersData);

                    return;
                }
            }
            ;


            //type1-1开关按系列
            if (typeNum2 == '1-1' && typeNum2.length < 5) {
                //切换着陆页
                toSeries(0);
                objSwiper.slideTo(0);
                changeNavStyle('2-youxilie');//两行的情况
                return;
            }
            //遍历1-1-1至1-1-8 让轮播图跳转 并且nav不清空
            if (typeNum2.length >= 5 && typeNum2.substr(0, 3) == '1-1') {
                changeNavStyle('2-youxilie');//改变nav样式为两行
                // bindSwiper(objSwiper);
                return;
            }
            ;
            //type1-2开关按颜色
            if (typeNum2 == '1-2' && typeNum2.length < 5) {
                //切换颜色页
                toColor(1)

                return;
            }
            //遍历1-2-1至1-2-5 改变颜色页内容
            if (typeNum2.length >= 5 && typeNum2.substr(0, 3) == '1-2') {

                //切换颜色页
                toColor(typeNum2.substr(4, 1));
                return;
            }
            //type1-3开关按材料
            if (typeNum2 == '1-3' && typeNum2.length < 5) {
                //切换颜色页
                changeMaterial(1)

                return;
            }
            //遍历1-2-1至1-2-5 改变材质页内容
            if (typeNum2.length >= 5 && typeNum2.substr(0, 3) == '1-3') {

                //切换颜色页
                changeMaterial(typeNum2.substr(4, 1));
                return;
            }


            //填充第二层nav
            navChange2();


        });

        //遍历第三层
        // $('.types').on('click', '.span-types', function(event) {
        // 	typeNum3 = $(this).attr('id').substring(4);
        // 	if (typeNum3.length < 5) return;
        // 	if (typeNum3.substring(0, 3) == '1-1') {
        // 		// window.location.href = "../nearProduct/series.html"
        // 		creatSwiper()
        // 	}

        // });

    }

    //填充第二层nav
    function navChange2() {
        var youbing = data1['type' + typeNum]
        var _html = '<span class="span-youbing-active">' + youbing[typeNum2.substr(-1, 1) - 1] + ':</span>'; //初始化模板
        arrtype1 = data2['type' + typeNum];
        var arrtype2 = arrtype1['type' + typeNum2];
        var forI = 1;
        for (var name in arrtype2) {
            if (forI == 1) {
                if (typeNum2.substr(0, 3) == '1-1') {
                    _html += '<span class="span-types toSeries active" id="type' + typeNum2 + '-' + forI + '">' + arrtype2[name] + '</span>'

                } else {
                    _html += '<span class="span-types active" id="type' + typeNum2 + '-' + forI + '">' + arrtype2[name] + '</span>'
                }
            } else {
                if (typeNum2.substr(0, 3) == '1-1') {
                    _html += '<span class="span-types toSeries" id="type' + typeNum2 + '-' + forI + '">' + arrtype2[name] + '</span>'
                } else {
                    _html += '<span class="span-types" id="type' + typeNum2 + '-' + forI + '">' + arrtype2[name] + '</span>'
                }

            }

            forI++;
        }
        $('.types').empty();
        $('.types').append(_html);
        isIndex = false;

    }

    var isIndex = true;
    var objSwiper;
    var color_id = null; //设置颜色默认值
    var isDetail = false;

    //重新创建swiper
    function creatSwiper() {
        var mySwiper = new Swiper('.swiper-series', {
            // autoplay: 5000, //可选选项，自动滑动
            prevButton: '.swiper-button-prev',
            nextButton: '.swiper-button-next',
            preventLinksPropagation: true,
            onInit: function (swiper) {
                objSwiper = swiper
                bindSwiper(objSwiper);
            },
            onSlideChangeStart: function (swiper) {
                changeActive(swiper.activeIndex);
            },
            onTap: function (swiper, eve) {
                if ($(eve.target).hasClass('swiper-button-prev') || $(eve.target).hasClass('swiper-button-next')) return;
                series = seriesArr[mySwiper.clickedIndex]
                color_id = colorArr[0];
                var switchData = {
                    'type': typeNum,
                    'series': series,
                    'color_id': color_id
                }
                ajaxSwitch(switchData);

                // alert(series);

            }
        })
    }

    //绑定元素与swiper的关联
    function bindSwiper(swiper) {
        $('.toSeries').click(function () {
            var idx = $(this).attr('id').split('-')[2] - 1;
            series = seriesArr[idx];
            swiper.slideTo(idx);
            if (isIndex == true || isDetail == true) {
                toSeries(idx);
            }


        })
    }

    //跳到系列轮播图页
    function toSeries(idx) {
        $('section').hide();
        $('section.sec-' + typeNum2.substr(0, 3)).show();
        $('.span-youbing-active').show();//展示按系列三个字

        if (isIndex == true) { //只有首页的时候填充第二层	
            navChange2(); //填充第二层nav
            changeNavStyle('2-youxilie');//改变nav样式为两行且有“有系列”三个字的
        }

        changeActive(idx); //切换active的nav
        bindSwiper(objSwiper); //重新绑定元素与swiper

        isIndex = false;
        isDetail = false;


    }

    function toDianjingDetail() {
        switchKindInit();
        $('section').hide();
        $('.sec-dianjing').show();
        // changeDcolor();

    }

    function toDetail() {
        switchKindInit();
        $('section').hide();
        changeNavStyle(2);//改变nav样式为两行且无“有系列”三个字的
        $('.sec-d-hasColor').show();
        // changeDcolor();
        isDetail = true;
        isIndex = false;
        bindSwiper(objSwiper); //重新绑定元素与swiper
    }

    //绑定active的系列
    function changeActive(idx) {
        $('.toSeries').removeClass('active');
        $('.toSeries:eq(' + idx + ')').addClass('active')
    }


    //按颜色页面变化
    function toColor(idx) {
        switchKindInit();
        $('section').hide();
        $('section.sec-' + typeNum2.substr(0, 3)).show();
        color_id = colorArr[idx - 1]
        var _html = '';
        var imgObj = data3['color-' + idx];
        var imgs = imgObj.colorImg;
        $(imgs).each(function (index, ele) {
            _html += '<p class="switch-contain-c switch-col" id="' + ele.seriesId + '"><img src="' + imgUrl + '/switch-col' + ele.img + '.png" alt=""></p>';
        })
        $('.color-switches').empty();
        $('.color-switches').append(_html);
        $('.color-switches').css({
            'background-image': 'url("' + imgUrl + '/bac-color' + idx + '.png")'
        })

        if (isIndex == true) {//当非首页时，不需要重新填充第二层nav
            navChange2(); //填充第二层nav
        }
        // if (idx == '2' || idx == '3') {
        // 	toDetailDj();
        // 	return;
        // }
        if (idx == '5') {
            isDianjing = true;
        } else {
            isDianjing = false;
        }
        changeColor(isDianjing);
    }

    //后三种跳详情页都走这个方法
    function toMobile() {
        switchKindInit()
        $('section').hide();
        changeNavStyle(1);
        $('.sec-d-noColor').show();
        isDetail = true;
        isIndex = false;
    }

    //按材质页面变化
    function changeMaterial(idx) {
        $('section').hide();
        $('section.sec-' + typeNum2.substr(0, 3)).show();
        var _html = '';

        var imgObj = data4['material-' + idx];
        var imgs = imgObj.mImg;
        $(imgs).each(function (index, ele) {
            _html += '<p class="switch-contain-c switch-col" id="' + ele.seriesId + '"><img src="' + imgUrl + '/switch-m' + ele.img + '.png" alt=""></p>';
        })

        $('.material-switches').empty();
        $('.material-switches').append(_html);
        $('.material-switches').css({
            'background-image': 'url("' + imgUrl + '/bac-material' + idx + '.png")'
        })
        var padTop = (idx == '1') ? '3%' : '19%';
        var height = (idx == '3') ? '29%' : '24.5%';
        $('.material-switches').css({
            'padding-top': padTop
        })

        $('.material-switches .switch-col').css({
            'height': height
        })


        if (idx == '1') {
            isDianjing = false;
        } else {
            isDianjing = true;
        }
        if (isIndex == true) {
            navChange2(); //填充第二层nav
        }
        changeColor(isDianjing);
    }

    //控制详情页产品框显示/隐藏
    function changeSwitchKind() {
        $('.h3-switch').click(function (event) {
            // $(this).css({
            // 	"position":"fixed",
            // 	"top":"17.5rem"
            // })


            $(this).next('.switch-kind').siblings('.switch-kind').slideUp(); //其他的kind关上
            $(this).siblings('.h3-switch').find('img').css({
                'transform': 'rotate(0deg)'
            })
            $(this).css({
                'position': 'relative',
                'bottom': ''
            })
            if ($(this).next('.switch-kind').is(':hidden')) {
                //先释放所有的固定
                $('.h3-switch').each(function (index, ele) {
                    $(ele).css({
                        'position': 'relative',
                        'bottom': ''
                    })
                })
                //底部固定
                var idx = $(this).index('.h3-switch')
                var times = 3 - idx;
                var bo = 0;
                for (var i = 3, j = 0; j < times; i--, j++) {
                    bo = Number(0.5 * j) + 3 * j;
                    $('.h3-switch:eq(' + i + ')').css({
                        'position': 'absolute',
                        'bottom': bo + 'rem'
                    })
                }

                $(this).next('.switch-kind').slideDown(); //当前kind打开
                $(this).find('img').css({
                    'transform': 'rotate(-90deg)'
                })

            } else {

                //底部固定
                var idx = $(this).index('.h3-switch')

                $('.h3-switch').each(function (index, ele) {
                    $(ele).css({
                        'position': 'relative',
                        'bottom': ''
                    })
                })


                $(this).next('.switch-kind').slideUp(); //当前kind关闭
                $(this).find('img').css({
                    'transform': 'rotate(0deg)'
                })

            }


        });
    }
/*系列*/
    var seriesArr = [7, 14, 13, 15, 6, 3, 2, 1, 5, 4, 8];
    //按颜色页面点击系列图标时，会由系统返回一个当前系列的id，用上seriesData进行转换，用于改变nav中active的类别
    var seriesData = {
    //键对应后台系列号，值对应nav中系列的index
    //增加系列时，要将值逐一后错
        '1': '7',
        '2': '6',
        '3': '5',
        '4': '9',
        '5': '8',
        '6': '4',
        '7': '0',
        '8': '10',
        '13':'2',
        '14':'1',
        '15':'3'
    }

    //开关详情页求颜色发送请求格式
    var proColorData = {
        'type': typeNum,
        'series': series
    }
    //开关详情页求颜色返回数据格式
    var backProColorData = [{
        'colorName': '炫白',
        'd_color_id': '1'
    }, {
        'colorName': '钛银',
        'd_color_id': '2'
    }, {
        'colorName': '雅黑',
        'd_color_id': '3'
    }]
    //开关详情页求产品发送请求格式
    var proDetailData = {
        'type': 1,
        'series': 1,
        'd_color': 1

    }
    //开关详情页返回数据格式
    var backSwitchData = {
        "switchKind1": [{
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }, {
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }],
        "switchKind2": [{
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }],
        "switchKind3": [{
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }, {
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }, {
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }],
        "switchKind4": [{
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }, {
            "pro_img": "imgurl", //产品图片路径
            "pro_descri": "", //产品描述
            "pro_escn": "" //产品型号
        }],
        "colorKinds": [{
            'colorName': '炫白',
            'd_color_id': '1',
            'isActive': '1'
        }, {
            'colorName': '钛银',
            'd_color_id': '2',
            'isActive': '0'
        }, {
            'colorName': '雅黑',
            'd_color_id': '3',
            'isActive': '0'
        }],
        "series_idx": '1'
    }
    var d_color_id = 0; //服务器给出的具体颜色id
    // var hasAjax=0;//详情页具体颜色标签是否已经绑定ajax的flag

    //按系列点击具体颜色标签
    function changeDcolor(dianjing) {
        $('.d-color').click(function () {
            var switchData = {
                'type': typeNum,
                'series': series_idx,
                'color_id': $(this).attr('id')
            }
            if ($(this).attr('id') == '5') {
                ajaxDianjing(switchData)
                return;
            }
            if (dianjing) {

                if (isDetail == true) {
                    if ($(this).attr('id') == '5') {
                        ajaxDianjing(switchData)
                    } else {
                        ajaxSwitch(switchData)
                    }
                }
            } else {
                if (isDetail == true) {
                    ajaxSwitch(switchData)
                }
            }


            // hasAjax=1
            isDetail = true;
        })
    }

    var colorArr = [4, 2, 1, 3, 5];//后端数据
    var color_id = colorArr[0];//全局变量
    var series_idx = -1;
    var isDianjing = false; //判断是否走点晶系列接口


    //按颜色点击系列标签
    function changeColor(isDianjing) {
        $('.switch-col').click(function () {
            // alert($(this).attr('id'))
            if (isDianjing) {
                var switchData = {
                    'series': $(this).attr('id'),
                    'color_id':5
                };
                ajaxDianjing(switchData);

            } else {
                var switchData = {
                    'type': typeNum,
                    'series': $(this).attr('id'),
                    'color_id': color_id
                }

                ajaxSwitch(switchData, changeActive);


            }


        })

    }

    function ajaxDianjing(dianjingData) {
        $.ajax({
            url: '/index.php/Home/Product/dianjingChoose',
            method: 'POST',
            data: dianjingData,
            dataType: 'json',
            success: function (data) {
                if (data == '0') {
                    $('.sec-dianjing .dColor-contain').empty(); //清空具体颜色
                    $('.sec-dianjing .switch-kind').each(function (idx, ele) {
                        $(ele).empty().append('<span class="msg-error">本类别没有产品信息</span>');
                    })
                    return;
                }
                var _html1 = '';
                var _html2 = '';
                var _html3 = '';
                var _html4 = '';
                var _html5='';
                var _html6='';
                var _htmlColor = '';
                if (data["typeKind1"] != undefined) {
                    $(data["typeKind1"]).each(function (index, el) {
                        _html5 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
                } else {
                    _html5 = '<span class="msg-error">本类别没有产品信息</span>'
                }
                if (data["typeKind2"] != undefined) {
                    $(data["typeKind2"]).each(function (index, el) {
                        _html6 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
                } else {
                    _html6 = '<span class="msg-error">本类别没有产品信息</span>'
                }
                /*映彩*/
				if(data["switchKind1"]!=undefined){
					 $(data["switchKind1"]).each(function (index, el) {
                        _html1 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
				}else{
					 _html1 = '<span class="msg-error">本类别没有产品信息</span>'
				}
				if(data["switchKind2"]!=undefined){
					 $(data["switchKind1"]).each(function (index, el) {
                        _html2 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
				}else{
					 _html2 = '<span class="msg-error">本类别没有产品信息</span>'
				}
				if(data["switchKind3"]!=undefined){
					 $(data["switchKind1"]).each(function (index, el) {
                        _html3 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
				}else{
					 _html3 = '<span class="msg-error">本类别没有产品信息</span>'
				}
				if(data["switchKind4"]!=undefined){
					 $(data["switchKind1"]).each(function (index, el) {
                        _html4 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    })
				}else{
					 _html4 = '<span class="msg-error">本类别没有产品信息</span>'
				}
                if (data["colorKinds"] != undefined) {
                    $(data["colorKinds"]).each(function (index, ele) {
                        d_color_id = $(ele).d_color_id; //服务器返回的具体颜色的id
                        if (ele.is_active == '1') {
                            _htmlColor += '<span class="d-color active" id="' + ele.d_color_id + '">' + ele.colorname + '</span>'
                        } else {
                            _htmlColor += '<span class="d-color" id="' + ele.d_color_id + '">' + ele.colorname + '</span>'
                        }

                    });
                }
                series_idx = data.series_idx; //服务器返回的系列id


                $('.sec-dianjing .switch-kind').each(function (idx, ele) {
                    $(ele).empty();
                })
                if(data["switchKind1"]!=undefined&&data["typeKind1"] == undefined){                	
                	$('.sec-1-1-x.sec-d-hasColor').css('display','block');
                	$('.sec-1-1-x.sec-dianjing').css('display','none');
                	$('.sec-d-hasColor .switchKind1').empty().append(_html1);
	                $('.sec-d-hasColor .switchKind2').empty().append(_html2);
	                $('.sec-d-hasColor .switchKind3').empty().append(_html3);
	                $('.sec-d-hasColor .switchKind4').empty().append(_html4);
	                $('.sec-d-hasColor .dColor-contain').empty();
                	$('.sec-d-hasColor .dColor-contain').append(_htmlColor);
                	
                	isDetail = true;
                	toDetail();
            		/*隐藏分类标题*/
            		$(".h3-switch").hide();
            		$(".switchKind1").addClass("switch-change");
            		$(".sec-d-hasColor .pro-contain .one-pro").addClass("one-change");
            		$(".sec-d-hasColor .pro-contain .one-pro img").addClass("img-change");
                }else{
                	$('.sec-1-1-x.sec-dianjing').css('display','block');
                	$('.sec-1-1-x.sec-d-hasColor').css('display','none');
                	$('.sec-dianjing .switchKind1').append(_html5);
                	$('.sec-dianjing .switchKind2').append(_html6);
                	$('.sec-dianjing .dColor-contain').empty(); //清空具体颜色
                	$('.sec-dianjing .dColor-contain').append(_htmlColor); //填充具体颜色
                	isDetail = true;
                	toDianjingDetail();
                	/*显示分类标题*/
                	$(".h3-switch").show();
            		$(".switchKind1").removeClass("switch-change");
            		$(".sec-d-hasColor .pro-contain .one-pro").removeClass("one-change");
            		$(".sec-d-hasColor .pro-contain .one-pro img").removeClass("img-change");
                }
                typeNum2 = '1-1'
                navChange2();
                changeNavStyle(2);//改变nav样式为两行且无“有系列”三个字的
                $('.span-youbing-active').hide();//隐藏按系列三个字
                isDetail = true;
                changeDcolor('dianjing'); //重新绑定具体颜色元素
                bindSwiper(objSwiper); //重新绑定元素与swiper
                changeActive(seriesData[series_idx]);
                switchKindInit();
                /*$('.sec-1-2').hide();*/
                //;

            },
            error: function () {
                alert('系统繁忙！')
            }
        })
    }

    function ajaxSwitch(switchData, cb) {
        var id = switchData.series;
        $.ajax({
            url: '/index.php/Home/Product/switchChoose',
            method: 'POST',
            data: switchData,
            dataType: 'json',
            success: function (data) {
            	
                //当返回地插系列时
                if (id == 8) {
                    if (data == '0' || data["dicha"] == undefined) {
                        $('.sec-d-noColor .pro-contain').empty().append('<span class="msg-error active">本类别没有产品信息</span>');
                        $('.span-youbing-active').hide();//隐藏按系列三个字
                        changeNavStyle(2);//改变nav样式为两行且无“有系列”三个字的
                        toMobile();
                        return;
                    } else if (data["dicha"] != undefined) {
                        var _html = '';
                        $(data["dicha"]).each(function (index, ele) {
                            _html += '<div class="one-pro"><img src="/Public/Uploads/' + ele.pro_img + '" alt="产品图"><p class="pro-descrip">' + ele.pro_descri + '</p><p><span>产品型号：</span><em>' + ele.pro_escn + '</em></p></div>'
                        })
                        series_idx = data.series_idx; //服务器返回的系列id
                        $('.sec-d-noColor .pro-contain').empty();
                        $('.sec-d-noColor .pro-contain').append(_html);
                        $('.span-youbing-active').hide();//隐藏按系列三个字
                        changeNavStyle(2);//改变nav样式为两行且无“有系列”三个字的
                        toMobile(); //跳到后三类详情页（地插和后三类用同一个页面）
                        return;
                    }
                }

                //当前系列没有一条产品信息时
                else if (data == '0') {
                    $('.sec-d-hasColor .dColor-contain').empty(); //清空具体颜色
                    $('.sec-d-hasColor .switch-kind').each(function (idx, ele) {
                        $(ele).empty().append('<span class="msg-error">本类别没有产品信息</span>');

                    })
                    $('.span-youbing-active').hide();//隐藏"按系列"三个字
                    toDetail();
                    return;
                }

                var _html1 = '';
                var _html2 = '';
                var _html3 = '';
                var _html4 = '';
                var _htmlColor = '';
                if (data["switchKind1"] != undefined) {
                    $(data["switchKind1"]).each(function (index, el) {
                        _html1 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    });
                } else {
                    _html1 = '<span class="msg-error">本类别没有产品信息</span>'
                }

                if (data["switchKind2"] != undefined) {
                    $(data["switchKind2"]).each(function (index, el) {
                        _html2 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    });
                } else {
                    _html2 = '<span class="msg-error">本类别没有产品信息</span>'
                }
                if (data["switchKind3"] != undefined) {
                    $(data["switchKind3"]).each(function (index, el) {
                        _html3 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    });
                } else {
                    _html3 = '<span class="msg-error">本类别没有产品信息</span>'
                }

                if (data["switchKind8"] != undefined) {
                    $(data["switchKind8"]).each(function (index, el) {
                        _html4 += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                    });
                } else {
                    _html4 = '<span class="msg-error">本类别没有产品信息</span>'
                }
                if (data["colorKinds"] != '') {
                    $(data["colorKinds"]).each(function (index, ele) {
                        d_color_id = $(ele).d_color_id; //服务器返回的具体颜色的id
                        if (ele.is_active == '1') {//后端帮助返回的是否被点击的状态
                            _htmlColor += '<span class="d-color active" id="' + ele.d_color_id + '">' + ele.colorname + '</span>'
                        } else {
                            _htmlColor += '<span class="d-color" id="' + ele.d_color_id + '">' + ele.colorname + '</span>'
                        }
                    });
                }


                series_idx = data.series_idx; //服务器返回的系列id
                /*显示分类标题*/
				$(".h3-switch").show();
        		$(".switchKind1").removeClass("switch-change");
        		$(".sec-d-hasColor .pro-contain .one-pro").removeClass("one-change");
        		$(".sec-d-hasColor .pro-contain .one-pro img").removeClass("img-change");
        		
       			$('.sec-d-hasColor .switch-kind').each(function (idx, ele) {
                    $(ele).empty();
                })
                $('.sec-d-hasColor .switchKind1').empty().append(_html1);
                $('.sec-d-hasColor .switchKind2').empty().append(_html2);
                $('.sec-d-hasColor .switchKind3').empty().append(_html3);
                $('.sec-d-hasColor .switchKind4').empty().append(_html4);
                $('.sec-d-hasColor .dColor-contain').empty();
                $('.sec-d-hasColor .dColor-contain').append(_htmlColor);
                changeDcolor(); //重新绑定具体颜色元素
                if (cb) {
                    typeNum2 = '1-1'
                    navChange2()
                    $('.span-youbing-active').hide();//隐藏按系列三个字
                    bindSwiper(objSwiper); //重新绑定并跳系列轮播图页
                    // hasAjax=1
                    isDetail = true;
                    cb(seriesData[series_idx]);
                }
                $('.span-youbing-active').hide();//隐藏按系列三个字
                toDetail();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('系统繁忙！')
            }
        })
    }

    //其他类型返回数据格式
    var backOthersData = [{
        'proImg': '',
        'proDescri': '',
        'proNum': ''
    }, {
        'proImg': '',
        'proDescri': '',
        'proNum': ''
    }]

    //移动式插座ajax
    function ajaxMobile(mobileData) {

        $.ajax({
            url: '/index.php/Home/Product/chazuoChoose',
            method: 'POST',
            dataType: 'json',
            data: mobileData,
            success: function (data) {
                if (data == '0') {
                    $('.sec-d-noColor .pro-contain').empty().append('<span class="msg-error active">本类别没有产品信息</span>');
                    return;
                }
                var _html = '';
                $(data).each(function (index, ele) {
                    _html += '<div class="one-pro"><img src="/Public/Uploads/' + ele.pro_img + '" alt="产品图"><p class="pro-descrip">' + ele.pro_descri + '</p><p><span>产品型号：</span><em>' + ele.pro_escn + '</em></p></div>'
                })
                $('.sec-d-noColor .pro-contain').empty();
                $('.sec-d-noColor .pro-contain').append(_html);
                toMobile(); //跳到后三类详情页
            },
            error: function () {
                alert('系统繁忙！')
            }

        })
    }


    //后两类的ajax
    function ajaxOthers(othersData) {
        $.ajax({
            url: '/index.php/Home/Product/diyaChoose',
            method: 'POST',
            data: othersData,
            dataType: 'json',
            success: function (data) {
                if (data == '0') {
                    $('.sec-d-noColor .pro-contain').empty().append('<span class="msg-error active">本类别没有产品信息</span>');
                    return;
                }
                var _html = '';
                $(data).each(function (index, el) {
                    _html += '<div class="one-pro"><img src="/Public/Uploads/' + el.pro_img + '" alt="产品图"><p class="pro-descrip">' + el.pro_descri + '</p><p><span>产品型号：</span><em>' + el.pro_escn + '</em></p></div>'
                });
                $('.sec-d-noColor .pro-contain').empty().append(_html);
                toMobile();
            },
            error: function () {
                alert('系统繁忙！')
            }
        })
    }

    //初始化swithKind第一个打开
    function switchKindInit() {
        //普通开关页初始化
        $('.sec-d-hasColor .h3-switch:eq(0)').find('img').css({
            'transform': 'rotate(-90deg)'
        })
        $('.sec-d-hasColor .h3-switch:eq(0)').siblings('.h3-switch').find('img').css({
            'transform': 'rotate(0deg)'
        })
        $('.sec-d-hasColor .h3-switch:eq(0)').siblings('.switch-kind').hide();
        $('.sec-d-hasColor .h3-switch:eq(0)').next().show();

        //点晶开关页初始化
        $('.sec-dianjing .h3-switch:eq(0)').find('img').css({
            'transform': 'rotate(-90deg)'
        })
        $('.sec-dianjing .h3-switch:eq(0)').siblings('.h3-switch').find('img').css({
            'transform': 'rotate(0deg)'
        })
        $('.sec-dianjing .h3-switch:eq(0)').siblings('.switch-kind').hide();
        $('.sec-dianjing .h3-switch:eq(0)').next().show();

        //页面到顶
        //普通开关插座
        $('.sec-d-hasColor .switch-kind').each(function (index, ele) {
            $(ele).scrollTop(0)
        })

        //点晶特殊页
        $('.sec-dianjing .switch-kind').each(function (index, ele) {
            $(ele).scrollTop(0)
        })

        //后三类页
        $('.sec-d-noColor').each(function (index, ele) {
            $(ele).scrollTop(0)
        })


        //底部固定

        var times = 3;
        var bo = 0;
        for (var i = 3, j = 0; j < times; i--, j++) {
            bo = Number(0.5 * j) + 3 * j;
            $('.h3-switch:eq(' + i + ')').css({
                'position': 'absolute',
                'bottom': bo + 'rem',
                'width': 'calc(100% - 1rem)'
            })
        }
    }

    //阻止箭头冒泡
    function arrow() {
        $('.swiper-button-prev,.swiper-button-next').click(function (event) {
            event.stopPropagation();
        })
    }

    //计算容器高度
    function calcHeight() {
        var wHei = $(window).height() ? ($(window).height()) : ($(document).height());
        var hei = wHei;
        // alert(hei);
        $('.page-contain').css({
            'height': hei
        })
    }

    //改变nav样式
    function changeNavStyle(lineNum) {
        if (lineNum == 1) {
            $('.types').css({
                'display': 'flex',
                'height': '3rem'
            })

            $('.span-youbing-active').css({
                'float': '',
                'height': 'initial',
                'width': 'initial'
            });

            $('.span-types').css({
                'float': '',
                'width': 'initial'
            });

            $('section').css({
                'margin-top':'15rem'
            })
        }

        if (lineNum == '2-youxilie') {
            $('.types').css({
                'display': 'block',
                'height': '6rem'
            })

            $('.span-youbing-active').css({
                'float': 'left',
                'height': '6rem',
                'width': '15%'
            });

            $('.span-types').css({
                'float': 'left',
                'width': '10.3%'
            });

            $('section').css({
                'margin-top':'15rem'
            })
        }

        if (lineNum == 2) {
            $('.types').css({
                'display': 'block',
                'height': '6rem'
            })

            $('.span-types').css({
                'float': 'left',
                'width': '12.5%'
            });

            $('section').css({
                'margin-top':'18rem'
            })
        }


    }

    //init
    changetypes();
    creatSwiper();
    $('.sec-1-1').hide(); //不知道为什么隐藏的swiper不能被控制
    changeSwitchKind();
    switchKindInit();
    arrow();
    calcHeight();



    // changeTypeColor();


})