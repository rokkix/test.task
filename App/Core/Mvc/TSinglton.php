<?php 

namespace App\Core\Mvc;

trait TSinglton
{
	protected static $instance;
	protected function __construct() {}
	
	public static function instance() {
		if (null === $instance) {
			static::$instance = new static;
		}
		return static::$instance;
	}
}

?>