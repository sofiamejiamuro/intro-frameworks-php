<?php

// Front Controller --> centralizar las peticiones
require __DIR__ . '/../vendor/autoload.php';

// Todo pasa a través de index
// crear una nueva instancia a partir de la clase Request
$request = new App\Http\Request;
$request->send();
