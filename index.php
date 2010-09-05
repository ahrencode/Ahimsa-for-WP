<?php get_header(); ?>

<?php if( $options['showdelic'] && $options['delicid'] ) :
    $delid = $options['delicid']; ?>

    <div id='recent'>
        <div id='recentheader'>
            <div id='recentclose'
                onclick='toggleDelicious();'>+</div>
            <div id='recentmore' class='capsule'
                onclick='document.location="http://delicious.com/<?php print $delid; ?>";'>
                <?php
                    /* translators: this is the 'More' link for the Delicious box */
                    _e('More', 'ahimsa');
                ?>
            </div>
            <?php print $options['delictitle']; ?>
        </div>
        <div id='recentlist'>
            <?php delicious_bookmarks($delid, 5, true, false); ?>
        </div>
    </div>

<?php endif; ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <fieldset>

                <legend class='title'>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="<?php printf(__('Permanent Link to %s', 'ahimsa'), get_the_title()); ?>">
                        <?php the_title(); ?></a>
                </legend>

                <!-- wrap the date author in a div so that it sits by itself with a bottom margin -->
                <div>
                    <div class='capsule dateauthor'>
                        <?php
                            /* translators: this is the date format for posts. See http://php.net/date */
                            $post_time = the_time(__('M jS, Y', 'ahimsa'));
                            /* translators: this is the post date/author bubble in the main page */
                            printf(__('%1$s by %2$s', 'ahimsa'), $post_time, get_the_author());
                        ?>
                    </div>
                    <br clear='all'/>
                </div>

                <div class="entry">
                    <?php the_content(__('Read the rest of this entry', 'ahimsa') . ' &raquo;'); ?>
                </div>

                <div class="postmetadata
                        <?php if( $options["idxfadepmeta"] ) : ?>
                            fadedbottombar
                        <?php endif; ?>
                        ">

                    <span class='capsule commentlink actbubble'>
                        <?php comments_popup_link(
                                    __('No Comments', 'ahimsa') . ' &#187;',
                                    __('1 Comment', 'ahimsa') . ' &#187;',
                                    __('% Comments', 'ahimsa') . ' &#187;'); ?>
                    </span>

                    <input type='button' class='capsule actbubble cattrigger'
                        value='<?php _e('Categories', 'ahimsa'); ?> &darr;'
                        onclick='fadeBlock("#postcats-<?php the_ID();?>");'/>

                    <?php if( get_the_tags() ) : ?>
                        <input type='button' class='capsule actbubble cattrigger'
                            value='<?php _e('Tags', 'ahimsa'); ?> &darr;'
                            onclick='fadeBlock("#posttags-<?php the_ID();?>");'/>
                    <?php endif; ?>

                    <div id='postcats-<?php the_ID(); ?>' class='postcattags postcats'
                        style='display: none;'>
                        <?php
                            $first = 1;
                            foreach((get_the_category()) as $cat)
                            {
                                if( ! $first )
                                    print ", ";
                                print
                                    "<a href='" . get_category_link($cat->cat_ID) . "'>" .
                                    "$cat->cat_name</a>";
                                $first = 0;
                            }
                        ?>
                    </div>

                    <?php if( get_the_tags() ) : ?>
                        <div id='posttags-<?php the_ID(); ?>' class='postcattags posttags'
                            style='display: none;'>
                            <?php
                                print
                                    get_the_tag_list(
                                            $before = '',
                                            // leave newlines below... Safari needs them
                                            // for rounded borders!!!
                                            $sep = ', ',
                                            $after = '');
                            ?> 
                        </div>
                    <?php endif; ?>

                    <div style='clear: both; height: 1px !important;'></div>

                </div> <!-- postmetadata -->

            </fieldset>

        </div> <!-- post -->

    <?php endwhile; ?>

    <div class="navigation">
        <?php
            previous_posts_link(
                "<span class='capsule actbubble' style='float: right;'>" .
                __("Newer Entries", "ahimsa") . " &raquo;" .
                "</span>");
        ?>
        <?php next_posts_link(
                "<span class='capsule actbubble'>&laquo; " .
                __("Older Entries", "ahimsa") .
                "</span>"); ?>
    </div>

    <br clear='all' />

<?php else : ?>

    <div class="post">
        <fieldset>
            <legend class='title'><?php _e('Not Found', 'ahimsa'); ?></legend>
            <br/>
            <div class='entry'>
                <?php _e("Sorry, but you are looking for something that isn't here.", 'ahimsa'); ?>
                <br/>
                <br/>
            </div>
        </fieldset>
    </div>

<?php endif; ?>

<?php get_footer(); ?>

<?php if( $options['defhidesidebar'] == 1 ): ?>
    <script language='JavaScript'>
        slideSideBar('left');
        slideSideBar('right');
    </script>
<?php endif; ?>

