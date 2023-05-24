<?php

namespace App\Entity;

class Breed {

    private int $id;
    private string $breed_name;

    
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
     * Get the value of breed_name
     */
    public function getBreedName(): string
    {
        return $this->breed_name;
    }

    /**
     * Set the value of breed_name
     */
    public function setBreedName(string $breed_name): self
    {
        $this->breed_name = $breed_name;

        return $this;
    }
}