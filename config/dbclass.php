<?php
class DBClass {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "khatabook";

    public $connection;

    // get the database connection
    public function getConnection()
    {

        $this->connection = null;

        try
        {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);            
        }
        catch(exception $exception)
        {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}

?>