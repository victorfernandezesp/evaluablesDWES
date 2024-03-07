<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="SrPola">
        <title>Index View</title>
    </head>
    <body>
        <!-- crea un formulario con nombre apellido email y contraseña -->
        <form action="/registro" method="post">
            <input type="text" name="name" placeholder="Nombre">
            <input type="text" name="surname" placeholder="Apellido">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>