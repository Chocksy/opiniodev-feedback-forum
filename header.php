<div id="create_new">
    <a class="close" href="javascript:void(0)" onclick="HOM.closeNew()">X</a>
    <div class="title">New Idea</div>
    <div class="form">
        <form action="javascript:void(0)" onsubmit="HOM.createIdea()">
            <div class="f_title">Idea</div>
            <input type="text" id="title"/>
            <div class="f_title">Description &uArr;<sup>optional</sup></div>
            <textarea id="description" rows="5" cols="5"></textarea>
            <input type="submit" value="Add"/>
        </form>
    </div>
</div>
<div id="blackout"></div>
<div id="content">
    <a href="<?= HTTP_CORE_BASE ?>"><img src="<?= HTTP_CORE_BASE ?>images/logo.jpg" alt="logo"/></a>
    <br clear="all"/>
    <div class="title fleft"><b>Chocksy</b> Feedback</div>
    <div class="get_in">
        <? if (!session::check()) { ?>
            <a href="<?= HTTP_CORE_BASE ?>getin">Login</a> sau <a href="<?= HTTP_CORE_BASE ?>getin">Register</a>
        <? } else { ?>
            <a href="javascript:void(0)" onclick="OPN.logout()">Log Out</a>
        <? } ?>
    </div>
    <br clear="all"/>