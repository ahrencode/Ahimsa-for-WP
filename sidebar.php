<?php

$options = get_option('ahimsa');

?>

<?php if( $options['showauthors'] == 1 ) { ?>
<fieldset class='sidebarlist'>
    <legend>&sect; Authors</legend>
    <ul>
    <?php wp_list_authors("optioncount=0&exclude_admin=0&feed=1&feed_image=" .
                            get_bloginfo('template_url').
                            "/images/rss-icon.gif"); ?> 
    </ul>
</fieldset>
<?php } ?>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<fieldset class='sidebarlist'>
    <legend>&sect; Categories</legend>
    <ul>
    <?php wp_list_categories('title_li=&hierarchical=0'); ?>
    </ul>
</fieldset>

<fieldset class='sidebarlist'>
    <legend>&sect; Archives</legend>
    <ul>
    <?php wp_get_archives('type=monthly'); ?>
    </ul>
</fieldset>

<?php endif; ?>

