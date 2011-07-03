<?php

if (!defined('CORE_DIR'))
    die('No direct script access allowed');

$voted_ideas = array();
if (session::check()) {
    $videas_q = $main->con()->db_query("SELECT idea_id FROM feedback_votes WHERE voter_id='" . session::get_param('user_id') . "'");
    while ($i_videas = mysql_fetch_assoc($videas_q))
        $voted_ideas[] = $i_videas;
}

$id = $pars['id'];
$idea = mysql_fetch_array($main->con()->db_query("SELECT * FROM feedback_ideas WHERE id='$id'"));
$title = $idea['idea'];

$idea_link = 'idea/id/' . $id . '/title/' . render::makeTitle($title);

if (!isset($pars['page']))
    $page = 1;
else
    $page=$pars['page'];


$order = ' ORDER BY date DESC';
$selu = "idea_id='$id'";
//SEARCH TIME
$sql="SELECT * FROM feedback_comments WHERE " . $selu . "" . $order;
$p = new Paginator($sql,COMMENTS_PER_PAGE,$pars,$pagename);
$total_pages = $p->getTotalPages();

if ($page > 0)
    $prev_page = $page - 1;

if ($total_pages > $page)
    $next_page = $page + 1;

$result_resources = $p->getPageNumber($page);
$comments = array();
while ($info = mysql_fetch_array($result_resources)) {
    $user = mysql_fetch_assoc($main->con()->db_query("SELECT username,id,email FROM members WHERE id='" . $info['user_id'] . "'"));
    $comments[] = array('com_data' => $info, 'user' => $user);
}
?>