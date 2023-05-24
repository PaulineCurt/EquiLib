<?php 

namespace App\Core;

abstract class AbstractModel {

    protected Database $db;

    /**
     * Constructeur
     * @TODO injection de dépendances
     * -> créer une factory pour les modèles
     * -> static pour gérer un seul objet Database
     */
    public function __construct()
    {
        $this->db = new Database();
    }
}