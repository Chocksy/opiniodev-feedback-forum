<?php
if (!defined('CORE_DIR'))
    die('No direct script access allowed');
?>
<? if (session::check()) { ?>
    <div id="user_info">
        <img src="http://www.gravatar.com/avatar/<?= md5($user['email']) ?>?s=100" class="avatar"/>
        <div class="info">
            <div class="title nomrg">Your Ideas</div>
            <ul class="ideas">
                <? if (is_array($my_ideas))
                    foreach ($my_ideas as $idea) { ?>
                        <li><a href="<?= HTTP_CORE_BASE ?>idea/id/<?= $idea['id'] ?>/title/<?= render::makeTitle($idea['idea']) ?>"><?= shortString::convert($idea['idea'], 30, '...'); ?></a>
                            <div class="idea_inf"><?= number_format($idea['votes'], 0, '', ',') ?> votes</div></li>
                    <? } ?>
            </ul>
        </div>
        <div class="info">
            <div class="title nomrg">Voted Ideas</div>
            <ul class="ideas">
                <? if (is_array($my_votes))
                    foreach ($my_votes as $vote) { ?>
                        <li><a href="<?= HTTP_CORE_BASE ?>idea/id/<?= $vote['id'] ?>/title/<?= render::makeTitle($vote['idea']) ?>"><?= shortString::convert($vote['idea'], 30, '...'); ?></a>
                            <div class="idea_inf"><?= number_format($vote['votes'], 0, '', ',') ?> votes</div></li>
                    <? } ?>
            </ul>
        </div>
        <br clear="all"/>
    </div>
<? } ?>
<br clear="all"/>
<div class="search">
    <form action="javascript:void(0)" id="search_form" onsubmit="HOM.showNew()" autocomplete="off">
        <div class="i_t"><b>You should</b>
            <label for="y_idea">(tell us what you want us to do)</label>
            <input type="text" id="y_idea" onkeyup="HOM.search(this)"/>
        </div>
        <input type="submit" value="Cauta" id="create_button" disabled="disabled"/>
    </form>
</div>
<br clear="all"/>
<div id="results"></div>
<div id="init_results">
    <div class="categs">
        <ul>
            <li <?= ($tab == 'popular') ? 'class="active"' : '' ?>>
                <a href="<?= HTTP_CORE_BASE ?>home/tab/popular">Popular</a>
            </li>
            <li <?= ($tab == 'hot') ? 'class="active"' : '' ?>>
                <a href="<?= HTTP_CORE_BASE ?>home/tab/hot">Hot</a>
            </li>
            <li <?= ($tab == 'new') ? 'class="active"' : '' ?>>
                <a href="<?= HTTP_CORE_BASE ?>home/tab/new">New <b class="blue"><?= $new_rez ?></b></a>
            </li>
            <li <?= ($tab == 'accepted') ? 'class="active"' : '' ?>>
                <a href="<?= HTTP_CORE_BASE ?>home/tab/accepted">Accepted <b class="yellow"><?= $acc_rez ?></b></a>
            </li>
            <li <?= ($tab == 'completed') ? 'class="active"' : '' ?>>
                <a href="<?= HTTP_CORE_BASE ?>home/tab/completed">Completed <b class="green"><?= $com_rez ?></b></a>
            </li>
        </ul>
    </div>
    <br clear="all"/>
    <div class="before_line"></div>
    <br clear="all"/>
    <?
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
                    <div class="title nomrg"><a href="<?= HTTP_CORE_BASE ?>idea/id/<?= $idea['id'] ?>/title/<?= render::makeTitle($idea['idea']) ?>"><b><?= $idea['idea'] ?></b></a></div>
                    <div class="auth_desc">
                        <?= shortString::convert($idea['description'], 300, ' ...  <a href="' . HTTP_CORE_BASE.'idea/id/'.$idea['id'].'/title/'.render::makeTitle($idea['idea']). '"><b>More</b></a>') ?>
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
                                by <a href="">Gogu</a> (admin)
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
        <? } ?>
        <br clear="all"/>
        <? if ($total_pages > 1) { ?>
            <div class="before_line"></div>
            <div class="pagination">
                <? if ($page > 1) { ?>
                    <a class="paginate" href="<?= HTTP_CORE_BASE ?>home/page/<?= $prev_page ?>/tab/<?= $tab ?>">&laquo; Previous</a> :
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
                        echo '<a class="paginate" href="' . HTTP_CORE_BASE . 'home/page/' . $i . '/tab/' . $tab . '">' . $i . '</a>&nbsp;';
                }
                if ($total_pages - $page > 4)
                    echo '<span class="dots">...</span>&nbsp;';
                ?>
                <? if ($page < $total_pages) { ?>
                    : <a class="paginate" href="<?= HTTP_CORE_BASE ?>home/page/<?= $next_page ?>/tab/<?= $tab ?>">Next &raquo;</a>
                <? } else {
                    ?>
                    : <span class="dots">Next &raquo;</span>
                <? } ?>
            </div>
            <?
        }
    } else {
        ?>
        <div class="not_found"> There are no results. Please add the idea!</div>
    <? } ?>
</div>
