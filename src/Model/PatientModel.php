<?php

namespace App\Model;

use App\Entity\Horse;
use App\Entity\Patient;
use App\Core\AbstractModel;

class PatientModel extends AbstractModel {
    
    public function addPatient(Patient $patient)
    {
        $sql = 'INSERT INTO patient (firstname, lastname, email, address, phoneNumber, password) 
                VALUES 
                (?, ?, ?, ?, ?, ?) ';

        $values = [
            $patient->getFirstname(),
            $patient->getLastname(),
            $patient->getEmail(), 
            $patient->getAddress(),
            $patient->getPhoneNumber(),
            $patient->getPassword()
        ];
        return $this->db->insert($sql, $values);
    }
    
    public function getDataPatient()
    {
        $datas = [];

        // Récupération des données depuis la table
        $sql = "SELECT * FROM patient ";

        return $datas;
    }

    public function getPatientByEmail(string $email)
    {
    
        $sql = 'SELECT * 
                FROM patient
                WHERE email = ?';

        $result = $this->db->getOneResult($sql, [$email]);

        if (!$result) {
            return null;
        }

        return new Patient($result);
    }

    // For Admin
    public function getAllPatients()
    {
        // Récupération des données depuis la table
        $sql = "SELECT * FROM patient";
        $result = $this->db->getAllResults($sql);

        // Create array of results foreach
        $patients = array();
        foreach ($result as $row) {
            $patients[] = new Patient($row);
        }

        return $patients;
    }

}