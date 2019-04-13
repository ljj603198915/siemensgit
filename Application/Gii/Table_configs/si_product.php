<?php
return array(
	'tableName' => 'si_product',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('product_name','product_ecsn','product_desc','series_id','color_id','cat_id','material_id','type_id','light_id','is_usb','first_cat','second_cat','is_zz_xx')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','product_name','product_ecsn','product_desc','series_id','color_id','cat_id','material_id','type_id','light_id','is_usb','first_cat','second_cat','is_zz_xx')",
	'validate' => "
		array('product_name', '1,255', '产品编号的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('product_ecsn', 'require', '不能为空！', 1, 'regex', 3),
		array('product_ecsn', '1,60', '的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('product_desc', '1,255', '产品描述的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('series_id', 'number', '系列必须是一个整数！', 2, 'regex', 3),
		array('color_id', 'number', '颜色必须是一个整数！', 2, 'regex', 3),
		array('cat_id', 'number', '开关插座和配电产的分类字段必须是一个整数！', 2, 'regex', 3),
		array('material_id', 'number', '材质必须是一个整数！', 2, 'regex', 3),
		array('type_id', 'number', '类型必须是一个整数！', 2, 'regex', 3),
		array('light_id', 'number', '指示灯必须是一个整数！', 2, 'regex', 3),
		array('is_usb', 'number', '是否带usb必须是一个整数！', 2, 'regex', 3),
		array('first_cat', '1,255', '第一分类名称的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('second_cat', '1,255', '第二分类名称的值最长不能超过 255 个字符！', 2, 'length', 3),
		array('is_zz_xx', 'number', '自助选型下的还是了解产品下的 0都是1了解2自助必须是一个整数！', 2, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'product_name' => array(
			'text' => '产品编号',
			'type' => 'text',
			'default' => '',
		),
		'product_ecsn' => array(
			'text' => '',
			'type' => 'text',
			'default' => '',
		),
		'product_desc' => array(
			'text' => '产品描述',
			'type' => 'text',
			'default' => '',
		),
		'series_id' => array(
			'text' => '系列',
			'type' => 'text',
			'default' => '',
		),
		'color_id' => array(
			'text' => '颜色',
			'type' => 'text',
			'default' => '',
		),
		'cat_id' => array(
			'text' => '开关插座和配电产的分类字段',
			'type' => 'text',
			'default' => '',
		),
		'material_id' => array(
			'text' => '材质',
			'type' => 'text',
			'default' => '',
		),
		'product_image' => array(
			'text' => '图片',
			'type' => 'file',
			'thumbs' => array(
				array(350, 350, 2),
				array(150, 150, 2),
				array(50, 50, 2),
			),
			'save_fields' => array('product_image', 'big_product_image', 'mid_product_image', 'sm_product_image'),
			'default' => '',
		),
		'type_id' => array(
			'text' => '类型',
			'type' => 'text',
			'default' => '',
		),
		'light_id' => array(
			'text' => '指示灯',
			'type' => 'text',
			'default' => '',
		),
		'is_usb' => array(
			'text' => '是否带usb',
			'type' => 'text',
			'default' => '',
		),
		'first_cat' => array(
			'text' => '第一分类名称',
			'type' => 'text',
			'default' => '',
		),
		'second_cat' => array(
			'text' => '第二分类名称',
			'type' => 'text',
			'default' => '',
		),
		'is_zz_xx' => array(
			'text' => '自助选型下的还是了解产品下的 0都是1了解2自助',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('product_name', 'normal', '', 'like', '产品编号'),
		array('product_ecsn', 'normal', '', 'like', ''),
		array('product_desc', 'normal', '', 'like', '产品描述'),
		array('series_id', 'normal', '', 'eq', '系列'),
		array('color_id', 'normal', '', 'eq', '颜色'),
		array('cat_id', 'normal', '', 'eq', '开关插座和配电产的分类字段'),
		array('material_id', 'normal', '', 'eq', '材质'),
		array('type_id', 'normal', '', 'eq', '类型'),
		array('light_id', 'normal', '', 'eq', '指示灯'),
		array('is_usb', 'normal', '', 'eq', '是否带usb'),
		array('first_cat', 'normal', '', 'like', '第一分类名称'),
		array('second_cat', 'normal', '', 'like', '第二分类名称'),
		array('is_zz_xx', 'normal', '', 'eq', '自助选型下的还是了解产品下的 0都是1了解2自助'),
	),
);