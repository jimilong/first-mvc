<?php

class App
{
    protected $controller = 'Home';

    protected $method     = 'index';

    protected $params     = [];

    public function __construct()
    {
        $uri = $this->parseUrl();

        if (file_exists('../app/Controllers/' .$uri[0]. '.php')) {
            $this->controller = $uri[0];
            unset($uri[0]);
        }

        require_once '../app/Controllers/' .$this->controller. '.php';

        $this->controller = new $this->controller;

        if (isset($uri[1])) {
            if (method_exists($this->controller, $uri[1])) {
                $this->method = $uri[1];
                unset($uri[1]);
            }
        }

        $this->params = $uri ? array_values($uri) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        $uri = $_SERVER['REQUEST_URI'];

        return $uri = explode('/', filter_var(rtrim($uri, '/'), FILTER_SANITIZE_URL));
    }

}