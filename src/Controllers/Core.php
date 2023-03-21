<?php

namespace Cupcake\Controllers;

/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */

class Core
{
    private $currentController = 'Home';
    private $currentMethod = 'index';
    private $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());

        $url = $this->getUrl();


        // Look in BLL for first value
        if (file_exists(dirname(__FILE__) . '/' . ucwords($url[0]) . '/' . ucwords(substr($url[0], 0, -1)) . '.php')) {

            // If exists, set as controller
            $this->currentController = ucwords(substr($url[0], 0, -1));

            // Require the controller
            require_once dirname(__FILE__) . "/" . ucwords($url[0]) . '/' . $this->currentController . '.php';

            $class_name = get_class($this);

            $reflection_class = new \ReflectionClass($class_name);

            $namespace = $reflection_class->getNamespaceName();

            $this->currentController = $namespace . '\\' . ucwords($url[0]) . "\\"  . $this->currentController;



            // Instantiate controller class
            $this->currentController = new $this->currentController();

            // Unset 0 Index
            unset($url[0]);
        }


        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
