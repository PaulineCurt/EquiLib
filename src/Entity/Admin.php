<?php 

namespace App\Entity;

class Admin {

    private int $id;
    private string $email;
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