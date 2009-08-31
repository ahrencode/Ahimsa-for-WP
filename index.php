<?php get_header(); ?>

<?php if( $options['showdelic'] && $options['delicid'] ) :
    $delid = $options['delicid']; ?>

<div id='recent'>
    <div id='recentheader'>
        <div id='recentclose'
            onclick='toggleDelicious();'>+</div>
        <div id='recentmore' class='capsule'
            onclick='document.location="http://delicious.com/<?php print $delid; ?>";'> More </div>
        <?php print $options['delictitle']; ?>
        <!-- inline style for easy JavaScript mods, without getting computed styles -->
        <div id='recentlist' style='opacity: 1.0; display: block;'>
            <?php delicious_bookmarks($delid, 5, true, false); ?>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <fieldset>

                <legend class='title'>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                        title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
                </legend>

                <div class='capsule dateauthor'>
                    <?php the_time('M jS, Y') ?> by <?php the_author() ?>
                </div>

                <div class="entry">
                    <?php the_content('Read the rest of this entry &raquo;'); ?>
                </div>

                <div class="postmetadata"
                    <?php if( $options["idxfadepmeta"] ) : ?>
                    style='opacity: 0.3;'
                    onmouseover='this.style.opacity = 1.0;'
                    onmouseout='this.style.opacity = 0.3;'
                    <?php endif; ?>
                    >

                    <span class='capsule commentlink actbubble'>
                        <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;',
                                '% Comments &#187;'); ?>
                    </span>

                    <input type='button' class='capsule actbubble cattrigger'
                        value='Categories &darr;'
                        onclick='fadeBlock("postcats-<?php the_ID();?>");'/>

                    <?php if( get_the_tags() ) : ?>
                        <input type='button' class='capsule actbubble cattrigger'
                            value='Tags &darr;'
                            onclick='fadeBlock("posttags-<?php the_ID();?>");'/>
                    <?php endif; ?>

                    <!-- inline style for easy JavaScript mods, without getting computed styles -->
                    <div id='postcats-<?php the_ID(); ?>' class='postcattags postcats'
                        style='display: none; opacity: 0;'>
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
                        <!-- inline style for easy JavaScript mods, without getting computed styles -->
                        <div id='posttags-<?php the_ID(); ?>' class='postcattags posttags'
                            style='display: none; opacity: 0;'>
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

                </div> <!-- postmetadata -->

            </fieldset>

        </div> <!-- post -->

    <?php endwhile; ?>

    <div class="navigation">
        <?php
            previous_posts_link(
                "<span class='capsule actbubble' style='float: right;'>" .
                "Newer Entries &raquo;" .
                "</span>");
        ?>
        <?php next_posts_link("<span class='capsule actbubble'>&laquo; Older Entries</span>"); ?>
    </div>

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

<?php if( $options['defhidesidebar'] == 1 ): ?>
    <script language='JavaScript'>
        fadeSideBar();
    </script>
<?php endif; ?>

<?php get_footer(); ?>

