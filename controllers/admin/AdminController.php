<?php /**
 *
 */
namespace Controllers;
class AdminController extends \Controllers\BaseController {

	function __construct() {
		parent::__construct('views\admin\\', get_class(), 'admin');
	}
}?>