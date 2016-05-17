<?php 


//namespace App\Core;
//use App\Core\TCollection;

class MultiException extends \Exception implements \Iterator, \ArrayAccess
{
	protected $data = [];
	
	public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return array_key_exists($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
	
	function rewind() {
    return reset($this->data);
  }
  function current() {
    return current($this->data);
  }
  function key() {
    return key($this->data);
  }
  function next() {
    return next($this->data);
  }
  function valid() {
    return key($this->data) !== null;
  }
}



?>