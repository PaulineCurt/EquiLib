<?php 

namespace App\Services;

use App\Entity\Professionnal;

class ProfessionnalSession {

    const SESSION_KEY = 'pro';

    public function __construct()
    {
        // Si la session n'est pas encore démarrée...
        if (session_status() == PHP_SESSION_NONE) {

            // ... on la démarre !
            session_start();
        }
    }

    public function register(Professionnal $pro)
    {
        $_SESSION[self::SESSION_KEY] = $pro;
    }

    public function getProfessionnal()
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return null;
        }

      $pro = $_SESSION[self::SESSION_KEY];
    
        return $pro;   
    }
        //Verifie que le patient est connecté
        public function isProfessionnalLoggedIn(): bool {
            return isset($_SESSION[self::SESSION_KEY]);
        }
}