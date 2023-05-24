<?php

namespace App\Model;

use App\Entity\Horse;
use App\Core\AbstractModel;

class HorseModel extends AbstractModel {
    
    public function addHorse(Horse $horse)
    {
        $sql = 'INSERT INTO horse (name, breed_id, age, image, description, patient_id) 
                VALUES 
                (?, ?, ?, ?, ?, ?) ';

        $values = [
            $horse->getName(),
            $horse->getBreedId(),
            $horse->getAge(), 
            $horse->getImage(),
            $horse->getDescription(),
            $horse->getPatient_id(),

        ];

        return $this->db->insert($sql, $values);
    }

    public function getBreeds()
    {
        $sql = "SELECT breed FROM breed";
        $results = $this->db->getAllResults($sql);
    
        // Récupérer uniquement les noms des races de chevaux
        $breeds = array_column($results, 'breed');
    
        return $breeds;
    }

    public function getAllHorses(int $patientId = null) 
    {
        //Function 2 en 1 , pour récupéré tous le chevaux(pour l'admin) et aussi récupéré les chevaux par l'id du patient
        //Tableau vide
        $params = [];

        $sql = " SELECT * FROM horse 
                INNER JOIN breed ON breed_id = breed.id ";

        if ($patientId) {
            $params[] = $patientId;
            $sql .= ' WHERE patient_id = ? ';
        }

        $result = $this->db->getAllResults($sql, $params);

        $horses = array();
        foreach ($result as $row) {
            $horses[] = new Horse($row);
        }
        
        return $horses;
    }

    
}