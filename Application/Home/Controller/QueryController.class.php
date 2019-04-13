<?php

namespace Home\Controller;

use Think\Controller;

class QueryController extends Controller
{
    private $username = "siemens";
    private $password = "123456";
    private $urlHeader = "http://www.wawechat.siemens.com.cn/Public";

    public function findPro()
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data, true);
        $token = $data['token'];
        if ($token != sha1($this->username . $this->password)) {
            echo $this->jsonToData(403, "无权限请求");
            exit;
        }
        $mlfb = $data['mlfb'];

        if (empty($mlfb)) {
            echo $this->jsonToData(401, "请填写型号");
            exit;
        }
        $mlfb = str_replace(" ", "", $mlfb);
        $mlfb = str_replace("-", "", $mlfb);
        if (strlen($mlfb) < 10 || strlen($mlfb) > 13) {
            echo $this->jsonToData(405, "查询型号数位错误");
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
      if(!file_exists("Public".$data[0]['img_url'])){
          echo $this->jsonToData(403, "您查询的产品电子说明书还在快马加鞭制作中，如需操作帮助可咨询客服热线400-616-2020");
          exit;
      }else{
          echo $this->jsonToData(200, "查询成功", $this->urlHeader . $data[0]['img_url']);
          exit;
      }
      //echo $data[0]['img_url'];
    }

    public function index()
    {
        $this->display();

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


        $data = array("token" => sha1($this->username . $this->password), "mlfb" => "5UH1137-3NC03");
        $data = json_encode($data);
        // echo $data;die;
        $url = "localhost:81/Home/Query/findPro";
        $res = https_request($url, $data);
        var_dump($res);
        //echo $returncontent+"kk";

    }

}