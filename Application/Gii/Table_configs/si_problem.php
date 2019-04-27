<?php
return array(
	'tableName' => 'si_problem',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('problem_type','problem_name','is_use','answer')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','problem_type','problem_name','is_use','answer')",
	'validate' => "
		array('problem_type', 'require', '1常见问题2产品问题3接线问题不能为空！', 1, 'regex', 3),
		array('problem_type', 'number', '1常见问题2产品问题3接线问题必须是一个整数！', 1, 'regex', 3),
		array('problem_name', 'require', '不能为空！', 1, 'regex', 3),
		array('problem_name', '1,255', '的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('is_use', 'number', '1使用0停用必须是一个整数！', 2, 'regex', 3),
		array('answer', 'require', '不能为空！', 1, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'problem_type' => array(
			'text' => '1常见问题2产品问题3接线问题',
			'type' => 'text',
			'default' => '',
		),
		'problem_name' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'is_use' => array(
			'text' => '1使用0停用',
			'type' => 'text',
			'default' => '1',
		),
		'answer' => array(
			'text' => '',
			'type' => 'html',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('problem_type', 'normal', '', 'eq', '1常见问题2产品问题3接线问题'),
		array('problem_name', 'normal', '', 'like', ''),
		array('is_use', 'normal', '', 'eq', '1使用0停用'),
		array('answer', 'normal', '', 'eq', ''),
	),
);