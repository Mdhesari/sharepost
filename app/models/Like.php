<?php

/**
 * Like Model
 */
class Like
{
    /**
     * Database object
     *
     * @var object
     */
    private $db;

    /**
     * Set database object @var
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = new Database;

    }

    /**
     * Count all likes for each post
     *
     * @param int $id
     * @return int
     */
    public function countAll($id)
    {
        $this->db->query('SELECT id
                          FROM likes
                          WHERE post_id=:post_id');
        $this->db->bind(':post_id', $id);
        $this->db->exec();
        return $this->db->rowCount();
    }

    /**
     * Increment like
     *
     * @param array $data
     * @return bool
     */
    public function add($data)
    {
        $this->db->query('INSERT INTO likes (user_id,post_id)
                          VALUES (:user_id,:post_id)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        return $this->db->exec();
    }

    /**
     * Decrement like
     *
     * @param array $data
     * @return bool
     */
    public function remove($data)
    {
        $this->db->query('DELETE FROM likes
                          WHERE user_id=:user_id
                          AND post_id=:post_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        return $this->db->exec();

    }

    /**
     * Check llike existence
     *
     * @param array $data
     * @return bool
     */
    public function check($data)
    {
        $this->db->query('SELECT id
                          FROM likes
                          WHERE user_id=:user_id
                          AND post_id=:post_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->exec();

        return $this->db->rowCount();
    }

}
