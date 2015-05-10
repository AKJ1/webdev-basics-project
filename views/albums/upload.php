
<fieldset class="col-md-6 col-md-offset-3 col-xl-4 col-xl-offset-4 col-xs-10 col-xs-offset-1">
	
	<legend>Upload Album (Select Many Images)</legend>
	<form id="albumform" action="/Album/Upload" method="POST" class="dropzone">
		
		<div class="dz-message">Drag files or click here to upload an album</div>	
		
	</form>
	<label for="album-name">Album</label>
	<input type="text"  form="albumform" class="form-control" name="album-name">
	<button id="submitbutton" class="btn btn-primary" type="submit" form="albumform">Upload Album.</button>
	<!-- 
	<input name="filesToUpload[]" id="filesToUpload" type="file" multiple=""  accept=".jpg,.gif,.psd,.png,.tga,.bmp" />
	<button class="btn btn-primary" type="submit">Upload</button> -->

</fieldset>
<script type="text/javascript">
	Dropzone.options.albumform = {
		maxFilesize: 15,
		autoProcessQueue: false,
		acceptedFiles:'image/*,.psd',
		paramName:'image',
		init: function(){
			var myDropzone = this;
			document.querySelector("#submitbutton").addEventListener("click", function(e) {
	      // Make sure that the form isn't actually being sent.
			  e.preventDefault();
			  e.stopPropagation();
			  myDropzone.processQueue();
			})
			  this.on("successmultiple", function(files, response) {
		      // Gets triggered when the files have successfully been sent.
		      // Redirect user or notify of success.
		      noty({ text: 'Sucess!'});
		      document.getElementById('albumform').reset();
		      window.location.href('/');
		    });
		    this.on("errormultiple", function(files, response) {
		    	noty({ text: 'Error!'});
		      // Gets triggered when there was an error sending the files.
		      // Maybe show form again, and notify user of error
		    })
		}
	}	

	Dropzone.init();
</script>