
    <?php
        global $ahimsa_options;
        if( (is_home() && $ahimsa_options['defhidesidebar'] == 1 ) ||
            (is_singular() && $ahimsa_options['defhidesbpages'] == 1 ) ) :
    ?>

        <script language='JavaScript'>
            ahimsa_slide_sidebar('left');
            ahimsa_slide_sidebar('right');
        </script>

    <?php endif; ?>

    <?php
        if( file_exists(WP_CONTENT_DIR . "/themestore/ahimsa/footer-custom.php") )
            include_once(WP_CONTENT_DIR . "/themestore/ahimsa/footer-custom.php");
    ?>

    <?php wp_footer(); ?>

</body>

</html>
