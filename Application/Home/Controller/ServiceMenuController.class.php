<?php

namespace Home\Controller;

use Tools\HomeController;

class ServiceMenuController extends HomeController
{
    /**
     * 服务菜单首页页面
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 申请加盟列表页面
     */
    public function joinus()
    {
        $this->display();
    }

    /**
     * 投诉建议页面
     */
    public function advices()
    {
        $this->display();
    }

    /**
     * 问题列表页面
     */
    public function questions()
    {
        $this->display();
    }

    /**
     * 视频列表页面
     */
    public function videos()
    {
        $this->display();
    }

    /**
     * 视频接口
     */
    public function videosList()
    {
        $videoData = D("video")->order("sort asc")->select();
        //echo D("problem")->_sql();
        $res = $this->packageVideo($videoData);
        echo jsonToData(1, "success", $res);
        exit;
    }

    /**
     * 问题接口
     */
    public function problem()
    {
        $type = I("problem_type");
        $search = I("search");
        if (!empty($search)) {
            $map['problem_name'] = array("like", "%$search%");
            $map['answer'] = array("like", "%$search%");
            $map['_logic'] = "or";
            $where['_complex'] = $map;
        }
        if (!empty($type)) {
            $where['problem_type'] = $type;
        }
        $where['is_use'] = 1;
        $problemData = D("problem")->where($where)->select();
//        foreach ($problemData as $k => $v) {
//            $problemData[$k]['answer'] = htmlentities($problemData[$k]['answer']);
//        }
        //pp($problemData);
        //echo D("problem")->_sql();
        //$res = $this->packageProblem($problemData);
        echo jsonToData(1, "success", $problemData);
        exit;

    }

    /**
     * 包装问题列表
     * @param $problemData
     * @return mixed
     */
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

    /**
     * 包装视频列表
     * @param $videoData
     * @return mixed
     */
    public function packageVideo($videoData)
    {
        $brand = array();
        $product = array();
        $line = array();
        foreach ($videoData as $k => $v) {
            if ($v['video_type'] == 1) {
                $brand[] = $v;
            } elseif ($v['video_type'] == 2) {
                $product[] = $v;
            } elseif ($v['video_type'] == 3) {
                $line[] = $v;
            }
        }
        $res['brand'] = $brand;
        $res['product'] = $product;
        $res['line'] = $line;
        return $res;
    }

    /**
     * 添加答疑解惑
     */
    public function addJoin()
    {
        $data['name'] = I("name");
        $data['phone'] = I("phone");
        $data['province'] = I("province");
        $data['city'] = I("city");
        $data['agent_product'] = I("agent_product");
        $data['status'] = 1;
        $data['created_time'] = date(("Y-m-d H:i:s"));

        $res = D("Join_in")->add($data);
        if ($res) {
            echo jsonToData(1, "success");
            exit;
        } else {
            echo jsonToData(2, "申请失败");
            exit;
        }
    }

    /**
     * @return bool添加投诉与建议
     */
    public function addAdvice()
    {
        $data['customer_type'] = I("customer_type");
        $data['advice_name'] = I("advice_name");
        $data['phone'] = I("phone");
        $data['email'] = I("email");
        $data['status'] = 1;
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
//        array("prodesc", "checkproduct", "nearshop", "onshop", "logistics ", "joinus",
//            "advice", "electric", "400help", "jingcai", "video", "problem");
//        $problem_id = I("problem_id");
        if (empty($problem_id)) {
            $problem_id = 0;
        }
        addStatis($type, $problem_id);
    }

}