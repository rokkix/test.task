<?php 

namespace App\Core\Dbase;
use App\Core\Mvc\TSinglton;


class Db 
{
	use TSinglton;
	
    protected $dbh;
	
	protected function __construct() {
		try {
			$this->dbh = new \PDO('mysql:dbname=project1;host=localhost','root','');
			$this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
		} catch (\PDOException $e) {
			die('Error connect MySQL');
		}
	}
	
	public function query($sql, $class, $values = []){
		try {
			$sth = $this->dbh->prepare($sql);
			$res = $sth->execute($values);
			if (false !== $res) {
				return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
			}
		} catch (\PDOException $e) {
			die('Error query');
		}
	}
	
	public function queryCount($sql, $values = []) {
		$sth = $this->dbh->prepare($sql);
		$sth->execute($values);
		return (int)$sth->fetchColumn();
	}
	
	public function querybind($sql, $class,$value1, $value2) {
		//var_dump($value1); var_dump($value2); die;
		//var_dump($value3); die;
		$sth = $this->dbh->prepare($sql);
		
		
		$sth->bindValue(':limit', $value1, \PDO::PARAM_INT);
		$sth->bindValue(':offset', $value2, \PDO::PARAM_INT);
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
	}
	
	public function querybindsort($sql, $class, $value1, $value2, $value3, $value4) {
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':limit', $value1, \PDO::PARAM_INT);
		$sth->bindValue(':offset', $value2, \PDO::PARAM_INT);
		$sth->bindValue(':name', $value3, \PDO::PARAM_STR);
		$sth->bindValue(':model', $value4, \PDO::PARAM_STR);
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
	}
	
	public function querybindBrend($sql, $class, $value0, $value1, $value2) {
		//var_dump($value1); var_dump($value2); die;
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':name', $value0, \PDO::PARAM_STR);
		$sth->bindValue(':limit', $value1, \PDO::PARAM_INT);
		$sth->bindValue(':offset', $value2, \PDO::PARAM_INT);
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
	}
	
	public function execute($sql,$values = []){
		$sth = $this->dbh->prepare($sql);
		return $sth->execute($values);
	}
	
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
	
}


?>