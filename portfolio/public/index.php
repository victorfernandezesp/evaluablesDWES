<?php
    require_once "../vendor/autoload.php";
    require_once "../bootstrap.php";

    use App\Core\Router;
    use App\Controllers\IndexController;

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
    }

    $router = new Router();
    $router->add(array(
        "name" => "home", // Nombre de la ruta
        "path" => "/^\/$/", // Expresión regular con la que extraemos la ruta de la URL
        "action" => [IndexController::class, "indexAction"], // Clase y metedo que se ejecuta cuando se busque esa ruta
        "auth" => ["invitado", "usuario"]) // Perfiles de autenticación que pueden acceder
    );
    $router->add(array(
        "name" => "registro", // Nombre de la ruta
        "path" => "/^\/registro/", // Expresión regular con la que extraemos la ruta de la URL
        "action" => [IndexController::class, "registroAction"], // Clase y metedo que se ejecuta cuando se busque esa ruta
        "auth" => ["invitado"]) // Perfiles de autenticación que pueden acceder
    );
    $router->add(array(
        "name" => "login", // Nombre de la ruta
        "path" => "/^\/login/", // Expresión regular con la que extraemos la ruta de la URL
        "action" => [IndexController::class, "loginAction"], // Clase y metedo que se ejecuta cuando se busque esa ruta
        "auth" => ["invitado"]) // Perfiles de autenticación que pueden acceder
    );


    $request = $_SERVER['REQUEST_URI']; // Recoje URL
    $route = $router->match($request); // Busca en todas las rutas hasta encontrar cual coincide con la URL
    
    if ($route) {
        if (in_array($_SESSION['perfil'], $route['auth'])) {
            $className = $route['action'][0];
            $classMethod = $route['action'][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            exit(http_response_code(401));
        }
    } else {
        exit(http_response_code(404));
    }
