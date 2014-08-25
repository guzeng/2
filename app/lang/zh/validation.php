<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "必须先接受:attribute",
	"active_url"           => "错误的URL :attribute",
	"after"                => ":attribute必须是在:date之后的一个日期",
	"alpha"                => ":attribute只能包含字母",
	"alpha_dash"           => ":attribute只能包含字母、数字和横线(-)",
	"alpha_num"            => ":attribute只能包含字母和数字",
	"array"                => ":attribute必须是数组",
	"before"               => ":attribute必须是在:date之前的一个日期",
	"between"              => array(
		"numeric" => ":attribute必须是 :min - :max 之间的数字",
		"file"    => ":attribute大小必须在:min - :max K之间",
		"string"  => ":attribute长度必须在 :min - :max 之间",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"confirmed"            => "两次输入:attribute不匹配",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => ":attribute和:other必须不相同",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => ":attribute必须在:min-:max位之间",
	"email"                => "错误的电子邮件地址",//:attribute 
	"exists"               => ":attribute不存在",
	"image"                => ":attribute必须是图片",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => ":attribute必须是整数",
	"ip"                   => ":attribute必须是正确的IP地址",
	"max"                  => array(
		"numeric" => ":attribute不能大于:max.",
		"file"    => ":attribute不能大于:maxKB",
		"string"  => ":attribute须小于:max个字符",
		"array"   => ":attribute不能超过:max个元素",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => ":attribute最小为:min.",
		"file"    => ":attribute最小为:minKB",
		"string"  => ":attribute不能少于:min字符",
		"array"   => ":attribute最少:min个元素",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => ":attribute必须是数字",
	"regex"                => ":attribute格式错误",
	"required"             => ":attribute必须填写",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => ":attribute与:other不相同",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => ":attribute已被使用",
	"url"                  => "The :attribute format is invalid.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

    "custom" => array(
        "email"		=> array(
        	"unique"		=> "电邮已被使用",
            "required"		=> "我们需要知道您的电邮地址"
        ),
        "phone"		=> array(
            "phone"			=> "错误的电话号码"
        ),
        "username"	=> array(
        	"unique"		=> "用户名已被使用",
            "username"		=> "用户名只允许由字母、数字、下划线、横线及.号组成"
        ),
        "pwd"		=> array(
        	"required"		=> "密码必须填写",
        	"confirmed"		=> "两次密码输入不一致",
        	"digitsbetween"	=> "密码长度必须在:min-:max位之间"
        ),
        "new_pwd"	=> array(
        	"required"		=> "密码必须填写",
        	"confirmed"		=> "两次密码输入不一致",
        	"digitsbetween"	=> "密码长度必须在:min-:max位之间"
        ),
        "role"		=> array(
        	"required"		=> "请选择角色"
        ),
        "mobile2"	=> array(
        	//"unique"		=> "手机号码已被使用",
            "mobile"		=> "错误的手机号码",
            //"required"		=> "手机号码必须填写"
        )
    ),
    	"mobile"		=> "错误的手机号码",
	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
