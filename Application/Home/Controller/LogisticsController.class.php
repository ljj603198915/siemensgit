<?php

namespace Home\Controller;

use Tools\HomeController;

class LogisticsController extends HomeController
{
    private $urlHeader = "http://www.wawechat.siemens.com.cn/Public";

    public function logistics()
    {
        $obj = new \Org\Util\Weichat;
        $data = $obj->get_Sign();
        $this->assign('data', $data);
        $this->display();
    }

    public function getOrder()
    {
        $url = "http://159.138.5.60:8076/YuPuAPI/WebService1.asmx/getOrder";
        $orderId = I('orderId');
        $url.="?user=hswl&password=56f07d378ac6a718";
        $url .= "&orderId=" . $orderId;
        $res = https_request($url);
        echo $url;die;
        echo $res;exit;
        $resArr = json_decode($res,true);
        pp($resArr);
//        $aa = iconv("gb2312", "utf-8", $aa);
//        $aa = str_replace('gb2312', 'utf-8', $aa);
//        $aa = str_replace(":", "：", $aa);
//        $aa = str_replace("以往查询信息：", "", $aa);
//        //$aa = str_replace("中文名称：", "", $aa);
//        header("Content-type:text/html; charset=utf-8");
//        print_r($aa);

    }

    private function getRealIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return $ip;

    }

    public function jsonToData($code, $msg, $data = null, $other = null)
    {
        $res = array(
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        );
        if (!empty($other)) {
            foreach ($other as $k => $v) {
                $res[$k] = $v;
            }
        }
        return json_encode($res);
    }
}