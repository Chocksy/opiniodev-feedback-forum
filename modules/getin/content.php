<?php
if (!defined('CORE_DIR'))
    die('No direct script access allowed');
?>
<div id="login">
    <div class="sayit">Log in:</div>
    <form action="javascript:void(0)" id="login_form" autocomplete="off">
        <label for="username">Username</label>
        <input type="text" id="username"/>
        <label for="password">Password</label>
        <input type="password" id="password"/>
        <input type="submit" class="medium button green" value="Log me in"/>
    </form>
</div>
<div class="mid_or">OR</div>
<div id="signup">
    <div class="sayit">Register:</div>
    <form action="javascript:void(0)" id="register_form" autocomplete="off">
        <label for="s_username">Username</label>
        <input type="text" id="s_username"/>
        <label for="s_email">Email</label>
        <input type="text" id="s_email"/>
        <label for="s_password">Password</label>
        <input type="password" id="s_password"/>
        <label for="s_rpassword">Rewrite Password</label>
        <input type="password" id="s_rpassword"/>
        <input type="submit" class="medium button green" value="Get me in"/>
    </form>
</div>
<br clear="all"/>
