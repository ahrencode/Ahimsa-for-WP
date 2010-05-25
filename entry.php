<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

    <fieldset>

        <legend class='title'>
            <a href="<?php the_permalink() ?>" rel="bookmark"
                title="<?php printf(__('Permanent Link to %s', 'ahimsa'), get_the_title()); ?>">
                <?php the_title(); ?></a>
        </legend>

        <?php if( is_single() || $options['showpagemeta'] == 1 ) : ?>
            <!-- wrap the date author in a div so that it sits by itself with a bottom margin -->
            <div>
                <div class='capsule dateauthor'>
                <?php
                    /* translators: this is the post/page date format */
                    $post_time = the_time(__('F jS, Y', 'ahimsa'));
                    /* translators: this is the post/page date bubble: 'date' by 'author' */
                    printf(__('%1$s by %2$s', 'ahimsa'), $post_time, get_the_author());
                ?>
                </div>
                <br clear='all'/>
            </div>
        <?php endif; ?>

        <?php if( is_single() || $options['showpageactions'] == 1 ) : ?>

            <div id='postaction' class='actbubble'>

                <ul>

                    <?php edit_post_link(__('Edit Entry', 'ahimsa'), '<li>', '</li>'); ?>

                    <?php
                                
                        if (('open' == $post-> comment_status) && ('open' == $post->ping_status))
                        {
                            print "
                                <li> <a href='#respond'>" . __('Add Comment', 'ahimsa') . "</a> </li>
                                <li> <a href='" . trackback_url(false) . "' rel='trackback'>" .
                                    __('Trackback', 'ahimsa') . "</a> </li>
                                ";
                        }
                        elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status))
                        {
                            print "<li> <a href='" . trackback_url(false) . "' rel='trackback'>" .
                                __('Trackback', 'ahimsa') . "</a> </li>";
                        }

                    ?>

                    <li>
                        <img border='0' align='middle' alt='<?php _e('Comments Feed', 'ahimsa'); ?>'
                            src='<?php print bloginfo('template_directory') . "/images/rss-icon.gif"; ?>' />
                        <?php comments_rss_link(__('Comments Feed', 'ahimsa')); ?>
                    </li>

                </ul>

            </div> <!-- end postaction -->

        <?php endif; ?>

        <div class="entry">
            <?php the_content(__('Read the rest of this entry', 'ahimsa') . ' &raquo;'); ?>
        </div>

        <br clear='all'/>

        <div class="postmetadata">

            <?php
                wp_link_pages(
                        array
                        (
                            'before' => '<div id="subpagelinks" class="capsule actbubble">
                                            <span>' . __('Pages:', 'ahimsa') . '</span> ',
                            'after' => '</div>',
                            'next_or_number' => 'number'
                        )
                );
            ?>

            <div>

                <input type='button' class='capsule actbubble cattrigger'
                    value='<?php _e('Categories', 'ahimsa'); ?> &darr;'
                    onclick='fadeBlock(".postcats");'/>

                <?php if( get_the_tags() ) : ?>
                <input type='button' class='capsule actbubble cattrigger'
                    value='<?php _e('Tags', 'ahimsa'); ?> &darr;'
                    onclick='fadeBlock(".posttags");'/>
                <?php endif; ?>

            </div>

            <!-- inline style for easy JavaScript mods, without getting computed styles -->
            <div id='postcats' class='postcattags postcats' style='display: none;'>
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
            <div id='posttags' class='postcattags posttags' style='display: none;'>
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

<?php endwhile; ?>
<?php else: ?>

<div class="post">
    <fieldset>
    <br/>
    <div class='entry'>
    <?php _e('Sorry, no posts matched your criteria.', 'ahimsa'); ?>
    <br/>
    <br/>
    </div>
    </fieldset>
</div>

<?php endif; // have_posts() ?>
