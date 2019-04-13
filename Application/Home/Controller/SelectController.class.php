<?php

namespace Home\Controller;

use Tools\HomeController;

class SelectController extends HomeController
{
    private static $download = '';

    public function select_lst()
    {
        $obj = new \Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('sign_data', $sign_data);
        $this->display();
    }

    public function product_size()
    {
        $obj = new \Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('sign_data', $sign_data);
        $this->display();
    }

    public function add_selection1()
    {
        $obj = new \Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('sign_data', $sign_data);
        $this->display();
    }

    public function add_selection2()
    {
        $obj = new \Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('sign_data', $sign_data);
        $this->display();
    }

    public function eletrical_choose()
    {
        $obj = new \Org\Util\Weichat;
        $sign_data = $obj->get_Sign();
        $this->assign('sign_data', $sign_data);
        $this->display();
    }

    public function searchOne()
    {
        $home_one = array(
            '视讯电器' => array(
                array('name' => '电视机', 'count' => 2, 'xuan' => 0),
                array('name' => '电脑', 'count' => 1, 'xuan' => 0),
                array('name' => '音响', 'count' => 1, 'xuan' => 0),
                array('name' => '有线电视机顶盒', 'count' => 2, 'xuan' => 0),
                array('name' => '路由器', 'count' => 1, 'xuan' => 0),
                array('name' => '电话机', 'count' => 2, 'xuan' => 0),
                array('name' => '视频播放器', 'count' => 1, 'xuan' => 0),
                array('name' => '网络电视机顶盒', 'count' => 0, 'xuan' => 1),
                array('name' => '投影仪', 'count' => 0, 'xuan' => 1),
                array('name' => '打印机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '厨房电器' => array(
                array('name' => '冰箱', 'count' => 1, 'xuan' => 0),
                array('name' => '抽油烟机', 'count' => 1, 'xuan' => 0),
                array('name' => '电饭煲', 'count' => 1, 'xuan' => 0),
                array('name' => '微波炉', 'count' => 1, 'xuan' => 0),
                array('name' => '热水器', 'count' => 1, 'xuan' => 0),
                array('name' => '榨汁机', 'count' => 0, 'xuan' => 1),
                array('name' => '搅拌机', 'count' => 0, 'xuan' => 1),
                array('name' => '咖啡机', 'count' => 0, 'xuan' => 1),
                array('name' => '烤箱', 'count' => 0, 'xuan' => 1),
                array('name' => '厨电宝', 'count' => 0, 'xuan' => 1),
                array('name' => '洗碗机', 'count' => 0, 'xuan' => 1),
                array('name' => '饮水机', 'count' => 0, 'xuan' => 1),
                array('name' => '净水器', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '卫浴电器' => array(
                array('name' => '浴霸', 'count' => 1, 'xuan' => 0),
                array('name' => '卫洗丽', 'count' => 1, 'xuan' => 0),
                array('name' => '洗衣机', 'count' => 0, 'xuan' => 0),
                array('name' => '水牙线', 'count' => 0, 'xuan' => 1),
                array('name' => '吹风机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '其它电器' => array(
                array('name' => '空调挂机', 'count' => 1, 'xuan' => 0),
                array('name' => '空调柜机', 'count' => 1, 'xuan' => 0),
                array('name' => '空气净化器', 'count' => 0, 'xuan' => 1),
                array('name' => '台灯', 'count' => 0, 'xuan' => 1),
            ),
        );
        $home_two = array(
            '视讯电器' => array(
                array('name' => '电视机', 'count' => 2, 'xuan' => 0),
                array('name' => '电脑', 'count' => 1, 'xuan' => 0),
                array('name' => '音响', 'count' => 1, 'xuan' => 0),
                array('name' => '有线电视机顶盒', 'count' => 2, 'xuan' => 0),
                array('name' => '路由器', 'count' => 1, 'xuan' => 0),
                array('name' => '电话机', 'count' => 2, 'xuan' => 0),
                array('name' => '视频播放器', 'count' => 1, 'xuan' => 0),
                array('name' => '网络电视机顶盒', 'count' => 0, 'xuan' => 1),
                array('name' => '投影仪', 'count' => 0, 'xuan' => 1),
                array('name' => '打印机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '厨房电器' => array(
                array('name' => '冰箱', 'count' => 1, 'xuan' => 0),
                array('name' => '抽油烟机', 'count' => 1, 'xuan' => 0),
                array('name' => '电饭煲', 'count' => 1, 'xuan' => 0),
                array('name' => '微波炉', 'count' => 1, 'xuan' => 0),
                array('name' => '热水器', 'count' => 1, 'xuan' => 0),
                array('name' => '榨汁机', 'count' => 0, 'xuan' => 1),
                array('name' => '搅拌机', 'count' => 0, 'xuan' => 1),
                array('name' => '咖啡机', 'count' => 0, 'xuan' => 1),
                array('name' => '烤箱', 'count' => 0, 'xuan' => 1),
                array('name' => '厨电宝', 'count' => 0, 'xuan' => 1),
                array('name' => '洗碗机', 'count' => 0, 'xuan' => 1),
                array('name' => '饮水机', 'count' => 0, 'xuan' => 1),
                array('name' => '净水器', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '卫浴电器' => array(
                array('name' => '浴霸', 'count' => 1, 'xuan' => 0),
                array('name' => '卫洗丽', 'count' => 1, 'xuan' => 0),
                array('name' => '洗衣机', 'count' => 0, 'xuan' => 0),
                array('name' => '水牙线', 'count' => 0, 'xuan' => 1),
                array('name' => '吹风机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '其它电器' => array(
                array('name' => '空调挂机', 'count' => 2, 'xuan' => 0),
                array('name' => '空调柜机', 'count' => 1, 'xuan' => 0),
                array('name' => '空气净化器', 'count' => 0, 'xuan' => 1),
                array('name' => '台灯', 'count' => 0, 'xuan' => 1),
            ),
        );
        $home_three = array(
            '视讯电器' => array(
                array('name' => '电视机', 'count' => 2, 'xuan' => 0),
                array('name' => '电脑', 'count' => 2, 'xuan' => 0),
                array('name' => '音响', 'count' => 1, 'xuan' => 0),
                array('name' => '有线电视机顶盒', 'count' => 2, 'xuan' => 0),
                array('name' => '路由器', 'count' => 1, 'xuan' => 0),
                array('name' => '电话机', 'count' => 2, 'xuan' => 0),
                array('name' => '视频播放器', 'count' => 1, 'xuan' => 0),
                array('name' => '网络电视机顶盒', 'count' => 0, 'xuan' => 1),
                array('name' => '投影仪', 'count' => 0, 'xuan' => 1),
                array('name' => '打印机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '厨房电器' => array(
                array('name' => '冰箱', 'count' => 1, 'xuan' => 0),
                array('name' => '抽油烟机', 'count' => 1, 'xuan' => 0),
                array('name' => '电饭煲', 'count' => 1, 'xuan' => 0),
                array('name' => '微波炉', 'count' => 1, 'xuan' => 0),
                array('name' => '热水器', 'count' => 1, 'xuan' => 0),
                array('name' => '榨汁机', 'count' => 0, 'xuan' => 1),
                array('name' => '搅拌机', 'count' => 0, 'xuan' => 1),
                array('name' => '咖啡机', 'count' => 0, 'xuan' => 1),
                array('name' => '烤箱', 'count' => 0, 'xuan' => 1),
                array('name' => '厨电宝', 'count' => 0, 'xuan' => 1),
                array('name' => '洗碗机', 'count' => 0, 'xuan' => 1),
                array('name' => '饮水机', 'count' => 0, 'xuan' => 1),
                array('name' => '净水器', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '卫浴电器' => array(
                array('name' => '浴霸', 'count' => 2, 'xuan' => 0),
                array('name' => '卫洗丽', 'count' => 1, 'xuan' => 0),
                array('name' => '洗衣机', 'count' => 1, 'xuan' => 0),
                array('name' => '水牙线', 'count' => 0, 'xuan' => 1),
                array('name' => '吹风机', 'count' => 0, 'xuan' => 1),
                array('name' => '其它', 'count' => 0, 'xuan' => 1),
            ),
            '其它电器' => array(
                array('name' => '空调挂机', 'count' => 3, 'xuan' => 0),
                array('name' => '空调柜机', 'count' => 1, 'xuan' => 0),
                array('name' => '空气净化器', 'count' => 0, 'xuan' => 1),
                array('name' => '台灯', 'count' => 0, 'xuan' => 1),
            ),
        );
        $home_type = I('post.home_type');
        $arr1 = array('home_type' => 1);
        $arr2 = array('home_type' => 2);
        $arr3 = array('home_type' => 3);
        switch ($home_type) {
            case '2';
                echo json_encode(array_merge($arr2, $home_two));
                break;
            case '3';
                echo json_encode(array_merge($arr3, $home_three));
                break;
            default:
                echo json_encode(array_merge($arr1, $home_one));
                break;
        }

    }

    //第二部返回具体开关
    public function searchTwo()
    {
        $home_type = I('home_type');
        $arr1 = array('home_type' => 1);
        $arr2 = array('home_type' => 2);
        $arr3 = array('home_type' => 3);
        if ($home_type == 1) {
            $xuanpeicount = I('post.xuanpeicount');
            $hh = 9 + $xuanpeicount;
            $home_one_kaiguan = array('open' => array(
                array('name' => '一位单控开关', 'count' => 3),
                array('name' => '二位单控开关', 'count' => 0),
                array('name' => '三位单控开关', 'count' => 1),
                array('name' => '四位单控开关', 'count' => 1),
                array('name' => '一位双控开关', 'count' => 2),
                array('name' => '二位双控开关', 'count' => 4),
                array('name' => '三位双控开关', 'count' => 2),
                array('name' => '一位10A联体二三极插座', 'count' => $hh),
                array('name' => '10A二三级插座+USB插座', 'count' => 4),
                array('name' => '带单控开关10A联体二三极插座', 'count' => 4),
                array('name' => '双联10A二极扁圆两用插座', 'count' => 2),
                array('name' => '一位10A三极插座', 'count' => 1),
                array('name' => '带单控开关10A三极插座', 'count' => 4),
                array('name' => '带单控开关16A三极插座', 'count' => 3),
                array('name' => '一位电话插座', 'count' => 1),
                array('name' => '一位电视插座', 'count' => 2),
                array('name' => '电话插座+超五类电脑插座', 'count' => 1),
                array('name' => '双接线柱音响插座', 'count' => 3),
                array('name' => '开关防溅盒', 'count' => 1),
                array('name' => '插座防溅盒', 'count' => 2),
            ));
            echo json_encode(array_merge($arr1, $home_one_kaiguan));
            exit;
        } elseif ($home_type == 2) {
            $xuanpeicount = I('post.xuanpeicount');
            $hh = 12 + $xuanpeicount;

            $home_two_kaiguan = array('open' => array(
                array('name' => '一位单控开关', 'count' => 3),
                array('name' => '二位单控开关', 'count' => 0),
                array('name' => '三位单控开关', 'count' => 1),
                array('name' => '四位单控开关', 'count' => 1),
                array('name' => '一位双控开关', 'count' => 2),
                array('name' => '二位双控开关', 'count' => 6),
                array('name' => '三位双控开关', 'count' => 2),
                array('name' => '一位10A联体二三极插座', 'count' => $hh),
                array('name' => '10A二三级插座+USB插座', 'count' => 5),
                array('name' => '带单控开关10A联体二三极插座', 'count' => 4),
                array('name' => '双联10A二极扁圆两用插座', 'count' => 2),
                array('name' => '一位10A三极插座', 'count' => 1),
                array('name' => '带单控开关10A三极插座', 'count' => 4),
                array('name' => '带单控开关16A三极插座', 'count' => 4),
                array('name' => '一位电话插座', 'count' => 1),
                array('name' => '一位电视插座', 'count' => 2),
                array('name' => '电话插座+超五类电脑插座', 'count' => 1),
                array('name' => '双接线柱音响插座', 'count' => 3),
                array('name' => '开关防溅盒', 'count' => 1),
                array('name' => '插座防溅盒', 'count' => 2),
            ));
            echo json_encode(array_merge($arr2, $home_two_kaiguan));
            exit;
        } elseif ($home_type == 3) {
            $xuanpeicount = I('post.xuanpeicount');
            $hh = 14 + $xuanpeicount;
            $home_three_kaiguan = array('open' => array(
                array('name' => '一位单控开关', 'count' => 3),
                array('name' => '二位单控开关', 'count' => 3),
                array('name' => '三位单控开关', 'count' => 1),
                array('name' => '四位单控开关', 'count' => 2),
                array('name' => '一位双控开关', 'count' => 2),
                array('name' => '二位双控开关', 'count' => 6),
                array('name' => '三位双控开关', 'count' => 2),
                array('name' => '一位10A联体二三极插座', 'count' => $hh),
                array('name' => '10A二三级插座+USB插座', 'count' => 6),
                array('name' => '带单控开关10A联体二三极插座', 'count' => 6),
                array('name' => '双联10A二极扁圆两用插座', 'count' => 2),
                array('name' => '一位10A三极插座', 'count' => 1),
                array('name' => '带单控开关10A三极插座', 'count' => 5),
                array('name' => '带单控开关16A三极插座', 'count' => 5),
                array('name' => '一位电话插座', 'count' => 1),
                array('name' => '一位电视插座', 'count' => 2),
                array('name' => '电话插座+超五类电脑插座', 'count' => 2),
                array('name' => '双接线柱音响插座', 'count' => 3),
                array('name' => '开关防溅盒', 'count' => 2),
                array('name' => '插座防溅盒', 'count' => 3),
            ));
            echo json_encode(array_merge($arr3, $home_three_kaiguan));
            exit;

        } else {
            echo json_encode(0);
        }
    }

    //第三部根据筛选条件
    public function searchThree()
    {

        $home_type = I('home_type');
        $is_usb = I('is_usb');//带usb五孔插座数量
        $no_usb = I('no_usb');//不带usb五孔插座数量
        //接收用户已经选好的产品
        // pp(I('POST.'));DIE;
        $data1 = $_POST['kind'];
        $data1 = json_decode($data1, true);
        $data1 = $data1['kind'];
        foreach ($data1 as $k => $v) {
            if ($v['name'] == '一位10A联体二三极插座') {
                $data1[$k]['count'] = $v['count'] + (int)($no_usb);
            } elseif ($v['name'] == '10A二三级插座+USB插座') {
                $data1[$k]['count'] = $v['count'] + (int)($is_usb);
            }
        }


        //接收用户的筛选条件
        $search = I('search');
        $series_id = $search['series_id'];
        $serier_name = D('Series')->field('series_name')->where(array('id' => $series_id))->find();
        /**需要改*/
        $color_arr = array(1, 2, 3, 4, 25, 30, 31, 32, 33);
        $color_arr1 = array(23, 24);//铝制材质
        $color_id = (int)$search['color_id'];
        if ($color_id > 10000) {
            $color_id = $color_id - 10000;
        }
        /**需要改**/
        if (!empty($color_id) && in_array($color_id, $color_arr)) {
            $color_name = 'PC材质';
        } else if (!empty($color_id) && in_array($color_id, $color_arr1)) {
            $color_name = '铝制材质';
        } else {
            $color_name = '玻璃材质';
        }
        $light_id = $search['light_id'];

        $light_name = D('light')->field('light_name')->where(array('id' => $light_id))->find();
        $title = array('title' => array('series_name' => $serier_name['series_name'], 'color_name' => $color_name, 'light_name' => $light_name['light_name']));
        $is_lvduan = $search['is_id'];//是否需要绿段产品 0真1假
        if (empty($data1)) {
            echo json_encode(1);//'没有接收到数据';
            exit;
        }

        if (empty($series_id) || empty($color_id) || empty($light_id)) {
            echo json_encode(2);
            '筛选条件过少';
            exit;
        } else {
            if (!empty($series_id))
                $where = " and series_id=" . $series_id;
            if (!empty($light_id))
                $where .= " and light_id in" . '(' . $light_id . ',' . '1' . ')';
            //查找当前系列下的默认颜色线检测color_id是否为大类，如果是则查找默认颜色，反之当前为默认颜色
            $is_parent_color_id = D('Color')->where(array('id' => $color_id, 'pid' => 0))->find();//判断当前是否为一级颜色
            $default_color_id = $color_id;
            if (!empty($is_parent_color_id)) {
                $series_color_info = D('Series_color')->where(array('series_id' => $series_id, 'color_id' => $color_id))->find();
                $default_color_id = $series_color_info['select_default_color_id'];
            }
            if (!empty($default_color_id))
                $where .= " and color_id=" . $default_color_id;


            $data = D('Product')->query('select product_show_desc,product_desc,product_name from si_product where is_zz_xx in(1,4) ' . $where);
            //pp(D('Product')->_sql());
            //组装普通商品的数据
            $i = 0;
            foreach ($data as $k => $v) {
                foreach ($data1 as $k1 => $v1) {
                    if ($v['product_desc'] == $v1['name']) {
//                        $res['kind1'][$i]['product_name']=$v['product_name'];
//                        $res['kind1'][$i]['product_count']=$v1['count'];
//                        $res['kind1'][$i]['product_desc']=$v['product_desc'];
                        $ppp['product_name'] = $v['product_name'];
                        $ppp['product_count'] = $v1['count'];
                        $ppp['product_desc'] = $v['product_show_desc'];
                    }

                }
                $res['kindpt'][] = $ppp;
                $i++;
            }
        }
        if (!empty($home_type) && $home_type == 1) {
            if ($is_lvduan == 1) {
                $lvduan_one = array('kind2' => array(
                    array('product_desc' => '1P+N 16A 西门子双进双出 空气开关断路器', 'product_name' => '5SJ30167CR', 'product_count' => 3),
                    array('product_desc' => '2P C40A  西门子空气开关断路器 总开 ', 'product_name' => '5SJ62407CR', 'product_count' => 1),
                    array('product_desc' => '1P+N 16A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR16', 'product_count' => 1),
                    array('product_desc' => '1P+N 20A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR20', 'product_count' => 4),
                    array('product_desc' => '1P+N 25A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR25', 'product_count' => 1),
                    array('product_desc' => 'SIMOBX PC 雅白 13位 小型配电箱', 'product_name' => '8GB3312-4CC78', 'product_count' => 1),
                ));
                if (empty($res)) {
                    echo json_encode(array_merge($title, $lvduan_one));
                    exit;
                } else {
                    echo json_encode(array_merge($title, $res, $lvduan_one));
                    exit;
                }
            } else {
                if (empty($res)) {
                    echo json_encode(array_merge($title));
                } else {
                    echo json_encode(array_merge($res, $title));
                    exit;
                }

            }
        } elseif (!empty($home_type) && $home_type == 2) {
            if ($is_lvduan == 1) {
                $lvduan_two = array('kind2' => array(
                    array('product_desc' => '2P C50A 西门子空气开关断路器 总开', 'product_name' => '5SJ62507CR', 'product_count' => 1),
                    array('product_desc' => '1P+N 16A  西门子双进双出 空气开关断路器 ', 'product_name' => '5SJ30167CR', 'product_count' => 4),
                    array('product_desc' => '1P+N 20A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR20', 'product_count' => 5),
                    array('product_desc' => '1P+N 16A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR16', 'product_count' => 1),
                    array('product_desc' => '1P+N 25A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR25', 'product_count' => 1),
                    array('product_desc' => 'SIMOBX PC 雅白 13位 小型配电箱', 'product_name' => '8GB3312-4CC78', 'product_count' => 1),
                ));
                if (empty($res)) {
                    echo json_encode(array_merge($title, $lvduan_two));
                    exit;
                } else {
                    echo json_encode(array_merge($title, $res, $lvduan_two));
                    exit;
                }

            } else {
                if (empty($res)) {
                    echo json_encode(array_merge($title));
                } else {
                    echo json_encode(array_merge($title, $res));
                    exit;
                }

            }

        } elseif (!empty($home_type) && $home_type == 3) {
            if ($is_lvduan == 1) {
                $lvduan_three = array('kind2' => array(
                    array('product_desc' => '2P C63A 西门子空气开关断路器 总开 ', 'product_name' => '5SJ62637CR', 'product_count' => 1),
                    array('product_desc' => '1P+N 16A  西门子双进双出 空气开关断路器', 'product_name' => '5SJ30167CR', 'product_count' => 5),
                    array('product_desc' => '1P+N 20A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR20', 'product_count' => 7),
                    array('product_desc' => '1P+N 16A 西门子双进双出 空气开关断路器', 'product_name' => '5SJ30207CR', 'product_count' => 1),
                    array('product_desc' => '1P+N 25A 西门子双进双出 漏电开关断路器', 'product_name' => '5SV93137CR25', 'product_count' => 1),
                    array('product_desc' => 'SIMOBX PC 雅白 16位 小型配电箱', 'product_name' => '8GB3312-6CC78', 'product_count' => 1),
                ));
                if (empty($res)) {
                    echo json_encode(array_merge($title, $lvduan_three));
                    exit;
                } else {
                    echo json_encode(array_merge($title, $res, $lvduan_three));
                    exit;
                }

            } else {
                if (empty($res)) {
                    echo json_encode(array_merge($title));
                } else {
                    echo json_encode(array_merge($title, $res));
                    exit;
                }
            }

        } else {
            echo json_encode(3);//房型错误
        }

    }

    public function ChooseSearch()
    {
        $series = I('series_id');
        if (!empty($series)) {
            /*针对选型的小类颜色处理，目前没有使用上*/
//            $result = D('Series_color')->field('*')->where(array('series_id' => $series))->select();
//            foreach ($result as $key => $value) {
//                if (strpos($value['have_color_id'], ',') === false) {
//                    $color_son_arr[] = $value['have_color_id'];
//                } else {
//                    $needHandleColorArr = explode(',', $value['have_color_id']);
//                    foreach ($needHandleColorArr as $key1 => $value1) {
//                        $color_son_arr[] = $value1;
//                    }
//                }
//            }
            /*针对选型的小类颜色处理，目前没有使用上*/
            $data = D('Product')->field('color_pid as color_id ,light_id')->where("series_id='$series'")->select();
            foreach ($data as $v) {
                $color_arr[] = $v['color_id'];
                $light_arr[] = $v['light_id'];
            }
            if ($series == 7)
                $color_arr[] = "25";
            if ($series == 13) {
                $color_arryingcai[] = "30";
                $color_arryingcai[] = "31";
                $color_arryingcai[] = "32";
                $color_arryingcai[] = "33";
                $color_arryingcai[] = "10001";
                $color_arryingcai[] = "10002";
                $color_arryingcai[] = "10003";
                $color_arryingcai[] = "10004";
            }

            $color_arr = array_values(array_unique($color_arr)); //数组去重和重置键名
            $light_arr = array_values(array_unique($light_arr));
            //pp($color_arr);pp($light_arr);die;
            if (!empty($color_arryingcai)) {
                echo json_encode(array('arrColor' => $color_arryingcai, 'arrLight' => $light_arr));
                die;
            }
            echo json_encode(array('arrColor' => $color_arr, 'arrLight' => $light_arr));
            die;

        } else {
            echo json_encode(1);//没有选择系列
        }
    }

    public function ajax()
    {
        $kaiguan_data = I('post.kind');
        $type = I('type');
        $down_id = time() . rand(0, 100000);
        foreach ($kaiguan_data as $k => $v) {
            $data['down_id'] = $down_id;
            $data['product_name'] = $v['product_name'];
            $data['product_desc'] = $v['product_desc'];
            $data['product_count'] = $v['product_count'];
            $data['datetime'] = time();
            D('download')->add($data);
        }

        if ($type == 1) {
            echo 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/Home/Select/excel_download/down_id/' . $down_id;
        } else if ($type == 2) {
            echo 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/Home/Select/word_download/down_id/' . $down_id;
        }
    }

    public function excel_download()
    {
        $down_id = (I('down_id'));
        $kaiguan_data = D('download')->where(array('down_id' => $down_id))->select();
        D('download')->where(array('datetime' => array('elt', (time() - 86400)),))->delete();

        Vendor('PHPExcel.Classes.PHPExcel');
        date_default_timezone_set('PRC'); //设置中国时区
        $objPHPExcel = new \PHPExcel();
        // 操作第一个工作表
        $objPHPExcel->setActiveSheetIndex(0);

        // 设置sheet名
        $objPHPExcel->getActiveSheet()->setTitle('清单信息');
        // 表格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);

        // 列名表头加粗
        $objPHPExcel->getActiveSheet()->getStyle('A1:A3')->getFont()->setBold(true);
        // 列名赋值
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '产品类型');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '产品型号');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '产品数量');


        // 数据起始行
        $row_num = 2;
        // 向每行单元格插入数据
        // $kaiguan_data=array(array(1,1,1),array(2,2,2),array(3,3,3));

        foreach ($kaiguan_data as $key => $value) {
            // 设置单元格高度
            $objPHPExcel->getActiveSheet()->getRowDimension($row_num)->setRowHeight(32);

            $objPHPExcel->getActiveSheet()->getStyle('D' . $row_num)->getAlignment()->setWrapText(true);

            // 设置单元格数值
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row_num, $value['product_desc']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, $value['product_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row_num, $value['product_count']);
            $row_num++;
        }

        ob_end_clean(); //清除缓冲 防止乱码
        $outputFileName = 'siemens' . time() . '.xls';
        $xlsWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="' . $outputFileName . '"');
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $xlsWriter->save("php://output");
        echo file_get_contents($outputFileName);
    }

    public function word_download()
    {
        $down_id = (I('down_id'));

        $kaiguan_data = D('download')->where(array('down_id' => $down_id))->select();
        D('download')->where(array('datetime' => array('elt', (time() - 86400)),))->delete();
        $data = '
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<xml><w:WordDocument><w:View>Print</w:View></xml>
<style>
td{
text-align: center;
}
</style>
</head>';
        $data .= '<body>
<h1 style="text-align: center">清单信息</h1>
<table border="1" cellpadding="3" cellspacing="0" >
<tr>
<th width="70%" valign="center" >产品类型</th>
<th width="20%" valign="center" >产品型号</th>
<th width="10%" valign="center"  >产品数量</th>
</tr>';
        foreach ($kaiguan_data as $k => $v) {
            $data .= '<tr><td width="65%" >' . $v['product_desc'] . '</td>';
            $data .= '<td width="20%">' . $v['product_name'] . '</td>';
            $data .= '<td width="15%">' . $v['product_count'] . '</td></tr>';
        }
        $data .= '</table></body>';
        echo $data;

        ob_start(); //打开缓冲区
        header("Cache-Control: public");
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        if (strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE')) {
            header('Content-Disposition: attachment; filename=siemens.doc');
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox')) {
            Header('Content-Disposition: attachment; filename=siemens.doc');
        } else {
            header('Content-Disposition: attachment; filename=siemens.doc');
        }
        header("Pragma:no-cache");
        header("Expires:0");
        ob_end_flush();//输出全部内容到浏览器


    }

}