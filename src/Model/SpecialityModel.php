<?php

namespace App\Model;

use App\Entity\Speciality;
use App\Core\AbstractModel;

class SpecialityModel extends AbstractModel {

   public function getAllSpecialities()
    {

        // Récupération des spécialités
        $sql = 'SELECT * FROM speciality 
                ORDER BY id ';
        
        $result = $this->db->getAllResults($sql);

        // Retourne la liste des spécialités
        return $result;
    }

    public function getSpecialityById(int $id): ?Speciality
    {
        // Récupération de la spécialité correspondante à l'id donné
        $sql = 'SELECT * FROM speciality 
                WHERE id = ?';

        $result = $this->db->getOneResult($sql, [$id]);

        if (!$result) {
            return null;
        }

        $speciality = new Speciality($result);

        return $speciality;
    }

    public function createSpeciality(string $name)
    {
        // Création d'une nouvelle spécialité
        $sql = 'INSERT INTO speciality 
                (name)
                VALUES (?)';

        $result = $this->db->insert($sql, [$name]);

        // Retourne l'identifiant de la nouvelle spécialité
        return $result;
    }

public function updateSpeciality(int $id, string $name)
{
    // Mise à jour d'une spécialité existante
    $sql = 'UPDATE speciality 
            SET name = ?
            WHERE id = ?';

    $result = $this->db->getAllResults($sql, [$name, $id]);

    // Retourne true si la mise à jour a réussi, false sinon
    return $result;
}

public function deleteSpeciality(int $id)
{
    // Suppression d'une spécialité
    $sql = 'DELETE FROM speciality 
            WHERE id = ?';

    $result = $this->db->getAllResults($sql, [$id]);

    // Retourne true si la suppression a réussi, false sinon
    return $result;
}

}