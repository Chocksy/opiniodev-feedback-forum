<?php

class Arrays {

    public static function arrayFilter($arr, $recursive=1) {
        $new_array = array();
        for ($i = 0; $i < count($arr); $i++) {
            //recursive delete empty keys
            if (is_array($arr[$i]) && $recursive) {
                //TO DO
                //   self::arrayFilter($arr[$i]);
            }
            //delete empty key
            else if (trim($arr[$i]) != "")
                $new_array[] = $arr[$i];
            //put other arrays untouched for now
            if (is_array($arr[$i]))
                $new_array[] = $arr[$i];
        }
        return $new_array;
    }

}

?>
