
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
Substance: <a href='http://wordpress.org/'>WordPress</a>
&nbsp;
&raquo;&nbsp;
Style: <a href='http://ahren.org/code/ahimsa'>Ahren Ahimsa</a>
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

