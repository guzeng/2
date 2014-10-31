<?php

class Admin_ExportController extends BaseController {

	public function getOrderDetail($id)
	{
		if(!$id)
		{
            return Response::view('common.500', array('msg'=>Lang::get('msg.param_incorrect')));
        }
		$order = Order::find($id);
		if(!$order)
        {
            return Response::view('common.500', array('msg'=>Lang::get('msg.no_data_exist')));
        }
        if($order->area_id)
        {
            $order->area = City::find($order->area_id);
        }
        require_once(app_path().'/lib/PHPExcel/PHPExcel.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/IOFactory.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/Writer/IWriter.php');
        require_once(app_path().'/lib/PHPExcel/PHPExcel/Writer/Excel5.php');
        $objPHPExcel = new PHPExcel();
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->setCellValue('A1', $order->code.Lang::get('text.order_detail'));//设置列的值
        $objActSheet->mergeCells('A1:D1');
        $objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中  
        $objActSheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        //垂直居中
        $objActSheet->getRowDimension('1')->setRowHeight(30);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //创建表格类型，目前支持老版的excel5,和excel2007,也支持生成html,pdf,csv格式
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="orders-detail-'.$order->code.'.xls"');
        header("Content-Transfer-Encoding:binary");
        $objWriter->save('php://output');
	}

}