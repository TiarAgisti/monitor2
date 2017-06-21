var Others = function() {
	"use strict";
	var runfilterpr = function () {
		var dataString = '-';
		$.ajax
		({
			type: "POST",
			url: host+"ajax/listbuyer",
			data: dataString,
			cache: false,
			success: function(data)
			{
				console.log($("#buyer").html(data));
			} 
		});
		
		$('#buyer').on('change', function() {
			var dataString = 'buyer=' + $("#buyer").val() ;
			var isDirty = !this.options[this.selectedIndex].defaultSelected;
			if($("#buyer").val()!="")
			{
				$('#style').prop("disabled", false);
				if (isDirty) 
				{
					if (isDirty) {
						$('#kpno').prop("disabled", true);
						$("#style option[value='']").attr('selected', true)
						//$("#select2-style-container").select2("val", "");
						$("#kpno option[value='']").attr('selected', true)
						//$("#kpno").empty();
					}
				}
			}
			else
			{
				$('#style').prop("disabled", true);
				$("#style").empty();
				$("#kpno").empty();
			}
			
			if($("#buyer").val()!="")
			{
				// console.log($("#buyer").val());
				$.ajax
				({
					type: "POST",
					url: host+"ajax/liststyle",
					data: dataString,
					cache: false,
					success: function(data)
					{
						console.log($("#style").html(data));
					} 
				});
			}
		});
		
		
		$('#style').on('change', function() {
			var dataString = 'style='+$("#style").val()+'&BuyerCode='+$("#buyer").val();
			if($("#style").val()!="")
			{
				$('#kpno').prop("disabled", false);
			}
			else
			{
				$('#kpno').prop("disabled", true);
				$("#kpno").empty();
			}
			
			if($("#buyer").val()!="")
			{
				// console.log($('#style').val());
				$.ajax
				({
					type: "POST",
					url: host+"ajax/listkp",
					data: dataString,
					cache: false,
					success: function(data)
					{
						console.log($("#kpno").html(data));
					} 
				});
			}
		});
		
		
		
	}
	return {
		init: function (){
			runfilterpr();
		}
	}
}();