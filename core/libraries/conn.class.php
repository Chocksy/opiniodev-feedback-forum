<?php

class Conn {

    protected static $conn;
    var $mysql_database = DB_NAME;
    var $mysql_username = DB_USERNAME;
    var $mysql_password = DB_PASSWORD;
    var $mysql_host = DB_HOST;

    public function __construct() {
        self::$conn = mysql_connect($this->mysql_host, $this->mysql_username, $this->mysql_password);
        if (!self::$conn)
            die('Can\'t connect to database');
        mysql_select_db("$this->mysql_database");
    }

    public function db_query($query) {
        $results = mysql_query($query, self::$conn);
        if (!$results)
            die('DATABASE ERROR ' . mysql_errno() . ' ' . mysql_error());
        return $results;
    }

}
?>