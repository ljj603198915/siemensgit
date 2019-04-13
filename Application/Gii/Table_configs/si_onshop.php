<?php
return array(
	'tableName' => 'si_onshop',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('shop_name','shop_url')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','shop_name','shop_url')",
	'validate' => "
		array('shop_name', 'require', '不能为空！', 1, 'regex', 3),
		array('shop_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('shop_url', 'require', '不能为空！', 1, 'regex', 3),
		array('shop_url', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'shop_name' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'shop_url' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('shop_name', 'normal', '', 'like', ''),
		array('shop_url', 'normal', '', 'like', ''),
	),
);