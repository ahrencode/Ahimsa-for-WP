<?php get_header(); ?>

<div id='single' style='width: 100%;'>
    <?php include_once("entry.php"); ?>
</div>

<?php comments_template(); ?>

<?php get_footer(); ?>

<?php if( $options['defhidesbpages'] == 1 ): ?>
    <script language='JavaScript'>
        slideSideBar('left');
        slideSideBar('right');
    </script>
<?php endif; ?>

