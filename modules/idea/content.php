<?php
if (!defined('CORE_DIR'))
    die('No direct script access allowed');
?>
<div class="idea_container">
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
        <div class="title nomrg"><b><?= $idea['idea'] ?></b></div>
        <div class="auth_desc">
            <?= $idea['description'] ?>
        </div>
        <div class="auth_inf">
            Suggested by <?= render::giveAuthor($idea['auth_id']) ?>
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
        <? if (Session::get_param('admin')) { ?>
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
        <br clear="all"/>
        <br/>
    </div>
    <br clear="all"/>
    <div class="before_line"></div>
    <div class="idea_info">
        <div class="nr_comments fleft"><?= render::giveComments($idea['comments']) ?></div>
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
                    <? if (session::get_param('admin')) { ?>
                        <a href="javascript:void(0)" class="delete_com" onclick="IDE.deleteComment('<?= $comment['com_data']['id'] ?>')">Delete</a>
                    <? } ?>
                </div>
                <br clear="all"/>
            </div>
        <? } ?>

    <? if ($total_pages > 1) { ?>
        <div class="pagination" style="float: right;">
            <? if ($page > 1) { ?>
                <a class="paginate" href="<?= HTTP_CORE_BASE . $idea_link . '/page/' . $prev_page ?>">&laquo; Previous</a> :
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
                    echo '<a class="paginate" href="' . HTTP_CORE_BASE . $idea_link . '/page/' . $i . '">' . $i . '</a>&nbsp;';
            }
            if ($total_pages - $page > 4)
                echo '<span class="dots">...</span>&nbsp;';
            ?>
            <? if ($page < $total_pages) { ?>
                : <a class="paginate" href="<?= HTTP_CORE_BASE . $idea_link . '/page/' . $next_page ?>">Next &raquo;</a>
            <? } else {
                ?>
                : <span class="dots">Next &raquo;</span>
            <? } ?>
        </div>
    <? } ?>
    <br/>
    <? if (session::check()) { ?>
        <!--Post comment-->
        <div class="comentit">
            <div class="sayit">Say something:</div>
            <form action="javascript:void(0)" id="post_comment">
                <input type="hidden" id="idea_id" name="idea_id" value="<?=$id?>"/>
                <label for="comment">Comment...</label>
                <textarea id="comment" name="comment" rows="5" cols="5"></textarea>
                <input type="submit" class="medium button red" value="Say it"/>
                <? if (session::get_param('admin')) { ?>
                    <label><input type="checkbox" value="1" id="admin_change" name="admin_change"/> Change the administrator comment.</label>
                    <? } ?>
            </form>
        </div>
    <? } ?>
</div>
<br clear="all"/>
