<?php 

namespace App\Models;

use App\Core\Dbase\Db;
use App\Core\Mvc\Model;
	
class User extends Model
{
	const TABLE = 'users';
    public $id;
    public $login;
    public $email;
    public $password;
    public $rememberToken;
	
	public function conditions()
    {
        return [
            ['login', ['required', 'trim']],
            ['password', ['required', 'trim']],
			['email', ['required', 'trim']],
			
        ];
    }
	
	public function fill(array $post) {
		parent::fill($post);
		$this->rememberToken = '';
		//var_dump($this); die;
		$this->password = password_hash($_POST['password'],PASSWORD_BCRYPT);
		$this->validate();
		//var_dump($this); die;
		return $this;
	}
	
	public static function findUserById($id)
    {
		
        $db = Db::instance();
		$sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
		$userdata = $db->query($sql, static::class, [':id' => $id])[0];
		return $userdata;
		
		
		//if(($userdata['rememberToken'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
		
		
		
        //$res = $db->query(
         //   'SELECT pass FROM ' . static::TABLE . ' WHERE login = :login', static::class, [':login' => $login]
      //  );
       // return (!empty($res[0])) ? $res[0] : false;;
    }
	
	public static function findUserByLogin($login) {
		$db = Db::instance();
		$sql = 'SELECT * FROM ' . static::TABLE . ' WHERE login = :login';
		$userdata = $db->query($sql, static::class, [':login' => $login])[0];
		return $userdata;
	}
	
	
	
}



?>