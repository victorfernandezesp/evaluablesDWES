<?php

namespace App\Models;

class Skills extends DBAsbtractModel
{

    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function get()
    {
        
    }
    public function set()
    {
    }
    public function edit()
    {
    }
    public function delete()
    {
    }
}