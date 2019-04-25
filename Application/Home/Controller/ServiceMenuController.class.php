<?php

namespace Home\Controller;

use Tools\HomeController;

class ServiceMenuController extends HomeController
{
    /**
     * 服务菜单首页
     */
    public function index()
    {
        $this->display();
        die;
    }

    public function join()
    {
        addStatis("join");
        //$this->display();
    }

    public function addJoin()
    {
        $data['name'] = I("name");
        $data['phone'] = I("phone");
        $data['province'] = I("province");
        $data['agent_product'] = I("agent_product");
        $data['status'] = 0;
        $data['created_time'] = date(("Y-m-d H:i:s"));

        D("join_in")->save($data);
        echo jsonToData(1, "success");
        exit;
    }

    public function advice()
    {
        $this->display();
    }

    public function addAdvice()
    {
        $data['customer_type'] = I("customer_type");
        $data['advice_name'] = I("advice_name");
        $data['phone'] = I("phone");
        $data['email'] = I("email");
        $files = $_FILES;
        foreach ($files as $k => $v) {
            if ($v['error'] == 0) {
                $filename = date("YmdH:i:s");
                $exits = substr(strrchr($v['name'], '.'), 1);
                unlink("./Public/Uploads/Product/$filename.$exits");
                $ret = uploadOne('img', 'Product', $filename, array()
                );
                if ($ret['ok'] == 1) {
                    $data['product_image'] = $ret['images'][0];

                } else {
                    $this->error = $ret['error'];
                    return FALSE;
                }

            }
        }
        $data['advice_type'] = I("advice_type");
        $data['status'] = 0;
        $data['created_time'] = date(("Y-m-d H:i:s"));

        D("join_in")->save($data);
        echo jsonToData(1, "success");
        exit;
    }

    /**
     * 问题列表
     */
    public function problem()
    {
        $problemData = D("problem")->where(array("is_use" => 1))->select();
//        foreach ($problemData as $k => $v) {
//            $answerData = D("answer")->where(array("problem_id" => $v['id']))->select();
//            $problemData[$k]['answer'] = $answerData;
//        }
        echo jsonToData(1, "success", $problemData);
        exit;
        pp($problemData);
        //$this->display();
    }

    public function statis()
    {
        $type = I("type");
        $problemId = I("problemId");
        switch ($type) {
            case "s":
                addStatis($type);
                break;

            default:
                break;
        }
    }

}