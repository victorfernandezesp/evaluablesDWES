<?php
namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Laminas\Diactoros\Response\HtmlResponse;

class BaseController
{
    // Propiedad que almacena el motor de plantillas Twig
    protected $templateEngine;

    // Constructor que inicializa el motor de plantillas Twig
    public function __construct()
    {
        // Configuración del cargador de archivos para Twig, indicando la ubicación de las vistas
        $loader = new FilesystemLoader("../app/Views");

        // Creación de una instancia del motor de plantillas Twig
        $this->templateEngine = new Environment($loader, [
            "debug" => true,   // Habilita el modo de depuración de Twig
            "cache" => false   // Deshabilita el almacenamiento en caché de Twig (para desarrollo)
        ]);
    }

    // Función que renderiza una plantilla Twig y devuelve una respuesta HTML
    public function renderHTML($fileName, $data = [])
    {
        // Utiliza Twig para renderizar la plantilla con los datos proporcionados
        $content = $this->templateEngine->render($fileName, $data);

        // Devuelve una respuesta HTML utilizando el contenido renderizado
        return new HtmlResponse($content);
    }
}
?>