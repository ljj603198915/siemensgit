<?php
return array(
	'tableName' => 'si_shopretali',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('shop_name','shop_area','shop_address','shop_desc')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','shop_name','shop_area','shop_address','shop_desc')",
	'validate' => "
		array('shop_name', 'require', '名称不能为空！', 1, 'regex', 3),
		array('shop_name', '1,35', '名称的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('shop_area', 'require', '区域不能为空！', 1, 'regex', 3),
		array('shop_area', '1,100', '区域的值最长不能超过 100 个字符！', 1, 'length', 3),
		array('shop_address', 'require', '详细地址不能为空！', 1, 'regex', 3),
		array('shop_address', '1,100', '详细地址的值最长不能超过 100 个字符！', 1, 'length', 3),
		array('shop_desc', 'require', '简介不能为空！', 1, 'regex', 3),
		array('shop_desc', '1,100', '简介的值最长不能超过 100 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'shop_name' => array(
			'text' => '名称',
			'type' => 'text',
			'default' => '',
		),
		'shop_image' => array(
			'text' => '图片',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('shop_image', 'big_shop_image', 'mid_shop_image', 'sm_shop_image'),
			'default' => '',
		),
		'shop_bigimage' => array(
			'text' => '大图片',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('shop_bigimage', 'big_shop_bigimage', 'mid_shop_bigimage', 'sm_shop_bigimage'),
			'default' => '',
		),
		'shop_area' => array(
			'text' => '区域',
			'type' => 'text',
			'default' => '',
		),
		'shop_address' => array(
			'text' => '详细地址',
			'type' => 'text',
			'default' => '',
		),
		'shop_desc' => array(
			'text' => '简介',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('shop_name', 'normal', '', 'like', '名称'),
		array('shop_area', 'normal', '', 'like', '区域'),
		array('shop_address', 'normal', '', 'like', '详细地址'),
		array('shop_desc', 'normal', '', 'like', '简介'),
	),
);