<?php
namespace Rest\Models;

use Connection\Database;
use PDO;

class GetModel
{

    public function get($id)
    {
        $db = Database::get();

        $query = $db->prepare('SELECT ADDRESSID, LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY '
            . 'FROM ADDRESS '
            . 'WHERE ADDRESSID = :id');
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
