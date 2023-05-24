<?php

namespace App\Model;

use App\Entity\Breed;
use App\Core\AbstractModel;

class BreedModel extends AbstractModel {

   public function getAllBreeds()
    {

        // Récupération des spécialités
        $sql = 'SELECT * FROM breed
                ORDER BY id ';
        
        $result = $this->db->getAllResults($sql);

        // Retourne la liste des spécialités
        return $result;
    }
}