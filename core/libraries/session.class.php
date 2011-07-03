<?php

class session {

    /**
     * Add a parameter with a value to a session
     *
     * @param string $name
     * @param mixed $value 
     */
    static function add_param($name, $value) {
        //session_register($name);
        $_SESSION[$name] = $value;
        //session_write_close();
    }

    /**
     * Get a named parameters value
     *
     * @param string $name
     * @return mixed
     */
    static function get_param($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    /**
     * Delete a parameter with its value from a session
     *
     * @param string $name
     */
    static function delete_param($name) {
        $_SESSION[$name] = "";
        //session_unregister($name);
    }

    /**
     * Fully destroy a session and all its values
     *
     */
    static function destroy() {
        $_SESSION = array();
        session_destroy();
    }

    /**
     * Check to see if the session is scure
     *
     * @return bool
     */
    static function check() {
        if (sessionConfig::session_timeout == 0) {
            return (isset($_SESSION['ss_fprint'])
            && $_SESSION['ss_fprint'] == self::_Fingerprint() && ($_SERVER['HTTP_REFFERER'] != '' ? (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false ? true : false) : true));
        } else {
            $date = date('m/d/Y H:i');
            if (intval(strtotime($date)) < intval(self::get_param('timeout'))) {
                self::add_param('timeout', intval(strtotime($date)) + (60 * intval(sessionConfig::session_timeout)));
                return (isset($_SESSION['ss_fprint'])
                && $_SESSION['ss_fprint'] == self::_Fingerprint() && ($_SERVER['HTTP_REFFERER'] != '' ? (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false ? true : false) : true));
            } else {
                return false;
            }
        }
    }

    /**
     * Starts the secure session
     *
     */
    static function start_secure_session() {
        self::add_param('ss_fprint', self::_Fingerprint());
        //self::_regenerate_id();

        if (sessionConfig::session_timeout > 0) {
            $date = date('m/d/Y H:i');
            self::add_param('timeout', intval(strtotime($date)) + (60 * intval(sessionConfig::session_timeout)));
        }
    }

    static function start($name='') {
        session_name($name);
        session_start();
    }

    private function _Fingerprint() {
        $fingerprint = sessionConfig::session_salt;
        if (sessionConfig::check_browser) {
            $fingerprint .= $_SERVER['HTTP_USER_AGENT'];
        }
        if (sessionConfig::check_ip_blocks) {
            $num_blocks = abs(intval(sessionConfig::check_ip_blocks));
            if ($num_blocks > 4) {
                $num_blocks = 4;
            }
            $blocks = explode('.', $_SERVER['REMOTE_ADDR']);
            for ($i = 0; $i < $num_blocks; $i++) {
                $fingerprint .= $blocks[$i] . '.';
            }
        }
        //self::_regenerate_id();
        return md5($fingerprint);
    }

}

?>