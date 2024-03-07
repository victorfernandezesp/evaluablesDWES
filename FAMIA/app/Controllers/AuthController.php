<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function loginAction()
    {
        if (!empty($_POST)) {
            // Validar datos
            if (isset($_POST['usuario']) && isset($_POST['contrasena']) && $_POST['usuario'] == USER && $_POST['contrasena'] == PASS) {
                $_SESSION['perfil'] = "usuario";
                header("Location: /comanda");
                
            } else {
                $this->renderHTML("../app/Views/login_view.php");
            }
        } else {
            $this->renderHTML("../app/Views/login_view.php");
        }
    }
}
