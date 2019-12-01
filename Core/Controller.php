<?php

namespace Core;

abstract class Controller
{
    protected $route_params = [];

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    public function __call($name, $arguments)
    {
        $method = $name.'Action';
        if(method_exists($this, $method)) {
            if($this->before() !== FALSE) {
                call_user_func_array([$this, $method], $arguments);
                $this->after();
            }
        } else {
            echo get_class($this).' sınıfında '.$method.' metodu bulunamadı!';
        }
    }

    protected function before() {

    }

    protected function after() {

    }
}