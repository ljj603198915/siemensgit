<?php
namespace Admin\Controller;

use Tools\AdminController;

class ServiceMenuController extends AdminController
{
    public function lst()
    {
        $menuArr = array("prodesc", "checkproduct", "nearshop", "onshop", "logistics ", "joinus",
            "advice", "electric", "400help", "jingcai", "video", "problem", "check");
        foreach ($menuArr as $k => $v) {
            $res[$k]['type'] = $v;
            $count = D("service_statis")->where(array("type" => $v))->count();
            $res[$k]['count'] = $count;
//            $uVcount = D("service_statis")->where(array("type" => $v))->count(  distinct("ips"));
            $sql = "select count(distinct ip)as total from si_service_statis where `type`='{$v}'";
            $uVcount = D("service_statis")->query($sql);
            $res[$k]['uVcount'] = $uVcount[0]['total'];
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
                case "logistics ":
                    $res[$k]['name'] = "物流查询";
                    break;
                case "joinus":
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
                case "check":
                    $res[$k]['name'] = "产品验真查询";
                    break;
                default:
                    break;

            }
        }
        $this->assign("data", $res);
        $this->display();
//        pp($res);
//        die;
//        $sql = "SELECT *,count(*) AS tp_sum FROM `si_service_statis` GROUP BY type";
//        $data = D("service_statis")->query($sql);
//        //$data = D("service_statis")->group("type")->select();
//        pp($data);
//        die;
    }

    public function info()
    {
        $type = I("type");
        $startTime = I("startTime");
        $endTime = I("endTime");
        if (empty($startTime) && empty($endTime)) {
            $sql = "SELECT date_time,count(*) as uv,count(distinct ip) as pv FROM `si_service_statis` WHERE  UNIX_TIMESTAMP(date_time) >= UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 30 DAY))and `type`='{$type}' GROUP BY date_time";
        } elseif (!empty($startTime) && empty($endTime)) {
            $sql = "SELECT date_time,count(*) as uv,count(distinct ip) as pv FROM `si_service_statis` WHERE  UNIX_TIMESTAMP(date_time) >= UNIX_TIMESTAMP('{$startTime}')and `type`='{$type}' GROUP BY date_time";
        } elseif (empty($startTime) && !empty($endTime)) {
            $sql = "SELECT date_time,count(*) as uv,count(distinct ip) as pv FROM `si_service_statis` WHERE  UNIX_TIMESTAMP(date_time) <= UNIX_TIMESTAMP('{$endTime}')and `type`='{$type}' GROUP BY date_time";
        }else{
            $sql = "SELECT date_time,count(*) as uv,count(distinct ip) as pv FROM `si_service_statis` WHERE  UNIX_TIMESTAMP(date_time) >= UNIX_TIMESTAMP('{$startTime}') and UNIX_TIMESTAMP(date_time) <= UNIX_TIMESTAMP('{$endTime}')and `type`='{$type}' GROUP BY date_time";
        }

        $res = D('service_statis')->query($sql);
        //echo D('service_statis')->_sql();die;
//        pp($res);
//        die;
        $this->assign("data", $res);
        $this->display();
    }
}
