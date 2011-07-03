<?php

class Security {

    public static function secureString($value) {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Quote if not integer
        if (!is_numeric($value)) {
            $value = mysql_real_escape_string($value);
        }
        filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        return $value;
    }

    public static function isAjax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }

    public static function generateSlug($phrase, $maxLength=255) {
        $result = strtolower($phrase);

        $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
        $result = trim(preg_replace("/[\s-]+/", " ", $result));
        $result = trim(substr($result, 0, $maxLength));
        $result = preg_replace("/\s/", "-", $result);

        return $result;
    }

    public static function validEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    function createPassword($length=8, $use_upper=1, $use_lower=1, $use_number=1, $use_custom="") {
        $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $lower = "abcdefghijklmnopqrstuvwxyz";
        $number = "0123456789";
        if ($use_upper) {
            $seed_length += 26;
            $seed .= $upper;
        }
        if ($use_lower) {
            $seed_length += 26;
            $seed .= $lower;
        }
        if ($use_number) {
            $seed_length += 10;
            $seed .= $number;
        }
        if ($use_custom) {
            $seed_length +=strlen($use_custom);
            $seed .= $use_custom;
        }
        for ($x = 1; $x <= $length; $x++) {
            $password .= $seed{rand(0, $seed_length - 1)};
        }
        return($password);
    }

    public static function rm($directory, $empty=FALSE) {
        if (substr($directory, -1) == '/') {
            $directory = substr($directory, 0, -1);
        }
        if (!file_exists($directory) || !is_dir($directory)) {
            return FALSE;
        } elseif (!is_readable($directory)) {
            return FALSE;
        } else {
            $handle = opendir($directory);

            while (FALSE !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    $path = $directory . '/' . $item;

                    if (is_dir($path)) {
                        self::rm($path);
                    } else {
                        unlink($path);
                    }
                }
            }
            closedir($handle);

            if ($empty == FALSE) {
                if (!rmdir($directory)) {
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    public static function convertDate($date, $inverse) {
        $month = array('Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);
        if ($inverse) {
            $month = array_keys($month);
            $date = explode("-", $date);
            $_date = $date[2] . ' ' . $month[(int) $date[1] - 1] . ' ' . $date[0];
        } else {
            $date = explode(" ", $date);
            $_date = $date[2] . '/' . $month[$date[1]] . '/' . $date[0];
        }
        return $_date;
    }

    public static function openDir($dir, $exception=array()) {
        $files = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != '.' && $file != '..') {
                        $path_parts = pathinfo($file);
                        if (in_array(strtolower($path_parts['extension']), $exception))
                            $files[] = $file;
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }

}

?>