<?php
class Conn {
    public $conn;
    var $mysql_database = DB_NAME;
    var $mysql_username = DB_USERNAME;
    var $mysql_password = DB_PASSWORD;
    var $mysql_host = DB_HOST;

    public function __construct() {
        $this->conn = mysql_connect($this->mysql_host, $this->mysql_username, $this->mysql_password);
        if (!$this->conn) die('Can\'t connect to database');
        mysql_select_db("$this->mysql_database");
    }
    public function __destruct() {
        mysql_close($this->conn);
    }
    public function db_query($query) {
        $results = mysql_query($query,$this->conn);
        if (!$results) die('DATABASE ERROR '. mysql_errno() . ' ' . mysql_error());
        return $results;
    }
}
?>