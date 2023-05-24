<?php

namespace App\Model;

use App\Entity\Professionnal;
use App\Core\AbstractModel;

class ProfessionnalModel extends AbstractModel {
    
    public function addProfessionnal(Professionnal $professionnal)
    {
        $sql = 'INSERT INTO professionnal 
                (lastname, firstname, email, postalCode, city, address, speciality, veterinaryNumber, phoneNumber, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $values = [
            $professionnal->getFirstname(),
            $professionnal->getLastname(),
            $professionnal->getEmail(), 
            $professionnal->getPostalCode(),
            $professionnal->getCity(),
            $professionnal->getAddress(),
            $professionnal->getSpeciality(),
            $professionnal->getVeterinaryNumber(),
            $professionnal->getPhoneNumber(),
            $professionnal->getPassword()
        ];

        return $this->db->insert($sql, $values);
    }


    public function getDataPro()
    {
        $datas = [];

        // Récupération des données depuis la table
        $sql = "SELECT * FROM professionnal ";

        return $datas;
    }

   public function getProByVeterinaryNumber(string $veterinaryNumber)
    {
        $sql = 'SELECT * 
                FROM professionnal
                WHERE veterinaryNumber = ?';

        $result = $this->db->getOneResult($sql, [$veterinaryNumber]);

        if (!$result) {
            return null;
        }


        $specialityModel = new SpecialityModel();
        $speciality = $specialityModel -> getSpecialityById($result['speciality']);
        // Remplace id par un objet 'speciality'
        $result['speciality'] = $speciality;

        return new Professionnal($result);
    }

        
    function getProById($proId) {

        $sql = 'SELECT * FROM professionnal 
                WHERE id_professionnal = ? ';

        $result = $this->db->getOneResult($sql, [$proId]);

        $specialityModel = new SpecialityModel();
        $speciality = $specialityModel -> getSpecialityById($result['speciality']);
        // Remplace id par un objet 'speciality'
        $result['speciality'] = $speciality;

        return new Professionnal($result);
    }

    public function getAllPros()
    {
        // Récupération des données depuis la table
        $sql = "SELECT * FROM professionnal";
        $result = $this->db->getAllResults($sql);

        // Création d'un tableau de patients à partir des résultats
        $patients = array();
        $specialityModel = new SpecialityModel();
        
        foreach ($result as $row) {
            $speciality = $specialityModel -> getSpecialityById($row['speciality']);
            // Remplace id par un objet 'speciality'
            $row['speciality'] = $speciality;

            $pros[] = new professionnal($row);
            
        }

        return $pros;
    }


    function getCity(int $speciality, string $postalCode, string $city) 
    {
    
        // Requête pour récupérer les entrées correspondantes
        $sql = 'SELECT * FROM professionnal 
                WHERE speciality = :speciality 
                AND postalCode = :code 
                AND city = :city';
        
        $result = $this->db->getAllResults($sql, [$speciality, $postalCode, $city]);
  
    }

    public function getVeterinariesByFilter($speciality="", $city="")
    {
        
        if (!empty($speciality) && $city == "") {
            // Récupération des vétérinaires ayant la spécialité sélectionnée avec le nom de la spécialité
            $sql = "SELECT p.*, s.name 
                    AS speciality_name 
                    FROM professionnal p 
                    INNER JOIN speciality s 
                    ON p.speciality = s.id 
                    WHERE s.id = ?";
            $veterinaries = $this->db->getAllResults($sql, [$speciality]);
           
        } else if (!empty($speciality) && $city !="") {
            $sql = "SELECT p.*, s.name 
            AS speciality_name 
            FROM professionnal p 
            INNER JOIN speciality s 
            ON p.speciality = s.id 
            WHERE s.id = ? 
            AND p.city = ?";
            $veterinaries = $this->db->getAllResults($sql, [$speciality, $city]);
            
        } else if ($speciality =='' && !empty($city)){
            $sql = "SELECT p.*, s.name 
                    AS speciality_name 
                    FROM professionnal p 
                    INNER JOIN speciality s 
                    ON p.speciality = s.id 
                    WHERE p.city = ?";
            $veterinaries = $this->db->getAllResults($sql, [$city]);
        }

        return $veterinaries;
    }
}