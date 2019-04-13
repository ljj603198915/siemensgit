<?php
namespace Home\Controller;
use Think\Controller;
class GetlocationController extends Controller
{
    public function index()
    {
        $lat=I('lat');
        $lnt=I('lnt');
        if(empty($lat)||empty($lnt)){
            echo '系统繁忙，请稍后重试';
            exit;
        }
        $obj = new \Org\Util\Weichat;
        $data=$obj->get_Sign();
        $this->assign(array(
            'data'=>$data,
             'lat'=>$lat,
            'lnt'=>$lnt
        ));
       $this->display();
        //$this->success('',U('Brandstory/brandstory'));


//echo
//<<<Eof
//<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
//<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
//        <script>
//
//		wx.config({
//			debug: true,
//			appId: 'wx7e38a14dfcd9328a',
//			timestamp:{$data['timestamp']},
//			nonceStr:"{$data['nonceStr']}",
//			signature:"{$data['signature']}",
//			jsApiList:['openLocation']
//		});
//
//
//		wx.ready(function(){
//        wx.openLocation({
//            latitude:{$lat}, // 纬度，浮点数，范围为90 ~ -90
//            longitude:{$lnt}, // 经度，浮点数，范围为180 ~ -180。
//            name: '西门子家具电气店铺导航 ', // 位置名
//            address: '点击右下方绿色按钮进行导航', // 地址详情说明
//            scale: 28, // 地图缩放级别,整形值,范围从1~28。默认为最大
//            infoUrl: 'www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转经过测试无效
//        });
//    });
//
//</script>
//Eof;



    }
    public function iframe(){
        $lat=I('lat');
        $lnt=I('lnt');
        if(empty($lat)||empty($lnt)){
            echo '系统繁忙，请稍后重试';
            exit;
        }
        $obj = new \Org\Util\Weichat;
        $data=$obj->get_Sign();
        $this->assign(array(
            'data'=>$data,
            'lat'=>$lat,
            'lnt'=>$lnt
        ));
        $this->display();

    }
}