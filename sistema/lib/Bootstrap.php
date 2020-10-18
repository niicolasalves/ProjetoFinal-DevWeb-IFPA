<?php 

class Bootstrap {
	
	function __construct() {
		
		$url = isset($_GET['u']) ? $_GET['u'] : null;
		$url = rtrim($url, '/');
        $url = explode('/', $url);
        
        $url_controller = $url[0];
        $url_action = $url[1];
		
		// print_r($url);
		
		if (empty($url[0])) {

            // $url_controller = 'pedidos';
            // $url_action = 'index';

			require 'controllers/pedidos_controller.php';
			$controller = new Pedidos();
			$controller->loadModel('pedidos');
			$controller->index();
			return false;
		}
		
		$file = 'controllers/'.$url_controller.'_controller.php';
		if (file_exists($file)) {
			require $file;
		} else {
			$this->error();
		}
		
        $controller = new $url[0];
		$controller->loadModel($url[0]);
		
		if (isset($url[2])) {
			//echo $url[0].'   '.$url[1].'   '.$url[2].'   ';
			if (method_exists($controller, $url[1])) {
				$controller -> {$url[1]}($url[2]);
			} else {
				$this->error();
			}
		} else {
			if (isset($url[1])) {
				if(method_exists($controller, $url[1])) {
					$controller -> { $url[1] }();
				} else {
					$this->error();
				}
			} else {
				$controller->index();
			}
		}
		
	}
	
	function error() {
		require 'controllers/error.php';
		// $controller = new Error();
		// $controller->index();
		return false;
	}
}

?>