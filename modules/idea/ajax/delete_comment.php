<?
include('../../../core/main.class.php');
$main = new Main;

//check for loged in
$id = Security::secureString($_GET['id']);

if (session::check() && session::get_param('admin')) {
    $idea=mysql_fetch_array($main->con()->db_query("SELECT * FROM feedback_comments WHERE id='$id'"));
    $main->con()->db_query("DELETE FROM feedback_comments WHERE id='$id'");
    $main->con()->db_query("UPDATE feedback_ideas SET comments=comments-1 WHERE id='".$idea['idea_id']."'");
}
?>