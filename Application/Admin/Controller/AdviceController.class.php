<?php
namespace Admin\Controller;

use Think\Controller;

class AdviceController extends Controller
{
    public function lst()
    {
        $model = D('Advice');
        $data = $model->search();
        foreach ($data['data'] as $k => $v) {
            $imgData = D("advice_img")->where(array("advice_id" => $v['id']))->select();
            $data['data'][$k]['img'] = $imgData;
        }
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));

        //pp($data);die;
        // 设置页面中的信息
        $this->assign(array(
            '_page_title' => '列表',
            '_page_btn_name' => '添加',
            '_page_btn_link' => U('add'),
        ));
        $this->display();
    }

    public function handle()
    {
        $id = I("id");
        $model = D('advice');
        $lowShopData = $model->find($id);
        $lowShopData["status"] = 2;
        $lowShopData['handle_time'] = date("Y-m-d H:i:s");
        if ($model->save($lowShopData) !== FALSE) {
            $this->success('处理成功！', U('lst', array('p' => I('get.p', 1))));
            exit;
        }

    }

    public function download()
    {
        $model = D('Advice');
        $where = array();
        if ($advice_name = I('get.advice_name'))
            $where['advice_name'] = array('like', "%$advice_name%");
        if ($phone = I('get.phone'))
            $where['phone'] = array('like', "%$phone%");
        if ($status = I('get.status'))
            $where['status'] = array('eq', $status);
        $data['data'] = $model->where($where)->order("status asc, created_time desc")->select();
        foreach ($data['data'] as $k => $v) {
            if ($v['customer_type'] = 1) {
                $data['data'][$k]['customer_type'] = "消费者";
            } elseif ($v['customer_type'] = 2) {
                $data['data'][$k]['customer_type'] = "代理商";
            } elseif ($v['customer_type'] = 3) {
                $data['data'][$k]['customer_type'] = "公司";
            }
            if ($v['advice_type'] = 1) {
                $data['data'][$k]['advice_type'] = "服务";
            } elseif ($v['advice_type'] = 2) {
                $data['data'][$k]['advice_type'] = "质量";
            } elseif ($v['advice_type'] = 3) {
                $data['data'][$k]['advice_type'] = "售假";
            } elseif ($v['advice_type'] = 4) {
                $data['data'][$k]['advice_type'] = "建议";
            } elseif ($v['advice_type'] = 5) {
                $data['data'][$k]['advice_type'] = "其他";
            }
            if ($v['status'] = 1) {
                $data['data'][$k]['status'] = "未处理";
            } elseif ($v['status'] = 2) {
                $data['data'][$k]['status'] = "处理";
            }
            $imgData = D("advice_img")->where(array("advice_id" => $v['id']))->select();
            $data['data'][$k]['img'] = $imgData;
        }

        Vendor('PHPExcel.Classes.PHPExcel');
        date_default_timezone_set('PRC'); //设置中国时区
        $objPHPExcel = new \PHPExcel();
        // 操作第一个工作表
        $objPHPExcel->setActiveSheetIndex(0);

        // 设置sheet名
        $objPHPExcel->getActiveSheet()->setTitle('投诉建议信息');
        // 表格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

        // 列名表头加粗
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        // 列名赋值
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '客户类型');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '电话');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '电子邮箱');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '投诉类型');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '投诉建议');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '状态');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '投诉时间');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', '处理时间');


        // 数据起始行
        $row_num = 2;
        // 向每行单元格插入数据
        // $kaiguan_data=array(array(1,1,1),array(2,2,2),array(3,3,3));

        foreach ($data['data'] as $key => $value) {
            // 设置单元格高度
            $objPHPExcel->getActiveSheet()->getRowDimension($row_num)->setRowHeight(32);

            $objPHPExcel->getActiveSheet()->getStyle('D' . $row_num)->getAlignment()->setWrapText(true);

            // 设置单元格数值
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row_num, $value['customer_type']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, $value['advice_name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row_num, $value['phone']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row_num, $value['email']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row_num, $value['advice_type']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row_num, $value['advice_content']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row_num, $value['status']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row_num, $value['created_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row_num, $value['handle_time']);
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
}