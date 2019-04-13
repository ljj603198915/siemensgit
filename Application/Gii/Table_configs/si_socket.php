<?php
return array(
	'tableName' => 'si_socket',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('goods_name','goods_daima','goods_desc','goods_cat_id','goods_color','goods_gn')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','goods_name','goods_daima','goods_desc','goods_cat_id','goods_color','goods_gn')",
	'validate' => "
		array('goods_name', 'require', '名称不能为空！', 1, 'regex', 3),
		array('goods_name', '1,35', '名称的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('goods_daima', 'require', '代码不能为空！', 1, 'regex', 3),
		array('goods_daima', '1,35', '代码的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('goods_desc', 'require', '简介不能为空！', 1, 'regex', 3),
		array('goods_desc', '1,35', '简介的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('goods_cat_id', 'require', '所属系列不能为空！', 1, 'regex', 3),
		array('goods_cat_id', '1,35', '所属系列的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('goods_color', 'require', '颜色不能为空！', 1, 'regex', 3),
		array('goods_color', '1,35', '颜色的值最长不能超过 35 个字符！', 1, 'length', 3),
		array('goods_gn', 'require', '功能不能为空！', 1, 'regex', 3),
		array('goods_gn', '1,35', '功能的值最长不能超过 35 个字符！', 1, 'length', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'goods_name' => array(
			'text' => '名称',
			'type' => 'text',
			'default' => '',
		),
		'goods_image' => array(
			'text' => '图片',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('goods_image', 'big_goods_image', 'mid_goods_image', 'sm_goods_image'),
			'default' => '',
		),
		'goods_daima' => array(
			'text' => '代码',
			'type' => 'text',
			'default' => '',
		),
		'goods_desc' => array(
			'text' => '简介',
			'type' => 'text',
			'default' => '',
		),
		'goods_cat_id' => array(
			'text' => '所属系列',
			'type' => 'text',
			'default' => '',
		),
		'goods_color' => array(
			'text' => '颜色',
			'type' => 'text',
			'default' => '',
		),
		'goods_gn' => array(
			'text' => '功能',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('goods_name', 'normal', '', 'like', '名称'),
		array('goods_daima', 'normal', '', 'like', '代码'),
		array('goods_desc', 'normal', '', 'like', '简介'),
		array('goods_cat_id', 'normal', '', 'like', '所属系列'),
		array('goods_color', 'normal', '', 'like', '颜色'),
		array('goods_gn', 'normal', '', 'like', '功能'),
	),
);