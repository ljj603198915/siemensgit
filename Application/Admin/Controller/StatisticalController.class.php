<?php
namespace Admin\Controller;
use Tools\AdminController;
class StatisticalController extends AdminController
{
    public function lst()
    {
        $this->assign(array(
            '_page_title' => '数据统计',
        ));
        $this->display();
    }

    public function lst_ajax()
    {
        //select * from si_weichat_fans where subscribe_time>UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 30 DAY));
        //SELECT * FROM `si_statistical` WHERE  timestamp > UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 10 DAY))
        //H5统计数据
        $stamodel = D('Statistical');
        $pv = $stamodel->query("SELECT * FROM `si_statistical` WHERE name='H5' and  UNIX_TIMESTAMP(datetime) > UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 30 DAY))");
        foreach ($pv as $k => $v) {
            $pv_res[$v['datetime']] = $v['count'];
        }
        //UV统计量
        $uv = D('Uv')->query("SELECT datetime,count(*) as count FROM `si_uv` WHERE  UNIX_TIMESTAMP(datetime) > UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 30 DAY)) GROUP BY datetime");
        foreach ($uv as $k => $v) {
            $uv_res[$v['datetime']] = $v['count'];
        }
        //30天新关注人数
        $fans_model = D('Weichat_fans');
        $fans = $fans_model->query("SELECT datetime,count(*) as count FROM `si_weichat_fans` WHERE subscribe='1'and UNIX_TIMESTAMP(datetime) > UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 30 DAY)) GROUP BY datetime");
        foreach ($fans as $k => $v) {
            $fans_res[$v['datetime']] = $v['count'];
        }
        //粉丝总数
        $fans_count = $fans_model->where(array('subscribe' => 1))->count();
        $res = array('PV' => $pv_res, 'UV' => $uv_res, 'FANS' => $fans_res, 'FANS_COUNT' => $fans_count);
        echo json_encode($res);


    }

    //粉丝属性
    public function fan_lst()
    {

        $model = D('Statistical');
        $data = $model->search();
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));
        $this->assign(array(
            '_page_title' => '粉丝属性',
        ));
        $this->display();
    }
    //统计粉丝来源拉取接口


    //粉丝来源展示静态页
    public function fan_source()
    {
        $this->assign(array(
            '_page_title' => '粉丝来源',
        ));
        $this->display();
    }

    /**
     * 0代表其他合计 1代表公众号搜索 17代表名片分享 30代表扫描二维码 43代表图文页右上角菜单 51代表支付后关注（在支付完成页） 57代表图文页内公众号名称 75代表公众号文章广告 78代表朋友圈广告
     */
    public function fan_source_ajax()
    {
        $model = D('Fans_source');
        $data = $model->query("select source, sum(count)as count  from si_fans_source  GROUP BY(source)");
        foreach ($data as $k => $v) {
            //用户的渠道，数值代表的含义如下：
            // 0代表其他合计 1代表公众号搜索 17代表名片分享 30代表扫描二维码 43代表图文页右上角菜单 51代表支付后关注（在支付完成页） 57代表图文页内公众号名称 75代表公众号文章广告 78代表朋友圈广告
            //
            if ($v['source'] == 0) {
                $res[$k]['name'] = '其他合计';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 1) {
                $res[$k]['name'] = '公众号搜索';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 17) {
                $res[$k]['name'] = '名片分享';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 30) {
                $res[$k]['name'] = '扫描二维码';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 43) {
                $res[$k]['name'] = '图文页右上角菜单';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 57) {
                $res[$k]['name'] = '图文页内公众号名称';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 75) {
                $res[$k]['name'] = '公众号文章广告';
                $res[$k]['value'] = $v['count'];
            } elseif ($v['source'] == 78) {
                $res[$k]['name'] = '朋友圈广告';
                $res[$k]['value'] = $v['count'];
            }
        }
//        $apimodel=D('weichat_api');
//        $api_info=$apimodel->where(array('name'=>'粉丝来源','datetime'=>date('Y-m-d',time())))->find();
//        $res[]['count']=$api_info['count'];
        echo json_encode($res);
    }

   //粉丝来源请求数据接口
    public function get_fan_source()
    {
        $weichatobj = new \Org\Util\Weichat;
        $model = D('Fans_source');
        $begin_date = I('post.begin_date');
        $end_date = I('post.end_date');
       // echo $begin_date; echo $end_date;die;
        if (!empty($begin_date) && !empty($end_date)) {
            //日期间隔不能超过7天
            if (strtotime($end_date) - strtotime($begin_date) >= 3600 * 27 * 6) {
                echo  4;
                exit;
            } else {
                //日期不能大于当前日期
                if(strtotime($begin_date)>=strtotime(date('Y-m-d',time()))||strtotime($end_date)>=strtotime(date('Y-m-d',time()))){
                    echo 4;
                    exit;
                }
                $data = $weichatobj->get_usersummary($begin_date, $end_date);

                if($data==false){
                    for($i=0;$i<10;$i++){
                        $data=$weichatobj->get_usersummary($begin_date, $end_date);
                        if($data!=false){
                            $i=10;
                        }
                    }
                }
                if($data==false){
                    //调用接口失败，可能是调用基础token失败，也可能是调用该接口失败
                    echo 5;
                    exit;
                }
                //将该接口当天调用的次数存到数据库
                $apimodel=D('weichat_api');
                $api_info=$apimodel->where(array('name'=>'粉丝来源','datetime'=>date('Y-m-d',time())))->find();
                if($api_info){
                    $apimodel->where(array('name'=>'粉丝来源','datetime'=>date('Y-m-d',time())))->save(array('count'=>$api_info['count']+1));
                }else{
                    $apimodel ->add(array('name'=>'粉丝来源','count'=>1,'datetime'=>date('Y-m-d',time())));
                }
                $api_info=$api_info['count']+1;//今天的调用次数

                //插入拉取的数据
                foreach ($data['list'] as $k => $v) {
                    $res['count'] = $v['new_user'] - $v['cancel_user'];
                    $res['datetime'] = $v['ref_date'];
                    $res['source'] = $v['user_source'];
                    $count = $model->where(array('datetime' => $v['ref_date'], 'source' => $v['user_source']))->count();
                    if ($count ==0 && $res['count'] != 0) {
                        $result=$model->add($res);
                        if ($result==false) {
                            echo  1;
                            exit;
                        }
                    }
                }
                //拉取成功
                echo 0;
            }
        }else{
            echo 4;
        }
    }
}