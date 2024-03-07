<?php

namespace App\Controllers;

use MultipleIterator;

class IndexController extends BaseController
{
    public function indexAction($request)
    {
        $tamano = false;

        if ($request == "/") {
            header("Location: /pizzas");
        }
        $producto = ltrim($request, "/");

        if ($producto == "pizzas") {
            $tamano = true;
        }
        $data = [
            "productos" => productos[$producto],
            "tamano" => $tamano,
            "tipo" => $producto
        ];
        $this->renderHTML("../app/Views/index_view.php", $data);
    }
    public function imagenAction($request)
    {
        $imagen = "../app/Config/img/" . basename($request);
        if (file_exists($imagen)) {
            header("Content-Type: image/jpg");
            readfile($imagen);
        } else {
            exit(http_response_code(404));
        }
    }
    public function cierraAction()
    {
        unset($_SESSION['perfil']);
        header("Location: /login");
    }

    public function vaciaCarritoAction()
    {
        unset($_SESSION["carrito"]);
        header("Location: carrito");
    }
}
