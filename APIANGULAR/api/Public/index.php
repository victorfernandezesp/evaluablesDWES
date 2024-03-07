<?php
    use App\Core\Router;
    use App\Controllers\ContactosController;
    use App\Controllers\AuthController;

    require "../bootstrap.php";

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
    }

    $router = new Router();
    $router->add(array(
        "name" => "home",
        "path" => "/^\/$/",
        "action" => [ContactosController::class, "indexAction"],
        "auth" => ["invitado", "usuario"])    
    );

    $router->add(array(
        "name" => "login",
        "path" => "/^\/login$/",
        "action" => [AuthController::class, "loginAction"],
        "auth" => ["invitado", "usuario"])    
    );

    $router->add(array(
        "name" => "logout",
        "path" => "/^\/logout$/",
        "action" => [AuthController::class, "logoutAction"],
        "auth" => ["invitado", "usuario"])    
    );

    $router->add(array(
        "name" => "addContacto",
        "path" => "/^\/add$/",
        "action" => [ContactosController::class, "setAction"],
        "auth" => ["usuario"])    
    );

    $router->add(array(
        "name" => "editContacto",
        "path" => "/^\/edit\/\d+$/",
        "action" => [ContactosController::class, "editAction"],
        "auth" => ["usuario"])    
    );
    $router->add(array(
        "name" => "delContacto",
        "path" => "/^\/delete\/\d+$/",
        "action" => [ContactosController::class, "deleteAction"],
        "auth" => ["usuario"])    
    );
    $router->add(array(
        "name" => "seaContacto",
        "path" => "/^\/search\?q=.+$/",
        "action" => [ContactosController::class, "searchAction"],
        "auth" => ["invitado", "usuario"])    
    );

    $request = $_SERVER['REQUEST_URI'];
    $route = $router->match($request);
    
    if ($route) {
        if (in_array($_SESSION['perfil'], $route['auth'])) {
            $className = $route['action'][0];
            $classMethod = $route['action'][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            echo "No autorizado";

        }
        
    } else {
        echo "Página no encontrada";
    }

?>