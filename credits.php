<div style='float: right;'>
    &raquo;&nbsp;
    <?php _e('Substance:', 'ahimsa'); ?>
    <a href='http://wordpress.org/'><?php _e('WordPress', 'ahimsa'); ?></a>
    &nbsp;&raquo;&nbsp;
    <?php _e('Style:', 'ahimsa'); ?>
    <a href='http://code.ahren.org/ahimsa'><?php _e('Ahren Ahimsa', 'ahimsa'); ?></a>
</div>

<?php
    global $ahimsa_options;
    if( $ahimsa_options['copyright'] != "" )
        print "&copy; " . $ahimsa_options['copyright'];
?>
