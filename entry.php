
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

    <fieldset>

        <legend class='title'>
            <a href="<?php the_permalink() ?>" rel="bookmark"
                title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
        </legend>

        <?php if( is_single() || $options['showpagemeta'] == 1 ) : ?>
            <div class='capsule dateauthor'>
                <?php the_time('F jS, Y') ?> by <?php the_author() ?>
            </div>
        <?php endif; ?>

        <div id='postaction' class='actbubble'>

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
                    <img border='0' align='middle' alt='Comments Feed'
                        src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
                    <?php comments_rss_link('Comments Feed'); ?>
                </li>

            </ul>

        </div> <!-- end postaction -->

        <div class="entry">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>

        <br clear='all'/>

        <div class="postmetadata">

            <?php
                wp_link_pages(
                        array
                        (
                            'before' => '<div id="subpagelinks" class="capsule actbubble"><span>Pages:</span> ',
                            'after' => '</div>',
                            'next_or_number' => 'number'
                        )
                );
            ?>

            <div>

                <input type='button' class='capsule actbubble cattrigger'
                    value='Categories &darr;'
                    onclick='fadeBlock("postcats");'/>

                <?php if( get_the_tags() ) : ?>
                <input type='button' class='capsule actbubble cattrigger'
                    value='Tags &darr;'
                    onclick='fadeBlock("posttags");'/>
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

<?php endif; // have_posts() ?>

</div>

<?php if( $options['defhidesbpages'] == 1 ): ?>
    <script language='JavaScript'>
        fadeSideBar();
    </script>
<?php endif; ?>

