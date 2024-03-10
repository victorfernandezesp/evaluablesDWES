<?php
namespace App\Controllers;

use App\Models\Users;
use Laminas\Diactoros\Response\RedirectResponse;
use \Respect\Validation\Validator as v;

class UserController extends BaseController
{

    // Función que maneja la acción de registro de usuarios
    public function userAction($request)
    {
        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() == "POST") {

            // Define un validador utilizando Respect\Validation para validar los campos del formulario de registro
            $validador = v::key('user', v::stringType()->notEmpty())
                ->key('password', v::stringType()->notEmpty())
                ->key('email', v::stringType()->notEmpty())
                ->key('profile', v::stringType()->notEmpty());

            try {
                // Intenta validar los datos de la solicitud usando el validador
                $validador->assert($request->getParsedBody());

                // Crea una nueva instancia de la clase Users y asigna valores a sus propiedades
                $user = new Users();
                $user->user = $request->getParsedBody()['user'];
                $user->password = password_hash($request->getParsedBody()['password'], PASSWORD_BCRYPT);
                $user->email = $request->getParsedBody()['email'];
                $user->profile = $request->getParsedBody()['profile'];

                // Guarda el objeto Users en la base de datos
                $user->save();
                header("Location: /");

            } catch (\Exception $e) {
                // Captura excepciones y muestra un mensaje de error
                $response = "Error: " . $e->getMessage();
            }
        }

        // Datos para pasar a la plantilla de vista (twig)
        $data = [
            "response" => $response ?? "", // Si no hay mensaje de respuesta, se establece en cadena vacía
        ];

        // Renderiza la plantilla de registro de usuarios con los datos proporcionados
        return $this->renderHTML("register_view.twig", $data);
    }

    // Función que maneja la acción de cierre de sesión
    public function getLogout()
    {
        // Elimina el usuario de la sesión y redirige al usuario a la página principal
        unset($_SESSION["user"]);
        header("Location: /");
    }
}