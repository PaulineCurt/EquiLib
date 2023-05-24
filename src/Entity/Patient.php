<?php 

// 1. Déclaration du namespace
namespace App\Entity;


// 2. Imports de classe

// 3. Déclaration de la classe Patient
class Patient {

    // Propriétés
    private int $id_patient;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $address;
    private string $phoneNumber;
    private string $password;
    
    // Constructeur
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
    public function getId_patient(): int
    {
        return $this->id_patient;
    }

    /**
     * Set the value of id
     */
    public function setId_patient(int $id_patient): self
    {
        $this->id_patient = $id_patient;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }
    
    /**
     * Get the value of lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
     /**
     * Get the value of address
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress(string $address): self
    {
        $this->address= $address;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

     /**
     * Get the value of phone
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phone
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}