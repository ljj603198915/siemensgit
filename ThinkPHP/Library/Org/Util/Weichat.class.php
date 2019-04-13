<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/3 0003
 * Time: 上午 10:57
 */

namespace Org\Util;
Class Weichat
{
    private $appid = "wx7e38a14dfcd9328a";
    private $appsecret = "5a1ea0e7a27f4b1e53584b5408cfd316";

    public function __construct($appid, $appSecret)
    {
        $this->appId = $appid;
        $this->appSecret = $appSecret;
    }


    //获取基础accsess_token
    public function get_access_token()
    {
//        S('access_token',"",10);
//        S('jsapi_ticket',"",10);
//        S('api_ticket',"",10);
        $data = S('access_token');
        if (empty($data)) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
            $output = $this->https_requests($url);
            $jsoninfo = json_decode($output, true);
            if ($jsoninfo['errcode']) {
                //var_dump($jsoninfo);die;
                return false;
            }
            $access_token = $jsoninfo["access_token"];
            S('access_token', $access_token, 7200);
            $this->get_jsapi_ticket();
            $this->getApiTicket();
        } else {
            $access_token = S('access_token');
        }
        return $access_token;
    }

    //curl提交
    public function https_requests($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    //自定义菜单
    public function get_menu($jsonmenu)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $this->get_access_token();
        $result = $this->https_requests($url, $jsonmenu);
        $result = json_decode($result, true);
//        if($result['errcode']){
//            return false;
//        }
        return $result;
    }

    //删除自定义菜单
    public function delete_menu()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $this->get_access_token();
        $result = $this->https_requests($url);
        $result = json_decode($result, true);

        if ($result['errcode']) {
            return false;
        }
        return $result;
    }

    //获取关注用户openid
    public function get_openid()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=" . $this->get_access_token();
        $result = $this->https_requests($url);
        $result = json_decode($result, true);
        if ($result['errcode']) {
            return false;
        }
        return $result;
    }

    //获取用户信息表
    public function get_user($openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $this->get_access_token() . "&openid=$openid&lang=zh_CN";
        $result = $this->https_requests($url);
        $result = json_decode($result, true);
        if ($result['errcode']) {
            return false;
        }
        return $result;

    }

    //获取用户增减数据//在此处用来统计粉丝来源，每天可用五次
    public function get_usersummary($begin_date, $end_date)
    {
        $url = "https://api.weixin.qq.com/datacube/getusersummary?access_token=" . $this->get_access_token();
        $json = '{ 
    "begin_date": "' . $begin_date . '", 
    "end_date": "' . $end_date . '"
}';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, true);
        if ($result['errcode']) {
            return false;
        }
        return $result;
    }

//获取高级接口jsapi_ticket
    public function get_jsapi_ticket()
    {
        $data = S('jsapi_ticket');
        if (empty($data)) {
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $this->get_access_token() . "&type=jsapi";
            $result = https_request($url);
            $result = json_decode($result, true);
            $jsapi_ticket = $result['ticket'];
            S('jsapi_ticket', $jsapi_ticket, 7200);
        } else {
            $jsapi_ticket = S('jsapi_ticket');
        }
        return $jsapi_ticket;

    }

    public function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    //微信高级接口签名
    public function get_Sign()
    {
        $jsqpi_ticket = $this->get_jsapi_ticket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsqpi_ticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    public function getApiTicket()
    {
        $data = S('api_ticket');
        if (empty($data)) {
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $this->get_access_token() . "&type=wx_card";
            $result = https_request($url);
            $result = json_decode($result, true);
            $api_ticket = $result['ticket'];
            S('api_ticket', $api_ticket, 7200);
        } else {
            $api_ticket = $data;
        }

        return $api_ticket;
    }

    //获取卡券签名

    public function wxCardPackage($cardId)
    {
        $apiTicket = $this->getApiTicket();
        $timestamp = time();
//        $nonceStr = $this->createNonceStr();
        $arrays = array($apiTicket, $timestamp, $cardId);
        sort($arrays, SORT_STRING);
        //print_r($arrays);
        //echo implode("",$arrays)."<br />";
        $string = sha1(implode("", $arrays));
        //echo $string;
        $resultArray['cardId'] = $cardId;
        $resultArray['cardExt'] = array();
        $resultArray['cardExt']['code'] = '';
        $resultArray['cardExt']['openid'] = '';
        //$resultArray['cardExt']['nonceStr'] = $nonceStr;
        $resultArray['cardExt']['timestamp'] = $timestamp;
        $resultArray['cardExt']['signature'] = $string;
        //print_r($resultArray);
        return $resultArray;
    }

    /*******************************************************
     *      微信卡券：JSAPI 卡券全部卡券 Package
     *******************************************************/
    public function wxCardAllPackage($cardIdArray = array())
    {
        $reArrays = array();
        if (!empty($cardIdArray) && (is_array($cardIdArray) || is_object($cardIdArray))) {
            //print_r($cardIdArray);
            foreach ($cardIdArray as $value) {
                //print_r($this->wxCardPackage($value,$openid));
                $reArrays[] = $this->wxCardPackage($value);
            }
            //print_r($reArrays);
        } else {
            $reArrays[] = $this->wxCardPackage($cardIdArray);
        }
        return strval(json_encode($reArrays));
    }

    pubLic function getApiSign($cardId)
    {
        $apiTicket = $this->getApiTicket();
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
//        $timestamp = "1527583044";
//        $nonceStr = "XLOaEdzeyGFqMqKb";
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $sortArr[] = $apiTicket;
        $sortArr[] = $timestamp;
        $sortArr[] = $nonceStr;
        //$sortArr[] = $cardId;
        //$sortArr[] = $this->appid;
        //$sortArr[] = "CASH";
        sort($sortArr, SORT_STRING);
        $string = implode("", $sortArr);
        $signature = sha1($string);
        $signPackage = array(
            //  "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            // "cardId" => $cardId,
            "signature" => $signature,
            //  "rawString" => $string
        );
        return $signPackage;

    }

    //步骤一：上传卡券LOGO上传图片接口
    public function upload_img()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=" . $this->get_access_token();
        if (class_exists('\CURLFile')) {
            $json = array('media' => new \CURLFile(realpath("./0.jpg"))); //curl提交文件
        } else {
            $json = array('media' => '@' . realpath("./0.jpg"));
        }
        $result = https_request($url, $json);
        $result = json_decode($result, true);
        return $result;

    }

    //步骤二创建门店接口测试号也没有权限
    public function create_shop()
    {
        $url = "http://api.weixin.qq.com/cgi-bin/poi/addpoi?access_token=" . $this->get_access_token();
        $json = '{"business":{
   "base_info":{
                   "sid":"33788392",
                   "business_name":"麦当劳",
                   "branch_name":"艺苑路店",
                   "province":"广东省",
                   "city":"广州市",
                   "district":"海珠区",
                   "address":"艺苑路11 号",
                   "telephone":"020-12345678",
                   "categories":["美食,小吃快餐"], 
                   "offset_type":1,
                   "longitude":115.32375,
                   "latitude":25.097486,
                   "photo_list":[{"photo_url":"https:// XXX.com"}，{"photo_url":"https://XXX.com"}],
                   "recommend":"麦辣鸡腿堡套餐，麦乐鸡，全家桶",
                   "special":"免费wifi，外卖服务",
                   "introduction":"麦当劳是全球大型跨国连锁餐厅，1940 年创立于美国，在世界上
             大约拥有3 万间分店。主要售卖汉堡包，以及薯条、炸鸡、汽水、冰品、沙拉、 水果等
             快餐食品",
                   "open_time":"8:00-20:00",
                   "avg_price":35
             }
    }
}';
        $result = $this->https_requests($url, $json);
        return $result;
    }

    //不可用需要使用新版客服功能 在公众号管理平台 添加功能插件 只有认证的公众号才可使用
    public function add_custom()
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=" . $this->get_access_token();
        $json = '{
      "kf_account" : "603198915@qq.com",
       "nickname" : "客服1"
       }';
        $result = $this->https_requests($url, $json);

        return $result;
    }

    public function get_custom()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=" . $this->get_access_token();
        $result = $this->https_requests($url);
        return $result;
    }

    //上传永久素材图片
    public function add_material_image()
    {
        $url = "http://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $this->get_access_token() . "&type=image";
        if (class_exists('\CURLFile')) {
            $json = array('media' => new \CURLFile(realpath("./0.jpg"))); //curl提交文件
        } else {
            $json = array('media' => '@' . realpath("./0.jpg"));
        }
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, true);
        return $result;
        //返回的结果
        //{"media_id":"zg79sf5ov1MviZaqvCdmSSprucQ6ao1hQRPe_f1n1Pw","url":"http:\/\/mmbiz.qpic.cn\/mmbiz_jpg\/kdvyweiclRmYyUX1UEZ1NPyS2Z6odcJV58kJlteMGZYLJmgPMXKT3b9Cib5OT9IQvDmzmpBDjm22vibYH03WtlcpQ\/0?wx_fmt=jpeg"}
    }

    //上传新增永久图文消息 ,经过测试没有成功 错误：无效的media_id
    public function add_meterial_news()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=" . $this->get_access_token();
        $json = '{
  "articles": [{
       "title": “标题”,
       "thumb_media_id":"zg79sf5ov1MviZaqvCdmSUYtvNGXgEODzD6zLSD2Jok",
       "author":"李俊杰",
       "digest": "摘要",
       "show_cover_pic": "1",
       "content": "图文消息内容",
       "content_source_url": "www.baidu.com"
    },
    //若新增的是多图文素材，则此处应还有几段articles结构
 ]
}';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, true);
        return $result;

    }

    //获取永久素材,结果为是带有防盗链的图片
    public function get_meterial()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=" . $this->get_access_token();
        $json = '{
                "media_id":"zg79sf5ov1MviZaqvCdmSUYtvNGXgEODzD6zLSD2Jok"
                }';
        $result = $this->https_requests($url, $json);
        return $result;
    }

    //获取永久素材列表
    public function get_meterial_list()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=" . $this->get_access_token();
        // TYPE素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
        //offset从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
        // count	返回素材的数量，取值在1到20之间
        $json = '
        {
   "type":"image",
   "offset":"0",
   "count":"10"
}';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, true);
        return $result;
    }
    /*
     * Array
(
    [item] => Array
        (
            [0] => Array
                (
                    [media_id] => zg79sf5ov1MviZaqvCdmScnxPcjV4lWUi45X_poYay8
                    [name] => C:\\phpStudy\\WWW\\ximenzi\\0.jpg
                    [update_time] => 1488250972
                    [url] => http://mmbiz.qpic.cn/mmbiz_jpg/kdvyweiclRmYyUX1UEZ1NPyS2Z6odcJV58kJlteMGZYLJmgPMXKT3b9Cib5OT9IQvDmzmpBDjm22vibYH03WtlcpQ/0?wx_fmt=jpeg
                )

            [1] => Array
                (
                    [media_id] => zg79sf5ov1MviZaqvCdmSUYtvNGXgEODzD6zLSD2Jok
                    [name] => C:\\phpStudy\\WWW\\ximenzi\\0.jpg
                    [update_time] => 1488250941
                    [url] => http://mmbiz.qpic.cn/mmbiz_jpg/kdvyweiclRmYyUX1UEZ1NPyS2Z6odcJV58kJlteMGZYLJmgPMXKT3b9Cib5OT9IQvDmzmpBDjm22vibYH03WtlcpQ/0?wx_fmt=jpeg
                )

            [2] => Array
                (
                    [media_id] => zg79sf5ov1MviZaqvCdmSSprucQ6ao1hQRPe_f1n1Pw
                    [name] => C:\\phpStudy\\WWW\\ximenzi\\0.jpg
                    [update_time] => 1488250319
                    [url] => http://mmbiz.qpic.cn/mmbiz_jpg/kdvyweiclRmYyUX1UEZ1NPyS2Z6odcJV58kJlteMGZYLJmgPMXKT3b9Cib5OT9IQvDmzmpBDjm22vibYH03WtlcpQ/0?wx_fmt=jpeg
                )

        )

    [total_count] => 3
    [item_count] => 3
)*/
    //删除永久素材
    public function delete_meterial()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=" . $this->get_access_token();
        $json = '{
                "media_id":"zg79sf5ov1MviZaqvCdmSSprucQ6ao1hQRPe_f1n1Pw"
                }';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, true);
        return $result;
    }
    /*结果
    Array
  (
      [errcode] => 0
      [errmsg] => ok
  )
    */
    //获取图文总数据
    public function getArticletotal($data1, $data2)
    {
        $url = "https://api.weixin.qq.com/datacube/getarticletotal?access_token=" . $this->get_access_token();
        $json = '{ 
    "begin_date": "' . $data1 . '", 
    "end_date": "' . $data2 . '"
}';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, TRUE);
        if ($result['errcode']) {
            return false;
        }
        return $result;
    }

    /**
     * 发送客服消息
     * @param $openid
     * @return mixed
     */
    public function sendContent($openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=" . $this->get_access_token();
        $json = '{
    "touser":"' . $openid . '",
    "msgtype":"text",
    "text":
    {
         "content":"Hello World"
    }
}';
        $result = $this->https_requests($url, $json);
        $result = json_decode($result, TRUE);
        return $result;
    }

    //oauth登录
    public function getCode($url1)
    {
        $url1 = urlencode($url1);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$this->appid&redirect_uri=$url1&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
        return $url;
    }
    //获取openid
    public function getOpenid($code)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->appid&secret=$this->appsecret&code=$code&grant_type=authorization_code ";
        $rs = $this->https_requests($url);

        return $rs;
        $rs = json_decode($rs, true);
        $openid = $rs['openid'];
        return $openid;
    }
    public function getUnionID($openid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->get_access_token()."&openid=".$openid."&lang=zh_CN";
        $res = $this->https_requests($url);
        $res = json_decode($res, true);
        return $res;
    }
}


