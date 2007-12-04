
<?php get_header(); ?>

<table cellspacing=0 cellpadding=0 border=0 height='100%'>

<tr>

    <td id='sidebar' valign='top'> <?php get_sidebar(); ?> </td>

    <td id='content'>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

                <fieldset>

                <legend class='title'>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
                </legend>

				<div class='dateauthor'>
                    <small><?php the_time('F jS, Y') ?> by <?php the_author() ?></small>
                </div>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<p class="postmetadata">
                    Posted in <?php the_category(', ') ?> |
                    <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;',
                            '% Comments &#187;'); ?>
                </p>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>

    </td>

</tr>
</table>

<?php get_footer(); ?>

