
<link
    rel='stylesheet'
    href='<?php print get_template_directory_uri(); ?>/shortcodes.css'
    type='text/css'
    media='screen' />

<?php

// [qfgallery]
// add if for option check for qfgallery activation
add_shortcode('qfgallery', 'ahimsa_qfgallery_handler');

?>

<link
    rel='stylesheet'
    href='<?php print get_template_directory_uri(); ?>/lib/jquery.fancybox/jquery.fancybox.css'
    type='text/css'
    media='screen' />

<script
    type="text/javascript"
    src="<?php print get_template_directory_uri(); ?>/lib/jquery.fancybox/jquery.easing.1.3.js">
</script>

<script
    type="text/javascript"
    src="<?php print get_template_directory_uri(); ?>/lib/jquery.fancybox/jquery.fancybox-1.2.1.js">
</script>

<?php

$ahimsa_galleryctr = 0;

function ahimsa_qfgallery_handler($atts, $content)
{
    global $ahimsa_galleryctr;

    $newcontent = "";

    extract
    (
        shortcode_atts
        (
            array
            (
                'width'     => 0,
                'matte'     => 1,
                'title'     => '',
                'scale'     => '',
                'float'     => '',
                'orient'    => ''
            ),
            $atts
        )
    );

    $boxclass = 'qfcontainer' . ($matte ? ' qfcontainer-matte' : '');
    $boxstyle = '';
    if( $width > 0 )            $boxstyle .= "width: ${width}px; ";
    if( $matte > 1 )            $boxstyle .= "padding: ${matte}px; ";
    if( $float != '' )          $boxstyle .= "float: $float; margin-${float}: 0px; ";
    if( $orient == 'portrait' ) $boxstyle .= "width: 160px; padding: 3px; ";

    $newcontent = "<div class='$boxclass' style='$boxstyle'>";

    if( $title != "" ) $newcontent .= "<h3>$title</h3>\n";
    foreach( explode("\n", $content) as $line )
    {
        // strip all HTML tags (such as <br>, <p> and other stuff inserted by wp_autop()
        $line = preg_replace("/\s*<[^>]*>\s*/", "", $line);
        
        // now get per-image options:
        // arg1 = URL [required]
        // arg2 = alt and title value
        // arg3 = top/left point in image: X
        // arg4 = top/left point in image: Y
        $matches = preg_split("/\s*\|\s*/", $line);
        if( sizeof($matches) < 1 || preg_match("/^\s*$/", $matches[0]) )
            continue;

        $alt    = isset($matches[1]) ? $matches[1] : "";
        $x      = isset($matches[2]) ? $matches[2] : 0;
        $y      = isset($matches[3]) ? $matches[3] : 0;
        $clear  = ( $orient == 'portrait' ) ? "clear: both;" : "";

        $newcontent .=
        "
            <!--[if IE]>
                <div class='qfgallerytnail' style='float: left; $clear'>
            <![endif]-->
            <!--[if !IE]>-->
            <div class='qfgallerytnail' style='display: inline-block; $clear'>
            <!--<![endif]-->
            <a class='qfgallerylink' rel='qfgallery$ahimsa_galleryctr' href='$matches[0]' title='$alt'>
            <img
                style='margin-left: -${x}px; margin-top: -${y}px;'
                src='$matches[0]' " . ($scale == 1 ? "width='128' height='128' " : "") . "
                alt='$alt' />
            </a>
            </div>
        ";
    }

    if( $float )
        $newcontent .= "<!--[if IE]>\n<div style='height: 1px; clear: both;'></div>\n<![endif]-->\n";
    
    $newcontent .= "</div>\n";

    $ahimsa_galleryctr++;

    return($newcontent);
}

?>

<script language='JavaScript'>

jQuery(document).ready(
    function()
    {
	    jQuery("a.qfgallerylink").
            fancybox
            ({
                'imageScale':   true,
                'zoomOpacity':  true,
                'overlayShow':  true,
                'easingIn':     'easeInElastic',
                'easingOut':    'easeOutBounce',
                'easingChange': 'easeInOutSine'
            });
    }
);

</script>

<?php

// [faqinway]
add_shortcode('faqinway', 'ahimsa_faqinway_handler');

?>

<?php

function ahimsa_faqinway_handler($atts, $content)
{
    extract
    (
        shortcode_atts
        (
            array
            (
                'dummy' => ''
            ),
            $atts
        )
    );

    $content = preg_replace("/\<br\s*\/?\>/", " ", $content);
    $newcontent = "<div class='faqinwaycontainer'>\n";
    foreach( explode("$$$", $content) as $qa )
    {
        if( ! (list($q, $a) = preg_split("/\@\@\@/", $qa, 2)) )
            continue;

        $newcontent .=
        "
            <div class='faqinwayqa'>
                <div class='faqinwayq'>$q</div>
                <div class='faqinwaya'>$a</div>
            </div>
        ";
    }
    $newcontent .= "</div>\n";

    return($newcontent);
}

?>

<script language='JavaScript'>

jQuery(document).ready(
    function()
    {
        jQuery('.faqinwayq').click(
            function()
            {
                jQuery('.faqinwaya').hide();
                jQuery(this).parent().find('.faqinwaya').show();
            }
        );
    }
);
	
</script>

