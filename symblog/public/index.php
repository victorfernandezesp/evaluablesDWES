<?php
require_once "../vendor/autoload.php";
require_once "../bootstrap.php";

use App\Controllers\AdminController;
use App\Controllers\BlogsController;
use App\Controllers\IndexController;
use Aura\Router\RouterContainer as router;
use App\Controllers\UserController;
use App\Controllers\AuthController;

// Inicia la sesión
session_start();

// Si no hay un perfil en la sesión, establece un perfil de "Invitado"
if (!isset($_SESSION['perfil'])) {
    $_SESSION['user'] = 'Invitado';
    $_SESSION['perfil'] = "Invitado";
}

// Crea una instancia de la solicitud utilizando Laminas\Diactoros
$request = \Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

// Crea un contenedor de enrutadores Aura\Router
$router = new Router();
$rutas = $router->getMap();

// Define las rutas y sus controladores asociados
$rutas->get("home", "/", [IndexController::class, "indexAction"]);
$rutas->get("about", "/about", [IndexController::class, "aboutAction"]);
$rutas->get("contactos", "/contactos", [IndexController::class, "contactoAction"]);
$rutas->get("blogForm", "/blogs", [BlogsController::class, "blogsAction"]);
$rutas->get("formuser", "/register", [UserController::class, "userAction"]);
$rutas->get("admin", "/admin", [AdminController::class, "indexAction", 'auth' => true]);
$rutas->get("LoginUserForm", "/login", [AuthController::class, "loginAction"]);
$rutas->get("logout", "/logout", [AuthController::class, "logoutAction", 'auth' => true]);

$rutas->post("addBlog", "/blogs", [BlogsController::class, "blogsAction", 'auth' => true]);
$rutas->post("addUser", "/register", [UserController::class, "userAction", 'auth' => true]);
$rutas->post("lognUser", "/login", [AuthController::class, "loginAction"]);

// Encuentra la ruta coincidente con la solicitud
$route = $router->getMatcher()->match($request);

// Si no hay coincidencia, devuelve un error 404
if (!$route) {
    exit(http_response_code(404));
}

// Obtiene el controlador y la acción asociada a la ruta
$handler = $route->handler;
$needsAuth = $handler['auth'] ?? false;

// Verifica si se requiere autenticación y si el perfil es "Invitado"
if ($_SESSION['perfil'] != "Invitado") {
    $needsAuth = false;
}

// Redirige a la página de inicio de sesión si se requiere autenticación y el perfil es "Invitado"
if ($needsAuth == true && $_SESSION['perfil'] == "Invitado") {
    header("Location: /login");
    exit;
}

// Crea una instancia del controlador y ejecuta la acción asociada
$controller = new $handler[0];
$action = $handler[1];
$response = $controller->$action($request);

// Imprime el contenido de la respuesta
echo $response->getBody();
