<?php include_once("utils.php"); ?>
<?php global $ahimsa_options; ?>

<td id='tdsidebarleft' class='tdsidebar'  valign='top'>

    <!-- inline style required for easy JavaScript mods, without getting computed styles -->
    <div id='sidebarleft' class='sidebar' style='display: block; opacity: 1.0;'>

        <?php if( $ahimsa_options['showauthors'] == 1 ) : ?>

            <fieldset class='sidebarlist'>
                <legend class='title'>
                    <?php if( $ahimsa_options['sectprefix'] ) print '&sect&nbsp;'; ?><?php _e('Authors', 'ahimsa'); ?>
                </legend>
                <ul>
                <?php wp_list_authors("optioncount=0&exclude_admin=0&feed=1&feed_image=" .
                                        get_template_directory_uri() .
                                        "/images/rss-icon.gif"); ?> 
                </ul>
            </fieldset>

        <?php endif; ?>

    </div>
</td>

