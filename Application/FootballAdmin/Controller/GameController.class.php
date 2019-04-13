<?php

namespace FootballAdmin\Controller;

use Think\Controller;

class GameController extends Controller
{
    public function add()
    {
        if (IS_POST) {
            $model = D('Game');
            if ($model->create(I('post.'), 1)) {
                if ($id = $model->add()) {
                    $this->success('添加成功！', U('lst?p=' . I('get.p')));
                    exit;
                }
            }
            $this->error($model->getError());
        }

        // 设置页面中的信息
        $this->assign(array(
            '_page_title' => '添加',
            '_page_btn_name' => '列表',
            '_page_btn_link' => U('lst'),
        ));
        $this->display();
    }

    public function edit()
    {
        $id = I('get.id');
        if (IS_POST) {
            $model = D('Game');
            if ($model->create(I('post.'), 2)) {
                if ($model->save() !== FALSE) {
                    $this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $model = M('Game');
        $data = $model->find($id);
        $this->assign('data', $data);

        // 设置页面中的信息
        $this->assign(array(
            '_page_title' => '修改',
            '_page_btn_name' => '列表',
            '_page_btn_link' => U('lst'),
        ));
        $this->display();
    }

    public function delete()
    {
        $model = D('Game');
        if ($model->delete(I('get.id', 0)) !== FALSE) {
            $this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
            exit;
        } else {
            $this->error($model->getError());
        }
    }

    public function lst()
    {

        $model = D('Game');
        $data = $model->search();
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));

        // 设置页面中的信息
        $this->assign(array(
            '_page_title' => '列表',
            '_page_btn_name' => '添加',
            '_page_btn_link' => U('add'),
        ));
        $this->display();
    }

    public function changeResults()
    {
        $model = D("Game");
        $id = $_POST['id'];//活动id
        $results = $_POST['results'];
        $gameData = $model->find($id);
        if (empty($gameData)) {
            echo jsonToData(0, "无效的id");
            exit;
        } else {
            if (time() <= strtotime($gameData['game_time'])) {
                echo jsonToData(0, "比赛尚未开始，无法设置结果");
                exit;
            } else {
                $gameData['results'] = $results;
                $model->save($gameData);
                echo jsonToData(1, "比赛结果设置成功");
                exit;
            }
        }
    }

    /**
     * 开奖更新积分，添加积分记录，更新竞猜结果，添加优惠券记录
     */
    public function publish()
    {
        $gameModel = D("Game");
        $WechatUserQuizModel = D("WechatUserQuiz");
        $time1 = time();
        $id = I("id");//gameid
        if (empty($id)) {
            //参数错误
        }
        $gameArr = $gameModel->find($id); //比赛记录
        if (empty($gameArr)) {
            //无法找到该项竞猜
        }
        $quizArr = $WechatUserQuizModel->where(array("game_id" => $id))->select();
        if (empty($quizArr)) {
            //该厂没有参加竞猜的记录
        }
        $winArr = array();
        $unwinArr = array();
        $winUserArr = array();
        $unwinUserArr = array();
        $WechatUserQuizModel->startTrans();//开启事务

        foreach ($quizArr as $k => $v) {
            if ($v['answer'] == $gameArr['results']) {
                //添加优惠券记录
                $res1 = $this->addCouponRecord($id, $v['wechat_user_id'], "quiz", "竞猜卡券的id", "ungain");
                $res2 = $this->handleJifen($v['wechat_user_id'], $id, null, 10, "gain");
                $winArr[] = $v;
                $winUserArr[] = $v['wechat_user_id'];
            } else {
                $unwinArr[] = $v;
                $unwinUserArr[] = $v['wechat_user_id'];
            }
        }
        //改变竞猜记录的结果
        if (!empty($winUserArr)) {
            $winWhere = array();
            $winWhere['game_id'] = $id;
            $winWhere['wechat_user_id'] = array("in", $winUserArr);
            $res3 = $WechatUserQuizModel->where($winWhere)->save(array("is_win" => 1));
        }

        if (!empty($unwinUserArr)) {
            $unwinWhere = array();
            $unwinWhere['game_id'] = $id;
            $unwinWhere['wechat_user_id'] = array("in", $unwinUserArr);
            $res4 = $WechatUserQuizModel->where($unwinWhere)->save(array("is_win" => 3));
        }
        echo time() - $time1;
        $sds = $WechatUserQuizModel->rollback();
        var_dump($sds);die;
//        if($res1 && $res2 &&$res3&&$res4){
//            $gameModel->commit();
//        }else{
//            $gameModel->rollback();
//        }
    }

    //添加优惠券
    public function addCouponRecord($gameId, $wechatUserId, $type, $couponId, $state)
    {
        //添加优惠券记录
        $couponRecordArr['game_id'] = $gameId;
        $couponRecordArr['wechat_user_id'] = $wechatUserId;
        $couponRecordArr['type'] = $type;
        $couponRecordArr['coupon_id'] = $couponId;
        $couponRecordArr['state'] = $state;//未领取
        $res = D("couponRecord")->add($couponRecordArr);
        return $res;
    }

    //更新积分总数，添加积分记录
    public function handleJifen($wechatUserId, $gameId, $prizeId, $jifen, $type)
    {
        $wechatUserArr = D("WechatUser")->find($wechatUserId);
        if (!empty($gameId)) {
            $wechatUserArr['jifen'] = $wechatUserArr['jifen'] + 10;
            $res = D("WechatUser")->save($wechatUserArr);
            if (!$res) {
                return false;
            }
        }
//        else if(!empty($prizeId)){
//            $wechatUserArr['jifen'] = $wechatUserArr['jifen']-10;
//            D("WechatUser")->save($wechatUserArr);
//        }
        $jifenRecordArr['wechat_user_id'] = $wechatUserId;
        $jifenRecordArr['game_id'] = $gameId;
        $jifenRecordArr['prize_id'] = $prizeId;
        $jifenRecordArr['jifen'] = $jifen;
        $jifenRecordArr['type'] = $type;
        $res1 = D("jifenRecord")->add($jifenRecordArr);
        if (!$res1) {
            return false;
        }
        return true;
    }

    public function test()
    {
        $time1 = time();
//        echo date("YY-mm-ss");die;
//        $sql = "TRUNCATE si_wechat_user";
//        D("WechatUser")->execute($sql);
//        $sql1 = "TRUNCATE si_wechat_user_quiz";
//        D("WechatUserQuiz")->execute($sql1);
//        $sql3 = "TRUNCATE si_coupon_record";
//        $sql4 = "TRUNCATE si_jifen_record";
//        die;

        //增加模拟记录
        for ($i = 0; $i < 100000; $i++) {
            //sleep(5);
            $wechatUserData['openid'] = uniqid(mt_rand(), true);
            $wechatUserData['unionid'] = uniqid(mt_rand(), true);
            D("WechatUser")->add($wechatUserData);
            ob_flush();
        }

        for ($j = 0; $j < 100000; $j++) {
            // sleep(5);
            if ($j % 2 == 0) {
                $answer = "home_win";
            } else {
                $answer = "guest_win";
            }
            $wechatUserQuizData["wechat_user_id"] = $j;
            $wechatUserQuizData["game_id"] = 1;
            $wechatUserQuizData["answer"] = $answer;
            $wechatUserQuizData["create_time"] = date(time());
            D("WechatUserQuiz")->add($wechatUserQuizData);
            ob_flush();
        }
        echo time() - $time1;
    }
}