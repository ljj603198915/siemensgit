function getjsoninfo(txtval) {
	var result;
	var data='';
	if (txtval == "1234"||txtval == "2222") {
		data = [
		{
			"check": [{
				"success": "1",
				"description": "中文名称:风逸M5系列单排分控带浪涌保护/带过载保护/2位2插+2位3插袋保护门3米(外露)MLFB:5EX8131-2NC01"
			}]
		}
		
		]
	}else{
		data = [
		{
			"check": [{
				"success": "0",
				"description": "中文名称:风逸M5系列单排分控带浪涌保护/带过载保护/2位2插+2位3插袋保护门3米(外露)MLFB:5EX8131-2NC01"
			}]
		}
		]
	}
	//	$.ajax({
	//		type:"get",
	//		url:"check.json",
	//		data:txtval,
	//		async:false,
	//		dataType:"json",
	//		
	//		success:function(data){
	//			if()
	//			result=data;
	//		}
	//	});
	return data;
}

