<?php
require_once "../vendor/autoload.php";
include_once "../bootstrap.php";

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\CarritoController;
use App\Controllers\AuthController;
use App\Controllers\ComandasController;

include_once "../app/Config/config.php";
define("productos", $productos);


session_start();

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = "invitado";
}

$router = new Router();
// Ruta de productos
$router->add(
    array(
        "name" => "home",
        "path" => "/^\/(pizzas|bebidas|postres)?$/",
        "action" => [IndexController::class, "indexAction"],
        "auth" => ["invitado", "usuario"]
    )
);
$router->add(
    array(
        "name" => "imagen",
        "path" => "/^\/imagen\/(.+)$/",
        "action" => [IndexController::class, "imagenAction"],
        "auth" => ["invitado", "usuario"]
    )
);
$router->add(
    array(
        "name" => "carrito",
        "path" => "/^\/carrito(\/agregar)?$/",
        "action" => [CarritoController::class, "carritoAction"],
        "auth" => ["invitado", "usuario"]
    )
);
$router->add(
    array(
        "name" => "Cerrar Sesion",
        "path" => "/^\/close_session$/",
        "action" => [IndexController::class, "cierraAction"],
        "auth" => ["invitado", "usuario"]
    )
);
$router->add(
    array(
        "name" => "Vacia Carrito",
        "path" => "/^\/vacia_carrito$/",
        "action" => [IndexController::class, "vaciaCarritoAction"],
        "auth" => ["invitado", "usuario"]
    )
);
$router->add(
    array(
        "name" => "crearTicketYComanda",
        "path" => "/^\/crearTicketYComanda$/",
        "action" => [CarritoController::class, "crearTicketYComanda"],
        "auth" => ["invitado","usuario"]
    )
);
$router->add(
    array(
        "name" => "login",
        "path" => "/^\/login$/",
        "action" => [AuthController::class, "loginAction"],
        "auth" => ["invitado","usuario"]
    )
);
$router->add(
    array(
        "name" => "comandas",
        "path" => "/^\/comanda$/",
        "action" => [ComandasController::class, "comandasAction"],
        "auth" => ["usuario"]
    )
);
$router->add(
    array(
        "name" => "completado",
        "path" => "/^\/completado$/",
        "action" => [ComandasController::class, "completadoAction"],
        "auth" => ["usuario"]
    )
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
        exit(http_response_code(401));
    }
} else {
    exit(http_response_code(404));
}
