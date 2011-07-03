<?
include('../../../core/main.class.php');
$main = new Main;
//check for loged in

$title=Security::secureString($_GET['title']);
$descr=Security::secureString($_GET['description']);
$auth_id = session::get_param('user_id');
$main->con()->db_query("INSERT INTO feedback_ideas (idea,description,sub_date,auth_id) VALUES('$title','$descr',NOW(),'$auth_id')");
//insert si in votes votu lu asta!
$id=mysql_insert_id();
$idea=mysql_fetch_array($main->con()->db_query("SELECT idea,id FROM feedback_ideas WHERE id='$id'"));
$url=HTTP_CORE_BASE.'idea/id/'.$idea['id'].'/'.render::makeTitle($idea['idea']);
echo '&url='.$url;
?>