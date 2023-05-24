<?php 

namespace App\Controller;

use App\Entity\Professionnal;
use App\Model\AppointmentModel;
use App\Model\SpecialityModel;
use App\Model\ProfessionnalModel;
use App\Services\ProfessionnalSession;


class ProfessionnalController {

    private AppointmentModel $appointmentModel;
    
    private ProfessionnalModel $professionnalModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
        $this->professionnalModel = new ProfessionnalModel();
    }

    public function showForm()
    {
        // Affichage du formulaire
        $template = 'signupPro';
        include '/pro/basePro.phtml';
    }

    
    public function signupPro()
    {
        $firstname = "";
        $lastname = "";
        $email= "";
        $address= "";
        $phoneNumber= "";
        $postalCode= "";
        $city = "";
        $speciality = "";
        $veterinaryNumber = "";

        // Si le formulaire est soumis
        if (!empty($_POST)) {

            // 1. Récupération des données du formulaire
            $firstname = strip_tags(trim($_POST['firstname']));
            $lastname = strip_tags(trim($_POST['lastname']));
            $email = strip_tags(trim($_POST['email']));
            $postalCode = $_POST['postalCode'];
            $city = $_POST['city'];
            $address = $_POST['address'];
            $speciality = $_POST['speciality'];
            $veterinaryNumber = $_POST['veterinaryNumber'];
            $phoneNumber = $_POST['phoneNumber'];
            $password = $_POST['password'];
            $passwordConfirm = $_POST['password-confirm'];

            // 2. Validation du formulaire
            $errors = $this->validateFormProfessionnal(
                $lastname, 
                $firstname,
                $email,
                $postalCode, 
                $city,
                $address, 
                $veterinaryNumber,
                $speciality,
                $phoneNumber,
                $password
            );

            // Si il n'y a pas d'erreur... 
            if(empty($errors)) {

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $professionnal = new Professionnal([
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "email" => $email,
                    "postacalCode" => $postalCode, 
                    "city" => $city,
                    "address" => $address,
                    "veterinaryNumber" => $veterinaryNumber,
                    "speciality" => $speciality,
                    "phoneNumber" => $phoneNumber,
                    "password" => $password,
                ]);
            

                // Ajout du nouvel utilisateur dans le fichier JSON
                $this->professionnalModel->addProfessionnal($professionnal);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Votre compte a été créé avec succès.';

                // Redirection vers l'index.php mais sans les données du formulaire
                // Design pattern : POST redirect GET (cf https://fr.wikipedia.org/wiki/Post-redirect-get)
                header('Location: ' . constructUrl('homeProfessionnal'));
                exit;
            }

        }

        $specialityModel = new SpecialityModel;
        $specialities = $specialityModel->getAllSpecialities();

        // Affichage du template
        $template = 'signupPro';
        include TEMPLATE_DIR .'/pro/basePro.phtml';
    }

    private function validateFormProfessionnal(
        string $firstname,
        string $lastname,
        string $email,
        string $postalCode,
        string $city,
        string $address,
        string $veterinaryNumber,
        string $phoneNumber,
        string $password,
        string $passwordConfirm
    )
    {
            $errors = array();
        
            // Vérification du numéro de téléphone
            if(!preg_match('/^[0-9]{10}$/', $phoneNumber)){
                $errors['phoneNumber'] = 'Le numéro de téléphone doit comporter 10 chiffres.';
            }

            // Vérification du nom
            if (empty($lastname)){
                $errors['lastname'] = 'Le nom est obligatoire.';
            }

            // Vérification du prénom
            if (empty($firstname)){
                $errors['firstname'] = 'Le prénom est obligatoire.';
            }
            // Vérification du code postal (obligé de contenir 5 chiffres)
            if (!preg_match('/^[0-9]{5}$/', $postalCode)) {
                $errors ['postalCode'] = 'Veuillez entrer un code postal valide.';
            }
            
            // Vérification de la ville 
            /*
            // @TODO Rajouter une sécurité / verification pour faire correspondre le code postal et la ville
            */
            if (empty($city)) {
                $errors['city'] = 'Veuillez saisir une ville';
            }

            // Vérification de l'adresse
            if (empty($address)){
                $errors['address'] = 'L\'adresse est obligatoire.';
            }

            // Vérification de le spécialité 
            if (empty($speciality)){
                    $errors["speciality"] = 'La spécialité est obligatoire';
            }       

            // Vérification du numéro oridinal des vétérinaire
            if(empty($veterinaryNumber)){
                    $errors['veterinaryNumber'] = 'Le numéro oridnal est obligatoire.';
            }

            // Vérification de l'adresse email
            if (empty($email)){
                $errors['email'] = 'L\'adresse email est obligatoire.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'L\'adresse email n\'est pas valide.';
            }

            // Vérification du mot de passe
            if (empty($password)){
                $errors['password'] = 'Le mot de passe est obligatoire.';
            } elseif (strlen($password) < 6) {
                $errors['password'] = 'Le mot de passe doit comporter au moins 6 caractères.';
            } elseif ($password != $passwordConfirm) {
                $errors['password'] = 'Les mots de passe ne correspondent pas.';
            }
                
            return $errors;
        }

        // Récupére un pro à partir de son numéro ordinal.
        function getProByVeterinaryNumber(int $veterinaryNumber, ProfessionnalModel $professionnalModel): ?array
        {
            // Récupération des données de la BDD
            $pros = $professionnalModel->getDataPro();
            
            // On vérifie l'existance de l'email seulement si celui-ci est rempli et valide
            foreach ($pros as $pro) {
                if($pro['veterinaryNumber'] == $veterinaryNumber) {
                    return $pro;
                }
            }

            return null;
        }

        /**
         * Vérifie des identifiants de connexion
         */
        function checkLoginPro(int $veterinaryNumber, string $password, ProfessionnalModel $professionnalModel)
        {
            // Est-ce que l'utilisateur (veterinaryNumber) existe ?
            $pro = $professionnalModel->getProByVeterinaryNumber($veterinaryNumber);

            // Si le professionnel de santé n'existe pas...
            if ($pro == null) {
                return false;
            } 

            // Vérifie le mot de passe
            if (password_verify($password, $pro->getPassword())) {
                // Le mot de passe est correct, retourne le professionnel de santé
                return $pro;
            } else {
                // Le mot de passe est incorrect
                return false;
            }
        }

        public function profilePro()
        {
    
            $professionnalSession = new ProfessionnalSession;
            // Récupération du professionnel depuis la session
            $pro= $professionnalSession->getProfessionnal();
            
            // Vérification si le professionnel est connecté
            if (!$pro) {
                // Redirection vers la page de connexion
                header('Location: ' . constructUrl('homeProfessionnal'));
                exit();
            }
        
            // Charger la vue
            $template = 'proProfile';
            include TEMPLATE_DIR . '/pro/basePro.phtml';
        }
        public function appointmentPro()
        {
            
            $professionnalSession = new ProfessionnalSession;
            $pro= $professionnalSession->getProfessionnal();
            if (!$pro) {
                // Redirection vers la page de connexion
                header('Location: ' . constructUrl('homeProfessionnal'));
                exit();
            }
        
            $professionnal = $professionnalSession->getProfessionnal();
            $appointmentModel = new AppointmentModel();
            $appointment = $appointmentModel->getAppointmentsByProId($professionnal->getId_professionnal());
        
            $template = 'appointmentPro';
            include TEMPLATE_DIR . '/pro/basePro.phtml';
        }
            
    }