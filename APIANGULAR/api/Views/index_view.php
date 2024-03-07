<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modelo vista-controlador</title>
    </head>
    <body>
        <h1>Tus contactos</h1>
        <nav>
            <ul>
                <li><a href="http://contactosmvc.local/">Home</a></li>
            </ul>
        </nav>

        <?php
            if ($data["perfil"] == "invitado") {
                include_once "include/login_view.php";
            } else {
                echo "<p>Bienvenido ".$_SESSION["usuario"]["usuario"]."</p>";
                echo "<a href='http://contactosmvc.local/logout'>Cerrar sesión</a>";
            }
            include "include/search_view.php";
        ?>

        


        <br>
        <div>Información de cuenta</div>
        <p><?php
            if ($data["perfil"] == "usuario") {
                echo "<a href='http://contactosmvc.local/add'>Nuevo</a><br>";
            }
            foreach ($data["contacto"] as $key => $value) {
                echo $value["nombre"] . " " . $value["telefono"] . " " . $value["email"];

                if ($data["perfil"] == "usuario") {
                    echo " | <a href='http://contactosmvc.local/edit/".$value["id"]."'>Editar</a>";
                    echo " | <a href='http://contactosmvc.local/delete/".$value["id"]."'>Borrar</a>";
                }
                
                echo "<br>";
            }
        ?></p>

        <footer>
            <p>Este es el pie de página</p>
        </footer>
    </body>
</html>