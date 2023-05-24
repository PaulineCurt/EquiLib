<?php 

namespace App\Services;

use App\Entity\Patient;
use App\Model\PatientModel;

class PatientSession {

    const SESSION_KEY = 'patient';

    public function __construct()
    {
        // Si la session n'est pas encore démarrée...
        if (session_status() == PHP_SESSION_NONE) {

            // ... on la démarre !
            session_start();
        }
    }

    public function register(Patient $patient)
    {
        $_SESSION[self::SESSION_KEY] = $patient;
    }

    public function getPatient()
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return null;
        }

        // $patientModel = new PatientModel();
        // $patient = $patientModel->getPatientByEmail($_SESSION[self::SESSION_KEY]['email']);
        $patient = $_SESSION[self::SESSION_KEY];

        return $patient;
    }
    
    //Verifie que le patient est connecté
    public function isPatientLoggedIn(): bool {
        return isset($_SESSION[self::SESSION_KEY]);
    }
    
}