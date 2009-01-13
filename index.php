<?php get_header(); ?>

<!-- some preliminary work towards a del.icio.us links section using an existing plugin
<div id='recent'>
    <div id='recentheader'>
        <div id='recentclose'
            onClick='toggleDisplay("recentlist");'>+</div>
        <div id='recentmore' class='capsule'
            onClick='document.location="http://delicious.com/YOUR_DELICIOUS_ID";'> More </div>
        Recent News and Links
        <div id='recentlist'>
           <! ?php delicious_bookmarks('YOUR_DELICIOUS_ID', 5, true, false); ?>
        </div>
    </div>
</div>
-->

<table cellspacing=0 cellpadding=0 border=0 height='100%'>

<tr>

    <td
        onMouseOver='this.style.opacity = 1.0;'
        onMouseOut='this.style.opacity = 1.0;'
        id='sidebar' valign='top'> <?php get_sidebar(); ?> </td>

    <td id='content' valign='top'>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

                <fieldset>

                <legend class='title'>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
                </legend>

				<div class='dateauthor'>
                    <small class='capsule'><?php the_time('M jS, Y') ?> by <?php the_author() ?></small>
                </div>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<div class="postmetadata">

                    <span id='commentlink' class='capsule'>
                    <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;',
                            '% Comments &#187;'); ?>
                    </span>

                    <input type='button' class='cattrigger capsule'
                        value='Categories'
                        onClick='toggleDisplay("postcats-<?php the_ID();?>");'/>

                    <input type='button' class='cattrigger capsule'
                        value='Tags'
                        onClick='toggleDisplay("posttags-<?php the_ID();?>");'/>

                    <div id='postcats-<?php the_ID(); ?>' class='postcats'>
                    CATEGORIES:
                    <?php
                        foreach((get_the_category()) as $cat)
                            print
                                "<a href='" . get_category_link($cat->cat_ID) . "'>" .
                                "<span class='capsule'>$cat->cat_name</span></a>\n";
                    ?>
                    </div>

                    <div id='posttags-<?php the_ID(); ?>' class='postcats'>
                    TAGS:
                    <?php
                        print
                            get_the_tag_list(
                                    $before = '<span class="capsule">',
                                    // leave newlines below... Safari needs them
                                    // for rounded borders!!!
                                    $sep = '
                                            </span><span class="capsule">
                                           ',
                                    $after = '</span>');
                    ?> 
                    </div>

                </div>

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

