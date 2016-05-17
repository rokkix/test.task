<?php 

namespace App\Controllers;

use App\Models\User;
use App\Core\Authorization;
use App\Core\Mvc\Controller;
use App\Core\Mvc\View;

class Auth extends Controller
{
	public function beforeAction() {}
	
	protected function actionRegister() 
	{
		if (true === Authorization::check()) {
			$this->redirect('/admin/');
		}
		$this->view->display(__DIR__ .  '/../Views/register.php');
	}
	
	protected function actionCreate() {
		$post = $_POST;
       	if (!empty($post)) {
			if (null == User::findUserByLogin($_POST['login'])) {
				$newUser = new User;
				$newUser->fill($post)->save();
				$this->redirect('/admin/');
			}
		}
		$this->redirect('/admin/');
	}
}

?>