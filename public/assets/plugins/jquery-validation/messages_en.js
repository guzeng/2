/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "This field is required.",
		remote: "This field is existed or invalid, please fix it.",
		email: "Must be a valid email address.",
		url: "Not a valid URL.",
		date: "The date is not a valid date.",
		dateISO: "The date is not a valid date (ISO).",
		number: "Must be a number.",
		digits: "Must be an integer.",
		creditcard: "May not be a credit card number.",
		equalTo: "Please enter the same value again.",
		accept: "Must be a valid string.",
		maxlength: $.validator.format("{0} characters maximum."),
		minlength: $.validator.format("Must have at least {0} characters."),
		rangelength: $.validator.format("{0} - {1} characters long."),
		range: $.validator.format("Must be between {0} and {1}."),
		max: $.validator.format("May not be greater than {0}."),
		min: $.validator.format("Must be at least {0}."),
		username: "Only Letters, Numbers, Underscores, Dashes and '.' are allowed.",
		phone: "Please enter a valid phone number."
	});
}(jQuery));