<?php

class App {

    function __construct() {
		
        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);
		
    }

    function autoload() {

       require_once ROOT . '/core/controller.php';

    }

    function require($path) {

        require ROOT . $path;

    }

    function start() {

            $this->require('/core/main.php');
            $controller = new Main();

    }
    
}

?>