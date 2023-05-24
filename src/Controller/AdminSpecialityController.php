<?php

namespace App\Controller;

use App\Model\AdminModel;
use App\Model\PatientModel;
use App\Model\SpecialityModel;
use App\Model\ProfessionnalModel;
use App\Services\AdminSession;


class AdminSpecialityController {

    private AdminModel $adminModel;
    private $specialityModel;
    private $patientModel;
    private $professionnalModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->specialityModel = new SpecialityModel();
        $this->patientModel = new PatientModel();
        $this->professionnalModel = new ProfessionnalModel();
    }

    
    // Récupère les spécialités
    public function listSpecialities()
    {
        // Messages flash
        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
            }

        // Récupération de toutes les spécialités
        $specialities = $this->specialityModel->getAllSpecialities();

        $adminSession = new AdminSession;
        // Récupération de l'admin depuis la session
        $admin = $adminSession->getAdmin();
        // Vérification si l'admin est connecté
        if (!$admin) {
            // Redirection vers la page home
            header('Location: ' . constructUrl('home'));
            exit();
        }

          // Affichage du template
          $template = 'specialityAdmin';
          include TEMPLATE_DIR . '/admin/baseAdmin.phtml';
        
    }
    
    public function createSpeciality()
    {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $success = $this->specialityModel->createSpeciality($name);
            
        
        $_SESSION ['flash'] = 'La spécialité a été créée avec succès';
        //@TODO message error
        
        header ('Location: ' . constructUrl('specialityAdmin'));
        exit;

         }
    }

    public function updateSpeciality()
    {
        if (isset($_POST['id-speciality']) && isset($_POST['name-speciality'])) {
            $id = (int) $_POST['id-speciality'];
            $name = $_POST['name-speciality'];
            $success = $this->specialityModel->updateSpeciality($id, $name);
            
            $_SESSION ['flash'] = 'La spécialité a été modifié avec succès.';
        
            header ('Location: ' . constructUrl('specialityAdmin'));
            exit;
        }
            
    }
    public function updateSpecialityAjax()
    {
        if (isset($_POST['id-speciality']) && isset($_POST['name-speciality'])) {
            $id = (int) $_POST['id-speciality'];
            $name = $_POST['name-speciality'];
            $success = $this->specialityModel->updateSpeciality($id, $name);
            
            // DATA 
            $result = [
                'id' => $id,
                'name' => $name,
            ];

            // Retourne au client la réponse en JSON
            echo json_encode($result);
            exit;
        }
    }

    public function deleteSpeciality()
    {
        $id = (int) $_GET['id'];
        $success = $this->specialityModel->deleteSpeciality($id);

        $_SESSION ['flash'] = 'La spécialité a été supprimée avec succès.';
        
        header ('Location: ' . constructUrl('specialityAdmin'));
        exit;

    }
}