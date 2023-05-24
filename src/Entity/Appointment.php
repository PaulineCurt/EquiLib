<?php 

namespace App\Entity;

class Appointment {

     //Par défaut statu 2 "en attente"
     const STATUS_WAITING = 2;

     // Propriétés
     private int $id;
     private string $message;
     private int $status_id = self::STATUS_WAITING;
     private int $professionnal_id;
     private int $patient_id;
     private string $date;
     private string $hours;
     private int $horse_id;

     public function __construct(array $data = [])
     {
         foreach ($data as $propertyName => $value) {
             $setter = 'set' . ucfirst($propertyName);
             if (method_exists($this, $setter)) {
                 $this->$setter($value);
             }
         }
     }



     /**
      * Get the value of id
      */
     public function getId(): int
     {
          return $this->id;
     }

     /**
      * Set the value of id
      */
     public function setId(int $id): self
     {
          $this->id = $id;

          return $this;
     }

     /**
      * Get the value of message
      */
     public function getMessage(): string
     {
          return $this->message;
     }

     /**
      * Set the value of message
      */
     public function setMessage(string $message): self
     {
          $this->message = $message;

          return $this;
     }

     /**
      * Get the value of status_id
      */
     public function getStatusId(): int
     {
          return $this->status_id;
     }

     /**
      * Set the value of status_id
      */
     public function setStatusId(int $status_id): self
     {
          $this->status_id = $status_id;

          return $this;
     }

     /**
      * Get the value of professionnal_id
      */
     public function getProfessionnal_id(): int
     {
          return $this->professionnal_id;
     }

     /**
      * Set the value of professionnal_id
      */
     public function setProfessionnal_id(int $professionnal_id): self
     {
          $this->professionnal_id = $professionnal_id;

          return $this;
     }

     /**
      * Get the value of date
      */
     public function getDate(): string
     {
          return $this->date;
     }

     /**
      * Set the value of date
      */
     public function setDate(string $date): self
     {
          $this->date = $date;

          return $this;
     }

     /**
      * Get the value of hours
      */
     public function getHours(): string
     {
          return $this->hours;
     }

     /**
      * Set the value of hours
      */
     public function setHours(string $hours): self
     {
          $this->hours = $hours;

          return $this;
     }

     /**
      * Get the value of patient_id
      */
     public function getPatient_id(): int
     {
          return $this->patient_id;
     }

     /**
      * Set the value of patient_id
      */
     public function setPatient_id(int $patient_id): self
     {
          $this->patient_id = $patient_id;

          return $this;
     }

     /**
      * Get the value of horse_id
      */
     public function getHorse_id(): int
     {
          return $this->horse_id;
     }

     /**
      * Set the value of horse_id
      */
     public function setHorse_id(int $horse_id): self
     {
          $this->horse_id = $horse_id;

          return $this;
     }
}
