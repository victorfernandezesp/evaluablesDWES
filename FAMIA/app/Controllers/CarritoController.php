<?php

namespace App\Controllers;

use App\Models\Carrito;


class CarritoController extends BaseController
{
    public function carritoAction($request)
    {
        $_SESSION['carrito'] = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

        if ($request == "/carrito/agregar") {
            $carrito = Carrito::getInstance();
            $carrito->agregarProducto($_POST);
            header("Location: /carrito");
        } else {
            $data = [
                "carrito" => $_SESSION['carrito']
            ];
            $this->renderHTML("../app/Views/carrito_view.php", $data);
        }
    }
    public function crearTicketYComanda()
    {
        // Genera el ticket de compra. 

        $nombreFichero = "ticket_" . date("YmdHis") . ".txt";
        $ruta_archivo = 'tickets/' . $nombreFichero;
        $ticket = fopen($ruta_archivo, 'a');

        // Escribimos la cabezera del ticket
        fwrite($ticket, "faMia\n");
        fwrite($ticket, "Pedido | Fecha: ");
        fwrite($ticket, date("d/m/Y H:i:s") . "\n");
        fwrite($ticket, "---------------------------------\n");

        // Escribimos el contenido del ticket
        foreach ($_SESSION['carrito'] as $producto) {
            fwrite($ticket,"Nombre: " .$producto['nombre'] . " | ");
            fwrite($ticket, "Cantidad: " .$producto['cantidad'] . " | ");
            // Si son pizzas escribimos el tamaño
            if ($producto['tipo'] == "pizzas") {
                if ($producto['precio'] == 5) {
                    fwrite($ticket, "pequeña | ");
                } elseif ($producto['precio'] == 10) {
                    fwrite($ticket, "mediana | ");
                } else {
                    fwrite($ticket, "grande | ");
                }
            }

            fwrite($ticket, "Precio: " .$producto['precio'] . " | ");
            fwrite($ticket, "Precio Total: " .$producto['precio_total'] . "\n");
        }
        fwrite($ticket, "---------------------------------\n");
        // calculamos el total
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio_total'];
        }
        fwrite($ticket, "Total: " . $total . " €\n");
        fwrite($ticket, "---------------------------------\n");
        fwrite($ticket, "Gracias por su compra\n");
        fclose($ticket);

        // Genera la comanda (Solo pizzas).
        $nombreFichero_comanda = "comanda_" . date("YmdHis") . "_pendiente.txt";
        $ruta_archivo_comanda = 'comandas/' . $nombreFichero_comanda;
        $comanda = fopen($ruta_archivo_comanda, 'a');
        fwrite($comanda, "faMia\n");
        fwrite($comanda, "Pedido | Fecha: ");
        fwrite($comanda, date("d/m/Y H:i:s") . "\n");
        fwrite($comanda, "---------------------------------\n");
        foreach ($_SESSION['carrito'] as $producto) {
            if ($producto['tipo'] == "pizzas") {
                fwrite($comanda, $producto['nombre'] . " | ");
                fwrite($comanda, $producto['cantidad'] . " | ");
                if ($producto['precio'] == 5) {
                    fwrite($comanda, "pequeña |  \n");
                } elseif ($producto['precio'] == 10) {
                    fwrite($comanda, "mediana |  \n");
                } else {
                    fwrite($comanda, "grande | \n");
                }
            }
            fwrite($comanda, "---------------------------------\n");
            fclose($comanda);
        }
        
        header("Location: /close_session");        
    }
}
