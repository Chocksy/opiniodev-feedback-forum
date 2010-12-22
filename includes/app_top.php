<?
session_start();
include('configure.php');
include('class.db.php');
include('functions.php');
include('paginator.class.php');
include('session.class.php');

$db=new Conn;
$paginate = new Paginator;
$session=new session;
?>
