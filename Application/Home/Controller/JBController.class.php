<?php

namespace Home\Controller;

use Tools\HomeController;

class JBController extends HomeController
{
    public function jb()
    {
        $this->error('禁止访问');
        $model = D("Product");
        $where['series_id'] = array("eq", 15);
        $res = $model->where($where)->select();
//        /**更改数据库图片路径**/
        foreach ($res as $k=>$v){
            $v["product_image"] = "Product/".$v['id'].".png";
            $boolean = $model->save($v);
            pp($boolean);
        }
        die;
//        /**更改图片路径**/
    }

    /**
     * 更改图片名称
     */
    public function file()
    {
        $this->error('禁止访问');
        $dirname = "F:\xshelldownload/newimg";
//        $dirname = glob("C:\Users\Administrator\Desktop/img/*.jpg");
        $this->fRename($dirname);
    }

    public function fRename($dirname)
    {
        $model = D("Product");
        if (!is_dir($dirname)) {
            echo "{$dirname}不是一个有效的目录！";
            exit();
        }
        $handle = opendir($dirname);
        $i = 1;
        while (($fn = readdir($handle)) !== false) {
            if ($fn != '.' && $fn != '..') {
//                echo $fn;die; //5TA01113NC01.jpg
                $curDir = $dirname . '/' . $fn;
                if (is_dir($curDir)) { //检测是否为目录
                    $this->fRename($curDir);
                } else {
                    $path = pathinfo($curDir);
                    $productName = $this->getFileName($fn);
                    $where['product_name'] = array("eq", $productName);
                    $where['series_id'] = array("eq", 15);
                    $productData = $model->where($where)->find();
                    //改成你自己想要的新名字
                    if (!empty($productData)) {
                        echo $i;
                        $newname = $path['dirname'] . '/' . $productData['id'] . '.' . $path['extension'];
                        //echo "替换成:" . $productData['id'] . '.' . $path['extension'] . "\r\n";
                        $boolean = rename($curDir, $newname);
                        //pp($boolean);
                    }
                    $i++;
                }
            }
        }
    }

    /**
     * 获取文件名称去掉后缀名
     * @param $file
     * @return bool|string
     */
    public function getFileName($file)
    {
        $fileName = substr($file, 0, strrpos($file, '.'));
        return $fileName;
    }

}