<?
include('../includes/app_top.php');

//check for loged in

$title=secure_string($_GET['title']);
$descr=secure_string($_GET['description']);
$db->db_query("INSERT INTO feedback_ideas (idea,description,sub_date) VALUES('$title','$descr',NOW())");
//insert si in votes votu lu asta!
$id=mysql_insert_id();
$idea=mysql_fetch_array($db->db_query("SELECT idea,id FROM feedback_ideas WHERE id='$id'"));
$url=$conf->HTTP_SERVER_BASE.'idea/'.$idea['id'].'-'.makeTitle($idea['idea']);
echo '&url='.$url;
?>