<?php

class func {

    var $db;

    function __construct() {
        $this->db = new Conn;
    }

    function dynamicFont($text, $max_font) {
        $txt_leng = strlen($text);

        if ($txt_leng < 9) {
            $html = '<b style="font-size:' . ($max_font - ($txt_leng * 2.7)) . 'px">' . $text . '</b>';
        } else {
            $html = '<b style="font-size:9px">' . $text . '</b>';
        }
        return $html;
    }

    function giveStatus($id, $type) {
        switch ($id) {
            case '1':
                $status['text'] = 'under review';
                $status['class'] = 'review';
                break;
            case '2':
                $status['text'] = 'planned';
                $status['class'] = 'planned';
                break;
            case '3':
                $status['text'] = 'started';
                $status['class'] = 'started';
                break;
            case '4':
                $status['text'] = 'completed';
                $status['class'] = 'completed';
                break;
            case'5':
                $status['text'] = 'duplicate';
                $status['class'] = 'duplicate';
                break;
            case'6':
                $status['text'] = 'declined';
                $status['class'] = 'declined';
                break;
            default:
                $status['text'] = '';
                $status['class'] = '';
                break;
        }
        return $status[$type];
    }

    function giveAuthor($id) {
        $config = new config();
        if ($id == '0')
            return 'Anonymous';
        else {
            $author = mysql_fetch_array($this->db->db_query("SELECT username FROM " . $config->USERS_TABLE . " WHERE id='$id'"));
            return $author['username'];
        }
    }

    function giveComments($nr) {
        if ($nr != 1) {
            $text = $nr . ' comments';
        } else {
            $text = $nr . ' comment';
        }
        return $text;
    }

    function str_highlight($text, $needle, $highlight = '<strong>\1</strong>') {
        $pattern = '#(?!<.*?)(%s)(?![^<>]*?>)#';
        $sl_pattern = '#<a\s(?:.*?)>(%s)</a>#';

        $pattern .= 'i';
        $sl_pattern .= 'i';

        $needle = explode(' ', $needle);
        foreach ($needle as $needle_s) {
            $needle_s = preg_quote($needle_s);
            $regex = sprintf($pattern, $needle_s);
            $text = preg_replace($regex, $highlight, $text);
        }

        return $text;
    }

    function makeTitle($text) {
        $text = strtolower(trim($text));
        $code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
        $code_entities_replace = array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $text = str_replace($code_entities_match, $code_entities_replace, $text);
        return $text;
    }

    function shortString($string, $length, $replacer=' ...') {
        if (strlen($string) > $length)
            return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length + 1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
        return $string;
    }

    function secure_string($string) {
        return filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    function array_search_r($needle, $haystack) {
        foreach ($haystack as $value) {
            if (is_array($value))
                $match = self::array_search_r($needle, $value);
            if ($value == $needle)
                $match = 1;
            if ($match)
                return 1;
        }
        return 0;
    }

    function checkVoted($idea_id, $voted_ideas) {
        if ($this->array_search_r($idea_id, $voted_ideas) || !Session::check())
            return true;
        else
            return false;
    }
}

?>