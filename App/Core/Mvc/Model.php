<?php 

namespace App\Core\Mvc;

use App\Core\Dbase\Db;
use App\Core\Mvc\Rules;
use App\Core\MultiException;


abstract class Model
{
	
	const TABLE = '';
	
	public function cleanSpecChar($value) {
		$value = trim($value);
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
   		return $value;
	}
	public static function DeleteTable() {
		$db = Db::instance();
		$db->execute('DELETE FROM catolog WHERE 1');
		return true;
	}
	
	public function isNew() {
		
		return empty($this->id);
	}
	
	public static function findAll() {
		$db = Db::instance();
		//echo 'SELECT * FROM ' . static::TABLE; die;
		return $db->query('SELECT * FROM ' . static::TABLE, static::class);
		
	}
	
	public static function findById($id) {
		$db = DB::instance();
		$sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id = :id';
		return $db->query($sql, static::class, [':id' => $id])[0];
	}
	
	public function save() {
		if ($this->isNew()) {
			$this->insert();
		} else {
			$this->update();
		}
	}
	
	public function insert(){
		//echo 111; die;
		$db = DB::instance();
		$columns = [];
		$values = [];
		foreach ($this as $key=>$value) {
			if ($key == 'id') {
				continue;
			} 
			$columns[] = $key;
			$values[':' . $key] = $value;
		}
		$sql = 'INSERT INTO ' . static::TABLE . '('. implode(', ',$columns) .') VALUES ('. implode(', ', array_keys($values)) .')';
		
		//var_dump($values); die;
		$db->execute($sql, $values);
		$this->id = $db->lastInsertId();
	}
	
	public function update() {
		
		$db = DB::instance();
		$columns = [];
		$values = [];
		foreach ($this as $key=>$value) {
			$values[':' . $key] = $value;
			if ($key == 'id') {
				continue;
			}
			$columns[] = $key . '=:' . $key;
		}
		$sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ',$columns) . ' WHERE id = :id';
		$db->execute($sql, $values);
	}	
	
	public function delete() {
		if ($this->isNew()) {
			return false;
		}
		$sql = 'DELETE FROM ' . static::TABLE . ' WHERE id = :id';
		$db = Db::instance();
		$db->execute($sql,[':id' => $this->id]);
		return true;
	}	
	
	public function fillObject($data) {
		//$this->model = $data->model;
		
		$data = get_object_vars($this);
		$keys = array_keys($data);
		//var_dump($keys); die;
		foreach ($keys as $attribute) {
			if ($attribute == 'id') {
				continue;
			}
			$this->{$attribute} = $this->cleanSpecChar($data[$attribute]);
		}	
		return $this;
	}	
		
	
	
	
	public function fill(array $data) {
    	$keys = array_keys($data);
		foreach ($keys as $attribute) {
			if ($attribute == 'id') {
				continue;
			}
			$this->{$attribute} = $this->cleanSpecChar($data[$attribute]);
	    }	
		return $this;
    }
	
	public function validate() {
		$e = new MultiException();
		$rules = Rules::filters();
		foreach ($this->conditions() as $condition) {
			foreach ($condition[1] as $filter) {
				$fun = $rules[$filter];
				if (false == $fun($this->{$condition[0]})) {
					 $e[] = new \Exception('Ошибка валидации свойства: ' . $condition[0] . ';  фильтр: ' . $filter);
				}
			}	
		}
		if (!empty($e[0])) {
			throw $e;
			return false;
        }
        return true;
	}
	
}