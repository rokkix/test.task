<?php 

namespace App\Controllers;

use App\Core\Mvc\Controller;
use App\Core\Mvc\View;
use App\Models\Ad as ModelAd;
use App\Core\Classes\PageNav;

class Ad extends Controller
{
	public function beforeAction() {}
	
	protected function sortName() {
		
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
		$this->view->display(__DIR__ . '/../../catalog.php');
			exit();
		}
		
		if (isset($_GET['start']) and isset($_GET['sort'])) {
			$start = isset($_GET['start']) ? $_GET['start'] : 0;
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
			$this->view->display(__DIR__ . '/../../catalog.php');
			exit();
			
			
		}
		
		
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
			$this->view->displayq();
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
		$this->view->display(__DIR__ . '/../../catalog.php');
	}
	
		
	
	protected function actionSortByValues() {
		
		$data = $_GET;
		
		$start = isset($_GET['start']) ? $_GET['start'] : 0;
		$resl = ModelAd::SortByValue($data, $start);
		
		
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
		$this->view->display(__DIR__ . '/../../catalog.php');
			
		
		
		
		
	}
	
}

?>