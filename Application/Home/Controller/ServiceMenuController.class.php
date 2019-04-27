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
    }

    /**
     * 申请加盟列表
     */
    public function joinus()
    {
        $this->display();
    }

    /**
     * 投诉建议
     */
    public function advices()
    {
        $this->display();
    }

    /**
     * 问题列表
     */
    public function questions()
    {
        $this->display();
    }

    /**
     * 问题接口
     */
    public function problem()
    {
        $type = I("problem_type");
        $search = I("search");
        if (!empty($search)) {
            $map['problem_name'] = array("like","%$search%");
            $map['answer'] = array("like","%$search%");
            $map['_logic'] = "or";
            $where['_complex'] = $map;
        }
        if (!empty($type)) {
            $where['problem_type'] = $type;
        }
        $where['is_use'] = 1;
        $problemData = D("problem")->where($where)->select();
        //echo D("problem")->_sql();
        $res = $this->packageProblem($problemData);
        echo jsonToData(1, "success", $res);
        exit;
        //pp($res);
    }

    public function packageProblem($problemData)
    {
        $normal = array();
        $product = array();
        $line = array();
        foreach ($problemData as $k => $v) {
            if ($v['problem_type'] == 1) {
                $normal[] = $v;
            } elseif ($v['problem_type'] == 2) {
                $product[] = $v;
            } elseif ($v['problem_type'] == 3) {
                $line[] = $v;
            }
        }
        $res['normal'] = $normal;
        $res['product'] = $product;
        $res['line'] = $line;
        return $res;
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