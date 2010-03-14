<?
include('../includes/app_top.php');
$term=secure_string($_GET['term']);
$result_resources = $db->db_query("SELECT *, MATCH(idea, description) AGAINST('$term') AS score FROM feedback_ideas
                                WHERE MATCH(idea, description) AGAINST('$term') ORDER BY score DESC LIMIT ".$conf->IDEAS_PER_PAGE);
while ($info = mysql_fetch_array($result_resources)) {
    $ideas[]=$info;
}
$highliter='<span style="background:yellow;">\1</span>';
if(!empty($ideas)) {
    foreach($ideas as $idea) { ?>
<br/>
<div class="idea_container">
    <div class="votes">
        <div class="nr_votes <?=($idea['status']==4) ? 'full' : ''?>">
                    <?=dynamicFont(number_format($idea['votes'],0,'',','),32)?><br/>
            votes<br/>
        </div>
                <? if($idea['status']!=4) { ?>
        <a href="" class="do_vote">vote</a>
                    <? } ?>
                <? if($idea['status']!=0) { ?>
        <div class="nr_votes <?=giveStatus($idea['status'],'class')?>"><?=giveStatus($idea['status'],'text')?></div>
                    <? } ?>
    </div>
    <div class="idea">
        <div class="title nomrg"><a href="<?=$conf->HTTP_SERVER_BASE?>idea/<?=$idea['id']?>-<?=makeTitle($idea['idea'])?>"><b><?=str_highlight($idea['idea'], $term, $highliter);?></b></a></div>
        <div class="auth_desc">
                    <?=str_highlight(shortString($idea['description'],300,' ...  <a href=""><b>More</b></a>'),$term,$highliter)?>
        </div>
        <div class="auth_inf">
            Suggested by <a href="">Chocksy</a> | <a href="<?=$conf->HTTP_SERVER_BASE?>idea/<?=$idea['id']?>-<?=makeTitle($idea['idea'])?>"><b><?=giveComments($idea['comments'])?></b></a>
        </div>
                <? if(!empty($idea['admin_comment'])) { ?>
        <div class="admin_comment">
            <div class="ad_<?=giveStatus($idea['status'],'class')?>"></div>
            <div class="ad_comment">
                            <?=$idea['admin_comment']?>
            </div>
            <div class="auth_inf">
                by <a href="">Gogu</a> (admin)
            </div>
        </div>
                    <? } ?>
    </div>
</div>
<br clear="all"/><br/><br/>
        <? }
}else {?>
<div class="not_found">The idea is not found. You should suggest it!</div>
    <? } ?>