
<fieldset class="col-md-6 col-md-offset-3 col-xl-4 col-xl-offset-4 col-xs-10 col-xs-offset-1">
	
	<legend>Upload Album (Select Many Images)</legend>
	<form id="dropzone" action="/Image/Upload" class="dropzone">
		<div class="dz-message">Drag files or click here to upload an album</div>
	</form>
	<!-- 
	<input name="filesToUpload[]" id="filesToUpload" type="file" multiple=""  accept=".jpg,.gif,.psd,.png,.tga,.bmp" />
	<button class="btn btn-primary" type="submit">Upload</button> -->

</fieldset>
<script type="text/javascript">
	Dropzone.options.dropzone ={
		maxFilesize: 15,
		acceptedFiles:'image/*,.psd',
		paramName:'image'
		// autoProcessQueue:false
	}	
</script>