<?php 

namespace App\Services;

use App\Entity\Admin;
use App\Model\AdminModel;

class AdminSession {

    const SESSION_KEY = 'admin';

    public function __construct()
    {
        // Si la session n'est pas encore démarrée...
        if (session_status() == PHP_SESSION_NONE) {

            // ... on la démarre !
            session_start();
        }
    }

    public function register(Admin $admin)
    {
        $_SESSION[self::SESSION_KEY] = $admin;
    }

    public function getAdmin()
    {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return null;
        }

        $admin = $_SESSION[self::SESSION_KEY];
        

        return $admin;
    }
    
    //Verifie que l'admin est connecté
    public function isAdminLoggedIn(): bool {
        return isset($_SESSION[self::SESSION_KEY]);
    }
    
}