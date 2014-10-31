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
        $objActSheet->setCellValue('A1', Lang::get('text.order_detail'));//设置列的值
        $objActSheet->mergeCells('A1:D1');
        $objActSheet->getStyle('A1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中  
        $objActSheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        //垂直居中
        $objActSheet->getRowDimension('1')->setRowHeight(40);

        //第2行
        $objActSheet->setCellValue('A2', Lang::get('text.order_code'));//设置列的值
        $objActSheet->setCellValue('B2', $order->code);
        $objActSheet->setCellValue('C2', Lang::get('text.flight_num'));//设置列的值
        $objActSheet->setCellValue('D2', $order->flight_num);
        $objActSheet->getStyle('A2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('2')->setRowHeight(30);
        $objActSheet->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('C2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);  

        //第3行
        $objActSheet->setCellValue('A3', Lang::get('text.ship_type'));//设置列的值
        $objActSheet->setCellValue('B3', Order::getType($order->type));
        $objActSheet->setCellValue('C3', Lang::get('text.ship_time'));//设置列的值
        $objActSheet->setCellValue('D3', date('Y-m-d H:i:s',gmt_to_local($order->time)));
        $objActSheet->getStyle('A3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A3')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D3')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('3')->setRowHeight(30);
        $objActSheet->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('C3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //第4行
        $objActSheet->setCellValue('A4', Lang::get('text.airport'));//设置列的值
        $objActSheet->setCellValue('B4', $order->airport ? (App::getLocale()=='zh'?$order->airport->name:$order->airport->name_en) : '');
        $objActSheet->setCellValue('C4', Lang::get('text.ship_city'));//设置列的值
        $objActSheet->setCellValue('D4', ($order->city ? (App::getLocale()=='zh'?$order->city->name:$order->city->name_en) : '').' '.(isset($order->area)?(App::getLocale()=='zh'?$order->area->name:$order->area->name_en):''));
        $objActSheet->getStyle('A4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A4')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D4')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('4')->setRowHeight(30);
        $objActSheet->getStyle('A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //第5行
        $objActSheet->setCellValue('A5', Lang::get('text.address'));//设置列的值
        $objActSheet->setCellValue('B5', $order->address);
        $objActSheet->mergeCells('B5:D5');
        $objActSheet->getStyle('A5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A5')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D5')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D5')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('5')->setRowHeight(30);
        $objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 

        //第6行
        $objActSheet->setCellValue('A6', Lang::get('text.one_num'));//设置列的值
        $objActSheet->setCellValue('B6', $order->one_num);
        $objActSheet->setCellValue('C6', Lang::get('text.two_num'));//设置列的值
        $objActSheet->setCellValue('D6', $order->two_num);
        $objActSheet->getStyle('A6')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A6')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A6')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B6')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B6')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C6')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C6')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D6')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D6')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('6')->setRowHeight(30);
        $objActSheet->getStyle('A6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
        $objActSheet->getStyle('C6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objActSheet->getStyle('D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //第7行
        $objActSheet->setCellValue('A7', Lang::get('text.special_num'));//设置列的值
        $objActSheet->setCellValue('B7', $order->special_num);
        $objActSheet->setCellValue('C7', Lang::get('text.distance'));//设置列的值
        $objActSheet->setCellValue('D7', round($order->distance,2).' km');
        $objActSheet->getStyle('A7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A7')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A7')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B7')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C7')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D7')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('7')->setRowHeight(30);
        $objActSheet->getStyle('A7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
        $objActSheet->getStyle('C7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objActSheet->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //第8行
        $objActSheet->setCellValue('A8', Lang::get('text.shipper'));//设置列的值
        $objActSheet->setCellValue('B8', $order->shipper);
        $objActSheet->setCellValue('C8', Lang::get('text.gender'));//设置列的值
        $objActSheet->setCellValue('D8', Lang::get('text.'.$order->gender));
        $objActSheet->getStyle('A8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A8')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('8')->setRowHeight(30);
        $objActSheet->getStyle('A8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('C8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //第9行
        $objActSheet->setCellValue('A9', Lang::get('text.mobile'));//设置列的值
        $objActSheet->setCellValue('B9', $order->phone);
        $objActSheet->setCellValue('C9', Lang::get('text.create_date'));//设置列的值
        $objActSheet->setCellValue('D9', date('Y-m-d H:i:s',gmt_to_local($order->create_time)));
        $objActSheet->getStyle('A9')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A9')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B9')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C9')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D9')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D9')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('9')->setRowHeight(30);
        $objActSheet->getStyle('A9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objActSheet->getStyle('B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
        $objActSheet->getStyle('C9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //第10行
        $objActSheet->setCellValue('A10', Lang::get('text.status'));//设置列的值
        $objActSheet->setCellValue('B10', Order::getStatus($order->status));
        $objActSheet->mergeCells('B10:D10');
        $objActSheet->getStyle('A10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('10')->setRowHeight(30);
        $objActSheet->getStyle('A10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 

        //第11行
        $objActSheet->setCellValue('A11', Lang::get('text.ship_note'));//设置列的值
        $objActSheet->setCellValue('B11', $order->info);
        $objActSheet->mergeCells('B11:D11');
        $objActSheet->getStyle('A11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('11')->setRowHeight(30);
        $objActSheet->getStyle('A11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 

        //第13行
        $objActSheet->setCellValue('A12', Lang::get('text.payment'));//设置列的值
        $objActSheet->mergeCells('A12:D12');
        $objActSheet->getStyle('A12')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A12')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B12')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C12')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D12')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D12')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('12')->setRowHeight(40);
        $objActSheet->getStyle('A12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    //左右居中  
        $objActSheet->getStyle('A12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        //垂直居中

        //第14行
        $objActSheet->setCellValue('A13', Lang::get('text.money'));//设置列的值
        $objActSheet->setCellValue('B13', $order->money);
        $objActSheet->setCellValue('C13', Lang::get('text.pay_type'));//设置列的值
        $objActSheet->setCellValue('D13', $order->pay_type>0 ? Lang::get('text.pay_type_'.Order::payType($order->pay_type)):'');
        $objActSheet->getStyle('A13')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A13')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A13')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B13')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B13')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C13')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C13')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D13')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D13')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('13')->setRowHeight(30);
        $objActSheet->getStyle('A13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
        $objActSheet->getStyle('C13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objActSheet->getStyle('D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //第15行
        $objActSheet->setCellValue('A14', Lang::get('text.pay'));//设置列的值
        $objActSheet->setCellValue('B14', $order->pay=='1' ? Lang::get('text.paid') : Lang::get('text.unpaid'));
        $objActSheet->setCellValue('C14', Lang::get('text.pay_code'));//设置列的值
        $objActSheet->setCellValue('D14', $order->pay_code);
        $objActSheet->getStyle('A14')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A14')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A14')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B14')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B14')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C14')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C14')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D14')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D14')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('14')->setRowHeight(30);
        $objActSheet->getStyle('A14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
        $objActSheet->getStyle('C14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('D14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objActSheet->getStyle('D14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //第16行
        $objActSheet->setCellValue('A15', Lang::get('text.pay_time'));//设置列的值
        $objActSheet->setCellValue('B15', $order->pay_time>0 ? date('Y-m-d H:i:s',$order->pay_time) : '');
        $objActSheet->mergeCells('B15:D15');
        $objActSheet->getStyle('A15')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A15')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A15')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('A15')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B15')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('B15')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C15')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('C15')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D15')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D15')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getStyle('D15')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//设置边框
        $objActSheet->getRowDimension('15')->setRowHeight(30);
        $objActSheet->getStyle('A15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        $objActSheet->getStyle('B15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 


        $objActSheet->getColumnDimension('A')->setWidth(15); 
        $objActSheet->getColumnDimension('B')->setWidth(30); 
        $objActSheet->getColumnDimension('C')->setWidth(15); 
        $objActSheet->getColumnDimension('D')->setWidth(30); 

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