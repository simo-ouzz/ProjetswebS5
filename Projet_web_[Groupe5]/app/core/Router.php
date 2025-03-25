<?php
// app/core/Router.php

class Router {
    private $routes = [];

    // Route GET
    public function get($route, $action) {
        $this->routes['GET'][$route] = $action;
    }

    // Route POST
    public function post($route, $action) {
        $this->routes['POST'][$route] = $action;
    }

    // Méthode pour exécuter la route
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Vérifier les routes définies
        foreach ($this->routes[$method] as $route => $action) {
            // Utiliser une expression régulière pour comparer les routes dynamiques (ex : /article/12)
            $pattern = $this->convertRouteToPattern($route);
            if (preg_match($pattern, $uri, $matches)) {
                // Si une correspondance est trouvée, traiter l'action
                array_shift($matches); // Enlever le premier élément (l'URL elle-même)
                if (is_callable($action)) {
                    call_user_func_array($action, $matches);
                } else {
                    list($controller, $method) = $action;
                    $controller = new $controller();
                    call_user_func_array([$controller, $method], $matches);
                }
                return;
            }
        }

        // Si aucune route ne correspond, afficher 404
        echo "404 Not Found";
    }

    // Convertir la route en un modèle de correspondance pour les expressions régulières
    private function convertRouteToPattern($route) {
        // Remplacer {param} par un groupe capturant pour l'expression régulière
        $route = preg_replace('/\{(\w+)\}/', '(\w+)', $route);
        // Ajouter le délimiteur de début et de fin de la regex
        return '#^' . $route . '$#';
    }
}
?>
