<?php
return array(
	'tableName' => 'si_lowshop',    // 表名
	'tableCnName' => '',  // 表的中文名
	'moduleName' => 'Admin',  // 代码生成到的模块
	'withPrivilege' => FALSE,  // 是否生成相应权限的数据
	'topPriName' => '',        // 顶级权限的名称
	'digui' => 0,             // 是否无限级（递归）
	'diguiName' => '',        // 递归时用来显示的字段的名字，如cat_name（分类名称）
	'pk' => 'id',    // 表中主键字段名称
	/********************* 要生成的模型文件中的代码 ******************************/
	// 添加时允许接收的表单中的字段
	'insertFields' => "array('shop_name','province','city','district','address','telephone','longitude','latitude','shop_type')",
	// 修改时允许接收的表单中的字段
	'updateFields' => "array('id','shop_name','province','city','district','address','telephone','longitude','latitude','shop_type')",
	'validate' => "
		array('shop_name', 'require', '店铺名称不能为空！', 1, 'regex', 3),
		array('shop_name', '1,255', '店铺名称的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('province', '1,60', '省份的值最长不能超过 60 个字符！', 2, 'length', 3),
		array('city', 'require', '城市不能为空！', 1, 'regex', 3),
		array('city', '1,60', '城市的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('district', 'require', '区（县）不能为空！', 1, 'regex', 3),
		array('district', '1,60', '区（县）的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('address', 'require', '详细地址不能为空！', 1, 'regex', 3),
		array('address', '1,255', '详细地址的值最长不能超过 255 个字符！', 1, 'length', 3),
		array('telephone', 'require', '联系电话不能为空！', 1, 'regex', 3),
		array('telephone', '1,60', '联系电话的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('longitude', 'require', '店铺经度不能为空！', 1, 'regex', 3),
		array('longitude', '1,60', '店铺经度的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('latitude', 'require', '店铺维度不能为空！', 1, 'regex', 3),
		array('latitude', '1,60', '店铺维度的值最长不能超过 60 个字符！', 1, 'length', 3),
		array('shop_type', 'require', '店铺类型不能为空！', 1, 'regex', 3),
		array('shop_type', 'number', '店铺类型必须是一个整数！', 1, 'regex', 3),
	",
	/********************** 表中每个字段信息的配置 ****************************/
	'fields' => array(
		'shop_name' => array(
			'text' => '店铺名称',
			'type' => 'text',
			'default' => '',
		),
		'province' => array(
			'text' => '省份',
			'type' => 'text',
			'default' => '',
		),
		'city' => array(
			'text' => '城市',
			'type' => 'text',
			'default' => '',
		),
		'district' => array(
			'text' => '区（县）',
			'type' => 'text',
			'default' => '',
		),
		'address' => array(
			'text' => '详细地址',
			'type' => 'text',
			'default' => '',
		),
		'telephone' => array(
			'text' => '联系电话',
			'type' => 'text',
			'default' => '',
		),
		'longitude' => array(
			'text' => '店铺经度',
			'type' => 'text',
			'default' => '',
		),
		'latitude' => array(
			'text' => '店铺维度',
			'type' => 'text',
			'default' => '',
		),
		'shop_type' => array(
			'text' => '店铺类型',
			'type' => 'text',
			'default' => '',
		),
	),
	/**************** 搜索字段的配置 **********************/
	'search' => array(
		array('shop_name', 'normal', '', 'like', '店铺名称'),
		array('province', 'normal', '', 'like', '省份'),
		array('city', 'normal', '', 'like', '城市'),
		array('district', 'normal', '', 'like', '区（县）'),
		array('address', 'normal', '', 'like', '详细地址'),
		array('telephone', 'normal', '', 'like', '联系电话'),
		array('longitude', 'normal', '', 'like', '店铺经度'),
		array('latitude', 'normal', '', 'like', '店铺维度'),
		array('shop_type', 'normal', '', 'eq', '店铺类型'),
	),
);