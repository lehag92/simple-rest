<?php
namespace Rest\Models;

use Connection\Database;
use PDO;

class ListModel
{
    public function fetchAll()
    {
        $db = Database::get();
        $query = $db->query('SELECT * FROM ADDRESS');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}

