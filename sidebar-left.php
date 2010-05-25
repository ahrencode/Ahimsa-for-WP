<?php include_once("utils.php"); ?>
<?php global $options, $sectprefix; ?>

<td valign='top' class='tdsidetabs'>
    <div id='sidebartableft' class='sidebartab' onclick='slideSideBar("left");'>
        <div class='sidebartabrotatedtext'><?php _e('SIDEBAR', 'ahimsa'); ?></div>
        <div class='sidebartabnorotatetext'>
            <font color='#22bb00'>&raquo;</font><br/>
            <?php _e('S<br/>I<br/>D<br/>E<br/>B<br/>A<br/>R', 'ahimsa'); ?><br/>
            <font color='#22bb00'>&laquo;</font>
        </div>
    </div>
</td>

<td id='tdsidebarleft' class='tdsidebar'  valign='top'>

    <!-- inline style required for easy JavaScript mods, without getting computed styles -->
    <div id='sidebarleft' class='sidebar' style='display: block; opacity: 1.0;'>

        <?php if( $options['showauthors'] == 1 ) : ?>

            <fieldset class='sidebarlist'>
                <legend><?php print $sectprefix; ?><?php _e('Authors', 'ahimsa'); ?></legend>
                <ul>
                <?php wp_list_authors("optioncount=0&exclude_admin=0&feed=1&feed_image=" .
                                        get_bloginfo('template_url').
                                        "/images/rss-icon.gif"); ?> 
                </ul>
            </fieldset>

        <?php endif; ?>

        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('leftbar') ) : ?>

            <fieldset class='sidebarlist'>
                <legend><?php print $sectprefix; ?><?php _e('Categories', 'ahimsa'); ?></legend>
                <ul>
                <?php wp_list_categories('title_li=&hierarchical=0'); ?>
                </ul>
            </fieldset>

            <fieldset class='sidebarlist'>
                <legend><?php print $sectprefix; ?><?php _e('Archives', 'ahimsa'); ?></legend>
                <ul>
                <?php wp_get_archives('type=monthly'); ?>
                </ul>
            </fieldset>

        <?php endif; ?>

    </div>
</td>

