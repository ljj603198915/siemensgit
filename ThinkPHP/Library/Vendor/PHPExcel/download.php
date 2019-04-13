<?php


//方法1 （简单类型）  //引入下面自己封装的类就可以只能实现简单导出
//    $excel = new Excel();
//    $excel->addHeader(array('日期','带班领导','指挥长'));
//
//
//    $list=array(array(1,1,1),array(2,2,2));
//    $excel->addBody($list);
//    $excel->downLoad();
//
//
//
//
//class Excel
//{
//    private $head;
//    private $body;
//
//    public function addHeader($arr){
//        foreach($arr as $headVal){
//            $headVal = $this->charset($headVal);
//            $this->head .= "{$headVal}\t ";
//        }
//        $this->head .= "\n";
//    }
//    public function addBody($arr){
//        foreach($arr as $arrBody){
//            foreach($arrBody as $bodyVal){
//                $bodyVal = $this->charset($bodyVal);
//                $this->body .= "{$bodyVal}\t ";
//            }
//            $this->body .= "\n";
//        }
//    }
//    public function downLoad($filename=''){
//        if(!$filename)
//            $filename = date('YmdHis',time()).'.xls';
//        header("Content-type:application/vnd.ms-excel");
//        header("Content-Disposition:attachment;filename=$filename");
//        header("Content-Type:charset=gb2312");
//        if($this->head)
//            echo $this->head;
//        echo $this->body;
//    }
//    public function charset($string){
//        return mb_convert_encoding($string,'GBK','auto');
//    }
//}

//方法二
require_once ("./Classes/PHPExcel.php");
date_default_timezone_set('PRC'); //设置中国时区
$objPHPExcel = new PHPExcel();
// 实例化excel图片处理类
$objDrawing = new PHPExcel_Worksheet_Drawing();
// 操作第一个工作表
$objPHPExcel->setActiveSheetIndex(0);
// 设置sheet名
$objPHPExcel->getActiveSheet()->setTitle('测试');
// 表格宽度
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);

// 列名表头加粗
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
// 列名赋值
$objPHPExcel->getActiveSheet()->setCellValue('A1', '品牌名称');
$objPHPExcel->getActiveSheet()->setCellValue('B1', '品牌logo');
$objPHPExcel->getActiveSheet()->setCellValue('C1', '品牌网址');


// 数据起始行
$row_num = 2;
// 向每行单元格插入数据
$brands=array(array(1,1,1),array(2,2,2),array(3,3,3));
foreach($brands as $key => $value)
{
    // 设置单元格高度
    $objPHPExcel->getActiveSheet()->getRowDimension($row_num)->setRowHeight(32);
    // 设置排序列、是否显示列居中显示
    $objPHPExcel->getActiveSheet()->getStyle('E' . $row_num . ':' . 'F' . $row_num)->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // 设置所有垂直居中
    $objPHPExcel->getActiveSheet()->getStyle('A' . $row_num . ':' . 'F' . $row_num)->getAlignment()
        ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    // 设置品牌描述折行显示
    $objPHPExcel->getActiveSheet()->getStyle('D' . $row_num)->getAlignment()->setWrapText(true);

    // 取得商品logo路径
    //$file = ROOT_PATH . DATA_DIR . '/brandlogo/' . $value['brand_logo'];
    // 存在商品logo
//    if (file_exists($file))
//    {
//        // 实例化插入图片类
//        $objDrawing = new PHPExcel_Worksheet_Drawing();
//        // 设置图片路径
//        $objDrawing->setPath($file);
//        // 设置图片高度
//        $objDrawing->setHeight(40);
//        // 设置图片宽度
//        $objDrawing->setWidth(100);
//        // 设置图片要插入的单元格
//        $objDrawing->setCoordinates('B' . $row_num);
//        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
//    }
//    // 不存在商品logo
//    else
//    {
//        // 输出空白
//        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, '');
//    }

    // 设置单元格数值
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row_num, $value[0]);
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $row_num, $value[1]);
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $row_num, $value[2]);
    $row_num++;
}
ob_end_clean(); //清除缓冲 防止乱码
$outputFileName = '测试_' . time() . '.xls';
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

//方法三 在ios里能显示出来，但也不是excel文件
//header("content-type:text/html;charset=utf-8");
///** Error reporting */
//error_reporting(E_ALL);
///** PHPExcel */
//include_once './Classes/PHPExcel.php';
//
///** PHPExcel_Writer_Excel2003用于创建xls文件 */
//include_once 'PHPExcel/Writer/Excel5.php';
//
//// Create new PHPExcel object
//$objPHPExcel = new PHPExcel();
//ob_end_clean();
//// Set properties
//$objPHPExcel->getProperties()->setCreator("李汉团");
//$objPHPExcel->getProperties()->setLastModifiedBy("李汉团");
//$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
//$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
//$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
//
//// Add some data
//$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Date');
////合并单元格：
//$objPHPExcel->getActiveSheet()->mergeCells('B1:F1');
//$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'CSAT 山东省看到');
//$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Grand Total');
//$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'CSAT');
//$objPHPExcel->getActiveSheet()->SetCellValue('A2', '08/01/11');
//$objPHPExcel->getActiveSheet()->SetCellValue('B2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('C2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('D2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('E2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('F2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('G2', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('H2', '0%');
//$objPHPExcel->getActiveSheet()->SetCellValue('A3', '08/01/11');
//$objPHPExcel->getActiveSheet()->SetCellValue('B3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('C3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('D3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('E3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('F3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('G3', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('H3', '0%');
//$objPHPExcel->getActiveSheet()->SetCellValue('A4', '08/01/11');
//$objPHPExcel->getActiveSheet()->SetCellValue('B4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('C4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('D4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('E4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('F4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('G4', '0');
//$objPHPExcel->getActiveSheet()->SetCellValue('H4', '0%');
//
//// Rename sheet
//$objPHPExcel->getActiveSheet()->setTitle('Csat');
//
//
//// Save Excel 2007 file
////$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//
//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));
//header("Pragma: public");
//header("Expires: 0");
//header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
//header("Content-Type:application/force-download");
//header("Content-Type:application/vnd.ms-execl");
//header("Content-Type:application/octet-stream");
//header("Content-Type:application/download");
//header("Content-Disposition:attachment;filename=csat.xls");
//header("Content-Transfer-Encoding:binary");
//$objWriter->save("php://output");

