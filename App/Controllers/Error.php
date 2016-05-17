<?php
namespace App\Controllers;
use App\Core\Mvc\Controller;

class Error extends Controller
{
	public function beforeAction() {}
	
    protected function actionError($errors)
    {
		$this->view->errors = $errors;
        $this->view->display(__DIR__ . '/../Views/errors/errors.php');
    }
	
	protected function actionError404($error)
	{
		$this->view->error = $error;
		$this->view->display(__DIR__ . '/../Views/errors/error.php');
	}
}