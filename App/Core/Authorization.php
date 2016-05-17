<?php 

namespace App\Core;

use App\Models\User;

class Authorization
{
	public static function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}
	
	public static function check() {
		//var_dump($_COOKIE); 
		//echo 111; die;
		if (isset($_COOKIE['id']) and isset($_COOKIE['_token']))
			//if (true)
		{
			
			$userdata = User::findUserById($_COOKIE['id']);
			//var_dump($userdata); die;
		//	var_dump($userdata->rememberToken) ; die;
		if ($userdata->id != $_COOKIE['id']) {
			echo 11; die;
		}
		
			if(($userdata->rememberToken !== $_COOKIE['_token']) or ($userdata->id != $_COOKIE['id'])) 
			{
				//echo 11; die;
				setcookie("id", "", time() - 3600*24*30*12, "/");
				setcookie("_token", "", time() - 3600*24*30*12, "/");
				return false;
			} else {
				return true;
			}
		}
		return false;	
	}
	
	public static function logIn() {
	//	echo 11; die;
		//var_dump($_COOKIE);
		if (isset($_POST['login']) and isset($_POST['password'])) {
			//echo 111; die;
			$userdata = User::findUserByLogin($_POST['login']);
			//var_dump($userdata);
		//var_dump($_POST); 
		//$password = $_POST['password'];
			//var_dump(password_verify($password, $userdata->password)); die;
			if (password_verify($_POST['password'], $userdata->password)) {
		//	echo 11; die;
				$userdata->rememberToken = md5(self::generateCode(30));
				$userdata->save();
				setcookie("id", $userdata->id, time()+600*60*24*30, "/");
				setcookie("_token", $userdata->rememberToken, time()+600*60*24*30, "/");
				//var_dump($_COOKIE); die;
				
				header('Location: /?ctrl=admin');
			}
			
		}
	}
}

?>