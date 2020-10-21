<?php 
    class App {
        protected $controller = "Home";
        protected $action = "load";
        protected $params = [];
        function __construct() {
            $arr = $this->processURL();
            if(file_exists("./mvc/controller/{$arr[0]}.php")){
                $this->controller = $arr[0];
            }
            require_once "./mvc/controller/{$this->controller}.php";
            $this->controller = new $this->controller;
            unset($arr[0]);
            if(method_exists($this->controller,$arr[1])){
                $this->action = $arr[1];
            }
            unset($arr[1]);
            $params = array_values($arr);
            call_user_func_array([$this->controller,$this->action],$params);
        }
        function processURL()
        {
            if(isset($_GET['url'])){
                return explode('/',$_GET['url']);
            }
            else return [];
        }
    }
?>