<?php

if (!defined('CORE_DIR'))
    die('No direct script access allowed');

if (!isset($pars['tab']))
    $tab = 'popular';
else
    $tab=$pars['tab'];

if (!isset($pars['page']))
    $page = 1;
else
    $page=$pars['page'];

$curdate = date('Y-m-d');
$weekold = date('Y-m-d', strtotime('-1 week'));
switch ($tab) {
    case'popular':
        $order = ' ORDER BY votes DESC';
        $selu = "status IN('0','1','2','3')";
        break;
    case'accepted':
        $order = ' ORDER BY id DESC';
        $selu = "status IN('1','2','3')";
        break;
    case'completed':
        $order = ' ORDER BY id DESC';
        $selu = "status='4'";
        break;
    case'new':
        $order = ' ORDER BY sub_date DESC';
        $selu = "date(sub_date)='" . $curdate . "' AND status IN('0','1','2','3')";
        break;
    case'hot':
        $order = ' ORDER BY votes DESC';
        $selu = "(date(sub_date)<='" . $curdate . "' AND date(sub_date)>'" . $weekold . "') AND status IN('0','1','2','3')";
        break;
}
$new_rez = mysql_num_rows($main->con()->db_query("SELECT id FROM feedback_ideas WHERE date(sub_date)='" . $curdate . "' AND status IN('0','1','2','3')"));
$acc_rez = mysql_num_rows($main->con()->db_query("SELECT id FROM feedback_ideas WHERE status IN('1','2','3')"));
$com_rez = mysql_num_rows($main->con()->db_query("SELECT id FROM feedback_ideas WHERE status=4"));

$voted_ideas = array();

if (session::check()) {
    $videas_q = $main->con()->db_query("SELECT idea_id FROM feedback_votes WHERE voter_id='" . session::get_param('user_id') . "'");
    while ($i_videas = mysql_fetch_assoc($videas_q))
        $voted_ideas[] = $i_videas;
}
//SEARCH TIME
$sql = "SELECT * FROM feedback_ideas WHERE " . $selu . "" . $order;
$p = new Paginator($sql, IDEAS_PER_PAGE, $pars, $pagename);
$total_pages = $p->getTotalPages();

if ($page > 0)
    $prev_page = $page - 1;

if ($total_pages > $page)
    $next_page = $page + 1;

$result_resources = $p->getPageNumber($page);
while ($info = mysql_fetch_array($result_resources)) {
    $ideas[] = $info;
}

$qmy_ideas =  $main->con()->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE auth_id='" . session::get_param('user_id') . "' ORDER BY sub_date DESC LIMIT 4");
$my_ideas = array();
while ($idea = mysql_fetch_array($qmy_ideas))
    $my_ideas[] = $idea;

$qmy_votes =  $main->con()->db_query("SELECT * FROM feedback_votes WHERE voter_id='" . session::get_param('user_id') . "' ORDER BY id DESC LIMIT 4");
$my_votes = array();
while ($vote = mysql_fetch_array($qmy_votes)) {
    $idea = mysql_fetch_array( $main->con()->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE id='" . $vote['idea_id'] . "'"));
    $my_votes[] = $idea;
}
$user = mysql_fetch_assoc( $main->con()->db_query("SELECT username,id,email FROM members WHERE id='" . session::get_param('user_id') . "'"));
?>