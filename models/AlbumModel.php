<?php 
namespace Models;
/**
* 
*/
class AlbumModel extends BaseModel
{
	
	function __construct()
	{
		parent::__construct(array('table'=>'albums', 'limit' => 15, 'columns' => '*' ));
	}
}

?>
