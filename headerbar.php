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
