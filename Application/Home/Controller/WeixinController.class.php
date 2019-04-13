<?php

namespace Home\Controller;

use Tools\HomeController;

define("TOKEN", "weixin");

class WeixinController extends HomeController
{
    public function index()
    {
        if (!isset($_GET["echostr"])) {
            $this->responseMsg();
        } else {
            $this->valid();
        }
    }

    //微信公众号配置验证
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    //微信响应消息
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $MsgType = $postObj->MsgType;
            switch ($MsgType) {
                case 'location';
                    $this->respondLocation($postObj);
                case 'event';
                    $this->respondEvent($postObj);
//                case 'text';
//                    $this->respondText($postObj);
                    break;
            }
        } else {
            echo "";
            exit;
        }
    }

    //获取粉丝具体属性
    public function respondEvent($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        if (($postObj->Event) == 'subscribe') {
            /*用户扫描二维码未关注情况——start*/
//            if (!empty($postObj->EventKey)) {
//                $eventkey = $postObj->EventKey;
//                $ticket = $postObj->Ticket;
//                $scanModel = D('scan');
//                $data['openid'] = "$fromUsername";
//                $data['eventkey'] = "$eventkey";
//                $data['ticket'] = "$ticket";
//                $data['type'] = "subscribe";
//                $data['create_time'] = date("Y-m-d");
//                $data['scan_time'] = strtotime(date("Y-m-d H:i:s"));
//                $scanModel->add($data);
//                /*回复消息*/
//                $code = substr($eventkey,strlen("qrscene_"));
//                //$contentStr ="欢迎参加西门子区域推广会议！". "<a href='https://www.sojump.hk/m/10576413.aspx'>点击此处进行信息注册</a>";
//				$contentStr ="欢迎参加西门子区域推广会议！"."<a href='https://www.sojump.hk/m/10576413.aspx?sojumpparm=".$fromUsername."_".$data['eventkey']."'>点击此处进行信息注册</a>";
//                if($code>=10001 && $code<=10101){
//                    $this->sendText($fromUsername,$toUsername,$contentStr);
//                }
//
//            }
            /*用户扫描二维码未关注情况——end*/
            $model = new \Org\Util\Weichat;
            $fans_model = D('weichat_fans');
            $data = $model->get_user($fromUsername);
            $fans = $fans_model->where(array('openid' => "$fromUsername"))->count();

            if ($data == false) {
                for ($i = 0; $i < 10; $i++) {
                    $data = $model->get_user($fromUsername);
                    if ($data != false) {
                        $i = 10;
                    }
                }
            }
            if ($data != false) {
                $data['datetime'] = date('Y-m-d', time());
                if ($fans) {
                    $fans_model->where(array('openid' => array('eq', "$fromUsername"), 'subscribe' => array('eq', 0),))->save($data);
                } else {
                    $fans_model->add($data);
                }
            } else {
                if ($fans) {
                    $fans_model->where(array('openid' => array('eq', "$fromUsername"), 'subscribe' => array('eq', 0),))->save(array('subscribe' => 1, 'datetime' => date('Y-m-d', time())));
                } else {
                    $data = array('openid' => "$fromUsername", 'datetime' => date('Y-m-d', time()), 'nickname' => '未知', 'sex' => 3, 'subscribe' => 1);
                    $fans_model->add($data);
                }
            }
        } else if (($postObj->Event) == 'unsubscribe') {
            D('weichat_fans')->where(array(
                'openid' => array('eq', "$fromUsername"),
                'subscribe' => array('eq', 1),
            ))->save(array(
                'subscribe' => 0,
                'datetime' => date('Y-m-d', time()),
            ));
            //获取UV统计量
        }
        /*用户扫描二维码已经关注情况-start*/
//        else if (($postObj->Event) == 'SCAN') {
//            $fromUsername = $postObj->FromUserName;
//            $toUsername = $postObj->ToUserName;
//            $eventkey = $postObj->EventKey;
//            $ticket = $postObj->Ticket;
//            $scanModel = D('scan');
//            $data['openid'] = "$fromUsername";
//            $data['eventkey'] = "$eventkey";
//            $data['ticket'] = "$ticket";
//            $data['type'] = "SCAN";
//            $data['create_time'] = date("Y-m-d");
//            $data['scan_time'] = strtotime(date("Y-m-d H:i:s"));
//            $scanModel->add($data);
//            /*回复消息*/
//            //$contentStr ="欢迎参加西门子区域推广会议！". "<a href='https://www.sojump.hk/m/10576413.aspx'>点击此处进行信息注册</a>";
//			$contentStr ="欢迎参加西门子区域推广会议！"."<a href='https://www.sojump.hk/m/10576413.aspx?sojumpparm=".$fromUsername."_".$data['eventkey']."'>点击此处进行信息注册</a>";
//            if($eventkey>=10001 && $eventkey<=10101){
//                $this->sendText($fromUsername,$toUsername,$contentStr);
//            }
//
//        }
        /*用户扫描二维码已经关注情况-end*/
        else if (($postObj->Event) == 'VIEW') {
            $uv_model = D('Uv');
            $uv_count = $uv_model->where(array('openid' => "$fromUsername", 'datetime' => date('Y-m-d', time())))->count();
            if ($uv_count == 0) {
                $data = array(
                    'openid' => "$fromUsername",
                    'datetime' => date('Y-m-d', time())
                );
                $uv_model->add($data);
            }

        }
//        else if (($postObj->Event) == 'CLICK') {
//            $textTpl = "<xml>
//							<ToUserName><![CDATA[%s]]></ToUserName>
//							<FromUserName><![CDATA[%s]]></FromUserName>
//							<CreateTime>%s</CreateTime>
//							<MsgType><![CDATA[%s]]></MsgType>
//							<Content><![CDATA[%s]]></Content>
//							<FuncFlag>0</FuncFlag>
//							</xml>";
//            $msgType = "text";
//            $time = time();
//            $contentStr = "精彩活动即将上线，敬请期待！";
//            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//            echo $resultStr;
//        }

    }

    public function respondLocation($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $time = time();
        $imgTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>";
        $lat = $postObj->Location_X;  //当前维度
        $lnt = $postObj->Location_Y;  //当前经度
        //数据库店铺数据
        $data = D('Lowshop')->select();
        //根据用户的当前位置筛选出符合条件的店铺
        $res = getDistance("$lat", "$lnt", $data, 45000);
        if (!empty($res)) {
            $imgTpl .= count($res);
            $imgTpl .= "</ArticleCount>
                            <Articles>
                            ";
//            $imgTpl.='<item>
//                        <Title><![CDATA[西门子家居电气附近店铺]]></Title>
//                        <Description><![CDATA[点击下方到这去进行导航]]></Description>
//                        <PicUrl><![CDATA[picurl]]></PicUrl>
//                        <Url><![CDATA[url]]></Url>
//                        </item>';
            foreach ($res as $k => $v) {
                $imgTpl .= '<item>
                            <Title><![CDATA[' . $v["shop_name"] . $v['address'] . '《《《到这去' . ']]></Title> 
                            <Description><![CDATA[' . $lat . $lnt . '《《《到这去' . ']]></Description>
                            <PicUrl><![CDATA[picurl]]></PicUrl>
                            <Url><![CDATA[' . 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v["longitude"] . '/lat/' . $v["latitude"] . ']]></Url>
                            </item>';
            }
            $imgTpl .= '</Articles>
                            </xml> "';
            $msgType = "news";

            $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType);
            echo $resultStr;
        } else {
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            $msgType = "text";
            $contentStr = "您所在的城市线下店铺待更新";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }

    }

    public function respondText($postObj)
    {
        $keyword = trim($postObj->Content);
        $fromUsername = $postObj->FromUserName;  //user
        $toUsername = $postObj->ToUserName;
        $time = time();
        if (mb_substr($keyword, 0, 2, 'UTF-8') == '位置') {
            //$addarr = getNeedBetween($keyword,'省','市');
            $keyarr = explode(',', str_replace('，', ',', $keyword));
            $keyword = $keyarr['1'];
            $shopcity = D('City')->field('city_name')->select();
            foreach ($shopcity as $k => $v) {
                $res[] = $v['city_name'];
            }
            $keyword = in_array($keyword, $res) ? $keyword : null;
            if (!$keyword) {
                //没有具体的城市
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
                $msgType = "text";
                $contentStr = "如果您想获取附近店铺的信息请在对话框输入‘位置，xx市’ 比如‘位置，无锡市’";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;
            }
            $user_location = getLocation($keyword);
            $lnt = $user_location['longitude'];
            $lat = $user_location['latitude'];
            $imgTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>";
            //数据库店铺数据
            $data = D('Lowshop')->select();
            //根据用户的当前位置筛选出符合条件的店铺
            $res = getDistance("$lat", "$lnt", $data, 45000);
            if (!empty($res)) {
                $imgTpl .= count($res);
                $imgTpl .= "</ArticleCount>
                            <Articles>
                            ";
//                $imgTpl.='<item>
//                        <Title><![CDATA[西门子家居电气附近店铺]]></Title>
//                        <Description><![CDATA[点击下方到这去进行导航]]></Description>
//                        <PicUrl><![CDATA[picurl]]></PicUrl>
//                        <Url><![CDATA[url]]></Url>
//                        </item>';
                foreach ($res as $k => $v) {
                    $imgTpl .= '<item>
                            <Title><![CDATA[' . $v["shop_name"] . $v['address'] . '《《《到这去' . ']]></Title> 
                            <Description><![CDATA[' . $v['address'] . '《《《到这去' . ']]></Description>
                            <PicUrl><![CDATA[picurl]]></PicUrl>
                            <Url><![CDATA[' . 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v["longitude"] . '/lat/' . $v["latitude"] . ']]></Url>
                            </item>';
                }
                $imgTpl .= '</Articles>
                            </xml> "';
                $msgType = "news";

                $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType);
                echo $resultStr;
            } else {
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
                $msgType = "text";
                $contentStr = "您所在的城市线下店铺待更新";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }

        } else if (!empty($keyword)) {
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            $msgType = "text";
            $contentStr = "如果您想获取附近店铺的信息请在对话框输入‘位置，xx市’ 比如‘位置，无锡市’";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }

    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    public function sendText($fromUsername,$toUsername,$contentStr){
        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
        $msgType = "text";
        $time = time();
        //$contentStr = "精彩活动即将上线，敬请期待！";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
    }


}