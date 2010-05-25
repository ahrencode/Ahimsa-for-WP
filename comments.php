<?php

if ( function_exists('wp_list_comments') ) :

// new comments.php stuff

    // password check
    if (!empty($_SERVER['SCRIPT_FILENAME']) &&
            'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Please do not load this page directly. Thanks!', 'ahimsa'));
    if ( post_password_required() )
    {
        print '
            <p class="nocomments">' .
            __('This post is password protected. Enter the password to view comments.', 'ahimsa') .
            '</p>';
        return;
    }

    if ( have_comments() ) : ?>

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

            <div class="postmetadata">
                <?php
                    previous_comments_link('<span class="capsule actbubble" style="float: left;">' .
                                            '&laquo; ' . __('previous', 'ahimsa') . '</span>');
                    next_comments_link('<span class="capsule actbubble" style="float: right;">' .
                                            __('next', 'ahimsa') . ' &raquo;</span>');
                ?>
                <br clear='all'/>
            </div>

        </fieldset>

    <?php else : // this is displayed if there are no comments so far ?>

        <?php if ('open' == $post->comment_status) :
            // If comments are open, but there are no comments.

        else : // comments are closed ?>
            <!-- If comments are closed. -->
            <span class='capsule nocomments'><?php _e('Comments are closed', 'ahimsa'); ?></span>
            <br/>
            <br/>

        <?php endif;

    endif;

else : // old WP < 2.7

    include_once("comments-old.php");

endif; // WP 2.7 check (old vs new style of comments) ?>

<?php if('open' == $post->comment_status) : ?>

    <div id='respond'>

    <fieldset id='responsebox'>

    <legend><?php _e('Leave a Reply', 'ahimsa'); ?></legend>

    <?php if( get_option('comment_registration') && !$user_ID ) : ?>

        <p>
        <?php
            $loginlink = get_option('siteurl') . '/wp-login.php?redirect_to=' . the_permalink();
            printf(__("You must be <a href='%s'>logged in</a> to post a comment.</p>", 'ahimsa'), $loginlink);
        ?>

    <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php if( $user_ID ) : ?>

            <p>
            <?php
                $profile_url = get_option('siteurl') . '/wp-admin/profile.php';
                printf(__("Logged in as <a href='%s'>%s</a>", 'ahimsa'), $profile_url, $user_identity);
            ?>
            <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout"
                title="<?php _e('Log out of this account', 'ahimsa'); ?>">
                <?php _e('Logout', 'ahimsa'); ?> &raquo;</a>
            </p>

        <?php else : ?>

            <p>
            <input type="text" name="author" id="author" class='inptext'
                   value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
            <label for="author"><small>
                <?php
                    _e('Name', 'ahimsa');
                    if($req) _e("(required)", 'ahimsa');
                ?>
            </small>
            </label>
            </p>

            <p>
            <input type="text" name="email" id="email" class='inptext'
                   value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
            <label for="email"><small>
                <?php
                    _e('Mail (will not be published)', 'ahimsa');
                    if($req) _e("(required)", 'ahimsa');
                ?>
                </small></label>
            </p>

            <p>
            <input type="text" name="url" id="url" class='inptext'
                   value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
            <label for="url"><small><?php _e('Website', 'ahimsa'); ?></small></label></p>

        <?php endif; ?>

        <p><textarea name="comment" id="replytext" rows="20" tabindex="4"></textarea></p>

        <div id='commenthint'>
        <small>
            <?php _e('<strong>XHTML</strong>: You can use these tags:', 'ahimsa'); ?>
            <code><?php echo allowed_tags(); ?></code>
        </small>
        </div>

        <input name="submit" type="submit" id="submit" class='capsule actbubble'
             tabindex="5" value="<?php _e('Submit Comment', 'ahimsa'); ?>" />

        <?php
            if ( function_exists('comment_id_fields') ) :

                // WP > 2.7
                comment_id_fields();
            ?>
                <div id="cancel-comment-reply">
	                <small><?php cancel_comment_reply_link() ?></small>
                </div>

            <?php else : ?>

                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

        <?php endif; ?>

        <?php do_action('comment_form', $post->ID); ?>

        </form>

    <?php endif; // If registration required and not logged in ?>

    </fieldset>

    </div>

<?php endif; // if you delete this the sky will fall on your head ?>

