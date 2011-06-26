<?

include('../includes/app_top.php');

if ($session->check()) {
    $user_id = $session->get_param('user_id');
    $idea_id = $func->secure_string($_GET['idea_id']);
    $comment = $func->secure_string(strip_tags($_GET['comment']));
    $admin_change = $func->secure_string(strip_tags($_GET['admin_change']));
    if ($admin_change == '1') {
        $db->db_query("UPDATE feedback_ideas SET admin_comment='$comment' WHERE id='$idea_id'");
    } else {
        $db->db_query("INSERT INTO feedback_comments (idea_id,user_id,comment,date) VALUES('$idea_id','$user_id','$comment',NOW())");
        $db->db_query("UPDATE feedback_ideas SET comments=comments+1 WHERE id='$idea_id'");
    }
}
?>

