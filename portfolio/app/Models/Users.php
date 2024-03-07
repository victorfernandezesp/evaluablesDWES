<?php

namespace App\Models;

class Users extends DBAbstractModel
{

    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = self::class;
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
    public function register($datos_formulario)
    {
        foreach ($datos_formulario as $key => $value) {
            $this->params[$key] = $value;
        }
        $this -> query = "INSERT INTO users (name,surname, email, password) VALUES (:name, :surname, :email, :password)";
        $this -> get_results_from_query();
    }
    public function login($datos_formulario)
    {
        foreach ($datos_formulario as $key => $value) {
            $this->params[$key] = $value;
        }
        $this -> query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $this -> get_results_from_query();
        if (count($this->rows) == 1) {
            $_SESSION['perfil'] = "admin";
            $_SESSION['email'] = $datos_formulario['email'];
            header("Location: /");
        } else {
            header("Location: /login");
        }
    }
}
