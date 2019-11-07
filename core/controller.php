<?php

abstract class Controller {

    private $route = [];

    private $args = 0;

    private $params = [];

    function __construct() {

        $this->route = explode('/', URI);
        
        $this->route[1] = str_replace('-','_',$this->route[1]);
		@$this->route[2] = str_replace('-','_',$this->route[2]);

        $this->args = count($this->route);

        $this->router();

    }

    private function router() {

        if (class_exists($this->route[1])) {

            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->uriCaller(2, 3);
                } else {
                    $this->uriCaller(0, 2);
                }
            } else {
                $this->uriCaller(0, 2);
            }

        } else {

            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->uriCaller(1, 2);
                } else {
                    $this->uriCaller(0, 1);
                }
            } else {
                $this->uriCaller(0, 1);
            }

        }

    }

	private function uriCaller($method, $param) {

        for ($i = $param; $i < $this->args; $i++) {
        	if($this->route[$i])
            	$this->params[$i] = $this->route[$i];	
        }

		if ($method == 0)
            call_user_func_array(array($this, 'Index'), $this->params);
        else {
    		$reflection = new ReflectionMethod( $this, $this->route[$method] );
			call_user_func_array(array($this, $this->route[$method]), $this->params);
		}
    }

	
    abstract function Index($lang = 'sk', $city = '0', $zd = '0', $za = '0', $time = '0');


}

?>