
	//类型select框联动
	// 使用说明：将用于控制的select对象作为参数，
	// select的option设value值为"x"，如"1",
	// 下方需要联动显示的div，设class名"group-x",如"group-1"
	$('.ad_setting_a').click(function() {
		if ($('.dropdown-menu-uu').is(':hidden')) {
			$('.dropdown-menu-uu').slideDown();
		} else {
			$('.dropdown-menu-uu').slideUp();
		}

	})

	function selectChange(obj) {
		var val = $('option:selected', obj).val();
		$('.groups').hide();
		$('.sel-specol:hidden').prop('name', '')
		$('.group-' + val).show();
		$('.sel-specol:visible').prop('name', 'color_id')
	}
	//具体颜色select
	function selectColor(obj1) {
		var _html = '';
		var val = $('option:selected', obj1).val();
		$.ajax({
			url: "/index.php/Admin/Product/color_ajax",
			method: 'GET',
			data: {
				color_pid: val
			},
			dataType: 'json',
			// success:function(data){
			// 	$.each(data,function(index,obj){
			// 		_html+='<option id="'+obj.id+'">'+obj.color_name+'</option>';
			// 	})
			// },
			// error:function () {
			// 	alert('a')
			// }
			success: function(data) {
				$.each(data, function(index, obj) {
					_html += '<option value="' + obj.id + '">' + obj.color_name + '</option>';
				})
				$('.sel-specol').empty();
				$('.sel-specol').append(_html);

			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('error!' + textStatus + ',' + errorThrown)
			}

		})

	}


	//确认密码验证
	//使用说明：密码框class名设为pwd，确认密码框class名设为re_pwd
	//提示框class名设为help-block
	$(function() {
		var valid = false;
		$('.help-block').hide()
		$("#ad_setting").click(function() {
			$("#ad_setting_ul").show();
		});
		$("#ad_setting_ul").mouseleave(function() {
			$(this).hide();
		});
		$("#ad_setting_ul li").mouseenter(function() {
			$(this).find("a").attr("class", "ad_setting_ul_li_a");
		});
		$("#ad_setting_ul li").mouseleave(function() {
			$(this).find("a").attr("class", "");
		});
		//确认密码验证
		$('.pwd').focus(function() {
			$('.re_pwd').parent().find('.help-block').hide();
		}).blur(function() {
			if ($(this).val() != $('.re_pwd').val()) {
				// $('.re_pwd').parent().find('.help-block').hide();
				valid = false;
			} else {
				valid = true;
			}
		})
		$('.re_pwd').focus(function() {
			$('.re_pwd').parent().find('.help-block').hide();
		}).blur(function() {
			if ($(this).val() != $('.pwd').val()) {
				$('.re_pwd').parent().find('.help-block').show();
				valid = false;
			} else {
				$('.re_pwd').parent().find('.help-block').hide();
				valid = true;
			}
		})
	});

	//粉丝属性请求
	function fansOri_getData(from, to) {
		$.ajax({
			url: '/index.php/Admin/Statistical/get_fan_source',
			method: 'post',
			data: {
				begin_date: from,
				end_date: to
			},
			success: function(data) {
				if (data == 0) {
					alert('拉取成功')
				} else if (data == 1) {
					alert('拉取失败')
				} else if (data == 4) {
					alert('日期错误')
				} else if (data == 5) {
					alert('调用次数过多，微信系统繁忙')
				}
			},
			error: function() {
				alert('拉取失败')
			}
		})
	}
	//粉丝来源实时更新
	function fansOri_update() {
		$.ajax({
			url: '/index.php/Admin/Statistical/fan_source_ajax',
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				var dataOriName = [];
				$(data).each(function(idx, item) {
					dataOriName.push(item.name);
				})
				return fansOrigin(data, dataOriName);
			}
		})
	}

	//数据统计实时更新
	function dataSum_update() {
		$.ajax({
			url: '/index.php/Admin/Statistical/lst_ajax',
			method: 'GET',
			dataType: 'json',
			success: function(data) {


				var arrPV = []; //纵轴数据
				var arrUV = [];
				var arrFANS = [];
				var dataPV = data.PV; //横轴数据
				var dataUV = data.UV;
				var dataFans = data.FANS;
				var arrDatePV = []; //取data中数据
				var arrDateUV = [];
				var arrDateFANS = [];
				var fansCount = data.FANS_COUNT;

				$('.fans-count').html(fansCount)

				for (var item in dataPV) {
					arrDatePV.push(item)
					arrPV.push(dataPV[item])
				}
				for (var item in dataUV) {
					arrDateUV.push(item)
					arrUV.push(dataUV[item])
				}
				for (var item in dataFans) {
					arrDateFANS.push(item)
					arrFANS.push(dataFans[item])
				}
				return dataSum(arrDatePV, arrPV, arrDateUV, arrUV, arrDateFANS, arrFANS);
			}
		})
	}

	//图文消息实时更新
	// function dataInfo_update(){
	// 	$.ajax({
	// 		url:'/index.php/Admin/Image_Text/get_imagetext',
	// 		method:'POST',
	// 		async: false,
	// 		dataType:'json',
	// 		success:function(data){
	// 			var _html='<tr>';
	// 			$(data).each(function(idx,item){
	// 				_html+='<td>'+item.nickName+'</td><td>'+item.img+'</td><td>'+item.sex+'</td><td>'+item.country+'</td><td>'+item.province+'</td><td>'+item.city+'</td><td>'+item.focus+'</td><td>'+item.focusTime+'</td>'
	// 				_html+='<td><a href="manager_edit.html" target="menuFrame">编辑</a><span> | </span><a href="#">移除</a></td></tr>';
	// 			})
	// 			_html+='</tr>';
	// 			$('table.data_info').append(_html);
	//
	//
	//
	// 		}
	// 	})
	// }

	//图文消息拉取数据
	function dataInfo_getData(date) {
		$.ajax({
			type: "post",
			url: "/index.php/Admin/ImageText/get_imagetext",
			async: false,
			data: {
				begin_date: date
			},
			success: function(msg) {
				if (msg == 0) {
					alert("拉取成功")
				} else if (msg == 1) {
					alert("日期不正确")
				} else if (msg == 2) {
					alert("数据拉取出错请重新拉取")
				} else if (msg == 3) {
					alert("系统繁忙")
				} else if (msg == 4) {
					alert("目前没有数据")
				}
			},
			error: function() {
				alert('拉取失败')
			}
		});
	}
$(function () {
	//密码验证
	function validPwd() {
		$('.inp-pwd').blur(function() {
			if ($(this).val().match(/\s/)) {
				$(this).next('.help-block').show().html('密码格式错误，不能包含空格！')
			}else{
				$(this).next('.help-block').hide();
			}
		})
	}
	validPwd();
	//电话验证
	function validTel() {
		$('.inp-tel').blur(function () {
			var telNo = $(this).val()
			if ((/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1})|(14[0-9]{1}))+\d{8})$|^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/).test(telNo)) {

				$(this).next('.help-block').hide();
			}else{
				$(this).next('.help-block').show().html('电话号码格式不对！')
			}

		})
	}

	validTel()
})





