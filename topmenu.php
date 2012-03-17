<div id='rsslinks'>
    <div class='capsule'>
        <a href='<?php bloginfo('comments_rss2_url'); ?>'>
        <img border='0' align='top' alt='<?php _e('Comments RSS', 'ahimsa'); ?>'
            src='<?php print get_template_directory_uri() . "/images/rss-icon.gif"; ?>' />
        <span title='<?php _e('Subscribe to the RSS feed for the comments on this site', 'ahimsa'); ?>'>
            <?php
                /* translators: this is the text of the comments RSS link at top right */
                _e('Comments', 'ahimsa');
            ?>
        </span>
        </a>
    </div>
    <div class='capsule'>
        <a href='<?php bloginfo("rss2_url"); ?>'>
        <img border='0' align='top' alt='<?php _e('Site RSS', 'ahimsa'); ?>'
            src='<?php print get_template_directory_uri() . "/images/rss-icon.gif"; ?>' />
        <span title='<?php _e('Subscribe to the RSS feed for the posts on this site', 'ahimsa'); ?>'>
            <?php
                /* translators: this is the text of the site RSS link at top right */
                _e('Site', 'ahimsa');
            ?>
        </span>
        </a>
    </div>
    <?php if( $ahimsa_options['showloginout'] == 1 ) : ?>
        <div class='capsule'>
            <?php wp_loginout(); ?>
        </div>
    <?php endif; ?>
</div>
