<?php get_header(); ?>

<?php include_once("content.php"); ?>

<?php get_footer(); ?>

<?php
    if( (is_home() && $ahimsa_options['defhidesidebar'] == 1 ) ||
        (is_singular() && $ahimsa_options['defhidesbpages'] == 1 ) ) :
?>

    <script language='JavaScript'>
        ahimsa_slide_sidebar('left');
        ahimsa_slide_sidebar('right');
    </script>

<?php endif; ?>
