<?
include('../../../core/main.class.php');
$main = new Main;
$term = Security::secureString($_GET['term']);
$result_resources = $main->con()->db_query("SELECT *, MATCH(idea, description) AGAINST('$term') AS score FROM feedback_ideas
                                WHERE MATCH(idea, description) AGAINST('$term') ORDER BY score DESC LIMIT 30");
while ($info = mysql_fetch_array($result_resources)) {
    $ideas[] = $info;
}
$voted_ideas = array();
if (session::check()) {
    $videas_q = $main->con()->db_query("SELECT idea_id FROM feedback_votes WHERE voter_id='" . session::get_param('user_id') . "'");
    while ($i_videas = mysql_fetch_assoc($videas_q))
        $voted_ideas[] = $i_videas;
}

$highliter = '<span style="background:yellow;">\1</span>';
if (!empty($ideas)) {
    foreach ($ideas as $idea) {
        ?>
        <div id="idea_<?= $idea['id'] ?>" class="idea_container">
            <div class="votes">
                <div id="nr_votes_<?= $idea['id'] ?>" class="nr_votes <?= ($idea['status'] == 4 || render::checkVoted($idea['id'], $voted_ideas)) ? 'full' : '' ?>">
                    <?= render::dynamicFont(number_format($idea['votes'], 0, '', ','), 32) ?><br/>
                    votes<br/>
                </div>
                <? if ($idea['status'] != 4 && !render::checkVoted($idea['id'], $voted_ideas)) { ?>
                    <a href="javascript:void(0)" id="do_vote_<?= $idea['id'] ?>" onclick="OPN.vote('<?= $idea['id'] ?>')" class="do_vote">vote</a>
                <? } ?>
                <? if ($idea['status'] != 0) { ?>
                    <div id="status_<?= $idea['id'] ?>" class="nr_votes <?= render::giveStatus($idea['status'], 'class') ?>"><?= render::giveStatus($idea['status'], 'text') ?></div>
                <? } ?>
            </div>

            <div class="idea">
                <div class="title nomrg"><a href="<?= HTTP_CORE_BASE ?>idea/id/<?= $idea['id'] ?>/title/<?= render::makeTitle($idea['idea']) ?>">
                        <b><?= render::str_highlight($idea['idea'], $term, $highliter) ?></b></a></div>
                <div class="auth_desc">
                    <?= render::str_highlight(shortString::convert($idea['description'], 300, ' ...  <a href="' . HTTP_CORE_BASE . 'idea/id/' . $idea['id'] . '/title/' . render::makeTitle($idea['idea']) . '"><b>More</b></a>'),$term,$highliter) ?>
                </div>
                <div class="auth_inf">
                    Suggested by <?= render::giveAuthor($idea['auth_id']) ?> on <?= date('jS \o\f F Y', strtotime($idea['sub_date'])) ?> | 
                    <a href="<?= HTTP_CORE_BASE ?>idea/id/<?= $idea['id'] ?>/title/<?= render::makeTitle($idea['idea']) ?>"><b>
                            <?= render::giveComments($idea['comments']) ?></b></a>
                </div>
                <? if (!empty($idea['admin_comment'])) { ?>
                    <div class="admin_comment">
                        <div id="com_status_<?= $idea['id'] ?>" class="ad_<?= render::giveStatus($idea['status'], 'class') ?>"></div>
                        <div class="ad_comment">
                            <?= $idea['admin_comment'] ?>
                        </div>
                        <div class="auth_inf">
                            by (admin)
                        </div>
                    </div>
                <? } ?>
                <? if (session::get_param('admin')) { ?>
                    <ul class="admin_actions">
                        <? if ($idea['status'] != '3') { ?>
                            <li><a href="javascript:void(0)" class="start" onclick="OPN.markIdea('<?= $idea['id'] ?>','3')">Started</a></li>
                        <? } ?>
                        <? if ($idea['status'] != '2') { ?>
                            <li><a href="javascript:void(0)" class="plan" onclick="OPN.markIdea('<?= $idea['id'] ?>','2')">Planned</a></li>
                        <? } ?>
                        <? if ($idea['status'] != '1') { ?>
                            <li><a href="javascript:void(0)" class="reviz" onclick="OPN.markIdea('<?= $idea['id'] ?>','1')">Under Review</a></li>
                        <? } ?>
                        <? if ($idea['status'] != '4') { ?>
                            <li><a href="javascript:void(0)" class="complet" onclick="OPN.markIdea('<?= $idea['id'] ?>','4')">Completed</a></li>
                        <? } ?>       
                        <li><a href="javascript:void(0)" class="delete_idea" onclick="OPN.deleteIdea('<?= $idea['id'] ?>')">Delete</a></li>
                    </ul>
                <? } ?>
            </div>
        </div>
        <br clear="all"/><br/><br/>
    <? }
} else { ?>
    <div class="not_found">Idea nu a fost gasita. Ar trebui sa o sugerezi!</div>
<? } ?>