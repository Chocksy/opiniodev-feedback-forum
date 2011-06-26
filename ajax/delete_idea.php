<?

include('../includes/app_top.php');

//check for loged in
$id = $func->secure_string($_GET['id']);

if ($session->check() && Session::get_param('admin')) {
    $db->db_query("DELETE FROM feedback_ideas WHERE id='$id'");
}
?>