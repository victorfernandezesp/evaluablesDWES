<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Victor Fernandez España">
    <title>Fa Mia Pizzeria</title>

    <style>
        /* Reset some default styles */
        body,
        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
        }

        /* Set a background color for the body */
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            font-size: 16px;
        }

        /* Limit max width of the main container */
        main {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Style the header */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        /* Style the navigation bar */
        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Style the main content */
        main {
            padding: 20px;
        }

        /* Style the product form */
        .mostrar {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            overflow: auto;
            /* Add scrollbar if needed */
        }

        form div {
            width: 100%;
            margin: 10px;
            padding: 15px;
            background-color: #fff4a1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 8px;
            box-sizing: border-box;

        }

        .tarjeta {
            background-color: #ffff;
        }

        .tarjeta:hover {
            background-color: #fada5e;
            box-shadow: 5 5 10px rgba(255, 244, 161, 0.5);
            color: #fff;
        }

        form img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        form p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        form input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-right: 10px;
        }

        form select {
            width: calc(100% - 22px);
            padding: 8px;
            margin-top: 10px;
        }

        form input[type="submit"] {
            background-color: #fada5e;
            color: #fff;
            padding: 12px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        form input[type="submit"]:hover {
            background-color: red;
        }

        /* Style the footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            bottom: 0;
        }

        /* Style links in the footer */
        footer a {
            color: #fff;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <header>
        <h1>Fa Mia Pizzeria</h1>
    </header>
    <nav>
        <?php
        $navegador = ["pizzas", "bebidas", "postres"];

        foreach ($navegador as $item) {
            echo "<a href='http://famia.local/$item'>" . strtoupper($item) . "</a> ";
        }
        ?>
        <a href='http://famia.local/carrito'>CARRITO</a>
    </nav>

    <main>
        <form action="/carrito/agregar" method="post">
            <div class="mostrar">
                <?php
                
                foreach ($data["productos"] as $producto) {
                    echo "<input type='hidden' name='tipo_" . str_replace(" ", "_", $producto["nombre"]) . "'' value='" . $data["tipo"] . "'>";
                    echo "<div class='tarjeta'>";

                    if (file_exists("../app/Config/img/" . $producto["imagen"])) {
                        echo "<img src='imagen/" . $producto["imagen"] . "' alt='" . $producto["nombre"] . "'>";
                    }

                    echo "<p>" . $producto["nombre"] . "</p>"; ?>
                    Cantidad: <input type="number" name="<?php echo "cantidad_" . $producto['nombre']; ?>" value="0" min="0">
                <?php
                    if ($data["tamano"]) {
                        echo "<select name='size_" . $producto["nombre"] . "'>";
                        foreach ($producto["precio"] as $tamaño => $precio) {
                            echo "<option value='" . $producto["precio"][$tamaño] . "'>" . $tamaño . " - " . $precio . "€</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<br/> Precio: " . $producto["precio"] . "€";
                        echo "<input type='hidden' name='size_" . $producto["nombre"] . "' value='" . $producto["precio"] . "'>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
            <br />
            <br />
            <input type="submit" class="submit" name="submit" value="Añadir al carrito">
        </form>
    </main>
    <footer>
        <p>© 2024 Famia</p>
    </footer>
</body>

</html>