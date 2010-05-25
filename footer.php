
<?php if( is_active_sidebar(2) ) get_sidebar('right'); ?>

</td>
</tr>
</table> <!-- end of table main -->

</td>
</tr>

<tr>
<td id='credits'>

<div style='float: right;'>
&raquo;&nbsp;
<?php _e('Substance:', 'ahimsa'); ?>
<a href='http://wordpress.org/'><?php _e('WordPress', 'ahimsa'); ?></a>
&nbsp;
&raquo;&nbsp;
<?php _e('Style:', 'ahimsa'); ?>
<a href='http://ahren.org/code/ahimsa'><?php _e('Ahren Ahimsa', 'ahimsa'); ?></a>
</div>

<?php
global $options;
if( $options['copyright'] != "" )
    print "&copy; " . $options['copyright'];
?>

</td> <!-- end of credits -->
</tr>

</table> <!-- end of table container -->

<?php
    if( file_exists(WP_CONTENT_DIR . "/themestore/ahimsa/footer-custom.php") )
        include_once(WP_CONTENT_DIR . "/themestore/ahimsa/footer-custom.php");
?>

<?php wp_footer(); ?>

</body>

</html>

