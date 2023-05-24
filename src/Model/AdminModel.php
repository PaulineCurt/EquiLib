<?php

namespace App\Model;

use App\Entity\Admin;
use App\Core\AbstractModel;

class adminModel extends AbstractModel {
    
    public function addAdmin(Admin $admin)
    {
        $sql = 'INSERT INTO admin (id, email) 
                VALUES 
                (?, ?) ';

        $values = [
            $admin->getId(),
            $admin->getEmail(),

        ];

        return $this->db->insert($sql, $values);
    }
    
    public function getAdmin()
    {
        $datas = [];

        // Récupération des données depuis la table
        $sql = "SELECT * FROM admin ";

        return $datas;
    }

    public function getAdminByEmail(string $email)
    {
    
        $sql = 'SELECT * 
                FROM admin
                WHERE email = ?';

        $result = $this->db->getOneResult($sql, [$email]);

        if (!$result) {
            return null;
        }

        return new Admin($result);
    }
}