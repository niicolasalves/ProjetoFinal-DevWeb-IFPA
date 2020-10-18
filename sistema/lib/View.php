<?php
class View {
    public function render($page, $no_include = false){
        if($no_include){
            require('views/' . $page . '.php');
        } else {
            require('views/layout_header.php');
            require('views/' . $page . '.php');
            require('views/layout_footer.php');
        }
    }

    public function data($page){
        require('views/' . $page . '.php');
    }
    
	public function set($name, $value) {
        $this->$name=$value;
    }
	
	public function get($name) {
        return $this->$name;
    }
}
?>