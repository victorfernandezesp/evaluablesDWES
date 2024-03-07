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
        <div>Editar contarcto</div>
        <form action="http://contactosmvc.local/edit/<?php echo $data["id"] ?>" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $data["nombre"]; ?>">

            <br>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo $data["telefono"]; ?>">

            <br>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $data["email"]; ?>">

            <br>

            <input type="submit" name="editar" value="Editar">
        </form>
        <footer>
            <p>Este es el pie de página</p>
        </footer>
    </body>
</html>