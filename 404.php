<?php get_header(); ?>

<div class='post'>

    <fieldset>

        <legend class='title'>
                <?php _e('Oops!', 'ahimsa'); ?>
        </legend>

        <div class='entry'>

            <?php _e( 'Sorry, but the page you are looking for is not here! You could try one of the below:', 'ahimsa' ); ?></p>

            <hr size='1' />

            <h2><?php _e('Search', 'ahimsa'); ?></h2>
             <?php get_search_form(); ?>

            <br />
            <hr size='1' />

            <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

            <br />
            <hr size='1' />

            <div class="widget">
                <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'ahimsa' ); ?></h2>
                <ul>
                    <?php wp_list_categories(
                            array('orderby' => 'count',
                                'order' => 'DESC',
                                'show_count' => 1,
                                'title_li' => '',
                                'number' => 10 ) );
                    ?>
                </ul>
            </div>

            <br />
            <hr size='1' />

            <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

            <br />
            <hr size='1' />

            <?php the_widget('WP_Widget_Archives', array('count' => 0)); ?>

        </div> <!-- entry -->

    </fieldset>

</div> <!-- post -->

<?php get_footer(); ?>
