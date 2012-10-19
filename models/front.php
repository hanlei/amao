<?php

class FrontController{
	
	public $_controller, $_action, $_params, $_body;
	static $_instance;
	
	public static function getInstance(){
		if(! (self::$_instance instanceof self)){
			self::$_instance = new self();
		}
		return self::$_instance;		
	}
	
	public function __construct(){
		$request = $_SERVER['REQUEST_URI'];
		$splits = explode('/',trim($request,'/'));
		$this->_controller = !empty($splits[1])?$splits[1]:'index';
		$this->_action = !empty($splits[2])?$splits[2]:'index';
		//echo $this->_action."\n";echo "2";
		if(!empty($splits[3])){
			$keys = $values = array();
			for($idx = 3, $cnt = count($splits); $idx<$cnt; $idx++){
				if($idx %2 ==1){
					$keys[] = $splits[$idx];
				} else {
					$values[] = $splits[$idx];
				}
			}
			$this->_params = array_combine($keys,$values);
		}
	}
	
	public function route(){
		if(class_exists($controller = $this->getController())){
			$rc = new $controller();
			$action = 'action'.$this->getAction();
			if(method_exists($rc,$action)){
				$result = $rc->$action($this->getParams());
				$this->setBody($result);				
			} else {
				throw new Exception('Action');
			}
			
			/*
			if($rc->implementsInterface('IController')){
			
				if($rc->hasMethod($this->getAction())){
					
					//$controller = $rc->newInstance();
					//$method = $rc->getMethod($this->getAction());
					
				} 
				
			} else {
				throw new Exception('Interface');
			}
			*/
		} else{
			throw new Exception('Controller');
		}
	} 
	
	public function getParams(){
		return $this->_params;
	}
	
	public function getController(){
		return $this->_controller;
	}
	
	public function getAction(){
		return $this->_action;
	}
	
	public function getBody(){
		return $this->_body;
	}
	
	public function run(){
		echo $this->getBody();
	}
	
	public function setBody($body){
		$this->_body = $body;
	}
}
