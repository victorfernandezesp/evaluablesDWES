<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Victor Fernandez España">
    <title>Editar</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        h1,
        h2 {
            color: #007BFF;
            text-align: center;
        }

        p {
            margin-bottom: 20px;
            text-align: center;
        }

        nav {
            background-color: #007BFF;
            padding: 10px;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1> Area Portfolios </h1>
    <p>
        Bienvenido <?php echo $data["usuario"] ?>
    </p>
    <nav>
        <a href="/">Inicio</a>
        <a href="/logout">Cerrar sesión</a>
    </nav>
    <h2>Mi portfolio</h2>
    <?php
    switch ($data["elemento"]) {
        case "job":
            echo "<h2>TRABAJO</h2>";
            echo "<form action='/add/job' method='post'>";
            echo "<label for='title'>Título</label>";
            echo "<input type='text' name='title' id='title'>";
            echo "<label for='description'>Descripción</label>";
            echo "<input type='text' name='description' id='description'>";
            echo "<label for='start_date'>Fecha de inicio</label>";
            echo "<input type='date' name='start_date' id='start_date'>";
            echo "<label for='finish_date'>Fecha de fin</label>";
            echo "<input type='date' name='finish_date' id='finish_date'>";
            echo "<label for='achievements'>Logros</label>";
            echo "<input type='text' name='achievements' id='achievements'>";
            echo "<input type='submit' value='Añadir'>";
            echo "</form>";
            break;
        case "project":
            echo "<h2>PROYECTOS</h2>";
            echo "<form action='/add/project' method='post'>";
            echo "<label for='title'>Título</label>";
            echo "<input type='text' name='title' id='title'>";
            echo "<label for='description'>Descripción</label>";
            echo "<input type='text' name='description' id='description'>";
            echo "<label for='technologies'>Tecnologías</label>";
            echo "<input type='text' name='technologies' id='technologies'>";
            echo "<input type='submit' value='Añadir'>";
            echo "</form>";
            break;
        case "skill":
            echo "<h2>SKILLS</h2>";
            echo "<form action='/add/skill' method='post'>";
            echo "<label for='name'>Nombre</label>";
            echo "<input type='text' name='name' id='name'>";
            echo "<input type='submit' value='Añadir'>";
            echo "</form>";
            break;
        case "social":
            echo "<h2>SOCIAL NETWORK</h2>";
            echo "<form action='/add/social' method='post'>";
            echo "<label for='name'>Nombre</label>";
            echo "<input type='text' name='name' id='name'>";
            echo "<label for='url'>URL</label>";
            echo "<input type='text' name='url' id='url'>";
            echo "<input type='submit' value='Añadir'>";
            echo "</form>";
            break;
    }
    ?>
    </main>
</body>

</html>