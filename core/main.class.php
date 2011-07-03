<?php

//localhost test
if ($_SERVER['SERVER_ADDR'] == '127.0.0.1')
    $linfo = array('directory' => 'opiniodev/', 'host' => 'localhost', 'db_name' => 'opiniodev', 'db_username' => 'root', 'db_password' => '');
else
    $linfo=array('directory' => 'opiniodev/', //you will have to set this to "" if you place this in root of server.
        'host' => 'localhost', 'db_name' => 'MYSQLSERVER_DATABASE', 'db_username' => 'MYSQLSERVER_USERNAME', 'db_password' => 'MYSQLSERVER_PASSWORD');


//define admin directory
/* NO ADMIN DIRECTORY YET
  if (!defined('ADMIN_DIR')) {
  define('ADMIN_DIR', "admin");
  } */

//define shorthand directory separator constant
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
//the absolute path to the core directory
if (!defined('CORE_DIR')) {
    define('CORE_DIR', dirname(__FILE__) . DS);
}

if (!defined('ROOT')) {
    define('ROOT', basename(dirname(CORE_DIR)));
}

if (!defined('CWD')) {
    define('CWD', '/' . $linfo['directory']);
}
if (!defined('LIBRARIES_DIR')) {
    define('LIBRARIES_DIR', CORE_DIR . 'libraries' . DS);
}
if (!defined('PLUGINS_DIR')) {
    define('PLUGINS_DIR', $_SERVER['DOCUMENT_ROOT'] . CWD . 'core' . DS . 'plugins' . DS);
}
if (!defined('HTTP_CORE_BASE')) {
    define('HTTP_CORE_BASE', "http://" . $_SERVER['SERVER_NAME'] . CWD);
}
if (!defined('DB_HOST')) {
    define('DB_HOST', $linfo['host']);
}
if (!defined('DB_NAME')) {
    define('DB_NAME', $linfo['db_name']);
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', $linfo['db_username']);
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', $linfo['db_password']);
}
if (!defined('JS_DIR')) {
    define('JS_DIR', "http://" . $_SERVER['SERVER_NAME'] . CWD . 'core/js/');
}
if (!defined('MASTER_EMAIL')) {
    define('MASTER_EMAIL', 'admin@opiniodev.com');
}
//Akismet stuff
if (!defined('WPAPIKEY')) {
    define('WPAPIKEY', '');
}
if (!defined('WPAKIURL')) {
    define('WPAKIURL', "http://" . $_SERVER['SERVER_NAME']);
}
//include the configuration file
include($_SERVER['DOCUMENT_ROOT'] . CWD . "core/config.inc.php");
/**
 * register the class autoloader
 */
spl_autoload_extensions('.class.php');
set_include_path(LIBRARIES_DIR);
spl_autoload_register();
spl_autoload_register('loadPlugins');

class Main {

// exception handler
    private $exception_handler = null;
//php plugins directory
    private $plugins_dir = null;
    //@TODO cache implemenation
// cache directory
    private $cache_dir = null;
// config directory
    private $config_dir = null;
// caching enabled
    private $caching = false;
// cache lifetime
    private $cache_lifetime = 3600;
    //initialize connection to the database
    private static $con;

    public function __construct() {
        if (!empty($this->exception_handler))
            set_exception_handler($this->exception_handler);
        $this->plugins_dir = PLUGINS_DIR;
        //data encapsulation
        self::$con = new Conn;
        Session::start(SESSION_NAME);
    }

    public function __destruct() {
// restore to previous exception handler, if any
        if (!empty($this->exception_handler))
            restore_exception_handler();
    }

//exception handler method
    public function setExceptionHandler($handler) {
        $this->exception_handler = $handler;
        return set_exception_handler($handler);
    }

//load plugins/functions
    public function loadPlugin($plugin_name, $check = true) {
        // Plugin name is expected to be: [name].class
        $_plugin_name = strtolower($plugin_name);
        $_name_parts = explode('.', $_plugin_name, 2);
        // if function or class exists, exit silently (already loaded)
        if (!$check || (!is_callable($_name_parts[1]) && !class_exists($_name_parts[1], false))) {
            // class name must have two parts to be valid plugin
            if (count($_name_parts) < 2 || $_name_parts[1] !== 'class')
                throw new Exception("plugin {$plugin_name} is not a valid name format");
            $file = $this->plugins_dir . $_plugin_name . '.php';
            if (file_exists($file))
                require_once($file);
        }
    }

    public function modulesUrl($pagename) {
        $file = $_SERVER['DOCUMENT_ROOT'] . CWD . "modules" . '/' . $pagename . '/' . "content.php";
        if (!is_file($file)) {
            header('HTTP/1.0 404 NOT FOUND');
            include('_errors/404.php');
            exit();
        }else
            return $file;
    }

    public function controllerUrl($pagename) {
        return $_SERVER['DOCUMENT_ROOT'] . CWD . "modules" . '/' . $pagename . '/' . "controller.php";
    }

//return db connection
    public function con() {
        return self::$con;
    }

    public function redirect($url) {
        if (!headers_sent()) {
            header('Location:' . $url);
            die();
        } else {
            //this should be used in extreme cases
            die("<script type='text/javascript'><!--\n
        location.href='$url';\n
        //--></script>\n");
        }
    }

}

function loadPlugins($class_name) {
    $_class = strtolower($class_name);
    require_once PLUGINS_DIR . $_class . '.class.php';
}

?>