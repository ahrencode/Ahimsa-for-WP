<?php

// Do not delete these lines
if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if(!empty($post->post_password)) // if there's a password
{
    if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password)  // and it doesn't match the cookie
    {
        ?>
        <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
        <?php
        return;
    }
}

if($comments) :

?>

<div id='comments'>

    <h3 id="commentheader">
        <?php comments_number('No Responses', 'One Response', '% Responses' );?>
    </h3>

    <?php foreach ($comments as $comment) : ?>

        <fieldset class='comment'>

            <legend> <?php comment_author_link() ?> writes: </legend>

            <div class="commentmeta">
                <small class='capsule'>
                    <?php comment_date('F jS, Y') ?> at <?php comment_time() ?>
                </small>
                <?php if( $user_ID ) : ?>
                    &nbsp;&nbsp;
                    <small class='capsule'>
                        <?php edit_comment_link('edit','&nbsp;',''); ?>
                    </small>
                <?php endif; ?>
            </div>

            <?php
                if(function_exists('get_avatar'))
                    echo get_avatar(get_comment_author_email(), '50');
            ?>

            <div class='commenttext'>

            <?php if($comment->comment_approved == '0') : ?>
                <span class='capsule'>Your comment is awaiting moderation.</span>
                <br />
            <?php endif; ?>

            <?php comment_text() ?>

            </div>

        </fieldset>

    <?php endforeach; /* end for each comment */ ?>

<?php else : // this is displayed if there are no comments so far ?>

    <?php if('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

     <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <span class='capsule nocomments'>
            Comments are closed
        </span>
        <br/>
        <br/>

    <?php endif; ?>

<?php endif; ?>

<?php if($comments) : ?>
</div>
<?php endif; ?>


