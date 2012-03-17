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

<?php global $ahimsa_options; ?>

<body onload='ahimsa_recalc_block();' onresize='ahimsa_recalc_block();' <?php body_class(); ?>>

    <div id='bgtop'>
    <br clear='all'/>
    </div>

    <?php if( $ahimsa_options['showtopmenu'] == 1 ) include_once('topmenu.php'); ?>

