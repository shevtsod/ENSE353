<?php
require_once 'SQLWrapper.php';

class SQLQuery {
    private $sql = null;
    private $tablename = 'subscribers';

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
        $stmt = "CREATE TABLE $this->tablename (
                 `id` int(11) NOT NULL,
                 `email` varchar(255) NOT NULL,
                 `password` varchar(255) NOT NULL,
                 `active` tinyint(1) DEFAULT 0,
                 `optionA` tinyint(1) DEFAULT 0,
                 `optionB` tinyint(1) DEFAULT 0,
                 `optionC` tinyint(1) DEFAULT 0,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `id` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT";

        $this->sql->query(null, $stmt);
    }

    /*
        Gets the current maximum user ID in the table (1 or greater)
        Return:
            maximum ID integer, 0 if no users
    */
    public function getMaxID() {
        $stmt = "SELECT id FROM `$this->tablename` ORDER BY id DESC LIMIT 1";
        $result = $this->sql->query(null, $stmt);
        
        if(empty($result))
            return 0;
        else
            return $result[0]['id'];
    }

    /*
        Inserts a signed up user into the database
        Params:
            $email - email string
            $password - Hashed password string
    */
    public function signUp($email, $password) {
        $id = $this->getMaxID() + 1;
        $params = array(':id' => $id,
                        ':email' => $email,
                        ':password' => $password);
        $stmt = "INSERT INTO `$this->tablename` (id, email, password) VALUES (:id, :email, :password)";
        $this->sql->query($params, $stmt);
        
    }

    /*
        Return whether a user with the given email exists already in the table
        Params:
            $email - email string
        Return:
            boolean user exists
    */
    public function userExists($email) {
        $params = array(':email' => $email);
        $stmt = "SELECT * FROM `$this->tablename` WHERE email = :email";
        $result = $this->sql->query($params, $stmt);

        return !empty($result);
    }

    /*
        Return whether a user with the given email has verified their email
        and their account is active
        Params:
            $email - email string
        Return:
            boolean user activated
    */
    public function userActivated($email) {
        $params = array(':email' => $email);
        $stmt = "SELECT active FROM `$this->tablename` WHERE email = :email LIMIT 1";
        $result = $this->sql->query($params, $stmt);

        return (bool) $result[0]['active'];
    }


    /*
        Verify a user with the given email (set the active boolean)
        Params:
            $email - email string
    */
    public function activateUser($email) {
        $params = array(':email' => $email);
        $stmt = "UPDATE `$this->tablename` SET active = 1 WHERE email = :email";
        $this->sql->query($params, $stmt);
    }

    /*
        Return a user's hash from the database to confirm a login password
        Params:
            $email - email string
        Return:
            string password hash
    */
    public function getHash($email) {
        $params = array(':email' => $email);
        $stmt = "SELECT password FROM `$this->tablename` WHERE email = :email LIMIT 1";
        $result = $this->sql->query($params, $stmt);

        if(empty($result))
            return null;

        return $result[0]['password'];
    }

    /*
        Returns an array containing all users in the table
        Return:
            2D array containing all rows in the table
    */
    public function getUsers() {
        $stmt = "SELECT * FROM `$this->tablename`";
        return $this->sql->query(array(), $stmt);
    }

    /*
        Return whether the user with the given email has selected the given option or not
        Params:
            $email - email string
            $option - option string (optionA, optionB, etc.)
        Return:
            boolean option selected
    */
    public function getOption($email, $option) {
        $params = array(':email' => $email, ':option' => $option);
        $stmt = "SELECT :option FROM `$this->tablename` WHERE email = :email LIMIT 1";
        $result = $this->sql->query($params, $stmt);

        if(empty($result))
            return false;

        return (bool) $result[0][$option];
    }
}
?>
