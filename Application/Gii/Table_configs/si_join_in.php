<?php
return array(
	'tableName' => 'si_join_in',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('name','phone','province','city','agent_product','status','created_time','handle_time')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','name','phone','province','city','agent_product','status','created_time','handle_time')",
	'validate' => "
		array('name', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('phone', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('province', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('city', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('status', 'number', '必须是一个整数！', 2, 'regex', 3),
		array('created_time', 'require', '不能为空！', 1, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'name' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'phone' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'province' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'city' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'agent_product' => array(
			'text' => '',
			'type' => 'html',
			'default' => '',
		),
		'status' => array(
			'text' => '',
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
		array('name', 'normal', '', 'like', ''),
		array('phone', 'normal', '', 'like', ''),
		array('province', 'normal', '', 'like', ''),
		array('city', 'normal', '', 'like', ''),
		array('agent_product', 'normal', '', 'eq', ''),
		array('status', 'normal', '', 'eq', ''),
		array('created_time', 'betweenTime', 'created_timefrom,created_timeto', '', ''),
		array('handle_time', 'betweenTime', 'handle_timefrom,handle_timeto', '', ''),
	),
);