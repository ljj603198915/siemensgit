<?php

namespace Home\Controller;

use Tools\HomeController;

class CheckproductController extends HomeController
{
    private $urlHeader = "http://www.wawechat.siemens.com.cn/Public";

    public function index()
    {
        $this->display();
    }

    public function proDesc()
    {
        $this->display();
    }
    public function checkproduct()
    {
        $obj = new \Org\Util\Weichat;
        $data = $obj->get_Sign();
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 物流查询页面
     */
    public function logistics()
    {
        $obj = new \Org\Util\Weichat;
        $data = $obj->get_Sign();
        $this->assign('data', $data);
        $this->display();
    }

    public function check_ajax()
    {
        $url = "http://218.56.104.14:8033/wxjg.asp";
        $code = I('code');
        // $code='12365479813992415474';
        $fromtype = I('fromtype');
        $url .= '?CX=' . $code;
        if (!empty($fromtype)) {
            $url .= '&fromtype=1';
        } else {
            $url .= '&fromtype=0';
        }
        //记录次数和人数
        $ip = $this->getRealIp();
        \Think\Log::record("客户端ip" . $ip, 'DEBUG');
        $url .= "&ip=" . $ip;
        $aa = https_request($url);
        $aa = iconv("gb2312", "utf-8", $aa);
        $aa = str_replace('gb2312', 'utf-8', $aa);
        $aa = str_replace(":", "：", $aa);
        $aa = str_replace("以往查询信息：", "", $aa);
        //$aa = str_replace("中文名称：", "", $aa);
        header("Content-type:text/html; charset=utf-8");
        print_r($aa);

    }
    /**
     * 产品说明书查询接口
     */
    public function selectPro()
    {
        header("Content-type: text/html; charset=utf-8");
        $mlfb = I("mlfb");
        if (empty($mlfb)) {
            echo $this->jsonToData(401, "请填写型号");
            exit;
        }

        $mlfb = str_replace(" ", "", $mlfb);
        $mlfb = str_replace("-", "", $mlfb);
        if (strlen($mlfb) < 10 || strlen($mlfb) > 13) {
            echo $this->jsonToData(402, "查询型号数位错误");
            exit;
        }
        $sql = "select * from si_img_product p left join si_img_url iu ON p.product_img_num = iu.product_img_num where p.mlfb='$mlfb'";
        $data = D("imgProduct")->query($sql);
//        echo D("imgProduct")->_sql();
//        var_dump($data);
        if (empty($data)) {
            echo $this->jsonToData(402, "请填写正确的型号");
            exit;
        }
        if (empty($data[0]['img_url'])) {
            echo $this->jsonToData(404, "您查询的产品电子说明书还在快马加鞭制作中，如需操作帮助可咨询客服热线400-616-2020");
            exit;
        }
        if (!file_exists("Public" . $data[0]['img_url'])) {
            echo $this->jsonToData(403, "您查询的产品电子说明书还在快马加鞭制作中，如需操作帮助可咨询客服热线400-616-2020");
            exit;
        } else {
            echo $this->jsonToData(200, "查询成功", $this->urlHeader . $data[0]['img_url']);
            exit;
        }
    }

    /**
     * 物流查询接口
     */
    public function getOrder()
    {
//        echo 2;die;
        $url = "http://159.138.5.60:8076/YuPuAPI/WebService1.asmx/getOrder";
        $orderId = I('orderId');
        //$order = "sd";
        //$orderId ="7880339672";
        $url.="?user=hswl&password=56f07d378ac6a718";
        $url .= "&orderId=" . $orderId;
        $res = https_request($url);
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

    public function test()
    {
        header("Content-type: text/html; charset=utf-8");
        $mlfb = "sds";
        $data = array("token" => sha1("siemens123456"), "mlfb" => trim($mlfb));
        $data = json_encode($data);
        // echo $data;die;
        //$url = "www.wawechat.siemens.com.cn/index.php/Home/Query/findPro";
        $url = "http://192.168.146.1:81/index.php/Home/Query/findPro";
        $res = https_request($url, $data);
        var_dump($res);
        echo $res;
    }
}