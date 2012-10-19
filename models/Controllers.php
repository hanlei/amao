<?php
class Controllers {
	public $laylout;
	
	public function __construct(){
		$this->laylout = 'kaka';
	}
	
	public function render($data){
		$view = new View();
		$view->data = $data;
		return $view->render('../view/site.php');
	}
}