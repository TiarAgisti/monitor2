var ReportData =  function(){
	"use strict";

	var salesOrder = function(){
		// console.log('ok');
		var fShow = $('form.form-show');
		var tTarget = $('.tabbable');

		// $.ajaxSetup({
		//     beforeSend: function() { tTarget.addClass('load1 csspinner'); },
		//     complete: function() { tTarget.removeClass('load1 csspinner'); }
		// });
		$('.btn-show').mousedown(function(event) {
			tTarget.addClass('load1 csspinner');
		});

		$('.btn-show').click(function(event) {
			// console.log(event);			

			var data = fArray(fShow);
			// ajaxPOST(data,'ajax/sales/order',null,true);
			var Json = jQuery.parseJSON(ajaxPOST(data,'ajax/sales/order',null,true));

			$('#tab_qty').html(Json.qty);
			$('#tab_amount').html(Json.amount);
			
			tTarget.removeClass('load1 csspinner');
			// return false;
		});

		
		
	};

	return {

		init: function (){
			salesOrder();
		}
	};
}();