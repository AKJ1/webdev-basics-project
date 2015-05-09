<?php 


/**
* 
*/
class ImageModel extends \Models\BaseModel
{
	
	function __construct()
	{
		parent::__construct(array('table'=>'images', 'limit' => 15, 'columns' => '*' ));
		
	}
}


 ?>в