
<?php get_header(); ?>

<div id='page'>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <fieldset>

            <legend class='title'>
                <a href="<?php the_permalink() ?>" rel="bookmark"
                    title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
            </legend>

            <div class='dateauthor'>
                <small class='capsule'><?php the_time('F jS, Y') ?> by <?php the_author() ?></small>
            </div>

            <div class="entry">
                <?php the_content('Read the rest of this entry &raquo;'); ?>
            </div>

            <?php if( $user_ID ) : ?>
            <p class="postmetadata">
                <span class='capsule'><?php edit_post_link('Edit', '', '&nbsp;'); ?></span>
                <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;',
                        '% Comments &#187;'); ?>
            </p>
            <?php endif; ?>

        </div>

    <?php endwhile; ?>

<?php else : ?>

    <div class="post">
        <fieldset>
            <legend class='title'>Not Found</legend>
            <br/>
            <div class='entry'>
            Sorry, but you are looking for something that isn't here.
            <br/>
            <br/>
            </div>
        </fieldset>
    </div>

<?php endif; ?>

<script language='JavaScript'>
    fadeSideBar();
</script>

</div>

<?php get_footer(); ?>

