<?php
return array(
	'tableName' => 'si_shoponline',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('shop_name','shop_type','shop_url','shop_desc')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','shop_name','shop_type','shop_url','shop_desc')",
	'validate' => "
		array('shop_name', 'require', '名称不能为空！', 1, 'regex', 3),
		array('shop_name', '1,35', '名称的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('shop_type', 'require', '类型不能为空！', 1, 'regex', 3),
		array('shop_type', '1,35', '类型的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('shop_url', 'require', '链接不能为空！', 1, 'regex', 3),
		array('shop_url', '1,35', '链接的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('shop_desc', 'require', '简介不能为空！', 1, 'regex', 3),
		array('shop_desc', '1,35', '简介的值最长不能超过 35 个字符！', 1, 'length', 3),
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
		'shop_type' => array(
			'text' => '类型',
			'type' => 'text',
			'default' => '',
		),
		'shop_url' => array(
			'text' => '链接',
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
		array('shop_type', 'normal', '', 'like', '类型'),
		array('shop_url', 'normal', '', 'like', '链接'),
		array('shop_desc', 'normal', '', 'like', '简介'),
	),
);