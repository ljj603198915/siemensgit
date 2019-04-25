<?php
namespace Admin\Controller;

use Tools\AdminController;

class ServiceMenuController extends AdminController
{
    public function lst()
    {
        $menuArr = array("prodesc", "checkproduct", "nearshop", "onshop", "los", "join_in",
            "advice", "electric", "400help", "jingcai", "video", "problem");
        foreach ($menuArr as $k => $v) {
            $count = D("service_statis")->where(array("type" => $v))->count();
            $res[$k]['count'] = $count;
            switch ($v) {
                case "prodesc":
                    $res[$k]['name'] = "产品说明书";
                    break;
                case "checkproduct":
                    $res[$k]['name'] = "产品验真";
                    break;
                case "nearshop":
                    $res[$k]['name'] = "附近店铺";
                    break;
                case "onshop":
                    $res[$k]['name'] = "在线购买";
                    break;
                case "los":
                    $res[$k]['name'] = "物流查询";
                    break;
                case "join_in":
                    $res[$k]['name'] = "申请加盟";
                    break;
                case "advice":
                    $res[$k]['name'] = "投诉建议";
                    break;
                case "electric":
                    $res[$k]['name'] = "电气贴士";
                    break;
                case "400help":
                    $res[$k]['name'] = "400关爱热线";
                    break;
                case "jingcai":
                    $res[$k]['name'] = "精彩乐惠";
                    break;
                case "video":
                    $res[$k]['name'] = "观看视频";
                    break;
                case "problem":
                    $res[$k]['name'] = "答疑解惑";
                    break;
                default:
                    break;
            }
        }
        $this->assign("data",$res);
        $this->display();
//        pp($res);
//        die;
//        $sql = "SELECT *,count(*) AS tp_sum FROM `si_service_statis` GROUP BY type";
//        $data = D("service_statis")->query($sql);
//        //$data = D("service_statis")->group("type")->select();
//        pp($data);
//        die;
    }
}
