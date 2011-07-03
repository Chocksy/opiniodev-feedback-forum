<?
include('../core/main.class.php');
$main = new Main;
//check for loged in
$id=Security::secureString($_GET['id']);
$idea=mysql_fetch_array($main->con()->db_query("SELECT votes FROM feedback_ideas WHERE id='$id'"));

if (session::check()) {
    $voter_id=session::get_param('user_id');
    $main->con()->db_query("UPDATE feedback_ideas SET votes=votes+1 WHERE id='$id'");
    $main->con()->db_query("INSERT INTO feedback_votes (idea_id,voter_id) VALUES('$id','$voter_id')");
}
?>
<?=render::dynamicFont(number_format(($idea['votes']+1),0,'',','),32)?><br/>
votes<br/>