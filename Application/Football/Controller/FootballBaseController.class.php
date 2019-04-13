<?php

namespace Football\Controller;

use Think\Controller;

class FootballBaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $needCheck = array('index');
        $_SESSION['openid'] = "o7KOcv-MS4YKpKtk_2g7O-3GY9QI";
        if (in_array(ACTION_NAME, $needCheck)) {
            if (empty($_SESSION['openid'])) {
                redirect(U('FootballBase/oauth'));
            }
//            else{
//                redirect(U('FootballBase/oauth'));
//            }
//            else {
//                $count = D('WechatUser')->where(array('openid' => array('eq', $_SESSION['openid'])))->find();
//                if ($count) {
//                } else {
//                    $data['openid'] = $_SESSION['openid'];
//                    $data['jifen'] = 0;
//                    D('WechatUser')->add($data);
//                }
//                //拉取信息
//
//            }
        }

    }

    public function oauth()
    {
        $wechatObj = new \Org\Util\Weichat();
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $weixinInfo = $wechatObj->getOpenid($code);
            $weixinInfo = json_decode($weixinInfo, true);
            if ($weixinInfo['openid']) {
                $_SESSION['openid'] = $weixinInfo['openid'];
                $this->addWechatUserEntries($_SESSION['openid']);
                redirect(U('Index/index'));
            } else {
                redirect(U('FootballBase/oauth'));
            }
        } else {
            $url = "http://www.wawechat.siemens.com.cn/index.php/Football/FootballBase/oauth";
            $url = $wechatObj->getCode($url);
            $this->assign('url', $url);
            echo
            <<<Eof
<script>
window.location.href="$url";
</script>
Eof;
        }
    }

    // 添加参与用户信息，并判断是否关注，发放优惠券
    public function addWechatUserEntries($openid)
    {
        //判断数据库是否有详细信息
        $wechatObj = new \Org\Util\Weichat();
        $couponRecordModel = D("couponRecord");  //优惠券表
        $wechatUserInfo = $wechatUserModel->field("wu.*,wue.subscribe")->alias('wu')->join('left join __WECHAT_USER_ENTRIES__ wue ON wu.id = wue.wechat_user_id')->where(array('openid' => array('eq', $openid)))->find();
        if (empty($wechatUserInfo)) {
            $data['openid'] = $openid;
            $data['jifen'] = 0;
            $wechatUserModel->startTrans();  //开启事务
            $wechatUserId = $wechatUserModel->add($data);
            $wechatUserInfo = $wechatObj->getUnionID($openid);
            //pp($wechatUserInfo);die;
            if (empty($wechatUserInfo['errcode'])) {
                $wechatUserEntriesData['wechat_user_id'] = $wechatUserId;
                $wechatUserEntriesData['nickname'] = $wechatUserInfo['nickname'];
                $wechatUserEntriesData['subscribe'] = $wechatUserInfo['subscribe'];
                $wechatUserEntriesModel->add($wechatUserEntriesData);
                $wechatUserModel->commit();

            } else {
                $wechatUserModel->rollback();
                return false;
            }
        }
        //判断是否关注如果关注了，发放优惠券
        //
        if ($wechatUserInfo['subscribe'] == 1) {
            $couponRecordwhere["wechat_user_id"] = array("eq", $wechatUserId);
            $couponRecordInfo = $couponRecordModel->where($couponRecordwhere)->find();
            if (empty($couponRecordInfo)) {
                $couponRecordData['wechat_user_id'] = $wechatUserId;
                $couponRecordData['type'] = "subscribe";
                $couponRecordData['coupon_id'] = "关注卡券id";
                $couponRecordData['state'] = "ungain";
                $couponRecordModel->add($couponRecordData);
            }
        }
    }
}