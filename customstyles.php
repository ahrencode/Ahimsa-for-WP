<?php

    include_once("utils.php");

    // Load custom skin stylesheet and then the final custom stylesheet

    global $options, $current_user;
    $skin = $options['skin'];
    get_currentuserinfo();
    if( isset($current_user) && $current_user->user_level == 10 && $_GET['ahimsaskin'] != "" )
        $skin = $_GET['ahimsaskin'];

    if( $skin != "none" && preg_match("/^[a-zA-Z0-9]+(\-[a-zA-Z0-9]+)*$/", $skin) )
        print
        "
            <link
                rel='stylesheet'
                href='" . util_get_skin_url($skin) . "'
                type='text/css' media='screen' />
        ";

    if( ($customstylesheet = util_get_customss_url()) != "" )
        print "<link rel='stylesheet' href='$customstylesheet' type='text/css' media='screen' />\n";

    // finally, if we are in skin edit mode, then load up the JavaScript for customisation
    /* TODO: this is not there yet
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
    */

?>
