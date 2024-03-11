<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Victor Fernandez España">
    <title>Tus Portfolios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 2%;
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
        h2,
        h4 {
            color: #007BFF;
        }

        h4 {
            display: inline;
            margin: 1%;
        }

        p {
            margin-bottom: 20px;
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
            display: inline-block;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .job {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #fff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
            margin-left: 3%;
        }

        span {
            display: block;
            margin-bottom: 20px;
        }

        span a {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 2px;
        }

        span a:hover {
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
        <a href="/logout">Cerrar sesión</a>
    </nav>

    <?php
    echo "<h2>" . $data["portfolio"]["name"] . "</h2>";

    echo "<span>";
    echo "<h4>Experiencia</h4>";
    echo "<a href='/add/job'>Añadir</a>";
    echo "</span>";

    foreach ($data["portfolio"]["jobs"] as $job) {
        echo "<div class='job'>";
        echo "<span>";
        echo "<h4> Trabajo: " . $job["title"] . "</h4>";
        echo "<a href='/edit/job/" . $job["id"] . "'>Editar</a>";
        echo "<a href='/del/job/" . $job["id"] . "'>Eliminar</a>";
        echo "</span>";


        echo "<ul>";
        echo "<li> Descripcion: " . $job["description"] . "</li>";
        echo "<li> Fecha de Inicio: " . $job["start_date"] . "</li>";
        echo "<li> Fecha de Fin: " . $job["finish_date"] . "</li>";
        echo "<li> Logros: " . $job["achievements"] . "</li>";
        echo "</ul>";
        echo "</div>";
    }

    echo "<span>";
    echo "<h4>Proyectos</h4>";
    echo "<a href='/add/project'>Añadir</a>";
    echo "</span>";

    foreach ($data["portfolio"]["projects"] as $project) {
        echo "<div class='job'>";
        echo "<span>";
        echo "<h4> Proyecto: " . $project["title"] . "</h4>";
        echo "<a href='/edit/project/" . $project["id"] . "'>Editar</a>";
        echo "<a href='/del/project/" . $project["id"] . "'>Eliminar</a>";
        echo "</span>";

        echo "<ul>";
        echo "<li> Descripcion: " . $project["description"] . "</li>";
        echo "<li> Logo: " . $project["logo"] . "</li>";
        echo "<li> Technologies: " . $project["technologies"] . "</li>";
        echo "</ul>";
        echo "</div>";
    }

    echo "<span>";
    echo "<h4>Skills</h4>";
    echo "<a href='/add/skill'>Añadir</a>";
    echo "</span>";

    foreach ($data["portfolio"]["skills"] as $skill) {
        echo "<div class='job'>";
        echo "<span>";
        echo "<h4> Skill: " . $skill["name"] . "</h4>";
        echo "<a href='/edit/skill/" . $skill["id"] . "'>Editar</a>";
        echo "<a href='/del/skill/" . $skill["id"] . "'>Eliminar</a>";
        echo "</span>";

        echo "</div>";
    }

    echo "<span>";
    echo "<h4>Redes Sociales</h4>";
    echo "<a href='/add/social'>Añadir</a>";
    echo "</span>";

    foreach ($data["portfolio"]["socialNetworks"] as $socialNetwork) {
        echo "<div class='job'>";

        echo "<span>";
        echo "<h4> Red: " . $socialNetwork["name"] . "</h4>";
        echo "<a href='/edit/social/" . $socialNetwork["id"] . "'>Editar</a>";
        echo "<a href='/del/social/" . $socialNetwork["id"] . "'>Eliminar</a>";
        echo "</span>";
        echo "<h5> URL: <a href='" . $socialNetwork["url"] . "' target='_blank'>" . $socialNetwork["url"] . "</a></h5>";
        echo "</div>";
    }

    ?>
</body>

</html>