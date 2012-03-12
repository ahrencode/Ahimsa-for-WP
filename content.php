<?php if( have_posts() ) : ?>

    <?php while( have_posts() ) : the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <fieldset class='entrybox'>

                <legend class='title'>
                    <a href="<?php the_permalink(); ?>" rel="bookmark"
                        title="<?php printf(__('Permanent Link to %s', 'ahimsa'), get_the_title()); ?>">
                        <?php the_title(); ?></a>
                </legend>

                <?php if( !is_page() || $options['showpagemeta'] == 1 ) : ?>
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

                <div class="entry">
                    <?php the_content(__('Read the rest of this entry', 'ahimsa') . ' &raquo;'); ?>
                </div>

                <?php
                    if( is_single() )
                        wp_link_pages(
                            array
                            (
                                'before' => '<div id="subpagelinks" class="capsule">
                                                <span>' . __('Pages:', 'ahimsa') . '</span> ',
                                'after' => '</div>',
                                'next_or_number' => 'number'
                            )
                        );
                ?>

                <?php include('postmeta.php'); ?>

            </fieldset> <!-- entrybox -->

            <?php if( is_singular() ) comments_template(); ?>

        </div>  <!-- [each] post/page/... -->

    <?php endwhile; ?>

    <?php if( is_home() ) : ?>

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

    <? endif; ?>

<?php else: // have_posts() ?>

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

<?php endif; // have_posts() ?>
