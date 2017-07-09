<?php
class SQLWrapper {
    private $conn = null;
    private $servername = "localhost";
    private $username = "shevtsod";
    private $password = "";
    private $dbname = "develop";

    /*
        Establish a connection to the database
    */
    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
    }

    /*
        Close the connection to the database
    */
    public function __destruct() {
        $this->conn = null;
    }

    /*
        Executes an SQL query using a prepared statement and returns the result array
        Params:
            $stmt - The prepared statement
            $params - Parameters in prepared statement
        Return:
            array containing all of the result set rows
    */
    public function query($params, $stmt) {
        $query = $this->conn->prepare($stmt);
        $query->execute($params);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>