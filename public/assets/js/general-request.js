$(".js-example-basic-multiple").select2();
Dropzone.options.dropZone = {
	//options here
	maxFilesize: 2,
	addRemoveLinks: true,
	removedfile: function(file) {
		var name = file.name;        
		$.ajax({
		type: 'POST',
		url: host+'upload/unfile',
		data: "id="+name,
		dataType: 'html'
		});
		var _ref;
		return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        

		//console.log();
	},
	init: function() {
		this.on("maxfilesexceeded", function(file){
			alert("No more files please!");
		});
	}
}

$("#cat_req").change(function()
{
	var check=$(this).val();
	var id = $('option:selected', this).attr('data-id');
	var tapp = $('option:selected', this).attr('data-app');
	
	console.log($("#subkat").val());
	if(tapp=="0")
	{
		var dataString = 'tapp='+ tapp;
		
		$('#approval').prop('disabled', false);
		$('#subkat').prop('disabled', true);
		$('#subkat').prop('selectedIndex',0);
		$('.js-example-basic-multiple').select2('val', '');
		
		$.ajax
		({
			type: "POST",
			url: host+"other/appby",
			data: dataString,
			cache: false,
			success: function(data)
			{
				//$("#subkat").html(html);
				console.log($("#approval").html(data));
			} 
		});
	}
	else if(tapp=="2")
	{
		$('#subkat').prop('disabled', false);
		$('#approval').prop('disabled', true);
		$('#subkat').prop('selectedIndex',0);
		$('.js-example-basic-multiple').select2('val', '');
		
		var dataString = 'id='+ id;
		console.log(tapp);
		$.ajax
		({
			type: "POST",
			url: host+"other/reqglob_subkat",
			data: dataString,
			cache: false,
			success: function(data)
			{
				//$("#subkat").html(html);
				console.log($("#subkat").html(data));
			} 
		});
	}
	else if (tapp=="3")
	{
		$('#approval').prop('disabled', true);
		$('#subkat').prop('disabled', true);
		$('#subkat').prop('selectedIndex',0);
		$('.js-example-basic-multiple').select2('val', '');
		
	}
	else if (tapp=="1")
	{
		var dataString = 'tapp='+ tapp +' &id=' + id;
		
		$('#approval').prop('disabled', false);
		$('#subkat').prop('disabled', true);
		$('#subkat').prop('selectedIndex',0);
		$('.js-example-basic-multiple').select2('val', '');
		
		$.ajax
		({
			type: "POST",
			url: host+"other/appby",
			data: dataString,
			cache: false,
			success: function(data)
			{
				//$("#subkat").html(html);
				console.log($("#approval").html(data));
			} 
		});
	}
});

$("#subkat").change(function()
{
	var kode=$(this).val();
	var id = $('option:selected', this).attr('data-id');
	var tapp = $('option:selected', this).attr('data-app');
	
	if(tapp=="0")
	{
		$('#approval').prop('disabled', true);
		$('.js-example-basic-multiple').select2('val', '');
	}
	else
	{
		var dataString = 'tapp='+ tapp +' &id=' + id +' &kode=' + kode;
		$('#approval').prop('disabled', false);
		$('.js-example-basic-multiple').select2('val', '');
		
		$.ajax
		({
			type: "POST",
			url: host+"other/appby",
			data: dataString,
			cache: false,
			success: function(data)
			{
				//$("#subkat").html(html);
				console.log($("#approval").html(data));
			} 
		});
	}
});

var id = 0;
jQuery("#addrow").click(function() {
	id++;           
	var row = jQuery('#dynamicTable1 tbody tr:last-child').clone(true);
	if(row.find("input:text").val()=="")
	{
		alert("Please fill in all fields!!");
	}
	else
	{
		row.find("input:text").val("");
		row.attr('id',id);
		
		row.appendTo('#dynamicTable1');        
	}
	return false;
});        
	
$('.remove').on("click", function() {
  $(this).parents("tr").remove();
});

$('#save').click(function(){
	var i = 0;
	var arrM = [];
	arrM.push($('#fFactory option:selected').val());
	if($('#cat_req option:selected').attr('data-app')!=2)
	{
		arrM.push($('#cat_req option:selected').val());
	}
	else
	{
		arrM.push($('#subkat option:selected').val());
	}
	arrM.push($(".js-example-basic-multiple").val());
	var arrfile = [];
	var file ="";
	$('.dropzone .dz-preview').each(function(){
			file = $(this).children().find('.dz-filename').find('span').html()+';'+file;
			arrfile = [file];
		//console.log($(this).children().find('.dz-filename').find('span').html())
	});
			arrM.push(arrfile);
		//console.log(file);
		//arrM.push(attch);
	if($(".js-example-basic-multiple").val()=="" || $(".js-example-basic-multiple").val()== null)
	{
		alert("Approve dont mising");
	}
	else if(jQuery('#dynamicTable1 tbody tr:last-child').find("input:text").val()!= "" || $('.dropzone .dz-preview').children().find('.dz-filename').find('span').html()!=undefined)
	{
		$('#dynamicTable1 tbody tr').each(function(){
			var remark = $(this).find('#remark').val();
			var ket = $(this).find('#ket').val();
			var curr =$(this).find('#curr option:selected').val();
			var amount = $(this).find('#amount').val();
			var arr =  [];
			arr = [remark,ket,curr,amount];
			arrM.push(arr);
			
		});
		
		$.ajax({
			type:"POST",
			url: host+"ajax/save_reqglob",
			data : {data:arrM},
			success: function(data){
				location.reload();
				//return false
			}
		});
		
	}
	else
	{
		alert("Fill out one Attachment or Detail Item");
	}
});

$('#update').click(function(){
	var i = 0;
	var arrM = [];
	arrM.push($('#kode_req').val());
	arrM.push($('#nomor').val());
	arrM.push($('#fFactory option:selected').val());
	if($('#cat_req option:selected').attr('data-app')!=2)
	{
		arrM.push($('#cat_req option:selected').val());
	}
	else
	{
		arrM.push($('#subkat option:selected').val());
	}
	arrM.push($(".js-example-basic-multiple").val());
	arrM.push($('.dropzone .dz-preview').children().find('.dz-filename').find('span').html());
	arrM.push($("#oldfile").val());
	if( $('.dropzone .dz-preview').children().find('.dz-filename').find('span').html()!=undefined)
	{
		var file= "ada";
	}
	else
	{
		if($("#oldfile").val()!=="")
		{
			var file= "ada";
		}
		else
		{
			var file = "tidak ada";
		}
	}
	if($(".js-example-basic-multiple").val()=="" || $(".js-example-basic-multiple").val()== null)
	{
		alert("Approve dont mising");
	}
	else if(jQuery('#dynamicTable1 tbody tr:last-child').find("input:text").val()!= "" || file=="ada")
	{
		$('#dynamicTable1 tbody tr').each(function(){
			var remark = $(this).find('#remark').val();
			var ket = $(this).find('#ket').val();
			var curr = $(this).find('#curr option:selected').val();
			var amount = $(this).find('#amount').val();
			var arr =  [];
			arr = [remark,ket,curr,amount];
			arrM.push(arr);
			
		});
		
		$.ajax({
			type:"POST",
			url: host+"ajax/edit_reqglob",
		data : {data:arrM},
			success: function(data){
				location.reload();
				//return false
			}
		});
	}
	else
	{
		alert("Fill out one Attachment or Detail Item");
	}
});
