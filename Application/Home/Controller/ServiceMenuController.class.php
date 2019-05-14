<?php

namespace Home\Controller;

use Tools\HomeController;

class ServiceMenuController extends HomeController
{
    private $preg_email = '/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/ims';
    private $preg_phone = '/^1[3456789]\d{9}$/ims';

    /**
     * 服务菜单首页页面
     */
    public function home()
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
        $problemData = D("problem")->order('sort')->where($where)->select();
        //echo D("problem")->_sql();die;
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
        $data['advice_type'] = I("advice_type");
        $data['advice_content'] = I("advice_content");
        if (empty($data['customer_type']) || empty($data['advice_name']) || empty($data['phone'])
            || empty($data['advice_type']) || empty($data['advice_content'])
        ) {
            echo jsonToData(400, "加*项为必填", null);
            exit;
        }
//        if (!empty($data['email'])) {
//            if (!preg_match($this->preg_email, $data['email'])) {
//                echo jsonToData(400, "请填写正确的电子邮箱");
//                exit;
//            }
//        }
        $data['status'] = 1;
        $data['created_time'] = date(("Y-m-d H:i:s"));

        $id = D("advice")->add($data);
        //pp($id);die;
        echo jsonToData(1, "success", array("id" => $id));
        exit;
    }

    /**
     * @return bool添加投诉与建议
     */
    public function addAdviceFile()
    {
        $model = D("advice_img");
        $id = I("uid");
        //pp($_FILES);die;

        if (isset($_FILES['advice_img']) && $_FILES['advice_img']['error'] == 0) {
            $ret = uploadImage('advice_img', 'Advice');

            if ($ret['ok'] == 1) {
                $filePath = $ret['images'][0];

            } else {
                echo jsonToData(2, "图片上传错误");
                exit;
            }
        }
        $data['advice_id'] = $id;
        $data['advice_img'] = $filePath;
        if ($model->add($data)) {
            echo jsonToData(1, "success");
            exit;
        } else {
            echo jsonToData(2, "图片保存错误");
            exit;
        }
    }

    public function statis()
    {
        //        array("prodesc", "checkproduct", "nearshop", "onshop", "logistics ", "joinus",
//            "advice", "electric", "400help", "jingcai", "video", "problem");
//        $problem_id = I("problem_id");
        $type = I("type");
        $problem_id = I("problem_id");
        if (empty($problem_id)) {
            $problem_id = 0;
        }
        $data['type'] = $type;
        $data['ip'] = $this->getRealIp();
        $data['date_time'] = date("Y-m-d");
        $data['created_time'] = date("Y-m-d H:i:s");
        $data['problem_id'] = $problem_id;
        D("service_statis")->add($data);
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
}