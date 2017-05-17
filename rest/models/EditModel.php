<?php
namespace Rest\Models;

use Connection\Database;
use PDO;

class EditModel
{

    public function edit($id, $data)
    {
        $db = Database::get();

        $query = $db->prepare('UPDATE ADDRESS '
            . 'SET  LABEL = :label, '
            . 'STREET=:street, '
            . 'HOUSENUMBER=:number, '
            . 'POSTALCODE = :code, '
            . 'CITY=:city, '
            . 'COUNTRY=:country '
            . 'WHERE ADDRESSID = :id');

        $query->bindParam(':label', $data['LABEL']);
        $query->bindParam(':street', $data['STREET']);
        $query->bindParam(':number', $data['HOUSENUMBER']);
        $query->bindParam(':code', $data['POSTALCODE']);
        $query->bindParam(':city', $data['CITY']);
        $query->bindParam(':country', $data['COUNTRY']);
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->rowCount();
    }
}
