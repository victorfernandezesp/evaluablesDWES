<?php

namespace App\Controllers;


class ComandasController extends BaseController
{
    public function comandasAction()
    {
        $data = array(
            "perfil" => $_SESSION['perfil'],
        );
        $this->renderHTML("../app/Views/comandas_view.php", $data);

    }

    public function completadoAction()
    {
        if(isset($_POST['comanda']) && !empty($_POST['comanda']))
        {
            $comanda = $_POST['comanda'];
            $ruta_archivo = "../public/comandas/" . $comanda;
            $ruta_archivo_completado = str_replace("pendiente", "completado", $ruta_archivo);
            rename($ruta_archivo, $ruta_archivo_completado);
            header("Location: /comanda");
        }
    }
    
    
}