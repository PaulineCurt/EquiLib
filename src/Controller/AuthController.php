<?php 

namespace App\Controller;

use App\Model\PatientModel;
use App\Services\PatientSession;

class AuthController {

    public function loginPatient()
    {
        // Messages flash
        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
        $flashMessage = $_SESSION['flash'];
        $_SESSION['flash'] = null;
        }

        $error = null;

        // Si le formulaire est soumis...
        if(!empty($_POST)) {

            // Récupération des données du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // 1. Est-ce que les identifiants sont corrects ?
            $patient = $this->checkUser($email, $password);

            if (!$patient) {
                $error = 'Identifiants incorrects';
            }

            // Identifiants corrects
            else {

                // 2. Enregistrer l'utilisateur en session
                $patientSession = new PatientSession();
                $patientSession->register($patient);
                
                // Redirection vers la page d'accueil
                header('Location: ' . constructUrl('home'));
                exit;
            }
        }

        // Affichage du template
        $template = 'loginPatient';
        include TEMPLATE_DIR .'/patient/base.phtml';
    }

    public function checkUser(string $email, string $password)
    {
        $patientModel = new PatientModel();
        $patient = $patientModel->getPatientByEmail($email);

        if (!$patient) {
            return false;
        }

        if (!password_verify($password, $patient->getPassword())) {
            return false;
        }

        return $patient;
    }

    public function logoutPatient()
    {
        // On efface les données enregistrées en session
        $_SESSION[PatientSession::SESSION_KEY] = null;


        // redirection
        header('Location: ' . constructUrl('home'));
        exit;
    }
}