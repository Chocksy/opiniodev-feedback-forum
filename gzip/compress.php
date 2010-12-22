<?php
error_reporting(E_ALL&~E_NOTICE);
$basedir = $_SERVER['DOCUMENT_ROOT'];
$file = realpath( $basedir . $_SERVER["REQUEST_URI"] );

if( !file_exists($file) && strpos($file, $basedir) === 0 ) {
    header("HTTP/1.0 404 Not Found");
    print "File does not exist.";
    exit();
}

$path_info = pathinfo($file);
$extension=$path_info['extension'];

switch($extension) {
    case 'css':
        $mime = "text/css";
        break;
    case'js':
        $mine = "text/javascript";
        break;
    default:
        $mime = "text/plain";
}

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler");
else
    ob_start();
header( "Content-Type: " . $mime . "; charset: UTF-8");
header ("cache-control: must-revalidate");
readfile($file);
?>
