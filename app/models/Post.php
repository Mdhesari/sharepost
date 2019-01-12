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
        // if (empty($data['image'])) {
        //     $this->db->query('UPDATE posts
        //                   SET description=:description, text=:text
        //                   WHERE id=:id');
        // } else {}
        $this->db->query('UPDATE posts
                          SET image=:image, description=:description, text=:text
                          WHERE id=:id');
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':id', $data['post_id']);
        
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
            $this->db->query('INSERT INTO posts (user_id,description,text,image)
                         VALUES (:user_id,:description,:text,:image)');
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':text', $data['text']);
            $this->db->bind(':image', $data['image']);
            return $this->db->exec();
        } catch (PDOException $err) {
            // handle errors
        }
    }

    public function fetchByUserId($user_id)
    {
        $this->db->query('SELECT *
                          FROM posts
                          WHERE user_id=:user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function countUserPosts($user_id)
    {
        $this->fetchByUserId($user_id);
        return $this->db->rowCount();

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
