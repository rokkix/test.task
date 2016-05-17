<?php 

namespace App\Models;

use App\Core\Mvc\Model;
use App\Core\MultiException;

class News extends Model
{
	const TABLE = 'news';
	public $id;
	public $title;
	public $text;
	public $dt;
	
	public function conditions()
    {
        return [
            ['title', ['required', 'trim']],
            ['text', ['required', 'trim']],
        ];
    }

	
	
	
	public function fill(array $post) {
		parent::fill($post);
		$this->dt = date('Y-m-d H:i:s');
		$this->validate();
		return $this;
	}
}
?>