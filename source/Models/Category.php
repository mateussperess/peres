<?php

namespace Source\Models;

use Source\Core\Connect;

class Category
{
    private $id;
    private $type;

    /**
     * @param $id
     * @param $type
     */
    public function __construct($id = null, $type = null)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function selectAll()
    {
        $query = "SELECT * FROM categories";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

}