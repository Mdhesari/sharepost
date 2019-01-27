<?php

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add($data)
    {
        $this->db->query('INSERT
                         INTO comments (user_id,post_id,text)
                         VALUES (:user_id,:post_id,:text)
                          ');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':text', $data['text']);

        return $this->db->exec();
    }

}
