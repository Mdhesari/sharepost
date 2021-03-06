<?php
/**
 * User Model : Related to database stuff
 * @return data from database
 * Modify database content
 */
class Post
{

    private $db;

    public function __construct()
    {

        $this->db = new Database;

    }

    public function edit($data)
    {
        $this->db->query('UPDATE posts
                          SET description=:description, text=:text
                          WHERE id=:id');
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':id',$data['post_id']);
        return $this->db->exec();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM posts WHERE id=:id');
        $this->db->bind(':id', $id);
        return $this->db->exec();
    }

    public function fetchById($id)
    {
        $this->db->query('SELECT *
                      FROM posts
                      WHERE id=:id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query('INSERT INTO posts (user_id,description,text)
                         VALUES (:user_id,:description,:text)');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':text', $data['text']);
            return $this->db->exec();
        } catch (PDOException $err) {
            // handle errors
        }
    }

    public function fetchAll()
    {
        $this->db->query('SELECT *,
                          posts.id as postId,
                          users.id as userId
                          FROM posts
                          INNER JOIN users
                          ON posts.user_id = users.id
                          ORDER BY posts.date DESC');
        return $this->db->resultSet();

    }

}
