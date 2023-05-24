<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Model\HorseModel;
use App\Model\SpecialityModel;
use App\Model\AppointmentModel;
use App\Services\PatientSession;
use App\Model\ProfessionnalModel;


class AppointmentController {

    private AppointmentModel $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new AppointmentModel();
    }

    public function generateTimeOptions($selectedTime = null) {
        $startHour = 8;
        $endHour = 19;
        $interval = 15;

        $options = '';
        for ($hour = $startHour; $hour <= $endHour; $hour++) {
            for ($minute = 0; $minute < 60; $minute += $interval) {
                $time = sprintf("%02d:%02d", $hour, $minute);
                $selected = ($time == $selectedTime) ? 'selected' : '';
                $options .= "<option value='$time' $selected>$time</option>";
            }
        }
        
        return $options;
    }

    public function appointmentPatient() {

        $horseModel = new HorseModel();

        $patientSession = new PatientSession;
        // Vérifier si le patient est connecté
        if (!$patientSession->isPatientLoggedIn()) {
           $_SESSION['flash'] = 'Veuillez vous connecter pour prendre rendez-vous.';
           header('Location: ' . constructUrl('loginPatient'));
           exit;
        }

        $specialityId = (int) $_GET['id'];
        $proId = (int)$_GET['id'];
        $date = '';
        $hours = '';
        $message = '';
        $patient_id = $patientSession->getPatient()->getId_patient();
        $horses = $horseModel -> getAllHorses($patient_id);
    
        $patientSession = new PatientSession;
        
        if ($_POST) {
            $date = $_POST['date'];
            $hours = $_POST['hours'];
            $message = $_POST['message'];
            $horse_id = (int) $_POST['horse'];
        
            if (isset($_POST['status'])) {
                $status_id = $_POST['status'];
            } else {
                $status_id = null;
            }
        // @TODO VALIDATION DU FORMULAIRE $errors
        // 2. Validation du formulaire
        $errors = $this->validateFormAppointment(
            $date,
            $hours, 
            $message,
            $horse_id,
        );

        if (empty($errors)) 
        {
            $appointment = new Appointment([
                'professionnal_id' => $proId,
                'patient_id' => $patient_id,
                'date' => $date,
                'hours' => $hours,
                'message' => $message,
                'horse_id' => $horse_id,
            ]);
        
            $this->appointmentModel->addAppointment($appointment);
        
            $response = [
                'success' => true,
                'message' => 'Le rendez-vous a été pris avec succès !'
            ];
        
        } else {
            $response = [
                // récupère les erreurs du tableau errors
                'errors' => $errors,
            ];
            
        }
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
    }

        $professionnalModel = new ProfessionnalModel();
        $pro = $professionnalModel->getProById($proId);
        
        $specialityModel = new SpecialityModel();
        $speciality = $specialityModel->getSpecialityById($specialityId);
    
         $template = 'appointmentPatient';
         include TEMPLATE_DIR .'/patient/base.phtml';
    }

    private function validateFormAppointment(
            string $date,
            string $hours, 
            string $message, 
            int $horse_id,
        )
    {
        $errors = array();

        if (empty($date)){
            $errors['date'] = 'Veuillez sélectionner une date.';
        }   
        if (empty($hours)){
            $errors['hours'] = 'Veuillez sélectionner une heure.';
        }
        if (empty($message)){
            $errors['message'] = 'Veuillez préciser la demande de rendez-vous.';
        }
        // -1 = la value 'selectionner un cheval'
        if (($horse_id == -1 )){
            $errors['horse_id'] = 'Veuillez sélectionner un cheval.';
        }

        return $errors;

    }
}