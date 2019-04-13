<?php
return array(
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'ximenzifuwuqi',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
//    'DB_HOST'               =>  '192.168.0.124', // 服务器地址
//    'DB_NAME'               =>  'ximenzi2',          // 数据库名
//    'DB_USER'               =>  'root',      // 用户名
//    'DB_PWD'                =>  'root',
    'DB_PREFIX'             =>  'si_',    // 数据库表前缀
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'MODULE__ALLOW_LIST' => 'Home,Admin',
    'DEFAULE_MODULE' =>'Home',

    /************ 图片相关的配置 ***************/
    'IMAGE_CONFIG' => array(
        'maxSize' => 1024*1024,
        'exts' => array('jpg', 'gif', 'png', 'jpeg'),
        'rootPath' => './Public/Uploads/',  // 上传图片的保存路径  -> PHP要使用的路径，硬盘上的路径
        'viewPath' => '/ximenzi/Public/Uploads/',   // 显示图片时的路径    -> 浏览器用的路径，相对网站根目录
    ),

);
// 'DB_USER'               =>  'zhensheng',      // 用户名
// 'DB_PWD'                =>  '1qazxcvbnm,./',          // 密码