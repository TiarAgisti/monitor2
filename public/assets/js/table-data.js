var TableData = function() {
	"use strict";

	$('.modal').on('click','button[data-dismiss=modal]',function(){
		$('.modal-title').html('');
		$('.modal-body').html('');
		$('.modal-footer').html('');
	})

	//add by tiar
	var RetrieveBuyerNoDetail = function () {
		var table = $("#tbBuyerNoDetail");
		var target = table.attr('data-table');
		var buyerNo = table.attr('data-buyerno');
		
		var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
			if (processing) {
				$(this).find('tbody').addClass('load1 csspinner');
			} else{
				$(this).find('tbody').removeClass('load1 csspinner');
			};
		} ).DataTable({
			"bServerSide": true,
			"ajax": host+'purchase/'+target+'?buyerno='+buyerNo,
			"columnDefs": [{
				"targets": [ -1 ],
				"className": "dt-body-left",
			}]
		});
	};
	//end add
	
	//comment by tiar
	// var runkontrakkerja = function () {
	// 	var table = $("#kontrakkerja");
	// 	var target = table.attr('data-table');
	// 	var tblDetail = table.attr('data-detail');
	// 	//console.logconsole.log(host+'konrtakkerja/'+target);
	// 	var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
    //             if (processing) {
    //                 $(this).find('tbody').addClass('load1 csspinner');
    //             } else{
    //                 $(this).find('tbody').removeClass('load1 csspinner');
    //             };
    //         } ).DataTable({
    //         	"bServerSide": true,
	// 			"ajax": host+'kontrakkerja/'+target,
	//             "columnDefs": [{
	//             	"targets": [ -1 ],
	// 				"className": "dt-body-left",
	//             },
	// 			{
	//             	"targets": [ 2 ],
	// 				"className": "details-control",
	//             }]
    //         });
		
	// 	$('.btn-form-filter').click(function(){
    //     	var hari = $("#hari").val();
	// 		//console.log(hari);
    //     	oTable.ajax.url( host+'kontrakkerja/'+target+'?hari='+hari).load();
	// 		oTable.draw();
    //     	return false;
    //     });
		
		
	// 	table.find('tbody').on('click', 'td.details-control', function () {
	// 		var code = $(this).find('a').text();
	// 		var modal = $('.bs-modal-lg');
	// 		var modalData = jQuery.parseJSON(ajaxPOST(code,'ajax/tabledetail/'+tblDetail,null,true));

	// 		modal.find('.modal-title').html(modalData.title);
	// 		modal.find('.modal-body').html(modalData.body);
	// 		modal.find('.modal-footer').html(modalData.footer);

	// 		modal.modal('show');
	// 		$('a[data-toggle=popover]').popover();
	// 	});
	// };
	// var runtabledetail = function () {
	// 	var table = $("#tabletd");
	// 	var target = table.attr('data-table');
	// 	var code = table.attr('data-kode');
		
	// 	var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
	// 		if (processing) {
	// 			$(this).find('tbody').addClass('load1 csspinner');
	// 		} else{
	// 			$(this).find('tbody').removeClass('load1 csspinner');
	// 		};
	// 	} ).DataTable({
	// 		"bServerSide": true,
	// 		"ajax": host+'datadetail/'+target+'?kode='+code,
	// 		"columnDefs": [{
	// 			"targets": [ -1 ],
	// 			"className": "dt-body-left",
	// 		}]
	// 	});
	// };
	//end comment
	return {
		//main function to initiate template pages
		init : function() {
			RetrieveBuyerNoDetail(); // add by tiar
			//comment by tiar
			// runkontrakkerja();
			// runtabledetail();
			// end comment
		}
	};
}();
