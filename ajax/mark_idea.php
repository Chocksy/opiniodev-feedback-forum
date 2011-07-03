<?
include('../core/main.class.php');
$main = new Main;
//check for loged in
$id=Security::secureString($_GET['id']);
$status=Security::secureString($_GET['status']);

if (session::check() && session::get_param('admin')) {
    $main->con()->db_query("UPDATE feedback_ideas SET status='$status' WHERE id='$id'");
    $info=array('status'=>'<div id="status_'.$id.'" class="nr_votes '.render::giveStatus($status, "class").'">'.render::giveStatus($status, "text").'</div>',
        'adm_com'=>'<div id="com_status_'.$id.'" class="ad_'.render::giveStatus($status, "class").'"></div>');
    echo json_encode($info);
}
?>