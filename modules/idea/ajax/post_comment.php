<?
include('../../../core/main.class.php');
$main = new Main;

if (session::check()) {
    $user_id = session::get_param('user_id');
    $idea_id = Security::secureString($_GET['idea_id']);
    $comment = Security::secureString(strip_tags($_GET['comment']));
    $admin_change = Security::secureString(strip_tags($_GET['admin_change']));
    if ($admin_change == '1') {
        $main->con()->db_query("UPDATE feedback_ideas SET admin_comment='$comment' WHERE id='$idea_id'");
    } else {
        $main->con()->db_query("INSERT INTO feedback_comments (idea_id,user_id,comment,date) VALUES('$idea_id','$user_id','$comment',NOW())");
        $main->con()->db_query("UPDATE feedback_ideas SET comments=comments+1 WHERE id='$idea_id'");
    }
}
?>

