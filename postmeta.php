<div class="postmetadata
        <?php if( is_home() && $options["idxfadepmeta"] ) : ?>
            fadedbottombar
        <?php endif; ?>
        ">

    <?php if( is_single() || is_page() ) : ?>

        <?php
            edit_post_link(
                __('Edit Entry', 'ahimsa'),
                "<div class='capsule actbubble' style='float: right;'>",
                '</div>');
        ?>

        <?php if( 'open' == $post->ping_status ) : ?>

            <div style='float: right; margin-right: 10px;' class='capsule actbubble'>
                <a href='<?php trackback_url(false); ?>' rel='trackback'>
                    <?php _e('Trackback', 'ahimsa'); ?></a>
            </div>

        <?php endif; ?>

    <?php else : // home page ?>

            <span class='capsule commentlink actbubble'>
                <?php comments_popup_link(
                            __('No Comments', 'ahimsa') . ' &#187;',
                            __('1 Comment', 'ahimsa') . ' &#187;',
                            __('% Comments', 'ahimsa') . ' &#187;'); ?>
            </span>

    <?php endif; ?>

    <?php
        $the_cats = get_the_category_list(', ');
        $the_tags = get_the_tag_list($before = '', $sep = ', ', $after = '');
    ?> 

    <?php if( $the_cats ) : ?>
        <div class='capsule actbubble cattrigger' onclick='toggleCatTags(<?php the_ID(); ?>, "cats");'>
            <?php _e('Categories', 'ahimsa'); ?> &darr;
        </div>
    <?php endif; ?>

    <?php if( $the_tags ) : ?>
        <div class='capsule actbubble cattrigger' onclick='toggleCatTags(<?php the_ID(); ?>, "tags");'>
            <?php _e('Tags', 'ahimsa'); ?> &darr;
        </div>
    <?php endif; ?>

    <div style='height: 1px; clear: both;'></div>

    <div class='cattagsbox'>

        <?php if( $the_cats ) : ?>
            <div class='postcattags postcats'>
                <?php print $the_cats; ?>
            </div>
        <?php endif; ?>

        <?php if( $the_tags ) : ?>
            <div class='postcattags posttags'>
                <?php print $the_tags; ?>
            </div>
        <?php endif; ?>

    </div>

</div> <!-- postmetadata -->
