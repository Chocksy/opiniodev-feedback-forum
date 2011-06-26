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
                $status['text'] = 'sub revizuire';
                $status['class'] = 'review';
                break;
            case '2':
                $status['text'] = 'planuita';
                $status['class'] = 'planned';
                break;
            case '3':
                $status['text'] = 'inceputa';
                $status['class'] = 'started';
                break;
            case '4':
                $status['text'] = 'completa';
                $status['class'] = 'completed';
                break;
            case'5':
                $status['text'] = 'duplicat';
                $status['class'] = 'duplicate';
                break;
            case'6':
                $status['text'] = 'respinsa';
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
            return 'Anonim';
        else {
            $author = mysql_fetch_array($this->db->db_query("SELECT username FROM " . $config->USERS_TABLE . " WHERE id='$id'"));
            return $author['username'];
        }
    }

    function giveComments($nr) {
        if ($nr != 1) {
            $text = $nr . ' comentarii';
        } else {
            $text = $nr . ' comentariu';
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

    function levenshteinDistance($str1, $str2) {
        $len1 = mb_strlen($str1);
        $len2 = mb_strlen($str2);

        // strip common prefix
        $i = 0;
        do {
            if (mb_substr($str1, $i, 1) != mb_substr($str2, $i, 1))
                break;
            $i++;
            $len1--;
            $len2--;
        } while ($len1 > 0 && $len2 > 0);
        if ($i > 0) {
            $str1 = mb_substr($str1, $i);
            $str2 = mb_substr($str2, $i);
        }

        // strip common suffix
        $i = 0;
        do {
            if (mb_substr($str1, $len1 - 1, 1) != mb_substr($str2, $len2 - 1, 1))
                break;
            $i++;
            $len1--;
            $len2--;
        } while ($len1 > 0 && $len2 > 0);
        if ($i > 0) {
            $str1 = mb_substr($str1, 0, $len1);
            $str2 = mb_substr($str2, 0, $len2);
        }

        if ($len1 == 0)
            return $len2;
        if ($len2 == 0)
            return $len1;

        $v0 = range(0, $len1);
        $v1 = array();

        for ($i = 1; $i <= $len2; $i++) {
            $v1[0] = $i;
            $str2j = mb_substr($str2, $i - 1, 1);

            for ($j = 1; $j <= $len1; $j++) {
                $cost = (mb_substr($str1, $j - 1, 1) == $str2j) ? 0 : 1;

                $m_min = $v0[$j] + 1;
                $b = $v1[$j - 1] + 1;
                $c = $v0[$j - 1] + $cost;

                if ($b < $m_min)
                    $m_min = $b;
                if ($c < $m_min)
                    $m_min = $c;

                $v1[$j] = $m_min;
            }

            $vTmp = $v0;
            $v0 = $v1;
            $v1 = $vTmp;
        }

        return $v0[$len1];
    }

}

?>