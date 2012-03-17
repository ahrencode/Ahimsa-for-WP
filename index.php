<?php get_header(); ?>

<table id='container' cellpadding='0' cellspacing='0'>
    <tr>
        <td id='maincontainer' style='height: 100%; width: 100%;'>
            <table id='main' cellpadding='0' cellspacing='0'>
                <tr>
                    <?php ahimsa_util_sidebartab_html(1, 'filler'); ?>
                    <td id='header'><?php include_once('headerbar.php'); ?></td>
                    <?php ahimsa_util_sidebartab_html(2, 'filler'); ?>
                </tr>
                <tr>
                    <?php ahimsa_util_sidebartab_html(1, 'left'); ?>
                    <td id='contentbox' class=' valign='top'>
                        <table cellpadding='0' cellspacing='0' width='100%' height='100%'>
                            <tr>
                                <?php if( is_active_sidebar(1) ) get_sidebar('left'); ?>
                                <td id='content' valign='top'><?php include_once("content.php"); ?></td>
                                <?php if( is_active_sidebar(2) ) get_sidebar('right'); ?>
                            </tr>
                        </table>
                    </td>
                    <?php ahimsa_util_sidebartab_html(2, 'right'); ?>
                </tr>
                <tr>
                    <?php ahimsa_util_sidebartab_html(1, 'filler'); ?>
                    <td id='header'><?php include_once('headerbar.php'); ?></td>
                    <?php ahimsa_util_sidebartab_html(2, 'filler'); ?>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td id='credits'><?php include_once('credits.php'); ?></td>
    </tr>
</table>

<?php get_footer(); ?>

