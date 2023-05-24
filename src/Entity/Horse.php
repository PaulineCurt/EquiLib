<?php

namespace App\Entity;

class Horse {



    private int $id_horse;
    private string $name;
    private int $breed_id;
    private string $breed_name;
    private string $age; 
    private ?string $image = NULL; 
    private string $description; 
    private int $patient_id;
    
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
    public function getId_horse(): int
    {
        return $this->id_horse;
    }

    /**
     * Set the value of id
     */
    public function setId_horse(int $id_horse): self
    {
        $this->id_horse = $id_horse;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of breed_id
     */
    public function getBreedId(): int
    {
        return $this->breed_id;
    }

    /**
     * Set the value of breed_id
     */
    public function setBreedId(int $breed_id): self
    {
        $this->breed_id = $breed_id;

        return $this;
    }

    /**
     * Get the value of age
     */
    public function getAge(): string
    {
        return $this->age;
    }

    /**
     * Set the value of age
     */
    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of breed_name
     */
    public function getBreed_name(): string
    {
        return $this->breed_name;
    }

    /**
     * Set the value of breed_name
     */
    public function setBreed_name(string $breed_name): self
    {
        $this->breed_name = $breed_name;

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
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}