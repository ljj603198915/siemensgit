<?php
return array(
	'tableName' => 'si_onactivity',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('promote_name','promote_url','is_do')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','promote_name','promote_url','is_do')",
	'validate' => "
		array('promote_name', 'require', '名称不能为空！', 1, 'regex', 3),
		array('promote_name', '1,35', '名称的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('promote_url', 'require', '链接不能为空！', 1, 'regex', 3),
		array('promote_url', '1,60', '链接的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('is_do', '1,10', '正在进行的值最长不能超过 10 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'promote_name' => array(
			'text' => '名称',
			'type' => 'text',
			'default' => '',
		),
		'promote_url' => array(
			'text' => '链接',
			'type' => 'text',
			'default' => '',
		),
		'is_do' => array(
			'text' => '正在进行',
			'type' => 'text',
			'default' => '是',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('promote_name', 'normal', '', 'like', '名称'),
		array('promote_url', 'normal', '', 'like', '链接'),
		array('is_do', 'normal', '', 'like', '正在进行'),
	),
);