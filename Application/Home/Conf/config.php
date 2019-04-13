<?php
$config=array(
    define('HomeCssUrl','/Application/Home/public/Styles'),
    define('HomeJsUrl','/Application/Home/public/Js'),
    define('HomeImgUrl','/Application/Home/public/Images'),
    define('Homessy','/Application/Home/public/img'),
    'HTML_CACHE_ON'     =>    true, // 开启静态缓存
    'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
        // 定义格式1 数组方式
        //'Product:ssy_product'    =>     array('ssy_product', '86400'),
        //'Select:select_lst'    =>     array('select_lst', '86400'),
        'Brandstory:brandstory'    =>     array('brandstory', '86400'),
        'Classical:classical'    =>     array('classical', '86400'),
        'Tip:tip'    =>     array('tip', '86400'),

    ),
    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'DEBUG', //
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
);


return array_merge(include './Application/Common/Conf/config.php',$config);
?>
