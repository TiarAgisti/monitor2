var Dropzone = function() {
	var runUpldoadFile = function () {
		Dropzone.options.dropZone = {
			//options here
			addRemoveLinks: true,
			removedfile: function(file) {
				var name = file.name;        
				$.ajax({
				type: 'POST',
				url: host+'upload/file',
				data: "id="+name,
				dataType: 'html'
				});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        

				//console.log();
			}

		}
	};
	return {
		//main function to initiate template pages
		init : function() {
			runUpldoadFile();
		}
	};
}();