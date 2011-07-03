<?php

class describeTable {

    private static $con;

    public function __construct() {
        self::$con = new Conn;
    }

    private function describeFields($table) {
        $result = self::$con->db_query("SHOW COLUMNS FROM `" . $table . "`");
        while ($row = mysql_fetch_assoc($result))
            $content[] = $row;
        return $content;
    }

    public function describeFieldsArray($table) {
        $content = $this->describeFields($table);
        foreach ($content as $item)
            $field.=$item['Field'] . ' ';
        $content = explode(" ", $field);
        $content = array_filter($content);
        return $content;
    }

    public function describeFieldsText($table) {
        $content = $this->describeFields($table);
        foreach ($content as $item)
            $field.=$item['Field'] . ' ';
        $content = explode(" ", $field);
        $content = array_filter($content);
        $content = implode(",", $content);
        return $content;
    }

}

?>