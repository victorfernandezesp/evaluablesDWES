<?php

namespace App\Controllers;

use App\Models\Contactos;

class ContactosController extends BaseController
{
    public function indexAction($request)
    {
        $contacto = Contactos::getInstancia();
        $data = [
            "contacto" => $contacto->getAll(),
            "perfil" => $_SESSION["perfil"]
        ];
        $this->renderHTML("../Views/index_view.php", $data);
    }

    public function setAction()
    {
        $data["perfil"] = $_SESSION["perfil"];

        if (!isset($_POST["enviar"])) {
            $this->renderHTML("../Views/add_view.php", $data);
        } else {
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

            $contacto = Contactos::getInstancia();
            $contacto->setNombre($nombre);
            $contacto->setTelefono($telefono);
            $contacto->setEmail($email);
            $contacto->set();

            header("Location: http://contactosmvc.local/");
        }
    }

    public function editAction($request)
    {
        $data["perfil"] = $_SESSION["perfil"];

        $parts = explode("/", $request);
        $id = end($parts);

        $contacto = Contactos::getInstancia();
        $datosContacto = $contacto->get($id);

        if ($datosContacto) {
            $procesaFormulario = false;

            $data["nombre"] = $datosContacto["nombre"];
            $data["telefono"] = $datosContacto["telefono"];
            $data["email"] = $datosContacto["email"];
            $data["id"] = $id;

            if (isset($_POST["editar"])) {
                $data["nombre"] = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
                $data["telefono"] = filter_var($_POST["telefono"], FILTER_SANITIZE_STRING);
                $data["email"] = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

                $procesaFormulario = true;
            }

            if (empty($data["nombre"]) || empty($data["telefono"]) || empty($data["email"])) {
                $procesaFormulario = false;
            }

            if ($procesaFormulario) {
                $contacto->setNombre($data["nombre"]);
                $contacto->setTelefono($data["telefono"]);
                $contacto->setEmail($data["email"]);
                $contacto->edit();
                header("Location: http://contactosmvc.local/");
            } else {
                $this->renderHTML("../Views/edit_view.php", $data);
            }
        } else {
            $this->renderHTML("../Views/not_contact_view.php", $data);
        }
    }


    public function deleteAction($request)
    {
        $data["perfil"] = $_SESSION["perfil"];

        $parts = explode("/", $request);
        $id = end($parts);

        $contacto = Contactos::getInstancia();
        $contacto->delete($id);

        header("Location: http://contactosmvc.local/");
        
    }
    public function searchAction($request)
    {
        $data["perfil"] = $_SESSION["perfil"];
        $contacto = Contactos::getInstancia();
        $data["contacto"] = $contacto -> getAllFromQuery($_GET["q"]);
        $this -> renderHTML("../Views/index_view.php", $data);
        
        
        
    }
}
