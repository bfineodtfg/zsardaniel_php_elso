<?php

class dbConnection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor to initialize database connection details
    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Establishes the database connection
    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Executes an SQL command
    public function execute($sql)
    {
        if (!$this->conn) {
            $this->connect();
        }

        $result = $this->conn->query($sql);

        if ($result === FALSE) {
            echo "Error executing SQL: " . $this->conn->error;
        }

        return $result;
    }

    // Closes the database connection
    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>
