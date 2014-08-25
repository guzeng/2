<?php

class CustomValidator extends Illuminate\Validation\Validator {

	/*
	|--------------------
	| 扩展验证器类
	|--------------------
	*/

	public function validatePhone($attribute, $value, $parameters)
	{
		return preg_match('/^[0-9\-\+\(\)\ ]+$/u', $value);
	}

	public function validateUsername($attribute, $value, $parameters)
	{
		return preg_match('/^[a-zA-Z0-9_\.-]+$/u', $value);
	}
	public function validateMobile($attribute, $value, $parameters)
	{
		return preg_match('/^[0-9]{11}$/u', $value);
	}
}