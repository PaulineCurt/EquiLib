<?php 

namespace App\Controller;

// Import de classes
use App\Model\PatientModel;
use App\Model\AppointmentModel;
use App\Model\ProfessionnalModel;
use App\Model\SpecialityModel;

class HomeController {

    public function index() 
    {
        // Messages flash
        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
        }

        $specialityModel = new SpecialityModel;
        $specialities = $specialityModel->getAllSpecialities();

        $veterinaries = []; 

        if(!empty($_POST)) {
                $city = $_POST['city'] ?? "";
                $speciality = $_POST['speciality'] ?? "";

                
        $professionnalModel = new ProfessionnalModel;
        $veterinaries = $professionnalModel ->getVeterinariesByFilter($speciality, $city);
        }

        // Affichage : inclusion du template
        $template = 'home';
        include TEMPLATE_DIR .'/patient/base.phtml';
    }
    
}