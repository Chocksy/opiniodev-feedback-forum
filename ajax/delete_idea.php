<?

include('../core/main.class.php');
$main = new Main;
//check for loged in
$id = Security::secureString($_GET['id']);

if (session::check() && session::get_param('admin')) {
    $main->con()->db_query("DELETE FROM feedback_ideas WHERE id='$id'");
}
?>