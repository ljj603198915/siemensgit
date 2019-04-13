<?php
return array(
	'tableName' => 'si_statistical',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('name','count','datetime')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','name','count','datetime')",
	'validate' => "
		array('name', '1,60', '的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('count', 'number', '必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'name' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'count' => array(
			'text' => '',
			'type' => 'text',
			'default' => '0',
		),
		'datetime' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('name', 'normal', '', 'like', ''),
		array('count', 'normal', '', 'eq', ''),
		array('datetime', 'normal', '', 'eq', ''),
	),
);