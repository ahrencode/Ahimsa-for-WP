
<?php get_header(); ?>

<script language='JavaScript'>
    fadeSideBar();
</script>

<div id='single' style='width: 100%;'>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

    <fieldset>

        <legend class='title'>
            <a href="<?php the_permalink() ?>" rel="bookmark"
                title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
        </legend>

        <div class='dateauthor'>
            <small class='capsule'><?php the_time('F jS, Y') ?> by <?php the_author() ?></small>
        </div>

        <div id='postaction'>

            <ul>

            <?php edit_post_link('Edit Entry', '<li>', '</li>'); ?>

            <?php
                        
                if (('open' == $post-> comment_status) && ('open' == $post->ping_status))
                {
                    print "
                        <li> <a href='#respond'>Add Comment</a> </li>
                        <li> <a href='" . trackback_url(false) . "' rel='trackback'>Trackback</a> </li>
                        ";
                }
                elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status))
                {
                    print "<li> <a href='" . trackback_url(false) . "' rel='trackback'>Trackback</a> </li>";
                }

            ?>

            <li>
                <img border=0 valign='middle'
                    src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>'>
                <?php comments_rss_link('Comments Feed'); ?>
            </li>

            </ul>

        </div>

        <div class="entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>

        <br clear='all'/>

        <div class="postmetadata">

            <div>

            <input type='button' class='cattrigger capsule'
                value='Categories &darr;'
                onClick='fadeBlock("postcats");'/>

            <?php if( get_the_tags() ) : ?>
            <input type='button' class='cattrigger capsule'
                value='Tags &darr;'
                onClick='fadeBlock("posttags");'/>
            <?php endif; ?>

            </div>

            <!-- inline style for easy JavaScript mods, without getting computed styles -->
            <div id='postcats' class='postcattags postcats' style='display: none; opacity: 0;'>
            <?php
                foreach((get_the_category()) as $cat)
                    print
                        "<div class='capsule'>
                            <a href='" . get_category_link($cat->cat_ID) . "'>" .
                            $cat->cat_name . "</a>
                        </div>\n";
            ?>
            <br clear='all'/>
            </div>

            <?php if( get_the_tags() ) : ?>
            <!-- inline style for easy JavaScript mods, without getting computed styles -->
            <div id='posttags' class='postcattags posttags' style='display: none; opacity: 0;'>
            <?php
                print
                    get_the_tag_list(
                            $before = '<div class="capsule">',
                            // leave newlines below... Safari needs them
                            // for rounded borders!!!
                            $sep = '
                                    </div><div class="capsule">
                                   ',
                            $after = '</div>');
            ?> 
            <br clear='all'/>
            </div>
            <?php endif; ?>

        </div>

    </fieldset>

</div>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<div class="post">
    <fieldset>
    <br/>
    <div class='entry'>
    Sorry, no posts matched your criteria.
    <br/>
    <br/>
    </div>
    </fieldset>
</div>

<?php endif; ?>

</div>

<?php get_footer(); ?>

