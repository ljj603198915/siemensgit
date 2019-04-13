<?php

namespace Football\Controller;

class IndexController extends FootballBaseController
{
    public function index()
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
        $i=0;
        foreach ($addCardArrJsonStr as $k => $v) {
            $res['carId']=$v['cardId'];
            $arr = array();
            $arr['timestamp']=$v['cardExt']['timestamp'];
            $arr['signature']=$v['cardExt']['signature'];
            $res['cardExt']=$arr;
            $result[$i] = $res;
            $i++;
        }
        echo json_encode(array("list"=>$result));

    }

}