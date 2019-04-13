<?php
return array(
	'tableName' => 'si_team',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('team_name')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','team_name')",
	'validate' => "
		array('team_name', '1,255', '队伍名称的值最长不能超过 255 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'team_name' => array(
			'text' => '队伍名称',
			'type' => 'text',
			'default' => '',
		),
		'team_image' => array(
			'text' => '队伍图标',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('team_image', 'big_team_image', 'mid_team_image', 'sm_team_image'),
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('team_name', 'normal', '', 'like', '队伍名称'),
	),
);