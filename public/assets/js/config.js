var host = 'http://'+window.location.hostname+'/';


function notifChoice(a){
	if(a){
		toastr[a[0]](a[2],a[1]);
		return;
	}
}

function ajaxPOST ( d, url, trigger, a) { // d = data array ; a async
	var post;
	if (a == true) {
		$.ajaxSetup({async: false})
	};      	
	$.post(
		host+url,
		{data:d},
		function(data,status,xhr){
			
			if (a == true) {
        		return post = data;
        	} else {
        		var json = $.parseJSON(data);
    			if (json.notif) {
					var notif = [json.notif,json.headMsg,json.msg];
					notifChoice(notif);
				}
				if (json.reload === 'true') {
					location.reload();
				}
				if (trigger != null) {
    				trigger.trigger('click');
    			};
        	}; 
    	}
    );
    if (a == true) {
    	return post;
    }
}

function replaceHtmlNotif (icon,notif,msg,link){

	if ($.type(link) === "array") {
		var componentLinks = '<p class="links cl-effect-1">'+
								'<a href="'+host+'/'+link[0]+'">'+link[1]+'</a>'+
							'</p>';
	} else{
		var componentLinks = '';
	};

	var componentHtml = '<div class="panel panel-white no-radius text-center">'+
				'<div class="panel-body">'+
					'<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-'+icon+' fa-stack-1x fa-inverse"></i> </span>'+
					'<h2 class="StepTitle">'+notif+'</h2>'+
					'<p class="text-small">'+msg+'</p>'+componentLinks+						
				'</div>'+
			'</div>';
	return componentHtml;
}


function replaceHTML(d,target,ajax){
	target.html('');
	target.addClass('load1 csspinner');

	$.ajax({
			url: host+ajax,
			type: 'POST',
			dataType: 'html',
			data: {param: d},
		})
		.done(function(data) {
			target.removeClass('load1 csspinner');
			target.html(data);
		})
		.fail(function() {
			// console.log("error");
		})
		.always(function() {
			// console.log("complete");
		});
}

function fArray(form){
	var arr = [];
	var input = form.find('input[type=text], input[type=email], input[type=password], :selected, :checked');
	
	input.each(function(index, el) {
		arr.push($(this).val());
	});

	return arr;
}

$('.btn-logout').click(function(event) {
	ajaxPOST('','ajax/logout');
});

// swal.setDefaults({ confirmButtonColor: '#0000' });

// ========================================================================================
var Config = function (){
	"use strict";

	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};

	var runSetDefaultToastr = function () {
		toastr.options = {
		  "closeButton": true,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "1000",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	}

	var runMethodValidation = function () {
		jQuery.validator.addMethod("regExpPass", function (value, element, params) {	
			// var passwordStrengthRegex = /((?=.*d)(?=.*[a-z]).{6,15})/gm;
			// var passwordStrengthRegex = /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[A-Z]).{6,}/gm;
			var passwordStrengthRegex = /^(?=.*\d)(?=.*[a-zA-Z]).{6,}/gm;

			var re = new RegExp(passwordStrengthRegex);
            return value.match(passwordStrengthRegex); 
		}, "Least 6 characters, combine letter and digit number!");

		jQuery.validator.addMethod("notEqualto", function (value, element, params) {	
			var target = $( params );
			return value != target.val();
		}, "Don't use NIK for username!");

		jQuery.validator.addMethod("onlyMailPbrx", function (value, element, params) {	
			var pbrxRegex = /^[_\.0-9a-zA-Z-]+@([pbrx]+\.)+([co]+\.)+[id]{2,6}$/i;
			var re = new RegExp(pbrxRegex);
            return value.match(pbrxRegex); 
		}, "Not valid email address!");

	}

	var runDefaultDatatables = function () {
		$.extend( true, $.fn.dataTable.defaults, {
            "oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "Search : ",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				},
				"sProcessing": ""
			},
			"processing": true,
		    "bFilter" : false,
        	"bLengthChange": false,
        	"ordering": false,
        	"iDisplayLength" : 10
		} );

		
        /* Custom filtering function which will search data in column four between two values */
		$.fn.dataTable.ext.search.push(
		    function( settings, data, dataIndex ) {
		        var min = $('#fRange').val().split("-").join("");
		        var max = $('#sRange').val().split("-").join("");
		        var date = data[1].split("-").join(""); // use data for the age column
		 		
		 		if (min === '' && max === '') {
		 			 return true;
		 		};

		        if ( ( isNaN( min ) && isNaN( max ) ) ||
		             ( isNaN( min ) && date <= max ) ||
		             ( min <= date   && isNaN( max ) ) ||
		             ( min <= date   && date <= max ) )
		        {
		            return true;
		        }
		        return false;
		    }
		);
	};

	return {
		init: function (){
        	runSetDefaultValidation();
        	runSetDefaultToastr();
        	runMethodValidation();
        	runDefaultDatatables();
		}
	}


}();