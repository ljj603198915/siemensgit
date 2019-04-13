<?php

/**
 * 使用一个表中的数据制作下拉框
 *
 */
function buildSelect($tableName, $selectName, $valueFieldName, $textFieldName, $selectedValue = '')
{
    $model = D($tableName);
    $data = $model->field("$valueFieldName,$textFieldName")->ORDER('id asc')->select();
    $select = "<select name='$selectName' class='input_select '><option value=''>请选择</option>";
    foreach ($data as $k => $v)
    {
        $value = $v[$valueFieldName];
        $text = $v[$textFieldName];
        if($selectedValue && $selectedValue==$value)
            $selected = 'selected="selected"';
        else
            $selected = '';
        $select .= '<option '.$selected.' value="'.$value.'">'.$text.'</option>';
    }
    $select .= '</select>';
    echo $select;
}
function deleteImage($image = array())
{
    $savePath = C('IMAGE_CONFIG');
    foreach ($image as $v)
    {
        unlink($savePath['rootPath'] . $v);
    }
}
/**
 * 上传图片并生成缩略图
 * 用法：
 * $ret = uploadOne('logo', 'Goods', array(
array(600, 600),
array(300, 300),
array(100, 100),
));
返回值：
if($ret['ok'] == 1)
{
$ret['images'][0];   // 原图地址
$ret['images'][1];   // 第一个缩略图地址
$ret['images'][2];   // 第二个缩略图地址
$ret['images'][3];   // 第三个缩略图地址
}
else
{
$this->error = $ret['error'];
return FALSE;
}
 *
 */
function uploadOne($imgName, $dirName, $id=null,$thumb = array())
{
    // 上传LOGO
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
    {
        $ic = C('IMAGE_CONFIG');
        $upload = new \Think\Upload(array(
            'rootPath' => $ic['rootPath'],
            'maxSize' => $ic['maxSize'],
            'exts' => $ic['exts'],
            'autoSub' =>false
        ));// 实例化上传类
        $upload->saveName =$id;
        $upload->savePath = $dirName .'/'; // 图片二级目录的名称

        // 上传文件
        // 上传时指定一个要上传的图片的名称，否则会把表单中所有的图片都处理，之后再想其他图片时就再找不到图片了
        $info   =   $upload->upload(array($imgName=>$_FILES[$imgName]));
        //var_dump($info);die;
        if(!$info)
        {
            return array(
                'ok' => 0,
                'error' => $upload->getError(),
            );
        }
        else
        {
            $ret['ok'] = 1;
           // var_dump($info[$imgName]['savepath'] . $info[$imgName]['savename']);die;
            $ret['images'][0] = $logoName = $info[$imgName]['savepath'] .$info[$imgName]['savename'];
            // 判断是否生成缩略图
            if($thumb)
            {
                $image = new \Think\Image();
                // 循环生成缩略图
                foreach ($thumb as $k => $v)
                {
                    $ret['images'][$k+1] = $info[$imgName]['savepath'] . 'thumb_'.$k.'_' .$info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open($ic['rootPath'].$logoName);
                    $image->thumb($v[0], $v[1])->save($ic['rootPath'].$ret['images'][$k+1]);
                }
            }
            return $ret;
        }
    }
}
function showImage($url, $width = '', $height = '')
{
    $ic = C('IMAGE_CONFIG');
    if($width)
        $width = "width='$width'";
    if($height)
        $height = "height='$height'";
    echo "<img $width $height src='{$ic['viewPath']}$url' />";
}

function pp($data)
{

    return print_r('<pre>'). print_r($data);
}


function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

//如果地址有省则截取省后面的地址信息中文字符串
function getNeedBetween($kw1,$mark1,$mark2){
    $st =strripos($kw1,$mark1);//截取最后一次出现省的位置
    $ed =strripos($kw1,$mark2);//截取最后一次出现市的位置
    if(!$st)
        $st = 3;
    $address=mb_substr($kw1,($st+3));
    $city =mb_substr($kw1,($st+3),$ed);
    return $res=array(
        'address'=>$address,
        'city'=>$city,
    );
}

//根据经纬度计算距离在$dis距离范围内
function getDistance($lat1, $lng1, $data,$dis)
{
    $res = getaddress($lat1,$lng1);

    $earthRadius = 6367000; //approximate radius of earth in meters

    $lat1 = ($lat1 * pi() ) / 180;
    $lng1 = ($lng1 * pi() ) / 180;

    foreach($data as$k =>$v){
        if(!empty($v['latitude'])&&!empty($v['longitude'])&&($v['province'] == $res['addressComponent']['city']|| $v['city']==$res['addressComponent']['city'])){
            $lat2 = ($v['latitude'] * pi() ) / 180;
            $lng2 = ($v['longitude'] * pi() ) / 180;

            $calcLongitude = $lng2 - $lng1;
            $calcLatitude = $lat2 - $lat1;
            $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
            $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
            $calculatedDistance = $earthRadius * $stepTwo;

            if (round($calculatedDistance)<=$dis) //返回结果单位m
            {
                $result[]=$v;
            }
        }
    }
    return $result;

}



function getLocation($data){
    //根据名称解析经纬度
     $url="http://api.map.baidu.com/geocoder/v2/?output=json&address='.$data.'&ak=HSm0N5y3kVjfazS2zZe04HK3lHf9sVPp";
     $res= json_decode(https_request($url),true);
     $result['longitude']=$res['result']['location']['lng'];
     $result['latitude']=$res['result']['location']['lat'];
    if($res['status']==0){
        return $result;
    }else{
        return false;
    }
}
function getaddress($lat,$lnt){
//    $lat=39.084158;
//    $lnt=117.200983;
    $url="http://api.map.baidu.com/geocoder/v2/?location=".$lat.",".$lnt."&output=json&ak=HSm0N5y3kVjfazS2zZe04HK3lHf9sVPp";
    $res= json_decode(https_request($url),true);
    if($res['status']==0){
        return $res['result'];
    }else{
        return false;
    }
}
//狂欢节新增
function uploadImage($imgName, $dirName,$thumb = array())
{
    // 上传LOGO
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
    {
        $ic = C('IMAGE_CONFIG');
        $upload = new \Think\Upload(array(
            'rootPath' => $ic['rootPath'],
            'maxSize' => $ic['maxSize'],
            'exts' => $ic['exts'],
            'autoSub' =>false
        ));// 实例化上传类
        $upload->saveName =time()."";
        $upload->savePath = $dirName .'/'; // 图片二级目录的名称

        // 上传文件
        // 上传时指定一个要上传的图片的名称，否则会把表单中所有的图片都处理，之后再想其他图片时就再找不到图片了
        $info   =   $upload->upload(array($imgName=>$_FILES[$imgName]));
        //var_dump($info);die;
        if(!$info)
        {
            return array(
                'ok' => 0,
                'error' => $upload->getError(),
            );
        }
        else
        {
            $ret['ok'] = 1;
            // var_dump($info[$imgName]['savepath'] . $info[$imgName]['savename']);die;
            $ret['images'][0] = $logoName = $info[$imgName]['savepath'] .$info[$imgName]['savename'];
            // 判断是否生成缩略图
            if($thumb)
            {
                $image = new \Think\Image();
                // 循环生成缩略图
                foreach ($thumb as $k => $v)
                {
                    $ret['images'][$k+1] = $info[$imgName]['savepath'] . 'thumb_'.$k.'_' .$info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open($ic['rootPath'].$logoName);
                    $image->thumb($v[0], $v[1])->save($ic['rootPath'].$ret['images'][$k+1]);
                }
            }
            return $ret;
        }
    }
}
function jsonToData($code, $msg, $data = null, $other = null)
{
    $res = array(
        'code' => $code,
        'msg' => $msg,
        'list' => $data,
    );
    if (!empty($other)) {
        foreach ($other as $k => $v) {
            $res[$k] = $v;
        }
    }
    return json_encode($res);
}

function getToken(){
    $url = "http://www.wawechat.siemens.com.cn/index.php/Home/WeChat/getAccessToken/sign/wechat";
    $res = https_request($url);
    $arr = json_decode($res,true);
    return $arr;
}
