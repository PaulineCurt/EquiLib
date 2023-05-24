<?php 

namespace App\Controller;

// Import de classes
use App\Model\ProfesionnalModel;

class HomeProfessionnalController {

    public function homeProfessionnal() 
    {

        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
        }

        // Affichage : inclusion du template
        $template = 'homeProfessionnal';
        include TEMPLATE_DIR .'/pro/basePro.phtml';
    }
}