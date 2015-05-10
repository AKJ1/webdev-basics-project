<section class="gallery">

	<div class="col-md-10 col-md-offset-1">
		<?php 
		if (isset($gallery_images)) {
			foreach ($gallery_images as $key => $row){?>
		<div class="image-div col-xs-6 col-sm-4 col-md-3 col-lg-2">
			<img class="img-responsive gallery-img" src=<?php echo 'data:' . $row['type'] . ';' . 'base64,' . base64_encode($row['content'] . '\"') ?> alt="">
		</div>

		<?php } }?>
	</div>
	<div  class="col-md-10 col-md-offset-1" >
		<?php if ($page > 0) {
			

		echo '<a href="' . strval($page-1) .'"' . '><button class="btn btn-primary ">Prev Page</button></a>';
			
		} ?>

		<?php echo ("<a href='" . strval($page+1) . '\'><button class="btn btn-primary pull-right">Next Page</button></a>');?>

	</div>

		

</section>




