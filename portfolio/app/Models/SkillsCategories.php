<?php

namespace App\Models;

class SkillsCategories extends DBAbstractModel
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
    public function delete($id)
    {
        $this->query = "DELETE FROM skills_categories WHERE id = :id";
        $this->params["id"] = $id;
        $this->get_results_from_query();
    }
}
