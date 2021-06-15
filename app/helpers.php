<?php
// Los helpers se utilizan principalmente en las vistas y en los controladores

if(! functon_exists('view')) {
    function view($view) {
        return new App\Http\Response();
    }
}

if(! functon_exists('viewPath')) {
    function viewPath($view) {
        return __DIR__ . "/../views/$view.php";
    }
}