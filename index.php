<?php
/**
 * Copyright: ajaxmasters.com
 * Original Authors: ajaxmasters.com
 */

include ('core/main.class.php');
$main = new Main();
$users = new Users();

//get pars except for page
$pars = parseUrl::get_pars($_GET['pars']);
//get page name and store it in a variable
$pagename = parseUrl::get_page(Security::secureString($_GET['pars']));

$filename = $main->modulesUrl($pagename);
//include the header of every module
$controller = $main->controllerUrl($pagename);
if (is_file($controller))
    include_once ($controller);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include_once (CORE_DIR . "meta_tags.php"); ?>
        <link rel="stylesheet" href="<?= HTTP_CORE_BASE ?>css/style.css"/>
        <link rel="icon" type="image/ico" href="favicon.ico"/>
        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?= HTTP_CORE_BASE ?>css/ie.css" />
        <![endif]-->
        <!--[if lte IE 6]>
            <link rel="stylesheet" type="text/css" href="<?= HTTP_CORE_BASE ?>css/ie6.css" />
        <![endif]-->
        <!--[if  IE 7]>
            <link rel="stylesheet" type="text/css" href="<?= HTTP_CORE_BASE ?>css/ie7.css" />
        <![endif]-->

    </head>
    <body>
        <input type="hidden" id="page_name_js" value="<?= $pagename ?>" />
        <?
        include ('header.php');
        ?>
        <div id="container">
            <?
            include_once ($filename);
            ?>
        </div>
        <?
        include ('footer.php');
        ?>
        <script type="text/javascript">var HTTP_SERVER_BASE = '<?= HTTP_CORE_BASE ?>'</script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="<?= HTTP_CORE_BASE ?>core/js/jquery-1.4.2.min.js"><\/script>')</script>
        <script type="text/javascript" src="<?= JS_DIR ?>plugins.js"></script>
        <script type="text/javascript" src="<?= JS_DIR ?>code.js"></script>
        <script type="text/javascript" src="<?= JS_DIR ?>main.js"></script>
        <script type="text/javascript" src="<?= JS_DIR ?>opiniodev.js"></script>
    </body>
</html>

