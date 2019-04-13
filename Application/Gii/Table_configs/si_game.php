<?php
return array(
	'tableName' => 'si_game',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('name','game_time','home_team_id','guest_team_id','results')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','name','game_time','home_team_id','guest_team_id','results')",
	'validate' => "
		array('name', 'require', '活动名称不能为空！', 1, 'regex', 3),
		array('name', '1,255', '活动名称的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('game_time', 'require', '比赛时间不能为空！', 1, 'regex', 3),
		array('home_team_id', 'require', '主队不能为空！', 1, 'regex', 3),
		array('home_team_id', 'number', '主队必须是一个整数！', 1, 'regex', 3),
		array('guest_team_id', 'require', '客对不能为空！', 1, 'regex', 3),
		array('guest_team_id', 'number', '客对必须是一个整数！', 1, 'regex', 3),
		array('results', '1,255', '主队胜 home_win,客队胜 guest_win ,平flat,未揭晓unknown的值最长不能超过 255 个字符！', 2, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'name' => array(
			'text' => '活动名称',
			'type' => 'text',
			'default' => '',
		),
		'game_time' => array(
			'text' => '比赛时间',
			'type' => 'text',
			'default' => '',
		),
		'home_team_id' => array(
			'text' => '主队',
			'type' => 'text',
			'default' => '',
		),
		'guest_team_id' => array(
			'text' => '客对',
			'type' => 'text',
			'default' => '',
		),
		'results' => array(
			'text' => '主队胜 home_win,客队胜 guest_win ,平flat,未揭晓unknown',
			'type' => 'text',
			'default' => 'unknown',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('name', 'normal', '', 'like', '活动名称'),
		array('game_time', 'betweenTime', 'game_timefrom,game_timeto', '', '比赛时间'),
		array('home_team_id', 'normal', '', 'eq', '主队'),
		array('guest_team_id', 'normal', '', 'eq', '客对'),
		array('results', 'normal', '', 'like', '主队胜 home_win,客队胜 guest_win ,平flat,未揭晓unknown'),
	),
);