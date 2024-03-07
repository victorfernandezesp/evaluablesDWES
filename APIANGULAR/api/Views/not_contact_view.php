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
        ?>

        <br>
        <h2>Contacto no encontrado</h2>
        <a href="http://contactosmvc.local/">Volver a inicio</a>
        <footer>
            <p>Este es el pie de página</p>
        </footer>
    </body>
</html>