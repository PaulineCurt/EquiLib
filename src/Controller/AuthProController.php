<?php 

namespace App\Controller;

use App\Model\ProfessionnalModel;
use App\Services\ProfessionnalSession;

class AuthProController {

    public function loginPro()
    {
        $error = null;

        // Si le formulaire est soumis...
        if(!empty($_POST)) {

            // Récupération des données du formulaire
            $veterinayNumber = $_POST['veterinaryNumber'];
            $password = $_POST['password'];
            
            // 1. Est-ce que les identifiants sont corrects ?
            $professionnal = $this->checkProfessionnal($veterinayNumber, $password);

            if (!$professionnal) {
                $error = 'Identifiants incorrects';
            }

            // Identifiants corrects
            else {

                // 2. Enregistrer l'utilisateur en session
                $proSession = new ProfessionnalSession();
                $proSession->register($professionnal);

                // Redirection vers la page d'accueil
                header('Location: ' . constructUrl('homeProfessionnal'));
                exit;
            }
        }

        // Affichage du template
        $template = 'loginPro';
        include TEMPLATE_DIR .'/pro/basePro.phtml';
    }

    public function checkProfessionnal(string $veterinayNumber, string $password)
    {
        $profesionnalModel = new ProfessionnalModel();
        $professionnal = $profesionnalModel->getProByVeterinaryNumber($veterinayNumber);

        if (!$professionnal) {
            return false;
        }

        if (!password_verify($password, $professionnal->getPassword())) {
            return false;
        }

        return $professionnal;
    }

    public function logoutPro()
    {
        // On efface les données enregistrées en session
        $_SESSION[ProfessionnalSession::SESSION_KEY] = null;


        // redirection
        header('Location: ' . constructUrl('homeProfessionnal'));
        exit;
    }
}