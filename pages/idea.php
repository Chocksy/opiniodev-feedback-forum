<?
$voted_ideas = array();
if (Session::check()) {
    $videas_q = $db->db_query("SELECT idea_id FROM feedback_votes WHERE voter_id='" . Session::get_param('user_id') . "'");
    while ($i_videas = mysql_fetch_assoc($videas_q))
        $voted_ideas[] = $i_videas;
}

$id = $_GET['idea_id'];
$idea = mysql_fetch_array($db->db_query("SELECT * FROM feedback_ideas WHERE id='$id'"));
$title = $_GET['title'];

$idea_link = 'idea/' . $id . '-' . $title;

if (!isset($_GET['page']))
    $page = 1;
else
    $page=$_GET['page'];

$order = ' ORDER BY date DESC';
$selu = "idea_id='$id'";
//SEARCH TIME
$p = new Paginator();
$p->setSQL("SELECT * FROM feedback_comments WHERE " . $selu . "" . $order);
$p->setItemsPerPage($conf->COMMENTS_PER_PAGE);

$total_pages = $p->getTotalPages();

if ($page > 0)
    $prev_page = $page - 1;

if ($total_pages > $page)
    $next_page = $page + 1;

$result_resources = $p->getPageNumber($page);
$comments = array();
while ($info = mysql_fetch_array($result_resources)) {
    $user = mysql_fetch_assoc($db->db_query("SELECT " . $conf->USERNAME . "," . $conf->USR_ID . "," . $conf->EMAIL . " FROM " . $conf->USERS_TABLE . " WHERE " . $conf->USR_ID . "='" . $info['user_id'] . "'"));
    $comments[] = array('com_data' => $info, 'user' => $user);
}
?>
<div class="idea_container">
    <div class="votes">
        <div id="nr_votes_<?= $idea['id'] ?>" class="nr_votes <?= ($idea['status'] == 4 || $func->checkVoted($idea['id'], $voted_ideas)) ? 'full' : '' ?>">
            <?= $func->dynamicFont(number_format($idea['votes'], 0, '', ','), 32) ?><br/>
            votes<br/>
        </div>
        <? if ($idea['status'] != 4 && !$func->checkVoted($idea['id'], $voted_ideas)) { ?>
            <a href="javascript:void(0)" id="do_vote_<?= $idea['id'] ?>" onclick="vote('<?= $idea['id'] ?>')" class="do_vote">vote</a>
        <? } ?>
        <? if ($idea['status'] != 0) { ?>
            <div id="status_<?= $idea['id'] ?>" class="nr_votes <?= $func->giveStatus($idea['status'], 'class') ?>"><?= $func->giveStatus($idea['status'], 'text') ?></div>
        <? } ?>
    </div>
    <div class="idea">
        <div class="title nomrg"><b><?= $idea['idea'] ?></b></div>
        <div class="auth_desc">
            <?= $idea['description'] ?>
        </div>
        <div class="auth_inf">
            Suggested by <?= $func->giveAuthor($idea['auth_id']) ?>
        </div>
        <? if (!empty($idea['admin_comment'])) { ?>
            <div class="admin_comment">
                <div id="com_status_<?= $idea['id'] ?>" class="ad_<?= $func->giveStatus($idea['status'], 'class') ?>"></div>
                <div class="ad_comment">
                    <?= $idea['admin_comment'] ?>
                </div>
                <div class="auth_inf">
                    by <a href="">Gogu</a> (admin)
                </div>
            </div>
        <? } ?>
        <? if (Session::get_param('admin')) { ?>
            <ul class="admin_actions">
                <? if ($idea['status'] != '3') { ?>
                    <li><a href="javascript:void(0)" class="start" onclick="markIdea('<?= $idea['id'] ?>','3')">Started</a></li>
                <? } ?>
                <? if ($idea['status'] != '2') { ?>
                    <li><a href="javascript:void(0)" class="plan" onclick="markIdea('<?= $idea['id'] ?>','2')">Planned</a></li>
                <? } ?>
                <? if ($idea['status'] != '1') { ?>
                    <li><a href="javascript:void(0)" class="reviz" onclick="markIdea('<?= $idea['id'] ?>','1')">Under Review</a></li>
                <? } ?>
                <? if ($idea['status'] != '4') { ?>
                    <li><a href="javascript:void(0)" class="complet" onclick="markIdea('<?= $idea['id'] ?>','4')">Completed</a></li>
                <? } ?>       
                <li><a href="javascript:void(0)" class="delete_idea" onclick="deleteIdea('<?= $idea['id'] ?>')">Delete</a></li>
            </ul>
        <? } ?>
        <br clear="all"/>
        <br/>
    </div>
    <br clear="all"/>
    <div class="before_line"></div>
    <div class="idea_info">
        <div class="nr_comments fleft"><?= $func->giveComments($idea['comments']) ?></div>
        <div class="share">
            <ul>
                <li>
                    Share:
                </li>
                <li>
                    <a href=""><img src="<?= $conf->DIR_IMG ?>facebook.png" alt="facebook"/></a>
                </li>
                <li>
                    <a href=""><img src="<?= $conf->DIR_IMG ?>twitter.png" alt="twitter"/></a>
                </li>
                <li>
                    <a href=""><img src="<?= $conf->DIR_IMG ?>linkedin.png" alt="linkedin"/></a>
                </li>
            </ul>
        </div>
        <br clear="all"/>
    </div>
    <br clear="all"/>
    <? if (is_array($comments))
        foreach ($comments as $comment) { ?>
            <div class="comment" id="comm_<?= $comment['id'] ?>">
                <div class="com_avatar">
                    <img src="http://www.gravatar.com/avatar/<?= md5($comment['user']['email']) ?>?s=50"/>
                </div>
                <div class="com_content">
                    <div class="com_auth"><b><?= $comment['user'][$conf->USERNAME] ?></b></div>
                    <div class="com_text">
                        <?= $comment['com_data']['comment'] ?>
                    </div>
                    <div class="com_date" title="<?= date('Y-m-d\TH:i:s\Z', strtotime($comment['com_data']['date'])); ?>"></div>
                    <? if (Session::get_param('admin')) { ?>
                        <a href="javascript:void(0)" class="delete_com" onclick="deleteComment('<?= $comment['com_data']['id'] ?>')">Delete</a>
                    <? } ?>
                </div>
                <br clear="all"/>
            </div>
        <? } ?>

    <? if ($total_pages > 1) { ?>
        <div class="pagination" style="float: right;">
            <? if ($page > 1) { ?>
                <a class="paginate" href="<?= $conf->HTTP_SERVER_BASE . $idea_link . '?page=' . $prev_page ?>">&laquo; Previous</a> :
                <?
            } else {
                ?>
                <span class="dots">&laquo; Previous</span> :
                <?
            }
            if ($page - 5 > 0)
                echo '<span class="dots">...</span>&nbsp;';

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page)
                    echo '<span class="inactive">' . $page . '</span>&nbsp;';
                else if ($i > $page - 5 && $i < $page + 5)
                    echo '<a class="paginate" href="' . $conf->HTTP_SERVER_BASE . $idea_link . '?page=' . $i . '">' . $i . '</a>&nbsp;';
            }
            if ($total_pages - $page > 4)
                echo '<span class="dots">...</span>&nbsp;';
            ?>
            <? if ($page < $total_pages) { ?>
                : <a class="paginate" href="<?= $conf->HTTP_SERVER_BASE . $idea_link . '?page=' . $next_page ?>">Next &raquo;</a>
            <? } else {
                ?>
                : <span class="dots">Next &raquo;</span>
            <? } ?>
        </div>
    <? } ?>
    <br/>
    <? if ($session->check()) { ?>
        <!--Post comment-->
        <div class="comentit">
            <div class="sayit">Say something:</div>
            <form action="javascript:void(0)" id="post_comment" onsubmit="postComment()">
                <input type="hidden" id="idea_id" name="idea_id" value="<?=$id?>"/>
                <label for="comment">Comment...</label>
                <textarea id="comment" name="comment" rows="5" cols="5"></textarea>
                <input type="submit" class="medium button red" value="Say it"/>
                <? if (Session::get_param('admin')) { ?>
                    <label><input type="checkbox" value="1" id="admin_change" name="admin_change"/> Change the administrator comment.</label>
                    <? } ?>
            </form>
        </div>
    <? } ?>
</div>
<br clear="all"/>
