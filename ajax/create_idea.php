<?
include('../includes/app_top.php');

//check for loged in

$title=$func->secure_string($_GET['title']);
$descr=$func->secure_string($_GET['description']);
$auth_id = Session::get_param('user_id');
$db->db_query("INSERT INTO feedback_ideas (idea,description,sub_date,auth_id) VALUES('$title','$descr',NOW(),'$auth_id')");
//insert si in votes votu lu asta!
$id=mysql_insert_id();
$idea=mysql_fetch_array($db->db_query("SELECT idea,id FROM feedback_ideas WHERE id='$id'"));
$url=$conf->HTTP_SERVER_BASE.'idea/'.$idea['id'].'-'.$func->makeTitle($idea['idea']);
echo '&url='.$url;
?>