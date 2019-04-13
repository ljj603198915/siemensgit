<?php

namespace Home\Controller;

use Think\Controller;
use Org\Util\Weichat;

class WechatController extends Controller
{
    private $weChat;

    public function __construct()
    {
        parent:: __construct();
        if (ACTION_NAME != 'noAccess') {
            if (I('sign') != "wechat" ) {
                redirect(U("noAccess"));
            }
        }
    }

    function noAccess()
    {
        echo "no access";
    }

    /**获取公众号token
     * @return string
     */
    public function getAccessToken()
    {
        $weChat = new \Org\Util\Weichat;
        $token = $weChat->get_access_token();
        if ($token == false) {
            echo $this->arrayToJson("1", "系统错误，请重试");
        } else {
            echo $this->arrayToJson("0", "请求成功", array("token" => $token));
        }

    }

    public function getUser()
    {
        $time = I('dateTime');
        if (!empty($time)) {
            $start = strtotime($time);
        } else {
            $start = strtotime(date("Y-m-d"));
        }
        $end = $start + 86400;
        $scanModel = D('scan');
        $where = array("scan_time" => array('between', array($start, $end)));
        $res = $scanModel->field("openid,eventkey,ticket,scan_time,type")->where($where)->select();
       // echo $scanModel->_sql();die;
        if (!empty($res)) {
            echo $this->arrayToJson("0","请求成功",$res);
            }else{
            echo $this->arrayToJson("1","无数据");
        }
    }

    /**
     * @param int $code
     * @param $msg
     * @param null $data
     * @return string
     */
//    public function sendContent(){
//        $weChat = new \Org\Util\Weichat;
//        $res = $weChat->sendContent();
//        var_dump($res);
//    }
    public function arrayToJson($code = 0, $msg, $data = null)
    {
        $array = array(
            "code" => $code,
            "msg" => $msg,
            "data" => $data,
        );

        return json_encode($array);
    }


}