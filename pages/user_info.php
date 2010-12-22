<?php
$qmy_ideas=$db->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE auth_id='".$session->get_param('user_id')."' ORDER BY sub_date DESC LIMIT 4");
while($idea=mysql_fetch_array($qmy_ideas))
    $my_ideas[]=$idea;

$qmy_votes=$db->db_query("SELECT * FROM feedback_votes WHERE voter_id='".$session->get_param('user_id')."' ORDER BY id DESC LIMIT 4");
while($vote=mysql_fetch_array($qmy_votes)){
    $idea=mysql_fetch_array($db->db_query("SELECT id,idea,votes FROM feedback_ideas WHERE id='".$vote['idea_id']."'"));
    $my_votes[]=$idea;
}
?>
<? if ($session->check()) { ?>
<div id="user_info">
    <img src="<?=$conf->DIR_IMG?>avatar.jpg" class="avatar" alt="avatar"/>
    <div class="info">
        <div class="title nomrg">Your Ideas</div>
        <ul class="ideas">
                <? if(is_array($my_ideas)) foreach($my_ideas as $idea) { ?>
            <li><a href="<?=$conf->HTTP_SERVER_BASE?>idea/<?=$idea['id']?>-<?=makeTitle($idea['idea'])?>"><?=shortString($idea['idea'],30,'...');?></a><div class="idea_inf"><?=number_format($idea['votes'],0,'',',')?> votes</div></li>
                    <? } ?>
        </ul>
    </div>
    <div class="info">
        <div class="title nomrg">Voted Ideas</div>
        <ul class="ideas">
                <? if(is_array($my_votes)) foreach($my_votes as $vote) { ?>
            <li><a href="<?=$conf->HTTP_SERVER_BASE?>idea/<?=$vote['id']?>-<?=makeTitle($vote['idea'])?>"><?=shortString($vote['idea'],30,'...');?></a><div class="idea_inf"><?=number_format($vote['votes'],0,'',',')?> votes</div></li>
                    <? } ?>
        </ul>
    </div>
    <br clear="all"/>
</div>
    <? } ?>