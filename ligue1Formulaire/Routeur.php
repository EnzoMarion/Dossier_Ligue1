<?php

class Router {
    private array $routes;

    public function __construct() {
        $this->routes = [];
    }

    public function addRoute($url, $controller) {
        $this->routes[$url] = $controller;
    }

    public function execute($url) {
    echo "Executing route for URL: $url<br>";
    if (array_key_exists($url, $this->routes)) {
        $controllerFile = $this->routes[$url];
        if (file_exists($controllerFile)) {
            include_once($controllerFile);
        } else {
            echo "Erreur : Contrôleur non trouvé";
        }
    } else {
        echo "Page non trouvée (Erreur 404)";
    }
}

}
