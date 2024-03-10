<?php
namespace App\Models;

use PDO;
use PDOException;

abstract class DBAbstractModel
{
    // Propiedades que contienen la información de conexión a la base de datos
    private static $db_host = DBHOST;
    private static $db_user = DBUSER;
    private static $db_pass = DBPASS;
    private static $db_name = DBNAME;
    private static $db_port = DBPORT;

    // Propiedades relacionadas con la ejecución de consultas
    public $message = "";
    protected $conn;
    protected $query;
    protected $params = array();
    protected $rows = array();

    // Métodos abstractos que deben ser implementados por las clases hijas
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();

    // Método para abrir la conexión a la base de datos
    protected function open_connection()
    {
        $dsn = "mysql:host=" . self::$db_host . ";"
            . "dbname=" . self::$db_name . ";"
            . "port=" . self::$db_port;

        try {
            return $this->conn = new PDO(
                $dsn,
                self::$db_user,
                self::$db_pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
        } catch (PDOException $e) {
            printf("Conexión fallida: %s\n", $e->getMessage());
            exit();
        }
    }

    // Método para obtener el último ID insertado en la base de datos
    public function lastInsert()
    {
        return $this->conn->lastInsertId();
    }

    // Método para cerrar la conexión a la base de datos
    private function close_connection()
    {
        $this->conn = null;
    }

    // Método para obtener los resultados de una consulta
    protected function get_results_from_query()
    {
        $this->open_connection();
        if (($_stmt = $this->conn->prepare($this->query))) {
            if (preg_match_all('/(:\w+)/', $this->query, $_named, PREG_PATTERN_ORDER)) {
                $_named = array_pop($_named);
                foreach ($_named as $_param) {
                    $_stmt->bindValue($_param, $this->params[substr($_param, 1)]);
                }
            }

            try {
                if (!$_stmt->execute()) {
                    printf("Error de consulta: %s\n", $_stmt->errorInfo()[2]);
                }

                $this->rows = $_stmt->fetchAll(PDO::FETCH_ASSOC);
                $_stmt->closeCursor();
            } catch (PDOException $e) {
                printf("Error en consulta: %s\n", $e->getMessage());
            }
        }
    }
}
