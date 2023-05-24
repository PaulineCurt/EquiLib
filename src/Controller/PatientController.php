<?php 

namespace App\Controller;

use App\Entity\Horse;
use App\Entity\Patient;
use App\Model\BreedModel;
use App\Model\HorseModel;
use App\Model\PatientModel;
use App\Services\PatientSession;
use App\Model\AppointmentModel;

class PatientController {

    private PatientModel $patientModel;
    private HorseModel $horseModel;

    public function __construct()
    {
        $this->horseModel = new HorseModel();
        $this->patientModel = new PatientModel();
    }

    public function showForm()
    {
        // Affichage du formulaire
        $template = 'signupPatient';
        include TEMPLATE_DIR .'/patient/base.phtml';
    }
    
    public function signupPatient()
    {
        $firstname = "";
        $lastname = "";
        $email= "";
        $address= "";
        $phoneNumber= "";

        // Si le formulaire est soumis
        if (!empty($_POST)) {

            // 1. Récupération des données du formulaire
            $firstname = strip_tags(htmlspecialchars(trim($_POST['firstname'])));
            $lastname = strip_tags(htmlspecialchars(trim($_POST['lastname'])));
            $email = strip_tags(htmlspecialchars(trim($_POST['email'])));
            $address = (htmlspecialchars($_POST['address']));
            $phoneNumber = (htmlspecialchars($_POST['phoneNumber']));
            $password = strip_tags(htmlspecialchars($_POST['password']));
            $passwordConfirm = strip_tags(htmlspecialchars($_POST['password-confirm']));

            // 2. Validation du formulaire
            $errors = $this->validateFormPatient(
                $firstname,
                $lastname, 
                $email,
                $address,
                $phoneNumber,
                $password,
                $passwordConfirm
            );

            // Si il n'y a pas d'erreur... 
            if(empty($errors)) {

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $patient = new Patient([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'address' => $address,
                    'phoneNumber' => $phoneNumber,
                    'password' => $hash
                ]);
            

                // Ajout du nouvel utilisateur
                $this->patientModel->addPatient($patient);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Votre compte a été créé avec succès.';

                // Redirection vers l'index.php mais sans les données du formulaire
                // Design pattern : POST redirect GET (cf https://fr.wikipedia.org/wiki/Post-redirect-get)
                header('Location: ' . constructUrl('home'));
                exit;
            }

        }

        // Affichage du template
        $template = 'signupPatient';
        include TEMPLATE_DIR .'/patient/base.phtml';
    }

    private function validateFormPatient(
        string $firstname,
        string $lastname,
        string $email,
        string $address,
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
        
            // Vérification de l'adresse
            if (empty($address)){
                $errors['address'] = 'L\'adresse est obligatoire.';
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

    /**
     * Vérifie des identifiants de connexion
     */
    function checkLoginPatient(string $email, string $password)
    {
        $patientModel = new PatientModel;

        // Est-ce que le patient (email) existe ?
        $patient = $patientModel->getPatientByEmail($email);
        
        // Si le patient n'existe pas...
        if ($patient == null) {
            return false;
    } 

        // Sinon (si le patient existe)
        // 2. Est-ce que le mot de passe est correct ?
        if (!password_verify($password, $patient->getPassword())) {
            return false;
        }
        // Ici tout est OK ! 
        return $patient;    
    }

    public function profilePatient()
    {

        // Messages flash
        if (array_key_exists('flash', $_SESSION) && $_SESSION['flash']) {
            $flashMessage = $_SESSION['flash'];
            $_SESSION['flash'] = null;
            }

        if(!empty($_POST)) {
            $errors = $this->addHorse();
        }

        // Créer une instance du modèle BreedModel
        $breedModel = new BreedModel();
        // Récupérer toutes les races de chevaux
        $breeds = $breedModel->getAllBreeds();

        $patientSession = new PatientSession;
        // Récupération du patient depuis la session
        $patient = $patientSession->getPatient();

        // Vérification si le patient est connecté
        if (!$patient) {
            // Redirection vers la page de connexion
            header('Location: ' . constructUrl('home'));
            exit();
        }

        $horses = $this->horseModel->getAllHorses($patient->getId_patient());
    
        // Charger la vue
        $template = 'patientProfile';
        include TEMPLATE_DIR .'/patient/base.phtml';
    }

     public function addHorse()
    { 
    
        $patientSession = new PatientSession;
        // Récupération du patient depuis la session
        $patient = $patientSession->getPatient();
          // Vérification si le patient est connecté
          if (!$patient) {
            // Redirection vers la page de connexion
            header('Location: ' . constructUrl('home'));
            exit();
        }

        // Créer une instance du modèle HorseModel
        $horseModel = new HorseModel();

        
        // Récupérer les données du formulaire
        $name = $_POST['name'];
        $breed = $_POST['breed'];
        $age = $_POST['age'];
        $description = $_POST['description'];

        // Validation du formulaire
        if(!$name) {
            $errors['name'] = 'Le nom est obligatoire';
        }
        if(!$breed) {
            $errors['breed'] = 'La race est obligatoire';
        }
        if(!$age) {
            $errors['age'] = 'L\'age est obligatoire';
        }
        if(!$description) {
            $errors['description'] = 'La description est obligatoire';
        }
    
         // Validation de l'image si un fichier a été uploadé
        if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE){
            $errors = array();
    
            // Validation du poids du fichier
            $filesize = filesize($_FILES['image']['tmp_name']);
            $maxUploadSize = 1048576; // 1 Mo en octets
            if ($filesize > $maxUploadSize) {
                $errors['image'] = 'Votre fichier excède 1 Mo.';
            }
    
            // Validation du type de fichier
            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
            $mimeType = mime_content_type($_FILES['image']['tmp_name']);
    
            if (!in_array($mimeType, $allowedMimeTypes)) {
                $errors['image'] = 'Type de fichier non autorisé';
            }
        }
    
            if (empty($errors)) {
                $filename = '';

                // Créer une instance de l'entité Horse avec les données du formulaire
                $horse = new Horse();
                $horse->setName($name);
                $horse->setBreedId($breed);
                $horse->setAge($age);
                $horse->setDescription($description);
                $horse->setPatient_id($patient->getId_patient());


                //SI IL Y A UNE IMAGE
                if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
    
                    // Nettoyer le nom du fichier
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $basename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
        
                    // Slugification du nom du fichier (on supprime caractères spéciaux, accents, majuscules, espaces, etc)
                    $basename = slugify($basename);
        
                    // On ajoute une chaîne aléatoire pour éviter les conflits
                    $filename = $basename . sha1(uniqid(rand(), true)) . '.' . $extension;
        
                    // Copier le fichier temporaire dans notre dossier "images"
                    if (!file_exists('images')) {
                        mkdir('images');
                    }
        
                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $filename);
        
                    // Utiliser le nom du fichier de l'image téléchargée
                    $horse->setImage($filename);
                }


                // Ajouter le cheval à la base de données
                $horseModel->addHorse($horse);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Votre cheval a été ajouter avec succès.';
            
                header('Location: ' . constructUrl('profilePatient'));
                exit();
            }

           return $errors;           
              
        }
    }
