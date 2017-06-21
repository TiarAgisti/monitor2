var webPBT = function (){
	"use scrict";

	var form = $('#form-data');

	var addElement = function (){
		var target = $('.control-element');
		var btnAdd = target.find('.btn[data-btn="add"]');
		var btnAdd = target.find('.btn[data-btn="remove"]');

		target.on('click', '.btn[data-btn="add"]', function(event) {

			var target = $(this).parent().parent().parent();
			var element = $(this).parent().parent().html();


			target.append('<div class="input-group margin-top-10">'+element);
		});

		target.on('click', '.btn[data-btn="remove"]', function(event) {

			var element = $(this).parent().parent();

			element.not(':first-child').remove();
			
			if (element.is(':first-child')) {
				element.find('input').val('');
			} ;

		});
	}

	var detailElement = function () {
		var btnDetail = $('.btn-detail');

		btnDetail.click(function(event) {
			/* Act on the event */
			var fKey = $(this).text();
			var sKey = $(this).parent().parent().find('td:nth-child(2)').text();

			var modal = $('.bs-modal-lg');

			var arr = [fKey,sKey];
			var modalData = jQuery.parseJSON(ajaxPOST(arr,'ajax/webjob/detail',null,true));

			modal.find('.modal-title').html(modalData.title);
			modal.find('.modal-body').html(modalData.body);
			modal.find('.modal-footer').html(modalData.footer);

			modal.modal('show');

			console.log(sKey);
		});
	}

	var fExec = function(){

		var btnConfirm = form.find('.btn-confirm');

		btnConfirm.click(function(event) {
			var arr = [];
			var input = form.find('input[type=text], input[type=email], input[type=password], :selected, :checked');
			var btnData = $(this).attr('data-btn');
			var url = 'ajax/webjob/'+btnData;

			input.each(function(index, el) {
				if (!$(this).hasClass('item-element')) {
					arr.push($(this).val());
				}				
			});

			form.find('.control-element').each(function(index, el) {
				var multiElem = [] ;
				$(this).find('input[type=text], input[type=email], input[type=password], :selected, :checked').each(function(index, el) {
					multiElem.push($(this).val());
				});
				arr.push(multiElem);

			});

			swal({
			title: 'Are you sure?',
			text: 'Confirm Position: '+arr[0]+' Location: '+arr[1],
			type: 'info',
			showCancelButton: true,
			confirmButtonColor: "#007AFF",
			closeOnConfirm: true
		}, function(isConfirm) {
			if(isConfirm) {
				ajaxPOST ( arr, url);
			}
			
		});

			return false;
		});

		// =========================================================================

		$('#table-job > tbody').on('click', 'a.btn-confirm', function(event) {
			var btnData = $(this).attr('data-btn');
			var td = $(this).parent().parent().find('td');

			var arr = [];
			var url = 'ajax/webjob/'+btnData;

			for (i = 0; i <= 1 ; i++) { 
			    arr.push(td.eq(i).text());
			}

			swal({
				title: 'Are you sure?',
				text: 'delete Position: '+arr[0]+' Location: '+arr[1],
				type: 'info',
				showCancelButton: true,
				confirmButtonColor: "#007AFF",
				closeOnConfirm: true
			}, function(isConfirm) {
				if(isConfirm) {
					var json = jQuery.parseJSON(ajaxPOST ( arr, url, null, true));

					if (json.row == true) {
						td.parent().remove();
					};
					var notif = [json.notif,json.headMsg,json.msg];
					notifChoice(notif);
				}
				
			});
						
		});
	}

	return {
		init : function (){
			addElement();
			detailElement();
			fExec();
		}
	}
}();