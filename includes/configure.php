<?php
if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
// local config
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'hack');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
} else {
// online config
    define('DB_HOST', 'localhost');
    define('DB_NAME', '');
    define('DB_USERNAME', '');
    define('DB_PASSWORD', '');
}

ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
class config {
    //session data{
    Const check_browser     = true;
    Const check_ip_blocks   = 4;
    Const session_salt 	    = 'secure';
    Const regenerate_id     = true;
    Const session_timeout   = 0;
    //end}

    //info data{
    var $SITE_TITLE='Feedbacker';
    var $IDEAS_PER_PAGE='5';
    var $COMMENTS_PER_PAGE='5';
    var $DS=DIRECTORY_SEPARATOR;
    //end}

    //location data{
    var $local_base='http://localhost/feedbacker/';
    var $online_base='http://ajaxmasters.com/development/feedback-forum/';

    var $HTTP_SERVER_BASE='';
    var $HTTP_SERVER_BASE_JAVA='';

    var $LOGIN_URL= 'getin';
    var $SIGNUP_URL = 'getin';
    var $DIR_CSS='css/';
    var $DIR_JS='js/';
    var $DIR_IMG='images/';
    //end}

    //user table data{
    var $USERS_TABLE='players';
    var $USERNAME='username';
    var $EMAIL='email';
    var $PASSWORD='password';
    var $JOINDATE='joindate';
    var $USR_ID='id';
    //end}

    function __construct() {
        if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            $this->HTTP_SERVER_BASE=$this->local_base;
            $this->HTTP_SERVER_BASE_JAVA=$this->local_base;
        } else {
            $this->HTTP_SERVER_BASE=$this->online_base;
            $this->HTTP_SERVER_BASE_JAVA=$this->online_base;
        }
        $this->SIGNUP_URL=$this->HTTP_SERVER_BASE.$this->SIGNUP_URL;
        $this->LOGIN_URL=$this->HTTP_SERVER_BASE.$this->LOGIN_URL;
        $this->DIR_CSS=$this->HTTP_SERVER_BASE.$this->DIR_CSS;
        $this->DIR_JS=$this->HTTP_SERVER_BASE.$this->DIR_JS;
        $this->DIR_IMG=$this->HTTP_SERVER_BASE.$this->DIR_IMG;
    }
}
$conf=new config;
?>