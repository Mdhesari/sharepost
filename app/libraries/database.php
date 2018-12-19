<?php
/**
 * PDO Based Database Class
 * Getting data from database
 * Connects to database
 * Creates prepared statements
 * Bind values
 * @return rows
 * @return results
 */
class Database
{
    // Database dsn information
    private $server = DB_SERVER;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $name = DB_NAME;
    // Database handlers
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set database source name
        $dsn = "mysql:host=$this->server;dbname=$this->name;charset=utf8mb4";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass);

        } catch (PDOException $err) {
            echo $this->error = $err->getMessage();
        }

    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        // User satement property to bind
        $this->stmt->bindValue($param, $value, $type);

    }

    // Execute the prepared statement
    public function exec(){
        return $this->stmt->execute();
    }

    // Get the result set
    public function resultSet(){
        $this->exec();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get the single result set
    public function single(){
        $this->exec();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}
