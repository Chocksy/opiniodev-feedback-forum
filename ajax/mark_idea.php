<?
include('../includes/app_top.php');

//check for loged in
$id=$func->secure_string($_GET['id']);
$status=$func->secure_string($_GET['status']);

if ($session->check() && Session::get_param('admin')) {
    $db->db_query("DELETE FROM feedback_ideas WHERE id='$id'");
    $info=array('status'=>'<div id="status_'.$id.'" class="nr_votes '.$func->giveStatus($status, "class").'">'.$func->giveStatus($status, "text").'</div>',
        'adm_com'=>'<div id="com_status_'.$id.'" class="ad_'.$func->giveStatus($status, "class").'"></div>');
    
    echo json_encode($info);
}
?>