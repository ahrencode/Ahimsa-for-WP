<?php // chunks of HEAD lifted from TwentyEleven ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">

    <meta charset="<?php bloginfo('charset'); ?>" />

    <title>
        <?php
            // more code from TwentyEleven
            global $paged, $page;

            wp_title('|', true, 'right');

            // Add the blog name.
            bloginfo('name');

            // Add the blog description for the home/front page.
            $site_description = get_bloginfo('description', 'display');
            if( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

            // Add a page number if necessary:
            if( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', 'ahimsa' ), max( $paged, $page ));

        ?>
    </title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link
        rel="stylesheet"
        href="<?php bloginfo('stylesheet_url'); ?>"
        type="text/css" media="screen"
    />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <meta
        name="generator"
        content="WordPress <?php bloginfo('version'); ?>"
    /> <!-- leave this for stats -->

    <link
        rel="alternate"
        type="application/rss+xml"
        title="<?php bloginfo('name'); _e('RSS Feed', 'ahimsa'); ?>"
        href="<?php bloginfo('rss2_url'); ?>"
    />

    <?php 
        global $ahimsa_options;
        if( $ahimsa_options['googlefonts'] != "" )
        {
            foreach( preg_split('/,[ ]*/', $ahimsa_options['googlefonts']) as $gfont )
            {
                $gfont = str_replace(' ', '+', $gfont);
    ?>
                <link
                     href='http://fonts.googleapis.com/css?family=<?php print $gfont; ?>'
                    rel='stylesheet' type='text/css'>
    <?php
            }
        }
    ?>

    <!-- inlude jQuery before we call wp_head(); -->
    <?php wp_enqueue_script("jquery"); ?>

    <?php
	    if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script('comment-reply');
        wp_head();
    ?>

    <script
        type="text/javascript"
        src="<?php print get_template_directory_uri() . '/lib/jquery-ui/jquery-ui.min.js'; ?>"></script>

    <script type="text/javascript" src="<?php print get_template_directory_uri().'/ahimsa.js'; ?>"></script>

    <!-- render some corners in IE using jQuery plugins -->
    <?php global $ahimsa_options; if( $ahimsa_options['iecorners'] == 1 ) : ?>
        <script type="text/javascript"
            src="<?php print get_template_directory_uri().'/lib/jquery.corner.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_template_directory_uri().'/lib/jquery.corners.min.js'; ?>"></script>
        <script type="text/javascript"
            src="<?php print get_template_directory_uri().'/iecorners.js'; ?>"></script>
    <?php endif; ?>

    <?php include_once("shortcodes.php"); // load shortcode handlers ?>
    <?php include_once("browsercss.php"); // browser specific CSS ?>
    <?php include_once("customstyles.php"); ?>

</head>

<body onload='ahimsa_recalc_block();' onresize='ahimsa_recalc_block();' <?php body_class(); ?>>

<?php global $ahimsa_options; ?>

<div id='bgtop'>
<br clear='all'/>
</div>

<?php if( $ahimsa_options['showtopmenu'] == 1 ) : ?>

    <div id='rsslinks'>
        <div class='capsule'>
            <a href='<?php bloginfo('comments_rss2_url'); ?>'>
            <img border='0' align='top' alt='<?php _e('Comments RSS', 'ahimsa'); ?>'
                src='<?php print get_template_directory_uri() . "/images/rss-icon.gif"; ?>' />
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
                src='<?php print get_template_directory_uri() . "/images/rss-icon.gif"; ?>' />
            <span title='<?php _e('Subscribe to the RSS feed for the posts on this site', 'ahimsa'); ?>'>
                <?php
                    /* translators: this is the text of the site RSS link at top right */
                    _e('Site', 'ahimsa');
                ?>
            </span>
            </a>
        </div>
        <?php if( $ahimsa_options['showloginout'] == 1 ) : ?>
            <div class='capsule'>
                <?php wp_loginout(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<table id='container' cellpadding='0' cellspacing='0'>

<tr>
<td id='maincontainer' style='height: 100%; width: 100%;'>

<table id='main' cellpadding='0' cellspacing='0'>

<tr>

<?php if( is_active_sidebar(1) ) : ?>
    <td class='tdsidetabs'>&nbsp;</td>
<?php endif; ?>

<td colspan='<?php print (is_active_sidebar(1)?1:0)+(is_active_sidebar(2)?1:0)+1; ?>' id='header'>

    <div id='headerfields'> <!-- needed because IE won't do CSS padding for TABLEs -->
    <table border='0' cellpadding='0' cellspacing='0'>
        <tr>
            <?php if( $ahimsa_options['logourl'] != "" ) : ?>
                <td id='tdlogo'>
                    <img id='logo' alt='' title='' src='<?php print $ahimsa_options['logourl']; ?>' />
                </td>
            <?php endif; ?>
            <td id='title'>
                <a href="<?php print home_url(); ?>/">
                    <?php bloginfo('name'); ?>
                </a>
            </td>
            <td id='description'><?php bloginfo('description'); ?></td>
            <td id='search' valign='middle'><?php get_search_form(); ?> </td>
        </tr>
    </table>
    </div>

    <div id='headermenu'>
        <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
        <div style='height: 1px; clear: both;'></div>
    </div>

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

