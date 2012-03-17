<?php

global $ahimsa_options;

if (!empty($_SERVER['SCRIPT_FILENAME']) &&
        'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die (__('Please do not load this page directly. Thanks!', 'ahimsa'));

?>

<?php if ( post_password_required() ) : ?>
    <p class="nocomments">' .
        <?php _e('This post is password protected. Enter the password to view comments.', 'ahimsa'); ?>
    </p>
    <?php return; ?>
<?php endif; ?>

<?php if ( have_comments() ) : ?>

    <fieldset id='comments'>

        <legend class='title'>
        <?php comments_number(
                __('No Responses', 'ahimsa'),
                __('One Response', 'ahimsa'),
                '% ' . __('Responses', 'ahimsa'));?>
        </legend>

        <!--
            The &nbsp; below is to workaround what seems to be a bug in Safari.
            Without it, the 'comments' container fieldset (above) is overlapped
            by the first comment fieldset.
        -->
        &nbsp;

        <?php if( $comments_rss_url = get_post_comments_feed_link() ) : ?>
            <div style='float: right; clear: right;' class='capsule actbubble'>
                <a href='<?php print $comments_rss_url; ?>'><?php _e('Comments Feed', 'ahimsa'); ?></a>
            </div>
        <?php endif; ?>

        <?php if( 'open' == $post->comment_status ) : ?>
            <div style='float: right; margin-right: 10px;' class='capsule actbubble'>
                <a href='#respond'><?php _e('Add Comment', 'ahimsa'); ?></a>
            </div>
        <?php endif ?>

        <ul>
            <?php wp_list_comments('type=all&style=ul&callback=ahimsa_custom_comment'); ?>
        </ul>

        <br clear='all' />

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

            <div class="postmetadata">
                <?php
                    previous_comments_link('<span class="capsule actbubble" style="float: left;">' .
                                            '&laquo; ' . __('previous', 'ahimsa') . '</span>');
                    next_comments_link('<span class="capsule actbubble" style="float: right;">' .
                                            __('next', 'ahimsa') . ' &raquo;</span>');
                ?>
                <br clear='all'/>
            </div>
        <?php endif; ?>

    </fieldset>

<?php endif; ?>

<?php if( comments_open() && ! post_password_required()
        && post_type_supports(get_post_type(), 'comments') ) : ?>

    <div id='newrespond'>
    <fieldset id='responsebox'>

        <legend class='title'><?php _e('Leave a Reply', 'ahimsa'); ?></legend>
 
        <?php comment_form(); ?>

        <?php if( $ahimsa_options['commentguide'] != "" ) : ?>
            <div id='commentguide'>
                <?php print stripslashes($ahimsa_options['commentguide']); ?>
            </div>
        <?php endif; ?>

    </fieldset>
    </div>

<?php else : ?>

    <!-- If comments are closed. -->
    <div class='capsule nocomments rounded-big'><?php _e('Comments are closed', 'ahimsa'); ?></div>
    <div style='height: 1px; clear: both;'></div>

<?php endif; ?>
