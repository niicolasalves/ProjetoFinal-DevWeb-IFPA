<?php
class Controller {
    function __construct(){
		$this->view = new View();
		$this->header = new ControllerHeader();

		if (Session::get('loggedIn') == false) {
			Session::init();
		}

	}
	
	public function protect(){
		Session::init();
		$logged = Session::get('loggedIn');

		if($logged == false) {
			Session::destroy();
			header("Location: ./?u=login");
			exit;
		}
	}

    public function loadModel($name) {
        $path = 'models/'.$name.'_model.php';
		
		if(file_exists($path)) {
			require 'models/'.$name.'_model.php';
			
			$modelName = $name.'Model';
			$this->model = new $modelName;
		}		
	}
}

class ControllerHeader {
	public function location($url){
        header("Location: $url");
	}

	public function status($code){
		header("HTTP/1.1 $code OK");
	}
}
?>