<?php

namespace Home\Controller;

use Tools\HomeController;

class NearshopController extends HomeController
{
    public function shop()
    {
        $obj = new\Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('data', $sign_data);
        $this->display();
    }

    public function create()
    {
        $lat = I('latitude');
        $lnt = I('longitude');
        if (!empty($lat) && !empty($lnt)) {
            echo json_encode(array('app' => "http://www.wawechat.siemens.com.cn/Home/Nearshop/allow/lat/$lat/lnt/$lnt"));
            die;
        } else {
            echo json_encode(0);//没有接收到数据
            exit;
        }
    }

    public function allow()
    {
        $lat = I('lat');
        $lnt = I('lnt');
//        $obj= new\Org\Util\Weichat;
//        $sign_data= $obj->get_Sign();
//        $this->assign('data',$sign_data);
        $shop_data = $this->create_shop($lat, $lnt);
        $this->assign('user_lat', $lat);
        $this->assign('user_lnt', $lnt);
        $this->assign('shop_data', $shop_data);
        $this->display();

    }

    public function no_allow()
    {
        $address = I('address');
        $user_location = getLocation($address);
        if (empty($user_location)) {
            echo json_encode(0);
            exit;
        }
        $lat = $user_location['latitude'];
        $lnt = $user_location['longitude'];
        $shop_data = $this->create_shop($lat, $lnt);
        if (!empty($user_location) && empty($shop_data)) {
            echo json_encode(1);
            exit;
        }
        echo json_encode($shop_data);

    }

    public function getShop()
    {
        //var_dump($_POST);
        $cityName = I("cityName");//具体的城市名称
        $searchType = I("searchType");//具体的城市名称
        $lat = I('centerLatitude');
        $lnt = I('centerLongitude');
        if ($searchType == "city") {
            $shop_data = $this->selectByCity($cityName);
            $location = getLocation($cityName);
            if ($location) {
                $lnt = $location['longitude'];
                $lat = $location['latitude'];
            } else {
                $lnt = "";
                $lat = "";
            }
        } else if ($searchType == "location") {
            $shop_data = $this->create_shop($lat, $lnt);
            if (empty($shop_data)) {
                $shop_data = $this->selectByCity($cityName);
            }
        }
        if (empty($shop_data)) {
            echo json_encode(array("code" => 1, "list" => array("centerLatitude" => $lat, "centerLongitude" => $lnt)));//换个地址哦
            exit;
        }
        echo json_encode($shop_data);

//        if (!empty($address)) {
//            $location = getLocation($address);
//            if ($location) {
//                $lnt = $location['longitude'];
//                $lat = $location['latitude'];
//            } else {
//                $lnt = "";
//                $lat = "";
//            }
//            $shop_data = $this->selectByCity($address);
//        } else {
//            //$data=json_decode($data,true);
//            $shop_data = $this->create_shop($lat, $lnt);
//        }
//        if (empty($shop_data)) {
//            echo json_encode(array("code"=>1,"list"=>array("centerLatitude" => $lat, "centerLongitude" => $lnt) ));//换个地址哦
//            exit;
//        }
//        echo json_encode($shop_data);
    }

    public function create_shop($lat, $lnt)
    {
        $where['on_sale'] = 1;
        $data = D('Lowshop')->where($where)->select();
        //根据用户的当前位置筛选出符合条件的店铺
        $res = getDistance("$lat", "$lnt", $data, 5000);
        $i = 0;
        $j = 0;
        foreach ($res as $k => $v) {
            if ($v['on_activity'] == 1) {
                $result['on_activity1'][$i]['shop_name'] = $v['shop_name'];
                $result['on_activity1'][$i]['shop_address'] = $v['address'];
                $result['on_activity1'][$i]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
                $result['on_activity1'][$i]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
                $i++;
            } else if ($v['on_activity'] == 2) {
                $result['on_activity2'][$j]['shop_name'] = $v['shop_name'];
                $result['on_activity2'][$j]['shop_address'] = $v['address'];
                $result['on_activity2'][$j]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
                $result['on_activity2'][$j]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
                $j++;
            }
        }

        return $result;
    }

    public function selectByCity($cityName)
    {
        $sql = "select * from si_lowshop where on_sale='1' and (province = '$cityName' or city='$cityName')";
        $res = D('Lowshop')->query($sql);
        $i = 0;
        $j = 0;
        foreach ($res as $k => $v) {
            if ($v['on_activity'] == 1) {
                $result['on_activity1'][$i]['shop_name'] = $v['shop_name'];
                $result['on_activity1'][$i]['shop_address'] = $v['address'];
                $result['on_activity1'][$i]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
                $result['on_activity1'][$i]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
                $i++;
            } else if ($v['on_activity'] == 2) {
                $result['on_activity2'][$j]['shop_name'] = $v['shop_name'];
                $result['on_activity2'][$j]['shop_address'] = $v['address'];
                $result['on_activity2'][$j]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
                $result['on_activity2'][$j]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
                $j++;
            }
        }

        return $result;
    }

    /**typekind*/
//    public function create_shop($lat, $lnt)
//    {
//        $where['on_sale'] = 1;
//        $data = D('Lowshop')->where($where)->select();
//        //根据用户的当前位置筛选出符合条件的店铺
//        $res = getDistance("$lat", "$lnt", $data, 5000);
//        $i = 0;
//        $j = 0;
//        foreach ($res as $k => $v) {
//            if ($v['shop_type'] == 1) {
//                $result['type_kind1'][$i]['shop_name'] = $v['shop_name'];
//                $result['type_kind1'][$i]['shop_address'] = $v['address'];
//                $result['type_kind1'][$i]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
//                $result['type_kind1'][$i]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
//                $i++;
//            } else if ($v['shop_type'] == 2) {
//                $result['type_kind2'][$j]['shop_name'] = $v['shop_name'];
//                $result['type_kind2'][$j]['shop_address'] = $v['address'];
//                $result['type_kind2'][$j]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
//                $result['type_kind2'][$j]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
//                $j++;
//            }
//        }
//
//        return $result;
//    }

//    public function selectByCity($cityName)
//    {
//        $sql = "select * from si_lowshop where on_sale='1' and (province = '$cityName' or city='$cityName')";
//        $res = D('Lowshop')->query($sql);
//        $i = 0;
//        $j = 0;
//        foreach ($res as $k => $v) {
//            if ($v['shop_type'] == 1) {
//                $result['type_kind1'][$i]['shop_name'] = $v['shop_name'];
//                $result['type_kind1'][$i]['shop_address'] = $v['address'];
//                $result['type_kind1'][$i]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
//                $result['type_kind1'][$i]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
//                $i++;
//            } else if ($v['shop_type'] == 2) {
//                $result['type_kind2'][$j]['shop_name'] = $v['shop_name'];
//                $result['type_kind2'][$j]['shop_address'] = $v['address'];
//                $result['type_kind2'][$j]['shop_latlnt'] = $v['longitude'] . ',' . $v['latitude'];
//                $result['type_kind2'][$j]['shop_url'] = 'http://www.wawechat.siemens.com.cn/Home/Getlocation/index/lnt/' . $v['longitude'] . '/lat/' . $v['latitude'];
//                $j++;
//            }
//        }
//
//        return $result;
//    }

}