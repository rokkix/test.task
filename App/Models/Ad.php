<?php 

namespace App\Models;
use App\Core\Dbase\Db;
use App\Core\Mvc\Model;

class Ad extends Model
{
	const TABLE = 'catolog';
	
	public function fill(array $post)
    {
		//var_dump($post); die;
		parent::fill($post);
		//var_dump($post); die;
		//$this->dt = date("Y-m-d H:i:s");
		//var_dump($this); die;
		//$this->validate();
		return $this;
	
    }
	
	
	
	public function findGroupByName() {
		$db = Db::instance();
		$res =  $db->query('SELECT name FROM ' . self::TABLE . ' GROUP BY name', static::class);
		return $res;
	}
	
	public function findByGroupByModel() {
		$db = Db::instance();
		$res =  $db->query('SELECT model FROM ' . self::TABLE . ' GROUP BY model', static::class);
		return $res;
	}
	
	public function findByCount($brend = false) {
		//var_dump($brend) ; die;
		$db = Db::instance();
		$value = [];
		$sql = 'SELECT COUNT(*) FROM catolog';
		if ($brend) {
			$sql .= ' WHERE name = :name';
			$value[':name'] = $brend;	
		}
		
		$res = $db->queryCount($sql, $value);
		return $res;
	}
	
	public function findByGroup() {
		$db = Db::instance();
		$sql = 'SELECT name, COUNT(id) as groupmodel FROM catolog GROUP BY name';
		return $res = $db->query($sql, static::class);
		
	}
	public function findGroupByFuel() {
		$db = Db::instance();
		$res =  $db->query('SELECT type_fuel FROM ' . self::TABLE . ' GROUP BY type_fuel', static::class);
		return $res;
	}
	public function findGroupByTransmission() {
		$db = Db::instance();
		$res =  $db->query('SELECT korobka FROM ' . self::TABLE . ' GROUP BY korobka', static::class);
		return $res;
	}
	public function findGroupByDate() {
		$db = Db::instance();
		$res =  $db->query('SELECT date FROM ' . self::TABLE . ' GROUP BY date', static::class);
		return $res;
	}
	public function SortByValue($data, $start ,$count = 10) {
		
		unset($data['act']);
		unset($data['ctrl']);
		unset($data['start']);
		//var_dump($data); die;
		$dati = [];
		$int = [];
		$db = Db::instance();
		$where = null;
		//var_dump($post);
		foreach ($data as $key=>$value) {
			
			if (($value == '0' and $key != 'pricel') or $value == '') {
				continue;
			}
			$int[':' . $key] = $value;
		if ($key == 'pricer' or $key == 'pricel' or $key == 'year_from' or $key == 'year_to') {
				
				continue ;
			}
			$dati[':' . $key] = $value;
			$where .= $key . '=:' . $key . ' AND '; 
		}
		    $range = ' price BETWEEN :pricel and :pricer AND date BETWEEN :year_from and :year_to ';
			$pagin = 'LIMIT :limit OFFSET :offset';
			$where .= $range; 
			
			$sql = 'SELECT COUNT(*) FROM catolog WHERE ' . $where ;
			//echo $sql; die;
			//echo $sql; die;
			$res0 = $db->queryCount($sql, $int);
			//var_dump($res0); die;
			
			
			
			$where .=$pagin;
			$int[':limit'] = $count;
			$int[':offset'] = $start;
			
			
		
			
			$sql = 'SELECT * FROM catolog WHERE ' . $where; 
			
			 
			 
			$res1 =  $db->query($sql, static::class, $int);
		//	var_dump()
			$res[] = $res0;
			$res[] = $res1;
			return $res;

		
		
	}
	
	public function findByPages($start,$max=false, $min=false, $count = 10) {
		$db = Db::instance();
		$sql = 'SELECT * FROM catolog LIMIT :limit OFFSET :offset';
		$sort = $_GET['type'];
		
		if ($max) {
			$sql = 'SELECT * FROM catolog ORDER BY '.$sort.' DESC LIMIT :limit OFFSET :offset';
			
		}
		if ($min) {
			$sql = 'SELECT * FROM catolog ORDER BY '. $sort .' LIMIT :limit OFFSET :offset';
		}
			
		//var_dump($values); die;
		$res = $db->querybind($sql, static::class, (int)$count, (int)$start);
		return $res;
		
	}
	
	public function findByPagesBrend($start, $brend, $count = 10) {
		$db = Db::instance();
		$sql = 'SELECT * FROM catolog WHERE name=:name LIMIT :limit OFFSET :offset';
			
		//var_dump($values); die;
		$res = $db->querybindBrend($sql, static::class, $brend, (int)$count, (int)$start);
		return $res;
		
	}
	
	public function findSortByPrice() {
		$db = Db::instance();
		//echo 'SELECT * FROM ' . static::TABLE; die;
		return $db->query('SELECT * FROM ' . self::TABLE, static::class);
	}
}