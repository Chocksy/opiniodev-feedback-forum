<?php

class Conn {

    public $conn;
    var $mysql_database = DB_NAME;
    var $mysql_username = DB_USERNAME;
    var $mysql_password = DB_PASSWORD;
    var $mysql_host = DB_HOST;
    var $mysql_database2 = DB_NAME2;
    var $mysql_username2 = DB_USERNAME2;
    var $mysql_password2 = DB_PASSWORD2;
    var $mysql_host2 = DB_HOST2;
    var $ftables = array('feedback_ideas', 'feedback_votes', 'members');
    var $stables = array('feedback_comments');

    public function __construct() {
        $this->conn = mysql_connect($this->mysql_host, $this->mysql_username, $this->mysql_password);
        if (!$this->conn)
            die('Can\'t connect to database');
        mysql_select_db("$this->mysql_database");
    }

    public function detectDB($query) {
        preg_match('/FROM (.*) WHERE/', $query, $matches);
        $table = $matches['1'];
        if (in_array($table, $this->ftables)) {
            $this->conn = mysql_connect($this->mysql_host, $this->mysql_username, $this->mysql_password);
            if (!$this->conn)
                die('Can\'t connect to database');
            mysql_select_db("$this->mysql_database");
        }else if (in_array($table, $this->stables)) {
            $this->conn = mysql_connect($this->mysql_host2, $this->mysql_username2, $this->mysql_password2);
            if (!$this->conn)
                die('Can\'t connect to database');
            mysql_select_db("$this->mysql_database2");
        }
    }

    /*
      public function __destruct() {
      mysql_close($this->conn);
      } */

    public function db_query($query) {
        $this->detectDB($query);
        $results = mysql_query($query, $this->conn);
        if (!$results)
            die('DATABASE ERROR ' . mysql_errno() . ' ' . mysql_error());
        return $results;
    }

}

?>