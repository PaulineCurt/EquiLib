<?php

namespace App\Model;

use App\Entity\Appointment;
use App\Core\AbstractModel;
use App\Services\PatientSession;

class AppointmentModel extends AbstractModel {

    
function addAppointment($appointment) {

 
    $sql = "INSERT INTO appointment (professionnal_id, patient_id, date, hours, message, status_id, horse_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";

   // Création d'un tableau associatif pour stocker les données du nouveau rendez-vous
    $values = [
        $appointment->getProfessionnal_id(),
        $appointment->getPatient_id(),
        $appointment->getDate(),
        $appointment->getHours(),
        $appointment->getMessage(),
        $appointment->getStatusId(),
        $appointment->getHorse_id(),
    ];

    return $this->db->insert($sql, $values);
   
}
        // @TODO ajouter horse
    function getAppointment($professionnal_id, $patient_id, $date, $hours, $message, $status_id, $horse_id) 
    {
        $datas = [];

        // Récupération de la liste des rendez-vous qui correspondent aux critères de recherche
        $sql = 'SELECT * FROM appointment 
                WHERE professionnal_id = ? 
                AND patient_id = ? 
                AND date = ? 
                AND hours = ? 
                AND message = ? 
                AND horse_id = ?
                AND status_id = ?';

        // Erreur si le patient n'est pas connecté

        if((new PatientSession)->getPatient()){
            // Retourner la liste des vétérinaires si des vétérinaires existent pour la spécialité sélectionnée
             $result = 'Veuillez vous connecter pour prendre rendez-vous';
              return $result;
            }  

        return $datas;
    }

    function getStatuses(int $status) {

        $sql = "SELECT * FROM status";
        
        $result = $this->db->getAllResults($sql, [$status]);
        
        return new Appointment($result);
    }
    
    public function getAppointmentsByProId(int $proId)
    {
        $sql = "SELECT * FROM appointment
                WHERE professionnal_id = :proId";

        $result = $this->db->getAllResults($sql, [':proId' => $proId]);

        return new Appointment($result);
    }

    public function getAppointmentByPatientId(int $patient_id) {

        $sql = "SELECT * FROM appointment
                WHERE patient_id = :patientId";
        
        $result = $this->db->getAllResults($sql, [':patientId' => $patient_id]);

        return new Appointment($result);
    }

}
