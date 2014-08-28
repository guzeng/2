/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ZH (Chinese, 中文 (Zhōngwén), 汉语, 漢語)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "必须填写",
		remote: "该字段已存在或者不合法，请修正该字段",
		email: "请输入正确格式的电子邮件",
		url: "请输入合法的网址",
		date: "请输入合法的日期",
		dateISO: "请输入合法的日期 (ISO).",
		number: "请输入合法的数字",
		digits: "只能输入整数",
		creditcard: "请输入合法的信用卡号",
		equalTo: "请再次输入相同的值",
		accept: "请输入拥有合法后缀名的字符串",
		maxlength: $.validator.format("最多 {0} 个字符"),
		minlength: $.validator.format("最少 {0} 个字符"),
		rangelength: $.validator.format("长度为{0}-{1}个字符"),
		range: $.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
		max: $.validator.format("请输入一个最大为 {0} 的值"),
		min: $.validator.format("请输入一个最小为 {0} 的值"),
		username: "登录名只允许由字母、数字、下划线、横线及.号组成",
		mobile: "错误的手机号码",
		length: $.validator.format("只允许 {0} 个字符")
	});
}(jQuery));