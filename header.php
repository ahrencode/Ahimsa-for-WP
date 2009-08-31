<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

    <meta
        http-equiv="Content-Type"
        content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
    />

    <title>
        <?php bloginfo('name'); ?>
        <?php if ( is_single() ) { ?>
            &raquo; Blog Archive
        <?php } ?>
        <?php wp_title(); ?>
    </title>

    <meta
        name="generator"
        content="WordPress <?php bloginfo('version'); ?>"
    /> <!-- leave this for stats -->

    <link
        rel="stylesheet"
        href="<?php bloginfo('stylesheet_url'); ?>"
        type="text/css" media="screen"
    />

    <link
        rel="alternate"
        type="application/rss+xml"
        title="<?php bloginfo('name'); ?> RSS Feed"
        href="<?php bloginfo('rss2_url'); ?>"
    />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        wp_head();
    ?>

    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/jquery-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/ahimsa.js'; ?>"></script>

    <?php
        global $options;
        if( $options['iecorners'] == 1 ) :
    ?>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/jquery.corner.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/jquery.corners.min.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/iecorners.js'; ?>"></script>
    <?php endif; ?>

<!-- browser specific CSS -->

    <style type='text/css'>

<?php if( preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT']) ) : ?>

    #sidebar fieldset.sidebarlist
    {
        margin-bottom: 15px !important;
    }

    fieldset.comment
    {
        margin-top: 15px;
    }

<?php endif; ?>

<?php if( preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) ) : ?>

    #sidebar
    {
        padding-top: 30px;
    }

    .post fieldset legend.title,
    fieldset#comments legend,
    fieldset.comment legend,
    fieldset#responsebox legend
    {
        font-size: 10pt !important;
    }

    .capsule
    {
        font-size: 8pt;
    }

    fieldset.comment,
    fieldset#responsebox
    {
        padding-top: 25px;
    }

    #respond INPUT#submit
    {
	    font-weight: normal;
        font-size: small;
        padding: 3px 0px;
    }

<?php endif; ?>

    </style>

<?php

    // Load custom skin stylesheet and then the final custom stylesheet

    global $options, $current_user;
    $skin = $options['skin'];
    get_currentuserinfo();
    if( isset($current_user) && $current_user->user_level == 10 && $_GET['ahimsaskin'] != "" )
        $skin = $_GET['ahimsaskin'];

    if( $skin != "none" )
        print
        "
            <link
                rel='stylesheet'
                href='" . get_bloginfo('template_url') . "/skins/skin_$skin.css'
                type='text/css' media='screen' />
        ";

    if( file_exists(TEMPLATEPATH . "/custom.css") )
    {
        $customstylesheet = get_bloginfo('template_url') . "/custom.css";
        print "<link rel='stylesheet' href='$customstylesheet' type='text/css' media='screen' />\n";
    }

    // finally, if we are in skin edit mode, then load up the JavaScript for customisation
    if( isset($current_user)
            && $current_user->user_level == 10
            && $_GET['ahimsaskin'] != ""
            && $_GET['skinedit'] == 1 )
    {
        print
        "
            <script
                type='text/javascript'
                src='" .
                get_bloginfo('template_url').'/skinedit.js' .
                "'>
            </script>
        ";
    }

?>

</head>

<body onload='recalcBlocks();' onresize='recalcBlocks();'>

<?php global $options; ?>

<div id='bgtop'>
<br clear='all'/>
</div>

<div id='rsslinks'>
    <div class='capsule'>
    <a href='<?php bloginfo('comments_rss2_url'); ?>'>
    <img border='0' align='top' alt='Comments RSS'
        src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
    <span title='Subscribe to the RSS feed for the comments on this site'>Comments</span>
    </a>
    </div>
    <div class='capsule'>
    <a href='<?php bloginfo("rss2_url"); ?>'>
    <img border='0' align='top' alt='Site RSS'
        src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
    <span title='Subscribe to the RSS feed for the posts on this site'>Site</span>
    </a>
    </div>
    <?php if( $options['showloginout'] == 1 ) { ?>
    <div class='capsule'>
    <?php wp_loginout(); ?>
    </div>
    <?php } ?>
</div>

<table id='container' cellpadding='0' cellspacing='0'>

<tr>
<td id='maincontainer' style='height: 100%; width: 100%;'>

<table id='main' cellpadding='0' cellspacing='0'>

<tr>

<td class='sidetabs'>&nbsp;</td>

<td colspan='2' id='header'>

<table border='0' cellpadding='0' cellspacing='0'>

    <tr>
    <td id='title'><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></td>
    <td id='description'><?php bloginfo('description'); ?></td>
    <td id='search' valign='middle'><?php include (TEMPLATEPATH . "/searchform.php"); ?> </td>
    </tr>

</table>
</td>

</tr>

<tr>

    <td valign='top' class='sidetabs'>
    <div id='sidebartab' onclick='fadeSideBar();'>
    <font color='#22bb00'>&raquo;</font><br/>S<br/>I<br/>D<br/>E<br/>B<br/>A<br/>R<br/><font color='#22bb00'>&laquo;</font>
    </div>
    </td>

    <td id='tdsidebar' valign='top'>
        <!-- inline style required for easy JavaScript mods, without getting computed styles -->
        <div id='sidebar' style='display: block; opacity: 1.0;'>
            <?php get_sidebar(); ?>
        </div>
    </td>

    <td id='content' valign='top'>

