var Button = function() {
	"use strict";
	// add by tiar
	$('.modal').on('click','button[data-dismiss=modal]',function(){
		$('.modal-title').html('');
		$('.modal-body').html('');
		$('.modal-footer').html('');
	})
	//end

	var runmonitoring = function () {
		$('#btnmont').on('click', function() {
			var target = $(this).attr('data-target');
			var ftycode = $("#fFactory").val();
			var dari = $("#tglfrom").val();
			var sampai = $("#tglto").val();
			var table = $("#monitor");
			var target = table.attr('data-table');

			if(dari!="" & sampai!="")
			{
				var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
					if (processing) {
						$(this).find('tbody').addClass('load1 csspinner');
					} else{
						$(this).find('tbody').removeClass('load1 csspinner');
					};
				} ).DataTable({
					"bDestroy": true,
					"filter": false,
					//"paging":true, //edit by tiar 2 februari 2017
					"scrollY": 300,
					"bServerSide": true,
					"ajax": {
							"url" : host+'monitor/table?ftycode='+ftycode+'&dari='+dari+'&sampai='+sampai,
							 "type": "JSON"
					},
					//add by tiar 2 februari 2017
					"aoColumns": [
            						null,null,null,
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"}],
					"columnDefs": [{"targets": [ 0 ],"className": "details-control",},]
					//end add
				}).draw();

				/*setInterval( function () {
					oTable.ajax.reload();
				}, 1800000 );*/

			 	

			}
			else
			{
				swal({
						title: "Please fill filter!!!",
						type : "warning"
					});
			}

		});

		$('#btncari').on('click', function() {
			var buyer = $("#buyer").val();
			var style = $("#style").val();
			var kpno = $("#kpno").val();
			var table = $("#tbl_prkp");
			var target = table.attr('data-table');
			

			if(buyer!="" & style!="" & kpno!="")
			{
				var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
					if (processing) {
						$(this).find('tbody').addClass('load1 csspinner');
					} else{
						$(this).find('tbody').removeClass('load1 csspinner');
					};
				} ).DataTable({
					"bDestroy": true,
					"filter": false,
					"bfilter": true, //add by tiar
					"ajax": host+'purchase/'+target+'?style='+style+'&kpno='+kpno,
					"scrollY": 300,
					"scrollX": true,
					"order": [[ 1, "desc" ]],
					"aoColumns": [
            						null,null,null,null,null,null,null,
									null,null,null,null,null,
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									null,null],
					//end add 
					"columnDefs": [{
						"targets": [ 0 ],
						"className": "details-control",
					},],
					"async":false
				});


				table.find('tbody').on('click', 'td:nth-child(7)', function () { // edit by tiar
					$('a[data-toggle="popover"]').popover(); // edit by tiar
				});

				table.find('tbody').on('click', 'td:nth-child(2)', function (){ // edit by tiar
					// comment by tiar
					/*var code = $(this).find('a').text();
					var kpno = $(this).attr('data-kpno');
					var item = $(this).attr('data-item');
					var garment = $(this).attr('data-garment');
					var color = $(this).attr('data-color');
					var pono = $(this).attr('data-pono'); */
					// end


					// add by tiar
					var currentRow = $(this).closest("tr")[0];
					var cells = currentRow.cells;
					var kpNO = cells[2].textContent;
					// console.log("KpNo = " + kpNO);
					var matContents = cells[5].textContent;
					// console.log("matContents = " + matContents);
					// var id = cells[16].textContent;
					// console.log("id = " + id);
					//end

					var modal = $('.bs-modal-lg');


					// var modalData = jQuery.parseJSON(ajaxPOST(code,'ajax/noteskp?kpno='+kpno+'&item='+item+'&garment='+garment+'&color='+color+'&pono='+pono,null,true));
					var modalData = jQuery.parseJSON(ajaxPOST(kpNO ,'ajax/detailsNotes?kpNo='+kpNO+'&matContents='+matContents,null,true)); // add by tiar
					// console.log(modalData);

					modal.find('.modal-title').html(modalData.title);
					modal.find('.modal-body').html(modalData.body);
					modal.find('.modal-footer').html(modalData.footer);

					modal.modal('show');
				});
			}
			else
			{
				swal({
						title: "Please fill filter!!!",
						type : "warning"
					});
			}

		});

		//add by tiar 10 februari 2017 filter mat contents
		$('#btncariDetail').on('click', function() {
			var buyer = $("#buyer").val();
			var style = $("#style").val();
			var kpno = $("#kpno").val();
			var matContents = $('input#txtFilter').val();
			var table = $("#tbl_prkp");

			if(buyer!="" & style!="" & kpno!="" & matContents!="")
			{
				var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
					if (processing) {
						$(this).find('tbody').addClass('load1 csspinner');
					} else{
						$(this).find('tbody').removeClass('load1 csspinner');
					};
				} ).DataTable({
					"bDestroy": true,
					"filter": false,
					"bfilter": true,
					"ajax": host+'purchase/RetrievePrkpByMatContents?style='+style+'&kpno='+kpno+'&matContents='+matContents,
					"scrollY": 300,
					"scrollX": true,
					"order": [[ 1, "desc" ]],
					"aoColumns": [
            						null,null,null,null,null,null,null,
									null,null,null,null,null,
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									{"sClass": "alignRight"},
									null,null],
					//end add 
					"columnDefs": [{
						"targets": [ 0 ],
						"className": "details-control",
					},],
					"async":false
				});


				table.find('tbody').on('click', 'td:nth-child(7)', function () { // edit by tiar
					$('a[data-toggle="popover"]').popover(); // edit by tiar
				});

				table.find('tbody').on('click', 'td:nth-child(2)', function (){ // edit by tiar

					// add by tiar
					var currentRow = $(this).closest("tr")[0];
					var cells = currentRow.cells;
					var kpNO = cells[2].textContent;
					// console.log("KpNo = " + kpNO);
					var matContents = cells[5].textContent;
					// console.log("matContents = " + matContents);
					// var id = cells[16].textContent;
					// console.log("id = " + id);
					//end

					var modal = $('.bs-modal-lg');


					// var modalData = jQuery.parseJSON(ajaxPOST(code,'ajax/noteskp?kpno='+kpno+'&item='+item+'&garment='+garment+'&color='+color+'&pono='+pono,null,true));
					var modalData = jQuery.parseJSON(ajaxPOST(kpNO ,'ajax/detailsNotes?kpNo='+kpNO+'&matContents='+matContents,null,true)); // add by tiar
					// console.log(modalData);

					modal.find('.modal-title').html(modalData.title);
					modal.find('.modal-body').html(modalData.body);
					modal.find('.modal-footer').html(modalData.footer);

					modal.modal('show');
				});
			}
			else
			{
				swal({
						title: "Please fill RMS / Item#!!!",
						type : "warning"
					});
			}
			
		});


		$('#btncari2').on('click', function() {
			var buyer = $("#buyer").val();
			var style = $("#style").val();
			var kpno = $("#kpno").val();
			var table = $("#tbl_orderstatus");
			var target = table.attr('data-table');

			
			// var dt = $('#tbl_orderstatus').DataTable();
			// alert( 'Column sum is: '+ dt.column( 6 ).data().sum() );

			

			if(buyer!="" & style!="" & kpno!="")
			{
				var oTable = table.on( 'processing.dt', function ( e, settings, processing ) {
					if (processing) {
						$(this).find('tbody').addClass('load1 csspinner');
					} else{
						$(this).find('tbody').removeClass('load1 csspinner');
					};
				} ).DataTable({
					"bDestroy": true,
					"filter": false,
					"ajax": host+'purchase/'+target+'?style='+style+'&kpno='+kpno,
					"scrollY": 300,
					"scrollX": true,
					"order": [[ 1, "desc" ]],
					//add by tiar
					"aoColumns": [
            						null,null,null,
									{"sClass": "alignRight"},
									null,null,null,null],
					"footerCallback": function ( row, data, start, end, display ) {
            							var api = this.api(), data;
 
										// Remove the formatting to get integer data for summation
										var intVal = function ( i ) {
											return typeof i === 'string' ?
												i.replace(/[\$,]/g, '')*1 :
												typeof i === 'number' ?
													i : 0;
										};
 
            							// Total over all pages
										var total = api.column( 3 ).data().reduce( function (a, b) {
												return intVal(a) + intVal(b);
										}, 0 );
 
										// // Total over this page
										var pageTotal = api
											.column( 3, { page: 'current'} )
											.data()
											.reduce( function (a, b) {
												return intVal(a) + intVal(b);
										}, 0 );

										var numFormat = $.fn.dataTable.render.number( '\,', '.', 0, '' ).display; //function to format number

            							// Update footer
										$( api.column( 1 ).footer() ).html(
											'Grand Total Qty = '+ numFormat(total)
										);

										// $( api.column( 5 ).footer() ).html(
										// 	''+ pageTotal +' (Grand Total Qty = '+ total +')'
										// );
        				},
					//end add

					"columnDefs": [{"targets": [ 0 ],"className": "details-control",},]
				
				});

				
				// $("#grandTotal").maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});


				// add by tiar
				table.find('tbody').on('click', 'td:nth-child(3)', function(){
					var buyerNo = $(this).find('a').text();
					var code = buyerNo;

					var currentRow = $(this).closest("tr")[0];
					var cells = currentRow.cells;
					var destination = cells[6].textContent;
					var deliveryDate = cells[7].textContent;
					var qty = cells[3].textContent; //add by tiar 9 mei 2017


					// console.log("buyer no = " + buyerNo);
					// console.log("code = " + code);
					// console.log("destination = "+ destination);
					// console.log("Delivery Date = "+deliveryDate);

					var modal = $('.bs-modal-lg');

					var modalData = jQuery.parseJSON(ajaxPOST(code,'ajax/BuyerNoDetail?buyerNo='+buyerNo+'&kpno='+kpno+'&style='+style+'&destination='+destination+'&deliverydate='+deliveryDate+'&qty='+qty,null,true));

					modal.find('.modal-title').html(modalData.title);
					modal.find('.modal-body').html(modalData.body);
					modal.find('.modal-footer').html(modalData.footer);

					modal.modal('show');
				});
				

				// end add
				//comment by tiar
				// table.find('tbody').on('click', 'td:nth-child(4)', function () {
				// 	$('a[data-toggle=popover]').popover();
				// });

				// table.find('tbody').on('click', 'td:last-child a', function (){
				// 	var code = $(this).find('a').text();
				// 	var kpno = $(this).attr('data-kpno');
				// 	var item = $(this).attr('data-item');
				// 	var garment = $(this).attr('data-garment');
				// 	var color = $(this).attr('data-color');
				// 	var pono = $(this).attr('data-pono');

				// 	var modal = $('.bs-modal-lg');
				// 	var modalData = jQuery.parseJSON(ajaxPOST(code,'ajax/noteskp?kpno='+kpno+'&item='+item+'&garment='+garment+'&color='+color+'&pono='+pono,null,true));

				// 	modal.find('.modal-title').html(modalData.title);
				// 	modal.find('.modal-body').html(modalData.body);
				// 	modal.find('.modal-footer').html(modalData.footer);

				// 	modal.modal('show');
				// });
				//end comment
			}
			
			else
			{
				swal({
						title: "Please fill filter!!!",
						type : "warning"
					});
			}



		});

		//add by tiar
		$('#btnNotes').on('click', function() {
			var kpno = $("#kpno").val();
			console.log("kp no = " + kpno);

			if (kpno != null){
				var modal = $('.bs-modal-lg');


				var modalData = jQuery.parseJSON(ajaxPOST(kpno ,'ajax/detailsNotesGlobal',null,true)); //test

				modal.find('.modal-title').html(modalData.title);
				modal.find('.modal-body').html(modalData.body);
				modal.find('.modal-footer').html(modalData.footer);

				modal.modal('show');
			}else{
				swal({
						title: "Please fill filter!!!",
						type : "warning"
					});
			}

		});
		//end add

		//add by tiar
		$('#btnExportPDF').on('click',function(){
			var kpno = $("#kpno").val();
			var styleno = $("#style").val();
			// console.log("kpno = " + kpno);
			if (kpno != null){
				window.location.href = 'purchase/BomPDF?styleno='+styleno+'&kpno='+kpno;
			}else{
				swal({
						title: "Please fill filter!!!",
						type : "warning"
					});
			}
		});
		// end add

		//add by tiar 26 januari 2017
		$('#btnSend').on('click', function() {
			var oTable = $('#tbl_prkp').dataTable();
			var rowcollection =  oTable.$(".call-checkbox:checked", {"page": "all"});
			var gloKp = '';
			var gloMatContents = '';
			var gloNotes;
			var populateNotes = '';
			// var notes = [];
			rowcollection.each(function(index,elem){
			    var checkbox_value = $(elem).val();
			    var currentRow = $(this).closest("tr")[0];
				var cells = currentRow.cells;
				var kpNO = cells[2].textContent;
				var matContents = cells[5].textContent;
				$.ajax({    //create an ajax request to load_page.php
			        type: "GET",
			        url: host+'purchase/RetrieveNotes?kpNo='+kpNO+'&matContents='+matContents,             
			        dataType: 'text',   //expect html to be returned                
			        success: function(response){
			        	if(populateNotes == '')
			        	{
			        		// notes = notes + 'No Kp = ' + kpNO + ' MatContents = ' + matContents + ' Notes = ' + response;
			        		populateNotes = response;
	        	        	 
			        	}
			        	else
			        	{
			        		populateNotes = populateNotes + ',' + response;
			        	}
			        	// $("#text").html(populateNotes);
			        	// gloNotes = populateNotes;
			        },
			        async: false
				});
				
    			// gloNotes = GetNotes(kpNO,matContents);

				if(gloKp == '' && gloMatContents == '')
				{
					gloKp = kpNO;gloMatContents = matContents;
				}
				else
				{
					gloKp = gloKp +','+kpNO;gloMatContents = gloMatContents + ',' + matContents;
				}
			});

			var modal = $('.bs-modal-lg');

			var modalData = jQuery.parseJSON(ajaxPOST(gloKp ,'ajax/PopulateNotes?matContents='+gloMatContents+'&notes='+populateNotes,null,true)); //test

			modal.find('.modal-title').html(modalData.title);
			modal.find('.modal-body').html(modalData.body);
			modal.find('.modal-footer').html(modalData.footer);

			modal.modal('show');

			// console.log("gloKp = " + gloKp);
			// console.log("gloMatContents = " + gloMatContents);
			// console.log("gloNotes = " + populateNotes);
		});
		//end add

	}



	function ajaxWithAlert(sInfo,data){
		swal({
			title: sInfo.title,
			text:sInfo.text,
			type:sInfo.type,
			showCancelButton:true,
			confirmButtonColor: "#007AFF",
			closeOnConfirm: true
		},function(isConfirm){
			if(isConfirm){
				console.log("isConfirm true");
				var trigger = $('#btnCari');
				// var trigger = $('.btn-form-filter');
				// console.log(trigger);
				var url = 'ajax/saveNotes';
				ajaxPOST ( data, url, trigger)
				// console.log("data push di ajaxWithAlert = " + data);
			}else{
				// console.log("isConfirm false");
			}
		});
	}

	//add by tiar
	$(".modal-footer").on("click",".modal-confirm",function(e){
		var data = [];
		// var id = $('.detail-id').text();
		// console.log("id= " + id);
		var kpNo = $('.detail-no-kp').text();
		// console.log("kpNO= " + kpNo);
		var matContents = $('.detail-matcontents').text();
		// console.log("matContents = " + matContents);
		var kpNotes = $('.modal-body textarea').val();
		// console.log("notes = " + kpNotes);

		var emailTo = $('input#txtEmail.form-control').val();
		// console.log("email to = " + emailTo);

		data.push(kpNo);
		data.push(matContents);
		data.push(kpNotes);
		// data.push(id);
		data.push(emailTo);

		var sInfo = {'title':'Are you sure save notes?','text':'# '+data[0],'type':'warning'};

		if(kpNotes === ''){
			swal({
				title: 'Please,',
				text: 'give a note !',
				type: 'warning'
			});
		}else{
			// console.log("data push = " + data);
			ajaxWithAlert(sInfo,data);
		};
		e.preventDefault;
	});
	// end

	//add by tiar 27 januari 2017 for populate send email
	$(".modal-footer").on("click","button#btnSave",function(e){
		var data = [];
		// var id = $('.detail-id').text();
		// console.log("id= " + id);
		var kpNo = $('.detail-no-kp').text();
		// console.log("kpNO= " + kpNo);
		var matContents = $('.detail-matcontents').text();
		// console.log("matContents = " + matContents);
		var kpNotes = $('.modal-body textarea').val();
		// console.log("notes = " + kpNotes);

		var emailTo = $('input#txtEmail.form-control').val();
		// console.log("email to = " + emailTo);

		data.push(kpNo);
		data.push(matContents);
		data.push(kpNotes);
		// data.push(id);
		data.push(emailTo);

		var sInfo = {'title':'Are you sure send email?','text':'# '+data[0],'type':'warning'};

		if(kpNo === ''){
			swal({
				title: 'Please,',
				text: 'Select Notes for send email !',
				type: 'warning'
			});
		}else if (emailTo === ''){
			swal({
				title: 'Please,',
				text: 'Give a email address !',
				type: 'warning'
			});
		}else{
			// console.log("data push = " + data);
			ajaxWithAlert(sInfo,data);
		};
		e.preventDefault;
	});
	//end add



	//add by tiar 2 februari 2017
	$(".modal-footer").on("click","button#btnSaveGlobal",function(e){
		var data = [];
		// var id = $('.detail-id').text();
		// console.log("id= " + id);
		var kpNo = $('.detail-no-kp').text();
		// console.log("kpNO= " + kpNo);
		var matContents = $('.detail-matcontents').text();
		// console.log("matContents = " + matContents);
		var kpNotes = $('.modal-body textarea').val();
		// console.log("notes = " + kpNotes);

		var emailTo = $('input#txtEmail.form-control').val();
		// console.log("email to = " + emailTo);

		data.push(kpNo);
		data.push(matContents);
		data.push(kpNotes);
		// data.push(id);
		data.push(emailTo);

		var sInfo = {'title':'Are you sure save notes?','text':'# '+data[0],'type':'warning'};

		if(kpNotes === ''){
			swal({
				title: 'Please,',
				text: 'give a note !',
				type: 'warning'
			});
		}else if (emailTo === ''){
			swal({
				title: 'Please,',
				text: 'Give a email address !',
				type: 'warning'
			});
		}else{
			// console.log("data push = " + data);
			ajaxWithAlert(sInfo,data);
		};
		e.preventDefault;
	});
	//end add
 	
	return {
		init: function (){
			runmonitoring();
			// $("#text").hide();
		}
	}


	



}();