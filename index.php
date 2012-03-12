<?php get_header(); ?>

<?php include_once("content.php"); ?>

<?php get_footer(); ?>

<?php
    if( (is_home() && $options['defhidesidebar'] == 1 ) ||
        (is_singular() && $options['defhidesbpages'] == 1 ) ) :
?>

    <script language='JavaScript'>
        slideSideBar('left');
        slideSideBar('right');
    </script>

<?php endif; ?>
