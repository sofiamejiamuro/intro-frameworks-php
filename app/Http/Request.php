<?php

namespace App\Http;

class Request
{
    protected $segments = [];
    protected $controller;
    protected $method;

    // Este constructor llena de datos las variables de arriba
    public function __construct()
    {
        // home/controller/method
        // platzi.test/servicios/index = [platzi.test,servicios,index ]
        //  $_SERVER['REQUEST_URI'] --> es el string de la url, el método explode lo convierte en un array
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);

        $this->setController();
        $this->setMethod();
    }

    //Aca se llena el controller y el metodo
    public function setController()
    {
        $this->controller = empty($this->segments[1])
            ? 'home'
            : $this->segments[1];
    }

    public function setMethod()
    {
        $this->method = empty($this->segments[2])
            ? 'index'
            : $this->segments[2];
    }

    // Se obtienen y transforman controllers y metodos
    public function getController()
    {
        //home, HomeController
        $controller = ucfirst($this->controller);

        return "App\Http\Controllers\\{$controller}Controller";
    }

    public function getMethod()
    {
        return $this->method;
    }

    // Metodo qu ejecuta la petición del usuario
    public function send()
    {
        $controller = $this->getController();
        $method = $this->getMethod();

        // Se dispara una respuesta
        $response = call_user_func([
            new $controller,
            $method
        ]);

        try {
            if($response instanceof Response) {
                $response->send();
            } else {
                throw new \Exception("Error Processing Request", 1);
            }
        } catch (\Exception $e) {
            echo "Details {$e->getMessage()}";
        }
    }
}