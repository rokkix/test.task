<?php 

namespace App\Controllers;

use App\Core\Mvc\Controller;
use App\Core\Mvc\View;
use App\Models\Ad as ModelAd;
use App\Core\Classes\PageNav;
use App\Core\Image;
use App\Core\Authorization;



//var_dump(__DIR__ . '/../Core/Classes/PHPExcel/IOFactory.php') ; die;

class Admin extends Controller
{
	
	public function action($action, $params = '') {
		
		Authorization::LogIn();
		if (true === Authorization::check()) {
			parent::action($action, $params = '');
		} else {
			$this->view->display(__DIR__ .  '/../Views/admin/authorization.php');
		}
	}
	
	public function beforeAction() {}
	
	protected function  actionCreate() {
		$this->view->display(__DIR__ . '/../Views/admin/form.php');
	}
	
	protected function  actionShowPanel() {
		$this->view->display(__DIR__ . '/../Views/admin/panel.php');
	}
	
	protected function actionSave(){
		//var_dump($_POST); die;
		//var_dump($_FILES); die;
		$post = $_POST;
		$image = $_FILES;
        if (empty($post)) {
          $this->redirect('/');
        }
        if (empty($post['id'])) {
			
            $ad = new ModelAd();
        } else {
            $ad = ModelAd::findById($post['id']);
        }
		$ad->fill($post)->save();
		if (!empty($image['image_upload'])) {
			Image::InsertImage($image, (int)$ad->id);
		}
		$this->redirect('/?act=One&ctrl=admin&id=' . $ad->id);
	}
	
	protected function actionImportXlsx() {
		$this->view->display(__DIR__ . '/../Views/admin/formx.php');
	}
	
	protected function actionAll(){
		
		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		
		if (isset($_GET['sort_id']) and $_GET['start'] >= 10) {
			$this->view->pages = ModelAd::findByPagesBrend($start, $_GET['sort_id']);
			$this->view->all = ModelAd::findByCount($_GET['sort_id']);
			$this->view->groupFuels = ModelAd::findGroupByFuel();
		$this->view->groupTransmissions = ModelAd::findGroupByTransmission();
		$this->view->groupDates = ModelAd::findGroupByDate();
		$this->view->modelGroups = ModelAd::findByGroup();
		$pageNav = new PageNav();
		$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
		//var_dump($this->view->pagen); die;
		//$this->view->ads = ModelAd::findAll();
		$this->view->groupModels = ModelAd::findByGroupByModel();
		$this->view->groupNames = ModelAd::findGroupByName();
		$this->view->display(__DIR__ . '/../Views/admin/catalog.php');
			exit();
		}
		
		if (isset($_GET['start']) and isset($_GET['sort'])) {
			
			if ($_GET['sort'] == 'max') {
				$this->view->pages = ModelAd::findByPages($start, $max = true);
			} else  { $this->view->pages = ModelAd::findByPages($start, $max = false, $min = true); }
			$this->view->all = ModelAd::findByCount();
			$pageNav = new PageNav();
			$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
			$this->view->modelGroups = ModelAd::findByGroup();
			$this->view->groupFuels = ModelAd::findGroupByFuel();
			$this->view->groupDates = ModelAd::findGroupByDate();
			$this->view->groupTransmissions = ModelAd::findGroupByTransmission();
			$this->view->groupModels = ModelAd::findByGroupByModel();
			$this->view->groupNames = ModelAd::findGroupByName();
			$this->view->display(__DIR__ . '/../Views/admin/catalog.php');
			exit();
			
			
		}
		
		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		//$sort = $_GET['type'];
		if (isset($_GET['sort'])){
			if ($_GET['sort'] == 'max') {
				$this->view->pages = ModelAd::findByPages($start, $max = true);
			} else  { $this->view->pages = ModelAd::findByPages($start, $max = false, $min = true); }
			
			$this->view->all = ModelAd::findByCount();
			$pageNav = new PageNav();
			$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
			$this->view->displayMax();
		}
		if ($_GET['sort_id']) {
			$this->view->pages = ModelAd::findByPagesBrend($start, $_GET['sort_id']);
			$this->view->all = ModelAd::findByCount($_GET['sort_id']);
			$pageNav = new PageNav();
			$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
			$this->view->displaya();
		} else {
		$this->view->pages = ModelAd::findByPages($start);
		
		}
		$this->view->all = ModelAd::findByCount();
		$this->view->groupFuels = ModelAd::findGroupByFuel();
		$this->view->groupTransmissions = ModelAd::findGroupByTransmission();
		$this->view->groupDates = ModelAd::findGroupByDate();
		$this->view->modelGroups = ModelAd::findByGroup();
		$pageNav = new PageNav();
		$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
		//var_dump($this->view->pagen); die;
		//$this->view->ads = ModelAd::findAll();
		$this->view->groupModels = ModelAd::findByGroupByModel();
		$this->view->groupNames = ModelAd::findGroupByName();
		$this->view->display(__DIR__ . '/../Views/admin/catalog.php');
	}
	
	
	protected function actionOne() {
		//echo 1111; die;
		$id = (int)$_GET['id'];
		//var_dump($id); die;
		if (empty($id)) {
			$this->redirect('/?ctrl=admin');
		}
		$ad = ModelAd::findById($id);
		if (null == $ad) {
			throw new Exception404('Страница с такой новостью не найдена');
		}
		$this->view->ad = $ad;
	
		
		$this->view->display(__DIR__ . '/../Views/admin/one.php');
	}
	
	protected function actionDelete() {
		$id = (int)$_GET['id'] ?: false;
		if (empty($id)) {
			$this->redirect('/?ctrl=admin');
		}
		$article = ModelAd::findById($id);
		$article->delete();
		$this->redirect('/?ctrl=admin');
	}
	
	protected function actionUpdate() {
		$id = (int)$_GET['id'] ?: false;
		if (empty($id)) {
			$this->redirect('/?ctrl=admin');
		}
		$ad = ModelAd::findById($id);
		$this->view->ad = $ad;
		$this->view->display(__DIR__ . '/../Views/admin/form.php');
	}
	
	protected function actionSortByValues() {
		//var_dump($_POST);
		$data = $_GET;
		
		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		$resl = ModelAd::SortByValue($data, $start);
		
		//$start = isset($_GET['start']) ? $_GET['start'] : 0;
		$this->view->pages = $resl[1];
		$this->view->all = $resl[0];
		//var_dump($this->view->all);
		$this->view->groupFuels = ModelAd::findGroupByFuel();
		$this->view->groupTransmissions = ModelAd::findGroupByTransmission();
		$this->view->groupDates = ModelAd::findGroupByDate();
		$this->view->modelGroups = ModelAd::findByGroup();
		$pageNav = new PageNav();
		$this->view->pagen = $pageNav->getLinks($this->view->all, 10, $start, 10, 'start' );
		//var_dump($this->view->pagen); die;
		//$this->view->ads = ModelAd::findAll();
		$this->view->groupModels = ModelAd::findByGroupByModel();
		$this->view->groupNames = ModelAd::findGroupByName();
		$this->view->display(__DIR__ . '/../Views/admin/catalog.php');
			
		
	}
		
		
	
	protected function actionaddAd() {
		//var_dump(__DIR__); die;
		if (isset($_FILES)) {
			 move_uploaded_file($_FILES['file_upload']['tmp_name'], __DIR__ . '/../Views/file/' . $_FILES['file_upload']['name']);
			 $File = __DIR__ . '/../Views/file/' . $_FILES['file_upload']['name'];
		}
	
		$Excel = \PHPExcel_IOFactory::load($File);
		 
		# Ч какой строки начинаютс§ данные
		$Start = 2;
		$Res = array();
		for ($i= $Start; $i <= 1000; $i++)
		{
			$Row = new ModelAd();
			//$Row->id = $i;
				
			//$Row->date = $Excel->getActiveSheet()->getCell('A'.$i )->getValue(); 
			# Њреобразовываем формат даты из MS в привычный
			//$Row->date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($oRow->date));
		   $Row->name = $Excel->getActiveSheet()->getCell('A'.$i )->getValue(); 
		   $Row->model = $Excel->getActiveSheet()->getCell('B'.$i )->getValue(); 
		   $Row->type_fuel = $Excel->getActiveSheet()->getCell('C'.$i )->getValue(); 
		   $Row->korobka = $Excel->getActiveSheet()->getCell('D'.$i )->getValue(); 
		   $Row->kuzov = $Excel->getActiveSheet()->getCell('E'.$i )->getValue(); 
		   $Row->privod = $Excel->getActiveSheet()->getCell('F'.$i )->getValue(); 
		   $Row->date = (int)$Excel->getActiveSheet()->getCell('G'.$i )->getValue(); 
		   $Row->artil = (int)$Excel->getActiveSheet()->getCell('H'.$i )->getValue(); 
		   $Row->price = (int)$Excel->getActiveSheet()->getCell('I'.$i )->getValue(); 
		   $Row->description = $Excel->getActiveSheet()->getCell('J'.$i )->getValue(); 
		   $Row->flag = 0;
			
		 
			if($Row->name == null) continue;
				
			$Res[] = $Row;
		}
			 
		 //echo "<pre>";
			//print_r($Res);
		// echo "</pre>";
		ModelAd::DeleteTable();
		foreach ($Res as $key) {
			$key->fillObject($key)->save();
		}
		$this->redirect('/?ctrl=admin');
	}
}