<?php 

namespace App\Controller;

use App\Entity\Admin;
use App\Model\AdminModel;
use App\Model\PatientModel;
use App\Model\ProfessionnalModel;
use App\Services\AdminSession;
use App\Model\SpecialityModel;

class AdminController {

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

    public function homeAdmin()
    {
          // Messages flash
          if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $message = $_SESSION['flash'];
            $_SESSION['flash'] = null;
            }
            
        // Affichage du formulaire de connexion
        $template = 'homeAdmin';
        include TEMPLATE_DIR . '/admin/baseAdmin.phtml';
    }


    public function listPatients()
    {
        $patients = $this->patientModel->getAllPatients();
        
        $adminSession = new AdminSession;
        // Récupération de l'admin depuis la session
        $admin = $adminSession->getAdmin();
        // Vérification si l'admin est connecté
        if (!$admin) {
            // Redirection vers la page home
            header('Location: ' . constructUrl('home'));
            exit();
        }

        // Templates
        $template = 'patientList';
        include TEMPLATE_DIR . '/admin/baseAdmin.phtml';
    }

    public function listPros() 
    {
        $pros = $this->professionnalModel->getAllPros();

        $adminSession = new AdminSession;
        // Récupération de l'admin depuis la session
        $admin = $adminSession->getAdmin();
        // Vérification si l'admin est connecté
        if (!$admin) {
            // Redirection vers la page home
            header('Location: ' . constructUrl('home'));
            exit();
        }

          // Templates
          $template = 'proList';
          include TEMPLATE_DIR . '/admin/baseAdmin.phtml';
    }


}