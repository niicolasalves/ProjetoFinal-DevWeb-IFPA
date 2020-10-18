<?php
class Database extends PDO {
    function __construct(){
        parent::__construct('mysql:host=localhost;dbname=ifstore_bd', 'root', '');
        parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}
?>