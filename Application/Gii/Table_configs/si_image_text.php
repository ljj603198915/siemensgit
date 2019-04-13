<?php
return array(
	'tableName' => 'si_image_text',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('msgid','title','int_page_read_count','share_count','datetime')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','msgid','title','int_page_read_count','share_count','datetime')",
	'validate' => "
		array('msgid', '1,60', '图文消息ID的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('title', '1,255', '的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('int_page_read_count', 'number', '图文页的阅读次数必须是一个整数！', 2, 'regex', 3),
		array('share_count', 'number', '图文分享次数必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'msgid' => array(
			'text' => '图文消息ID',
			'type' => 'text',
			'default' => '',
		),
		'title' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'int_page_read_count' => array(
			'text' => '图文页的阅读次数',
			'type' => 'text',
			'default' => '',
		),
		'share_count' => array(
			'text' => '图文分享次数',
			'type' => 'text',
			'default' => '',
		),
		'datetime' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('msgid', 'normal', '', 'like', '图文消息ID'),
		array('title', 'normal', '', 'like', ''),
		array('int_page_read_count', 'normal', '', 'eq', '图文页的阅读次数'),
		array('share_count', 'normal', '', 'eq', '图文分享次数'),
		array('datetime', 'normal', '', 'eq', ''),
	),
);