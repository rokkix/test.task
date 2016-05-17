<?php 

namespace App\Core\Mvc;

use App\Core\Mvc\View;

abstract class Controller
{
	protected $view;
		
	public function __construct() {
		$this->view = new View();
	}
			
	public function action($action, $params = '') {
		$methodName = 'action' . $action;
		$this->beforeAction();
		return $this->$methodName($params);
	}
	
	public function redirect($url, $code = 301) {
		header("Location: " . $url, true, $code);
		exit;
	}
}

?>