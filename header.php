<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

    <meta
        http-equiv="Content-Type"
        content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
    />

    <title>
        <?php
            bloginfo('name');
            if ( is_single() )
                print '&raquo; ' . __('Blog Archive', 'ahimsa');
            wp_title();
        ?>
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
        title="<?php bloginfo('name'); _e('RSS Feed', 'ahimsa'); ?>"
        href="<?php bloginfo('rss2_url'); ?>"
    />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!-- inlude jQuery before we call wp_head(); -->
    <?php wp_enqueue_script("jquery"); ?>

    <?php
        if ( is_singular() )
            wp_enqueue_script('comment-reply');
        wp_head();
    ?>

    <script
        type="text/javascript"
        src="<?php print get_bloginfo('template_url').'/lib/jquery-ui/jquery-ui.min.js'; ?>"></script>

    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/ahimsa.js'; ?>"></script>

    <!-- render some corners in IE using jQuery plugins -->
    <?php global $options; if( $options['iecorners'] == 1 ) : ?>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/lib/jquery.corner.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/lib/jquery.corners.min.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_bloginfo('template_url').'/iecorners.js'; ?>"></script>
    <?php endif; ?>

    <?php include_once("shortcodes.php"); // load shortcode handlers ?>
    <?php include_once("browsercss.php"); // browser specific CSS ?>
    <?php include_once("customstyles.php"); ?>

</head>

<body onload='recalcBlocks();' onresize='recalcBlocks();'>

<?php global $options; ?>

<div id='bgtop'>
<br clear='all'/>
</div>

<div id='rsslinks'>
    <div class='capsule'>
        <a href='<?php bloginfo('comments_rss2_url'); ?>'>
        <img border='0' align='top' alt='<?php _e('Comments RSS', 'ahimsa'); ?>'
            src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
        <span title='<?php _e('Subscribe to the RSS feed for the comments on this site', 'ahimsa'); ?>'>
            <?php
                /* translators: this is the text of the comments RSS link at top right */
                _e('Comments', 'ahimsa');
            ?>
        </span>
        </a>
    </div>
    <div class='capsule'>
        <a href='<?php bloginfo("rss2_url"); ?>'>
        <img border='0' align='top' alt='<?php _e('Site RSS', 'ahimsa'); ?>'
            src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
        <span title='<?php _e('Subscribe to the RSS feed for the posts on this site', 'ahimsa'); ?>'>
            <?php
                /* translators: this is the text of the site RSS link at top right */
                _e('Site', 'ahimsa');
            ?>
        </span>
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

<?php if( is_active_sidebar(1) ) : ?>
    <td class='tdsidetabs'>&nbsp;</td>
<?php endif; ?>

<td colspan='<?php print (is_active_sidebar(1)?1:0)+(is_active_sidebar(2)?1:0)+1; ?>' id='header'>
    <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
            <?php if( $options['logourl'] != "" ) : ?>
                <td id='tdlogo'>
                    <img id='logo' alt='' title='' src='<?php print $options['logourl']; ?>' />
                </td>
            <?php endif; ?>
            <td id='title'>
                <a href="<?php print get_option('home'); ?>/">
                    <?php bloginfo('name'); ?>
                </a>
            </td>
            <td id='description'><?php bloginfo('description'); ?></td>
            <td id='search' valign='middle'><?php include (TEMPLATEPATH . "/searchform.php"); ?> </td>
        </tr>
    </table>
</td>

<?php if( is_active_sidebar(2) ) : ?>
    <td class='tdsidetabs'>&nbsp;</td>
<?php endif; ?>

</tr>

<tr>

    <?php if( is_active_sidebar(1) ) get_sidebar('left'); ?>

    <td id='content' class='
        <?php
            if( ! is_active_sidebar(1) ) print "contentnoleftsb ";
            if( ! is_active_sidebar(2) ) print "contentnorightsb";
        ?>'
        valign='top'>

