<?php
$config=array(
    define('AdminCssUrl','/Application/Admin/public/Styles/'),
    define('AdminJsUrl','/Application/Admin/public/Js/'),
    define('AdminImgUrl','/Application/Admin/public/Images/'),
    define('AdminPublicUrl','/Application/Admin/public/'),
);


return array_merge(include './Application/Common/Conf/config.php',$config);
?>
