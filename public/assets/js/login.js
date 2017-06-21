var Login = function() {
	"use strict";

	$('form.form-upgrade').hide();

	var runLoginValidator = function() {
		var form = $('.form-login');
		var formInput = form.find('input[type=text], input[type=email], input[type=password], :selected, :checked');
		var errorHandler = $('.errorHandler', form);
		form.validate({
			rules : {
				username : {
					required : true
				},
				password : {
					minlength : 1,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				login(form);
				return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
	};

	var runCheckValidator = function() {
		var form = $('.form-check');
		var errorHandler = $('.errorHandler', form);
		form.validate({
			rules : {
				username : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				check(form);
				return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
	};

	var runUpgradeValidator = function() {
		var form = $('.form-upgrade');
		var errorHandler = $('.errorHandler', form);
		form.validate({
			rules : {
				username : {
					minlength : 9,
					number: true,
					required : true
				},
				email : {
					required : true
				},
				sbu : {
					minlength : 5,
					required : true
				},
				level : {
					required : true
				},
				password : {
					minlength : 6,
					regExpPass : true,
					required : true
				},
				rePassword : {
					required : true,
					minlength : 6,
					equalTo : "#password"
				}
			},
			messages:{
				password: "Least 6 characters, one upper case letter, one lower case letter, and one digit!"
			},
			submitHandler : function(form) {
				errorHandler.hide();
				upgrade(form);
				return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
	};

	var runForgotValidator = function() {
		var form2 = $('.form-forgot');
		var errorHandler2 = $('.errorHandler', form2);
		form2.validate({
			rules : {
				email : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				form2.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
		form3.validate({
			rules : {
				full_name : {
					minlength : 2,
					required : true
				},
				address : {
					minlength : 2,
					required : true
				},
				city : {
					minlength : 2,
					required : true
				},
				gender : {
					required : true
				},
				email : {
					required : true
				},
				password : {
					minlength : 6,
					required : true
				},
				password_again : {
					required : true,
					minlength : 5,
					equalTo : "#password"
				},
				agree : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				form3.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
			}
		});
	};

	function login(form){
		var arr = [];
		var input = $(form).find('input[type=text], input[type=email], input[type=password], :selected, :checked');

		input.each(function(index, el) {
			arr.push($(this).val());
		});

		ajaxPOST(arr, 'ajax/login');
	}

	function check(form){
		var arr = [];
		// var btnSubmit = form.find('button[type=submit]');
		var input = $(form).find('input[type=text], input[type=email], input[type=password], :selected, :checked');

		$('.form-check').find('button[type=submit]').attr('disabled',true);

		input.each(function(index, el) {
			arr.push($(this).val());
		});

		var data = ajaxPOST(arr, 'ajax/checkuserdetail', null, true);
		var json = $.parseJSON(data);

		// btnSubmit.attr('disabled',true);

		if (json.notif) {
			var notif = [json.notif,json.headMsg,json.msg];
			notifChoice(notif);
		} else{
			var form = $('form.form-upgrade');
			form.find('input[name=nik]').val(json.nik);
			form.find('input[name=fullname]').val(json.fullname);
			form.find('input[name=email]').val(json.email);
			form.find('input[name=department]').val(json.deptname);
			form.find('input[name=company]').val(json.company);
			form.find('input[name=sbu]').val(json.sbu);
			form.find('select[name=level] option[value='+json.level+']').attr('selected',true);
			form.slideDown(400);
		};
		$('.form-check').find('button[type=submit]').removeAttr('disabled');
		// btnSubmit.removeAttr('disabled');
	}

	function upgrade(form){
		var arr = [];
		var input = $(form).find('input[type=text], input[type=email], input[type=password], :selected, :checked');

		var inputUser = $('.form-check input[name=username]').val();
		arr.push(inputUser);
		
		input.each(function(index, el) {
			if (!$(this).attr('disabled')) {
				arr.push($(this).val());
			};
		});
		
		// ajaxPOST(arr, 'ajax/upgradeuserdetail', null, true);
		var data = ajaxPOST(arr, 'ajax/upgradeuserdetail', null, true);
		var json = $.parseJSON(data);

		if (json.replace) {
			$('body .row .main-login').html(json.replace);
		} else {
			var notif = [json.notif,json.headMsg,json.msg];
			notifChoice(notif);
		}

	}

	function ajaxWithAlert(sInfo,d){
		swal({
			title: sInfo.title,
			text: sInfo.text,
			type: sInfo.type,
			showCancelButton: true,
			confirmButtonColor: "#007AFF",
			closeOnConfirm: true
		}, function(isConfirm) {
			if(isConfirm) {
				var trigger = $('.btn-form-filter');
				var url = 'ajax/approvereqnon';
				ajaxPOST ( d, url, trigger)
				} else {
					// btn.removeAttr('disabled');
				}
			
		});
	}

	return {
		//main function to initiate template pages
		init : function() {
			runLoginValidator();
			runCheckValidator();
			runUpgradeValidator();
			// runForgotValidator();
			// runRegisterValidator();
		}
	};
}();
