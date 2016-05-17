<?php 

namespace App\Core\Mvc;

class View
{
	protected $data = [];
	
	public function __set($k,$v) {
		$this->data[$k] = $v;
	}
	
	public function __get($v) {
		return $this->data[$v];
	}
	
	public function render($template) {
		ob_start();
		foreach ($this->data as $key=>$values) {
			//var_dump($this->data); die;
			$$key = $values;
			
		}
		include $template;
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	
	public function display($template) {
		echo $this->render($template);
	}
	public function displayq() {
		foreach ($this->data as $key=>$values) {
			//var_dump($this->data); die;
			$$key = $values;
			
		}
		foreach ($pages as $page) {
			
			
			printf('<li class="catalog__item">
								<a class="catalog__image" href="#">
								
									
									',false);
			if (file_exists(__DIR__ . '/../../Views/images/' . $page->id . '.jpeg')) {
					printf('<img src="/App/Views/images/' . $page->id . '.jpeg"  alt="" />', false);
			}
			else { printf('<img src="/App/Views/images/no_image.jpeg"  alt="" />', false); }	
			if ($page->flag) { printf('<div class="catalog__badge">Новинка</div>',false) ; }	
				
			printf('</a>
						<div class="catalog__description">
							<div class="catalog__wrap">
								<span class="catalog__price">$'.$page->price.'</span>
							</div>
							<span class="catalog__number">#'.$page->artil.'</span>
							<a class="catalog__model" href="#">'.$page->name.' '. $page->model .'</a>
								<p class="catalog__features">
								' . $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov . '
								</p>
							<p class="catalog__options" id="catalog__options">
								<span class="catalog__options-title">Описание:</span> '. $page->description .' 
							</p>
						</div>
					</li> ',false)		;				
		}
			printf('<div class="pagelist">
				
                   '. $pagen . '
                </div>',false);
		
		exit();
	}
	public function displayMax() {
		foreach ($this->data as $key=>$values) {
			//var_dump($this->data); die;
			$$key = $values;
			
		}
		
		foreach ($pages as $page) {
			
			
			printf('<li class="catalog__item">
								<a class="catalog__image" href="#">
								
									
									',false);
			if (file_exists(__DIR__ . '/../../Views/images/' . $page->id . '.jpeg')) {
					printf('<img src="/App/Views/images/' . $page->id . '.jpeg"  alt="" />', false);
			}
			else { printf('<img src="/App/Views/images/no_image.jpeg"  alt="" />', false); }	
			if ($page->flag) { printf('<div class="catalog__badge">Новинка</div>',false) ; }	
				
			printf('</a>
						<div class="catalog__description">
							<div class="catalog__wrap">
								<span class="catalog__price">$'.$page->price.'</span>
							</div>
							<span class="catalog__number">#'.$page->artil.'</span>
							<a class="catalog__model" href="#">'.$page->name.' '. $page->model .'</a>
								<p class="catalog__features">
								' . $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov . '
								</p>
							<p class="catalog__options" id="catalog__options">
								<span class="catalog__options-title">Описание:</span> '. $page->description .' 
							</p>
						</div>
					</li> ',false)		;				
		}
			printf('<div class="pagelist">
				
                   '. $pagen . '
                </div>',false);
		
		exit();
	}
	
	public function displayMin() {
		foreach ($this->data as $key=>$values) {
			//var_dump($this->data); die;
			$$key = $values;
			
		}
		foreach ($pages as $page) {
			
			
			printf('<li class="catalog__item">
								<a class="catalog__image" href="#">
								
									
									',false);
			if (file_exists(__DIR__ . '/../../Views/images/' . $page->id . '.jpeg')) {
					printf('<img src="/App/Views/images/' . $page->id . '.jpeg"  alt="" />', false);
			}
			else { printf('<img src="/App/Views/images/no_image.jpeg"  alt="" />', false); }	
			if ($page->flag) { printf('<div class="catalog__badge">Новинка</div>',false) ; }	
				
			printf('</a>
						<div class="catalog__description">
							<div class="catalog__wrap">
								<span class="catalog__price">$'.$page->price.'</span>
							</div>
							<span class="catalog__number">#'.$page->artil.'</span>
							<a class="catalog__model" href="#">'.$page->name.' '. $page->model .'</a>
								<p class="catalog__features">
								' . $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov . '
								</p>
							<p class="catalog__options" id="catalog__options">
								<span class="catalog__options-title">Описание:</span> '. $page->description .' 
							</p>
						</div>
					</li> ',false)		;				
		}
			printf('<div class="pagelist">
				
                   '. $pagen . '
                </div>',false);
		
		exit();
	}
	
	public function displaya() {
		foreach ($this->data as $key=>$values) {
			//var_dump($this->data); die;
			$$key = $values;
			
		}
		foreach ($pages as $page) {
			
			
			printf('<li class="catalog__item">
								<a class="catalog__image" href="#">
								
									
									',false);
			if (file_exists(__DIR__ . '/../../Views/images/' . $page->id . '.jpeg')) {
					printf('<img src="/App/Views/images/' . $page->id . '.jpeg"  alt="" />', false);
			}
			else { printf('<img src="/App/Views/images/no_image.jpeg"  alt="" />', false); }	
			if ($page->flag) { printf('<div class="catalog__badge">Новинка</div>',false) ; }	
				
			printf('</a>
						<div class="catalog__description">
							<div class="catalog__wrap">
								<span class="catalog__price">$'.$page->price.'</span>
							</div>
							<span class="catalog__number">#'.$page->artil.'</span>
							<a class="catalog__model" href="/?act=One&ctrl=admin&id='.$page->id.'">'.$page->name.' '.$page->name.'</a>
								<p class="catalog__features">
								' . $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov . '
								</p>
							<p class="catalog__options" id="catalog__options">
								<span class="catalog__options-title">Описание:</span> '. $page->description .' 
							</p>
						</div>
					</li> ',false)		;				
		}
			printf('<div class="pagelist">
				
                   '. $pagen . '
                </div>',false);
		
		exit();
	}
	
	
}
?>