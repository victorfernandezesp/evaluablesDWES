<?php
// Definición del espacio de nombres para la clase
namespace App\Controllers;

// Importación de la clase Users desde el espacio de nombres App\Models
use App\Models\Users;

// Importación de la clase Validator del espacio de nombres Respect\Validation y se le da un alias 'v'
use \Respect\Validation\Validator as v;

// Definición de la clase AdminController que extiende de BaseController
class AdminController extends BaseController
{

    // Definición de la función indexAction que recibe un objeto $request como parámetro
    public function indexAction($request)
    {

        // Llama al método renderHTML de la clase padre (BaseController) para renderizar la plantilla "admin.twig"
        return $this->renderHTML("admin.twig");
    }
}
