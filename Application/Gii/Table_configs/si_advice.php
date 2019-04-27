<?php
return array(
	'tableName' => 'si_advice',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('customer_type','advice_name','phone','email','advice_type','advice_content','status','created_time','handle_time')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','customer_type','advice_name','phone','email','advice_type','advice_content','status','created_time','handle_time')",
	'validate' => "
		array('customer_type', 'require', '客户类型 1消费者2代理商3公司不能为空！', 1, 'regex', 3),
		array('customer_type', 'number', '客户类型 1消费者2代理商3公司必须是一个整数！', 1, 'regex', 3),
		array('advice_name', 'require', '不能为空！', 1, 'regex', 3),
		array('advice_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('phone', 'require', '不能为空！', 1, 'regex', 3),
		array('phone', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('email', 'email', '格式不正确！', 2, 'regex', 3),
		array('email', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('advice_type', 'require', '投诉类型1服务2质量3售假4建议5其他不能为空！', 1, 'regex', 3),
		array('advice_type', 'number', '投诉类型1服务2质量3售假4建议5其他必须是一个整数！', 1, 'regex', 3),
		array('advice_content', 'require', '投诉与建议内容不能为空！', 1, 'regex', 3),
		array('status', 'number', '状态必须是一个整数！', 2, 'regex', 3),
		array('created_time', 'require', '不能为空！', 1, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'customer_type' => array(
			'text' => '客户类型 1消费者2代理商3公司',
			'type' => 'text',
			'default' => '',
		),
		'advice_name' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'phone' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'email' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'advice_type' => array(
			'text' => '投诉类型1服务2质量3售假4建议5其他',
			'type' => 'text',
			'default' => '',
		),
		'img1' => array(
			'text' => '',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('img1', 'big_img1', 'mid_img1', 'sm_img1'),
			'default' => '',
		),
		'img2' => array(
			'text' => '',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('img2', 'big_img2', 'mid_img2', 'sm_img2'),
			'default' => '',
		),
		'img3' => array(
			'text' => '',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('img3', 'big_img3', 'mid_img3', 'sm_img3'),
			'default' => '',
		),
		'img4' => array(
			'text' => '',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('img4', 'big_img4', 'mid_img4', 'sm_img4'),
			'default' => '',
		),
		'img5' => array(
			'text' => '',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('img5', 'big_img5', 'mid_img5', 'sm_img5'),
			'default' => '',
		),
		'advice_content' => array(
			'text' => '投诉与建议内容',
			'type' => 'html',
			'default' => '',
		),
		'status' => array(
			'text' => '状态',
			'type' => 'text',
			'default' => '0',
		),
		'created_time' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'handle_time' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('customer_type', 'normal', '', 'eq', '客户类型 1消费者2代理商3公司'),
		array('advice_name', 'normal', '', 'like', ''),
		array('phone', 'normal', '', 'like', ''),
		array('email', 'normal', '', 'like', ''),
		array('advice_type', 'normal', '', 'eq', '投诉类型1服务2质量3售假4建议5其他'),
		array('advice_content', 'normal', '', 'eq', '投诉与建议内容'),
		array('status', 'normal', '', 'eq', '状态'),
		array('created_time', 'betweenTime', 'created_timefrom,created_timeto', '', ''),
		array('handle_time', 'normal', '', 'eq', ''),
	),
);