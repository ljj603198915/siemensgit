<?php
namespace Admin\Controller;

use Think\Controller;

class JoinInController extends Controller
{
    public function lst()
    {
        $model = D('JoinIn');
        $data = $model->search();
        $this->assign(array(
            'data' => $data['data'],
            'page' => $data['page'],
        ));

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
        $model = D('join_in');
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
        $model = D('join_in');
        $where = array();
        if ($name = I('get.name'))
            $where['name'] = array('like', "%$name%");
        if ($phone = I('get.phone'))
            $where['phone'] = array('like', "%$phone%");
        if ($status = I('get.status'))
            $where['status'] = array('eq', $status);
        $data = $model->where($where)->order("status asc, created_time desc")->select();
        foreach ($data as $k => $v) {
            if ($v['status'] = 1) {
                $data[$k]['status'] = "未处理";
            } elseif ($v['status'] = 2) {
                $data[$k]['status'] = "处理";
            }
        }

        Vendor('PHPExcel.Classes.PHPExcel');
        date_default_timezone_set('PRC'); //设置中国时区
        $objPHPExcel = new \PHPExcel();
        // 操作第一个工作表
        $objPHPExcel->setActiveSheetIndex(0);

        // 设置sheet名
        $objPHPExcel->getActiveSheet()->setTitle('申请加盟信息');
        // 表格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);


        // 列名表头加粗
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        // 列名赋值
        $objPHPExcel->getActiveSheet()->setCellValue('A1', '姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', '电话');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', '省份');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', '城市');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', '希望代理的产品');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', '状态');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', '申请时间');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', '处理时间');

        // 数据起始行
        $row_num = 2;
        // 向每行单元格插入数据
        foreach ($data as $key => $value) {
            // 设置单元格高度
            $objPHPExcel->getActiveSheet()->getRowDimension($row_num)->setRowHeight(32);
                //折行线索
//            $objPHPExcel->getActiveSheet()->getStyle('D' . $row_num)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle("A".$row_num.":"."H".$row_num)->getAlignment()
                ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_DISTRIBUTED);
            // 设置单元格数值
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row_num, $value['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, $value['phone']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row_num, $value['province']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row_num, $value['city']);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row_num, $value['agent_product']);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row_num, $value['status']);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row_num, $value['created_time']);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row_num, $value['handle_time']);
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