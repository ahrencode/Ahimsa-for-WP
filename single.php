<?php get_header(); ?>

<?php if( is_page() ) : ?>
<div class='singlepage'>
<?php elseif( is_single() ) : ?>
<div class='singlepost'>
<?php endif; ?>

    <div id='single' style='width: 100%;'>
        <?php include_once("entry.php"); ?>
    </div>

    <?php comments_template(); ?>

</div> <!-- single page or post wrapper -->

<?php get_footer(); ?>

<?php if( $options['defhidesbpages'] == 1 ): ?>
    <script language='JavaScript'>
        slideSideBar('left');
        slideSideBar('right');
    </script>
<?php endif; ?>

