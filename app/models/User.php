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

    public function findById($id)
    {
        $this->db->query('SELECT *
                          FROM users
                          WHERE id=:id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function login($data)
    {
        // Check if passwords match
        if (password_verify($data['password'], $data['user']->password)) {
            return true;
        }

        return false;

    }

    public function register($data)
    {
        $this->db->query('INSERT
                          INTO users (full_name,email,password,username,gender)
                          VALUES (:full_name,:email,:password,:username,:gender)
                          ');
        $this->db->bind(':full_name', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':gender', $data['gender']);

        // Check if anything is correct
        if ($this->db->exec()) {
            return true;
        }

        return false;
    }

    public function findByUsername($username, $get = false)
    {
        $this->db->query('SELECT *
        FROM users
        WHERE username=:username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if ($get) {
            return $row;
        }

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function findByEmail($email, $get = false)
    {
        $this->db->query('SELECT *
                          FROM users
                          WHERE email=:email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($get) {
            return $row;
        }

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
