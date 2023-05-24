<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Model\AdminModel;
use App\Services\AdminSession;

class AuthAdminController {

public function loginAdmin()
    {
         // Messages flash
         if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
            }
            
    
        $error = null;

        $email = "";
        $password = "";

        // Si le formulaire est soumis
        if (!empty($_POST)) {

            // 1. Récupération des données du formulaire
            $email = strip_tags(trim($_POST['email']));
            $password = $_POST['password'];

            // 2. Validation du formulaire
            $errors = $this->validateLoginFormAdmin($email, $password);

            // Si il n'y a pas d'erreur... 
            if(empty($errors)) {

                // 3. Vérification des identifiants
                $admin = $this->checkLoginAdmin($email, $password);

                // Si les identifiants sont corrects...
                if ($admin) {
                 
                  // 2. Enregistrer l'utilisateur en session
                $adminSession = new AdminSession();
                $adminSession->register($admin);

                    // 5. Redirection vers l'index.php
                    header('Location: ' . constructUrl('homeAdmin'));
                    exit;

                } else {
                    $errors['login'] = 'Les identifiants sont incorrects.';
                }

            }

        }

        // Affichage du template
        $template = 'loginAdmin';
        include TEMPLATE_DIR . '/admin/baseAdmin.phtml';
    }

    private function validateLoginFormAdmin(string $email, string $password)
    {
        $errors = array();

        // Vérification de l'adresse email
        if (empty($email)){
            $errors['email'] = 'L\'adresse email est obligatoire.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'L\'adresse email n\'est pas valide.';
        }

        // Vérification du mot de passe
        if (empty($password)){
            $errors['password'] = 'Le mot de passe est obligatoire.';
        }

        return $errors;
    }

    /**
     * Vérifie des identifiants de connexion
     */
    function checkLoginAdmin(string $email, string $password)
    {
        $adminModel = new AdminModel;

        // Est-ce que l'administrateur (email) existe ?
        $admin = $adminModel->getAdminByEmail($email);

        // Si l'administrateur n'existe pas...
        if ($admin == null) {
            return false;
        } 

        // Sinon (si l'administrateur existe)
        // 2. Est-ce que le mot de passe est correct ?
        if (!password_verify($password, $admin->getPassword())) {
            return false;
        }
        // Ici tout est OK ! 
        return new Admin;    
    }

    public function logoutAdmin()
    {
        // On efface les données enregistrées en session
        $_SESSION[AdminSession::SESSION_KEY] = null;

        // Redirection vers l'index.php
        header('Location: ' . constructUrl('home'));
        exit;
    }
}