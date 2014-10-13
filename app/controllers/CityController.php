<?php

class CityController extends BaseController {

	public function getIndex()
	{    
        
	}

    public function getArea($id)
    {
        $citys = City::where('parent_id',$id)->get()->toArray();
        echo json_encode($citys);
    }
    public function getAirport($id)
    {
        $arr = Airport::where('city_id',$id)->get()->toArray();
        echo json_encode($arr);
    }
}