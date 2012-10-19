<?php
class site extends Controllers{
	public function actionhello($data){
		return $this->render($data);
	}
}