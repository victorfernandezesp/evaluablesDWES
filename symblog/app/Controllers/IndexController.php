<?php
namespace App\Controllers;

use App\Models\Blog;

class IndexController extends BaseController
{

    // Función que maneja la acción de la página principal
    public function indexAction()
    {

        // Obtiene todos los blogs de la base de datos
        $data = [
            "blogs" => $blogs = Blog::all(),
            "user" => isset($_SESSION["user"]) ? $_SESSION["user"] : null,
            "perfil" => isset($_SESSION["perfil"]) ? $_SESSION["perfil"] : null,
        ];

        // Renderiza la plantilla de la página principal con los datos proporcionados
        return $this->renderHTML("index_view.twig", $data);
    }

    // Función que maneja la acción de la página "Acerca del Blog"
    public function aboutAction()
    {
        // Renderiza la plantilla de la página "Acerca del Blog"
        return $this->renderHTML("sobreElBlog.twig");
    }

    // Función que maneja la acción de la página de contacto
    public function contactoAction()
    {
        // Renderiza la plantilla de la página de contacto
        return $this->renderHTML("contactos.twig");
    }
}
