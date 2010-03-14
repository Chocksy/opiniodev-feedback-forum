<?
include('../includes/app_top.php');

if ($session->check()) {
    $user_id=$session->get_param('user_id');
    $idea_id=secure_string($_GET['idea_id']);
    $comment=secure_string(strip_tags($_GET['comment']));
    $db->db_query("INSERT INTO feedback_comments (idea_id,user_id,comment,date) VALUES('$idea_id','$user_id','$comment',NOW())");
    $db->db_query("UPDATE feedback_ideas SET comments=comments+1 WHERE id='$idea_id'");
}
?>

