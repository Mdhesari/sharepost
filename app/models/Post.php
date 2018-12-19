<?php

class Post
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query('SELECT * FROM posts');
        return $this->db->resultSet();
    }

    public function getLastPost(){
        $this->db->query('SELECT * FROM posts where id=:id');
        $this->db->bind(':id',1);
        return $this->db->single();
    }

    public function postCount(){
        $this->getPosts();
        return $this->db->rowCount();
    }
    
}
