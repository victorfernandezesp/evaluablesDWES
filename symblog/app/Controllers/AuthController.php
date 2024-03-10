<?php
namespace App\Controllers;

use App\Models\Users;
use \Respect\Validation\Validator as v;

class AuthController extends BaseController
{
    // Función que maneja la acción de inicio de sesión
    public function loginAction($request)
    {
        // Verifica si la solicitud es de tipo POST
        if ($request->getMethod() == "POST") {

            // Define un validador utilizando Respect\Validation para validar los campos 'email' y 'password'
            $validador = v::key('email', v::stringType()->notEmpty())
                ->key('password', v::stringType()->notEmpty());

            try {
                // Intenta validar los datos de la solicitud usando el validador
                $validador->assert($request->getParsedBody());

                // Busca un usuario en la base de datos con el email proporcionado
                $user = Users::where("email", $request->getParsedBody()['email'])->first();

                // Verifica si el usuario existe y si la contraseña coincide utilizando password_verify
                if ($user && password_verify($request->getParsedBody()['password'], $user->password)) {

                    // Almacena el usuario en la sesión y redirige al usuario a la página principal
                    $_SESSION['user'] = $user;
                    $_SESSION['perfil'] = $user->profile;
                    header("Location: /");

                } else {
                    // Mensaje de error si el email o la contraseña son inválidos
                    $response = "Invalid email or password";
                }

            } catch (\Exception $e) {
                // Captura excepciones y muestra un mensaje de error
                $response = "Error: " . $e->getMessage();
            }
        }

        // Datos para pasar a la plantilla de vista (twig)
        $data = [
            "response" => $response ?? "", // Si no hay mensaje de respuesta, se establece en cadena vacía
        ];

        // Renderiza la plantilla de formulario de inicio de sesión con los datos proporcionados
        return $this->renderHTML("loginView.twig", $data);
    }

    // Función que maneja la acción de cierre de sesión
    public function logoutAction()
    {
        // Destruye la sesión y redirige al usuario a la página principal
        session_destroy();
        header("Location: /");
    }
}