<?php
$tab=$_GET['tab'];
if(!isset($tab))
    $tab='popular';
$page=$_GET['page'];
if(!isset($page))
    $page=1;

$curdate=date('Y-m-d');
switch($tab) {
    case'popular':
        $order=' ORDER BY votes DESC';
        $selu="status IN('0','1','2','3')";
        break;
    case'accepted':
        $order=' ORDER BY id DESC';
        $selu="status IN('1','2','3')";
        break;
    case'completed':
        $order=' ORDER BY id DESC';
        $selu="status='4'";
        break;
    case'new':
        $order=' ORDER BY sub_date DESC';
        $selu="date(sub_date)='".$curdate."' AND status IN('0','1','2','3')";
        break;
    case'hot':
        $order=' ORDER BY votes DESC';
        $selu="date(sub_date)='".$curdate."' AND status IN('0','1','2','3')";
        break;
}
$new_rez=mysql_num_rows($db->db_query("SELECT id FROM feedback_ideas WHERE date(sub_date)='".$curdate."' AND status IN('0','1','2','3')"));
$acc_rez=mysql_num_rows($db->db_query("SELECT id FROM feedback_ideas WHERE status IN('1','2','3')"));
$com_rez=mysql_num_rows($db->db_query("SELECT id FROM feedback_ideas WHERE status=4"));
if(Session::check()) {
    $videas_q=$db->db_query("SELECT idea_id FROM feedback_votes WHERE voter_id='".Session::get_param('user_id')."'");
    while($i_videas=mysql_fetch_assoc($videas_q))
        $voted_ideas[]=$i_videas;
}
//SEARCH TIME
$p = new Paginator();
$p->setSQL("SELECT * FROM feedback_ideas WHERE ".$selu."".$order);
$p->setItemsPerPage($conf->IDEAS_PER_PAGE);

$total_pages=$p->getTotalPages();

if($page>0)
    $prev_page=$page-1;

if($total_pages>$page)
    $next_page=$page+1;

$result_resources = $p->getPageNumber($page);
while ($info = mysql_fetch_array($result_resources)) {
    $ideas[]=$info;
}
?>
<?php include('user_info.php');?>
<br clear="all"/>
<div class="search">
    <form action="javascript:void(0)" id="search_form" onsubmit="showNew()" autocomplete="off">
        <div class="i_t"><b>You should</b>
            <label for="y_idea">(tell us what you want us to do)</label>
            <input type="text" id="y_idea" onkeyup="search(this)"/>
        </div>
        <input type="submit" value="Search" id="create_button" disabled="disabled"/>
    </form>
</div>
<br clear="all"/>
<div id="results"></div>
<div id="init_results">
    <div class="categs">
        <ul>
            <li <?=($tab=='popular') ? 'class="active"' : ''?>>
                <a href="<?=$conf->HTTP_SERVER_BASE?>pages/1-popular">Popular</a>
            </li>
            <li <?=($tab=='hot') ? 'class="active"' : ''?>>
                <a href="<?=$conf->HTTP_SERVER_BASE?>pages/1-hot">Hot</a>
            </li>
            <li <?=($tab=='new') ? 'class="active"' : ''?>>
                <a href="<?=$conf->HTTP_SERVER_BASE?>pages/1-new">New <b class="blue"><?=$new_rez?></b></a>
            </li>
            <li <?=($tab=='accepted') ? 'class="active"' : ''?>>
                <a href="<?=$conf->HTTP_SERVER_BASE?>pages/1-accepted">Accepted <b class="yellow"><?=$acc_rez?></b></a>
            </li>
            <li <?=($tab=='completed') ? 'class="active"' : ''?>>
                <a href="<?=$conf->HTTP_SERVER_BASE?>pages/1-completed">Completed <b class="green"><?=$com_rez?></b></a>
            </li>
        </ul>
    </div>
    <br clear="all"/>
    <div class="before_line"></div>
    <br clear="all"/>
    <?
    if(!empty($ideas)) {
        foreach($ideas as $idea) { ?>
    <div class="idea_container">
        <div class="votes">
            <div id="nr_votes_<?=$idea['id']?>" class="nr_votes <?=($idea['status']==4 || checkVoted($idea['id'],$voted_ideas)) ? 'full' : ''?>">
                        <?=dynamicFont(number_format($idea['votes'],0,'',','),32)?><br/>
                votes<br/>
            </div>
                    <? if($idea['status']!=4 && !checkVoted($idea['id'],$voted_ideas)) { ?>
            <a href="javascript:void(0)" id="do_vote_<?=$idea['id']?>" onclick="vote('<?=$idea['id']?>')" class="do_vote">vote</a>
                        <? } ?>
                    <? if($idea['status']!=0) { ?>
            <div class="nr_votes <?=giveStatus($idea['status'],'class')?>"><?=giveStatus($idea['status'],'text')?></div>
                        <? } ?>
        </div>

        <div class="idea">
            <div class="title nomrg"><a href="<?=$conf->HTTP_SERVER_BASE?>idea/<?=$idea['id']?>-<?=makeTitle($idea['idea'])?>"><b><?=$idea['idea']?></b></a></div>
            <div class="auth_desc">
                        <?=shortString($idea['description'],300,' ...  <a href="'.$conf->HTTP_SERVER_BASE.'idea/'.$idea['id'].'-'.makeTitle($idea['idea']).'"><b>More</b></a>')?>
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
            <? } ?>
    <br clear="all"/>
        <? if($total_pages>1) { ?>
    <div class="before_line"></div>
    <div class="pagination">
                <? if($page>1) { ?>
        <a class="paginate" href="<?=$conf->HTTP_SERVER_BASE?>pages/<?=$prev_page?>-<?=$tab?>">&laquo; Previous</a> :
                    <?
                }else {
                    ?>
        <span class="dots">&laquo; Previous</span> :
                    <?
                }
                if($page-5>0)
                    echo '<span class="dots">...</span>&nbsp;';

                for($i=1;
                $i<=$total_pages;
                $i++) {
                    if($i==$page)
                        echo '<span class="inactive">'.$page.'</span>&nbsp;';
                    else if($i>$page-5 && $i<$page+5)
                        echo '<a class="paginate" href="'.$conf->HTTP_SERVER_BASE.'pages/'.$i.'-'.$tab.'">'.$i.'</a>&nbsp;';
                }
                if($total_pages-$page>4)
                    echo '<span class="dots">...</span>&nbsp;';
                ?>
                <? if($page<$total_pages) { ?>
        : <a class="paginate" href="<?=$conf->HTTP_SERVER_BASE?>pages/<?=$next_page?>-<?=$tab?>">Next &raquo;</a>
                    <? }else {
                    ?>
        : <span class="dots">Next &raquo;</span>
                    <?
                } ?>
    </div>
            <?
        }
    }else {
        ?>
    <div class="not_found"> Nothing to see here!</div>
        <? } ?>
</div>