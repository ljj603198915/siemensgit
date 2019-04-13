<?php

namespace Home\Controller;

use Tools\HomeController;
use Home\Model\ProductModel;

class ProductController extends HomeController
{
    protected $productModel;
    protected $colorModel;
    protected $series_color_model;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = D('product');
        $this->colorModel = D('color');
        $this->series_color_model = D('Series_color');
    }

    /*
     * 了解产品，开关产品选择筛选类型
     */
    public function ssy_product()
    {
        $this->display();
    }

    public function switchChoose()
    {
        $data['type_id'] = I('type');
        $data['series_id'] = I('series');
        $data['color_id'] = I('color_id');
//        $data['type_id'] = 1;
//        $data['series_id'] = 13;
//        $data['color_id'] = 5;
        /*******地插系列开始***/
        if ($data['series_id'] == 8) {
            $res = $this->packageData8($data);
            echo json_encode($res);
            exit;
        }
        /*******地插系列结束***/
        //如果没有传color_id默认为白色
        $data['color_id'] = empty($data['color_id']) ? 4 : $data['color_id']; //默认白色

        //查找当前系列下的默认颜色线检测color_id是否为大类，如果是则查找默认颜色，反之当前为默认颜色
        $is_parent_color_id = $this->colorModel->where(array('id' => $data['color_id'], 'pid' => 0))->find();//判断当前是否为一级颜色
        $default_color_id = $data['color_id'];
        if (!empty($is_parent_color_id)) {
            $series_color_info = $this->series_color_model->where(array('series_id' => $data['series_id'], 'color_id' => $data['color_id']))->find();
            $default_color_id = $series_color_info['default_color_id'];
        }

        //处理颜色筛选条件END
        $sql = "select GROUP_CONCAT(id),cat_id from si_product where type_id='" . $data['type_id'] . 'and is_zz_xx in(2,4)' . "' and series_id='" . $data['series_id'] . "' and color_id=" . $default_color_id ." group by cat_id";
        if ($data['series_id'] == 13 && $default_color_id == 5) {
            $sql = "select GROUP_CONCAT(id),cat_id from si_product where type_id=  %s and is_zz_xx in(2,4) and series_id= %s and color_pid= %s  group by cat_id  ";
            $sql = sprintf($sql, $data['type_id'], $data['series_id'], $default_color_id);
        }
        $result = $this->productModel->query($sql);
        //组装返回数据START
        $return = $this->packageData($result, "cat_id", $data, $default_color_id);
        return $return;
    }

    /*
     *	了解产品，移动式插座筛选
     */
    public function chazuoChoose()
    {
        $product_type = I('type');
        $color = I('color');
        $style = I('style');
        $where['color_id'] = $color;
        $where['is_usb'] = $style;
        $where['_logic'] = 'or';
        $data['type_id'] = $product_type;
        $data['_complex'] = $where;

        $result = $this->productModel->field(array('product_name' => 'pro_escn', 'product_image' => 'pro_img', 'product_show_desc' => 'pro_descri'))->where($data)->select();
        $return = json_encode($result);

        echo $return;
    }

    /*
     *	了解产品，低压终端配电，家居配电
     */
    public function diyaChoose()
    {
        $product_type = I('type');
        $kind = I('kind');

        if ($product_type == 3) {
            $field = "first_cat";
        } else if ($product_type == 4) {
            $field = "cat_id";
        }
        $condition[$field] = $kind;

        $result = $this->productModel->field(array('product_name' => 'pro_escn', 'product_image' => 'pro_img', 'product_show_desc' => 'pro_descri'))->where($condition)->select();
        $return = json_encode($result);

        echo $return;
    }

    /*
     *	组装数据
     */
    private function packageData($result, $field, $data, $default_color_id)
    {

        //按照产品分类组装数据
        foreach ($result as $k => $v) {
            $where["$field"] = $v["$field"];
            $where['id'] = array('in', $v['group_concat(id)']);
            $where['is_zz_xx'] = array('in', '2,4');
            $name = "switchKind" . $v["$field"];
            $$name = $this->productModel->field(array('id', 'product_name' => 'pro_escn', 'product_show_desc' => 'pro_descri', 'product_image' => 'pro_img'))->where($where)->order('soft desc')->select();
            if (!empty($$name)) {
                $return["$name"] = $$name;

            }
        }

        //组合当前颜色
        //查找当前系列下的颜色种类
        $series_have_color_id_arr = D('Series_color')->where(array('series_id' => $data['series_id']))->select();
        $series_have_color_id_str = '';
        foreach ($series_have_color_id_arr as $key => $v) {
            $series_have_color_id_str .= $v['have_color_id'] . ',';
        }
        $series_have_color_id_str = substr("$series_have_color_id_str", 0, -1);
        $color_name = $this->colorModel->field(array('id' => "d_color_id", "color_name" => "colorname", "pid"))->where(array('id' => array('in', $series_have_color_id_str)))->order('solt asc')->select();
        if ($data['series_id'] == 6 || $data['series_id'] == 13) {
            $color_name = $this->colorModel->query("select GROUP_CONCAT(id) as d_color_id,color_name as colorname,pid from si_color where id in" . '(' . $series_have_color_id_str . ')' . 'group by pid' . ' order by solt asc ');
        }

       // pp($data);pp($color_name);die;
        foreach ($color_name as $key => $value) {
            if ($value['pid'] != 5) {
                if ($value['d_color_id'] == $default_color_id) {
                    $color_name[$key]['is_active'] = 1;
                } else {
                    $color_name[$key]['is_active'] = 0;
                }
            } else if ($value['pid'] == 5 && $data['color_id'] == 5) {
                $color_name[$key]['colorname'] = '其他';
                $color_name[$key]['d_color_id'] = '5';
                $color_name[$key]['is_active'] = 1;
            } else {
                $color_name[$key]['colorname'] = '其他';
                $color_name[$key]['d_color_id'] = '5';
                $color_name[$key]['is_active'] = 0;
            }

        }
        $return['colorKinds'] = $color_name;
        $return['series_idx'] = $data['series_id'];
        $return = json_encode($return);
        echo $return;
    }

    //地插系列组装数据
    public function packageData8($data)
    {
        $result = $this->productModel->query("select product_name as pro_escn,product_show_desc as pro_descri,product_image as pro_img from si_product where type_id=" . $data['type_id'] . ' and is_zz_xx in(2,4)' . ' and series_id=8');
        foreach ($result as $k => $v) {
            $res['dicha'][] = $v;

        }
        $res['series_idx'] = $data['series_id'];
        return $res;
    }

    //点晶系列其他
    public function dianjingChoose()
    {
        $data['type_id'] = 1;
        $data['series_id'] = I('series');
        $data['series_id'] = $data['series_id'] == "dianjing"?6:$data['series_id'];
        $data['color_id'] = I('color_id');
        $data['series_id'] = empty($data['series_id']) ? 6 : $data['series_id'];
        if($data['series_id'] == 13){
            //处理颜色筛选条件END
            if ($data['series_id'] == 13 && $data['color_id'] == 5) {
                $sql = "select GROUP_CONCAT(id),cat_id from si_product where type_id=  %s and is_zz_xx in(2,4) and series_id= %s and color_pid= %s group by cat_id";
                $sql = sprintf($sql, $data['type_id'], $data['series_id'], $data['color_id']);
            }
            $result = $this->productModel->query($sql);
            //组装返回数据START
            $return = $this->packageData($result, "cat_id", $data, $data['color_id']);
            return $return;
        }
        $result = $this->productModel->query("select product_name as pro_escn,product_show_desc as pro_descri,product_image as pro_img,material_id from si_product where type_id=1 and is_zz_xx in(2,4) and series_id={$data['series_id']}");
        if (empty($result)) {
            echo json_encode(0); //没有信息
            exit;
        }
        /*处理点晶产品数据*/
        if ($data['series_id'] == 6) {
            foreach ($result as $k => $v) {
                if ($v['material_id'] == 3) {
                    $res['typeKind1'][] = $v;
                } else if ($v['material_id'] == 2) {
                    $res['typeKind2'][] = $v;
                }
            }
        }
//        else if($data['series_id'] == 13){
//           pp($result);
//        }
        /*处理产品数据*/


        /*处理颜色*/
        $series_color = $this->productModel->field("color_id")->group('color_id')->where(array('series_id' => array('eq', $data['series_id']), 'is_zz_xx' => array('in', '2,4')))->select();
        if (empty($series_color)) {
            echo json_encode(0);
            exit;
        }
        foreach ($series_color as $k => $v) {
            $pipixia[] = $v['color_id'];
        }
        $series_color = implode(',', $pipixia);
        $color_name = $this->colorModel->query("select GROUP_CONCAT(id) as d_color_id,id,color_name as colorname,pid from si_color where id in" . '(' . $series_color . ')' . ' group by pid ' . 'order by solt asc');
        foreach ($color_name as $key => $value) {
            if ($value['pid'] != 5) {
                $color_name[$key]['is_active'] = 0;

            } elseif ($value['pid'] == 5) {
                $color_name[$key]['colorname'] = '其他';
                $color_name[$key]['d_color_id'] = '5';
                $color_name[$key]['is_active'] = 1;
            }
        }
        $res['series_idx'] = 6;
        $res['colorKinds'] = $color_name;
        echo json_encode($res);
    }

}
