<?php 

require __DIR__ . '/autoload.php';
//require __DIR__ . '/App/Core/Classes/PHPExcel.php';

use App\Controllers\Error;
use App\Core\Exception404;
use App\Core\Logging;

const DEFAULT_CONTROLLER = 'Ad';
const DEFAULT_ACTION = 'All';


//$start = isset($_GET['start']) ? $_GET['start'] : 0;
$act = isset($_GET['act']) ? ucfirst($_GET['act']) : 'All';
$ctrl = isset($_GET['ctrl']) ? ucfirst($_GET['ctrl']) : 'Ad';


//var_dump($act);
//var_dump($ctrl);

	try {
		$controllerClassName = 'App\\Controllers\\' . $ctrl;
		if (!class_exists($controllerClassName)) {
			//echo $controllerClassName; die;
			throw new Exception404('Страница не найдена. Ошибка 404');
		}
		$controller = new $controllerClassName;
		if (!method_exists($controller, 'action' . $act)) {
			throw new Exception404('Страница не найдена. Ошибка 404');
		}
		$controller->action($act);
	}	
	catch (Exception404 $e) {
		Logging::toFile($e);
		$controllerErr = new Error();
		$controllerErr->action('error404', $e->getMessage());
		exit(0);
	}
	catch (Exception $e) {
		$controllerErr = new Error();
		$controllerErr->action('error',$e);
		exit(0);
	} 
?>