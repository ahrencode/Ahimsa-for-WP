<?php

global $options;

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

        <legend>
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

        <ul>
            <?php wp_list_comments('type=all&style=ul&callback=custom_comment'); ?>
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

<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <!-- If comments are closed. -->
    <span class='capsule nocomments'><?php _e('Comments are closed', 'ahimsa'); ?></span>

<?php else : ?>

    <?php comment_form(); ?>
    <fieldset id='responsebox'>
        <legend><?php _e('Leave a Reply', 'ahimsa'); ?></legend>
        <?php if( $options['commentguide'] != "" ) : ?>
            <div id='commentguide'>
                <?php print stripslashes($options['commentguide']); ?>
            </div>
        <?php endif; ?>
    </fieldset>

<?php endif; ?>

