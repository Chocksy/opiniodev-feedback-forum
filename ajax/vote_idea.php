<?
include('../includes/app_top.php');

//check for loged in
$id=secure_string($_GET['id']);
$idea=mysql_fetch_array($db->db_query("SELECT votes FROM feedback_ideas WHERE id='$id'"));

if ($session->check()) {
    $voter_id=$session->get_param('user_id');
    $db->db_query("UPDATE feedback_ideas SET votes=votes+1 WHERE id='$id'");
    $db->db_query("INSERT INTO feedback_votes (idea_id,voter_id) VALUES('$id','$voter_id')");
}
?>
<?=dynamicFont(number_format(($idea['votes']+1),0,'',','),32)?><br/>
votes<br/>