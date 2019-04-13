<?php

namespace Home\Controller;

use Tools\HomeController;

class IndexController extends HomeController
{
    public function index()
    {
//        $obj = new \Org\Util\Weichat;
////        $res = $obj->sendContent("o7KOcv3kRNk9utX0T7c4T6L6PLuA");
////        var_dump($res);
////        die;
////        die;
////        $sql[] = 'update si_product set soft=200 where series_id in(2,4,13) and product_show_desc like "%一位单控%" and product_show_desc like "%无荧光%"';
////        $sql[] = 'update si_product set soft=195 where series_id in(2,4,13) and product_show_desc like "%一位单控%" and product_show_desc like "%带荧光%"';
////
////        die;
////        header("Content-Type:text/Html;charset=utf-8");
//        $res = $obj->getApiSign("IDp7KOcvx_YaFD2BBMCkcMn096V9ts");
//        var_dump($res);
//        die;
        $this->error('禁止访问');
    }

    public function create_menu()
    {
        $obj = new \Org\Util\Weichat;
        $jsonmenu = '{
      "button":[
      {
            "name":"家居电气",
           "sub_button":[
            {
               "type":"view",
                "name":"品牌故事",
                "url":"http://www.wawechat.siemens.com.cn/Home/Brandstory/brandstory"
            },
            {
               "type":"view",
                "name":"了解产品",
                "url":"http://www.wawechat.siemens.com.cn/Home/Product/ssy_product"
            },
            {"type":"view",
                "name":"自助选型",
                "url":"http://www.wawechat.siemens.com.cn/Home/Select/select_lst"
            },
            {
              "type":"view",
                "name":"经典系列",
                "url":"http://www.wawechat.siemens.com.cn/Home/Classical/classical"
            }]
       },
        {
            "name": "精彩乐惠", 
            "type": "click", 
            "key": "V1001_TODAY"
        },
       {
       "name":"专享服务",
         "sub_button":[
            {
              "type":"view",
                "name":"附近店铺",
                "url":"http://www.wawechat.siemens.com.cn/Home/Nearshop/shop"
            },
             {
              "type":"view",
                "name":"在线购买",
                "url":"http://www.wawechat.siemens.com.cn/Home/Onshop/onshop"
            },
             {
              "type":"view",
                "name":"产品验真",
                "url":"http://www.wawechat.siemens.com.cn/Home/Checkproduct/checkproduct"
            },
             {
              "type":"view",
                "name":"电气小贴士",
                "url":"http://www.wawechat.siemens.com.cn/Home/Tip/tip"
            }
            ]
       }
       ]
 }';
        $a = $obj->get_menu($jsonmenu);
        pp($a);
    }

    public function deleteMenu()
    {
        $obj = new \Org\Util\Weichat;
        var_dump($obj->delete_menu());

    }

    public function lst()
    {
        $obj = new \Org\Util\Weichat;
        $addCardArrJsonStr = $obj->wxCardAllPackage("p7KOcvx_YaFD2BBMCkcMn096V9ts");
//        $data = $obj->get_access_token();
//        var_dump($data);die;
        $data = $obj->get_Sign();
        $addCardData = $obj->wxCardPackage("p7KOcvx_YaFD2BBMCkcMn096V9ts");
        $chooseCardData = $obj->getApiSign("p7KOcvx_YaFD2BBMCkcMn096V9ts");
        $this->assign(array(
            'data' => $data,
            "addCardData" => $addCardData,
            "chooseCardData" => $chooseCardData,
            "addCardArrJsonStr" => $addCardArrJsonStr,
        ));
        $this->display();
    }

    public function getaddCard()
    {
        //[{"cardId":"p7KOcvx_YaFD2BBMCkcMn096V9ts","cardExt":{"code":"","openid":"","timestamp":1527658612,"signature":"be9c9f787f0e404c1135cb88d2213e1b6750e9df"}}]
        $obj = new \Org\Util\Weichat;
        $addCardArrJsonStr = $obj->wxCardAllPackage(array("p7KOcvx_YaFD2BBMCkcMn096V9ts","p7KOcvx_YaFD2BBMCkcMn096V9ts"));
        $addCardArrJsonStr = json_decode($addCardArrJsonStr,true);
        //pp($addCardArrJsonStr);die;
        $res =array();
        foreach ($addCardArrJsonStr as $k => $v) {
            $res['carId']=$v['cardId'];
            $arr = array();
            $arr['timestamp']=$v['cardExt']['timestamp'];
            $arr['signature']=$v['cardExt']['signature'];
            $res['cardExt']=$arr;
            $result[] = $res;
        }
        echo json_encode(array("list"=>$result));
    }

}