<?php

/**
 * User Model : Related to database stuff
 * @return data from database
 * Modify database content
 */
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findByEmail($email)
    {
        $this->db->query('SELECT *
                          FROM users
                          WHERE email=:email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
