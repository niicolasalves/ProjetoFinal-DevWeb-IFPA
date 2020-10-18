<?php
class Model {
    function __construct(){
        $this->db = new Database();
    }

    public function set($name, $value) {
        $this->$name=$value;
    }
}
?>