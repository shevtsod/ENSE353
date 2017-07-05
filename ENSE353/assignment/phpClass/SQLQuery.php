<?php
require_once 'SQLWrapper.php';

class SQLQuery {
    private $sql = null;
    private $tablename = "subscribers";

    /*
        Constructor for SQLQuery object
    */
    public function __construct() {
        $this->sql = new SQLWrapper;
    }

    /*
        Destructor for SQLQuery object
    */
    public function __destruct() {
        $this->sql = null;
    }

    /*
        Generate the $tablename table in the database
    */
    public function generateTable() {
        $params = array(':tablename' => $this->tablename);
        $stmt = "CREATE TABLE `:tablename` (
                 `id` int(11) NOT NULL,
                 `email` varchar(255) NOT NULL,
                 `password` varchar(255) NOT NULL,
                 `optionA` tinyint(1) DEFAULT 0,
                 `optionB` tinyint(1) DEFAULT 0,
                 `optionC` tinyint(1) DEFAULT 0,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `id` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT";

        $this->sql->query($params, $stmt);
    }

    /*
        Inserts a signed up user into the database
        Params:
            $username - Username string
            $password - Password string
    */
    public function signUp($username, $password) {
        //NOTE: Going to have to use plain text passwords. 
        //Required to use vanilla PHP 5.4.16 which doesn't support the
        //password hashing functionality added in PHP 5.5
        //See: http://php.net/manual/en/function.password-hash.php

    }

    /*
        Gets the current maximum user ID in the table (1 or greater)
        Return:
            maximum ID integer, 0 if no users
    */
    public function getMaxID() {
        $params = array(':tablename' => $this->tablename);
        $stmt = "SELECT id FROM subscribers ORDER BY id DESC LIMIT 1";
        $result = $this->sql->query($params, $stmt);
        
        if(empty($result))
            return 0;
        else
            return $result[0]['id'];
    }
}
?>