<?php

class AgreementController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| News Controller
	|--------------------------------------------------------------------------
	|
	*/

    public function getIndex()
    {
        return View::make('home/agreement');
    }

}