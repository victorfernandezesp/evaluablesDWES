<?php

namespace App\Models;

class Carrito
{
    private static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $clase = __CLASS__;
            self::$instance = new $clase;
        }
        return self::$instance;
    }
    public function agregarProducto($productos)
    {
        foreach ($productos as $producto => $valor) {
            if (strpos($producto, 'cantidad_') === 0) {
                $identificador = str_replace('cantidad_', '', $producto);
                $cantidad = intval($valor);
                
                if ($cantidad > 0 && !isset($_SESSION["carrito"][$identificador])) {
                    $_SESSION["carrito"][$identificador] = array(
                        "tipo" => $productos["tipo_" . $identificador],
                        "nombre" => str_replace("_", " ", $identificador),
                        "cantidad" => $cantidad,
                        "precio" => $productos["size_" . $identificador],
                        "precio_total" => isset($productos["size_" . $identificador]) ? $productos["size_" . $identificador] * $cantidad : null,
                    );
                } elseif ($cantidad > 0) {
                    $_SESSION["carrito"][$identificador]["cantidad"] += $cantidad;
                }
            }
        }
    }
}
