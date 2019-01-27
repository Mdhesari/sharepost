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

    public function fetch($id, $get = true)
    {
        $this->db->query('SELECT comments.id, comments.post_id, comments.text, users.full_name, users.email, users.username, users.accessiblity,
                          users.id as userId
                          FROM comments
                          INNER JOIN users ON comments.user_id = users.id
                          WHERE post_id=:id
                          ');
        $this->db->bind(':id', $id);
        $row = $this->db->resultSet();

        if ($get) {
            return $row;
        }

        return $this->db->rowCount();
    }

}
