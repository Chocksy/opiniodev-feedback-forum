<?php
$qmy_ideas = $db->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE auth_id='" . $session->get_param('user_id') . "' ORDER BY sub_date DESC LIMIT 4");
$my_ideas = array();
while ($idea = mysql_fetch_array($qmy_ideas))
    $my_ideas[] = $idea;

$qmy_votes = $db->db_query("SELECT * FROM feedback_votes WHERE voter_id='" . $session->get_param('user_id') . "' ORDER BY id DESC LIMIT 4");
$my_votes = array();
while ($vote = mysql_fetch_array($qmy_votes)) {
    $idea = mysql_fetch_array($db->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE id='" . $vote['idea_id'] . "'"));
    $my_votes[] = $idea;
}
$user = mysql_fetch_assoc($db->db_query("SELECT " . $conf->USERNAME . "," . $conf->USR_ID . "," . $conf->EMAIL . " FROM " . $conf->USERS_TABLE . " WHERE " . $conf->USR_ID . "='" . Session::get_param('user_id') . "'"));
?>
<? if ($session->check()) { ?>
    <div id="user_info">
        <img src="http://www.gravatar.com/avatar/<?= md5($user['email']) ?>?s=100" class="avatar"/>
        <div class="info">
            <div class="title nomrg">Ideile Tale</div>
            <ul class="ideas">
                <? if (is_array($my_ideas))
                    foreach ($my_ideas as $idea) { ?>
                        <li><a href="<?= $conf->HTTP_SERVER_BASE ?>idea/<?= $idea['id'] ?>-<?= $func->makeTitle($idea['idea']) ?>"><?= $func->shortString($idea['idea'], 30, '...'); ?></a>
                            <div class="idea_inf"><?= number_format($idea['votes'], 0, '', ',') ?> votes</div></li>
                    <? } ?>
            </ul>
        </div>
        <div class="info">
            <div class="title nomrg">Idei Votate</div>
            <ul class="ideas">
                <? if (is_array($my_votes))
                    foreach ($my_votes as $vote) { ?>
                        <li><a href="<?= $conf->HTTP_SERVER_BASE ?>idea/<?= $vote['id'] ?>-<?= $func->makeTitle($vote['idea']) ?>"><?= $func->shortString($vote['idea'], 30, '...'); ?></a>
                            <div class="idea_inf"><?= number_format($vote['votes'], 0, '', ',') ?> votes</div></li>
        <? } ?>
            </ul>
        </div>
        <br clear="all"/>
    </div>
<? } ?>
