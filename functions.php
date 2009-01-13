<?php

if( ! is_array(get_option('ahimsa')) )
    add_option('ahimsa', array('init' => 1));

$options = get_option('ahimsa');
$sectprefix = $options['sectprefix'] ? "&sect;&nbsp;" : "";

# defaults
if( ! isset($options['showloginout'     ]) ) $options['showloginout'    ] = 1;
if( ! isset($options['showauthors'      ]) ) $options['showauthors'     ] = 1;
if( ! isset($options['defhidesidebar'   ]) ) $options['defhidesidebar'  ] = 0;
if( ! isset($options['defhidesbpages'   ]) ) $options['defhidesbpages'  ] = 1;
if( ! isset($options['sectprefix'       ]) ) $options['sectprefix'      ] = 1;
if( ! isset($options['idxfadepmeta'     ]) ) $options['idxfadepmeta'    ] = 0;
if( ! isset($options['showpagemeta'     ]) ) $options['showpagemeta'    ] = 1;
if( ! isset($options['showdelic'        ]) ) $options['showdelic'       ] = 0;
if( ! isset($options['delicid'          ]) ) $options['delicid'         ] = "";
if( ! isset($options['delictitle'       ]) ) $options['delictitle'      ] = "Recent News and Links";
if( ! isset($options['copyright'        ]) ) $options['copyright'       ] = "";
# end defaults

update_option('ahimsa', $options);

# setup admin menu
add_action('admin_menu', 'ahimsa_admin_menu');


#-------------------------------------------------------------------------------
function ahimsa_admin_menu()
{
    add_theme_page('Ahimsa Options', 'Ahimsa Options', 'edit_themes', "Ahimsa", 'ahimsa_options');
}

#-------------------------------------------------------------------------------
function ahimsa_options()
{
    global $options;

    if( $_POST['action'] == 'save' )
        save_options();

    print
    "
        <form id='settings' action='' method='post' class='themeform'
            style='margin: 20px;'>

            <input type='hidden' id='action' name='action' value='save'>

            <input type='checkbox' name='showloginout' id='showloginout'" .
                ($options['showloginout'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showloginout'>
                Show Login/Logout option in Top Menu</label><br />

            <input type='checkbox' name='showauthors' id='showauthors'" .
                ($options['showauthors'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showauthors'>Show Authors in Sidebar</label><br />

            <input type='checkbox' name='defhidesidebar' id='defhidesidebar'" .
                ($options['defhidesidebar'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='defhidesidebar'>
                Hide Sidebar by default in Main/Home page</label><br />

            <input type='checkbox' name='defhidesbpages' id='defhidesbpages'" .
                ($options['defhidesbpages'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='defhidesbpages'>
                Hide Sidebar by default in posts and pages</label><br />

            <input type='checkbox' name='sectprefix' id='sectprefix'" .
                ($options['sectprefix'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='sectprefix'>
                Show &sect; symbol as prefix for section headers in sidebar</label><br />

            <input type='checkbox' name='idxfadepmeta' id='idxfadepmeta'" .
                ($options['idxfadepmeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='idxfadepmeta'>
                In index/home page, fade category, tag, comment links
                unless hovered over</label><br />
                <dd>(does not work in IE)</dd>

            <input type='checkbox' name='showpagemeta' id='showpagemeta'" .
                ($options['showpagemeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='showpagemeta'>
                Show author and date information for pages</label><br />

            <input type='checkbox' name='showdelic' id='showdelic'" .
                ($options['showdelic'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='showdelic'>
                Show 5 recent del.icio.us links for user: </label>
                <input type='text' name='delicid' value='$options[delicid]' />
                <br />
                <dd>
                    <label style='margin-left: 5px;' for='delictitle'>
                    Title for Delicious Links section: </label>
                    <input type='text' name='delictitle' value='$options[delictitle]' />
                    <br/>
                    (requires the <a
                     href='http://wordpress.org/extend/plugins/delicious-for-wordpress/'>del.icio.us
                     for Wordpress</a> plugin.)
                </dd>

            <br/>


            <label style='margin-left: 5px;' for='copyright'>
                Copyright text:
            </label>
            <input type='text' size='50' name='copyright' id='copyright'
                value='$options[copyright]' />

            <p class='submit'><input type='submit' value='Save Changes' name='save'/></p>

        </form>
    ";
}


function save_options()
{
    global $_POST, $options;

    $customflag = 0;
    /*
    if( $fp = fopen(TEMPLATEPATH  . "/custom.css", 'w') )
    {
    }
    */

    print
    "
        <div class='updated fade' id='message'
            style='background-color: rgb(255, 251, 204);
                    width: 300px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p>Ahimsa Settings <strong>saved</strong>.</p>
        </div>
    ";

    $options['showauthors']     = ( isset($_POST['showauthors']) ) ? 1 : 0;
    $options['showloginout']    = ( isset($_POST['showloginout']) ) ? 1 : 0;
    $options['defhidesidebar']  = ( isset($_POST['defhidesidebar']) ) ? 1 : 0;
    $options['defhidesbpages']  = ( isset($_POST['defhidesbpages']) ) ? 1 : 0;
    $options['sectprefix']      = ( isset($_POST['sectprefix']) ) ? 1 : 0;
    $options['idxfadepmeta']    = ( isset($_POST['idxfadepmeta']) ) ? 1 : 0;
    $options['showpagemeta']    = ( isset($_POST['showpagemeta']) ) ? 1 : 0;
    $options['showdelic']       = ( isset($_POST['showdelic']) ) ? 1 : 0;
    $options['delicid']         = ( isset($_POST['delicid']) ) ? $_POST['delicid'] : "";
    $options['delictitle']      = ( isset($_POST['delictitle']) ) ? $_POST['delictitle']
                                    : "Recent News and Links";
    $options['copyright']       = ( isset($_POST['copyright']) ) ? $_POST['copyright'] : "";

    update_option('ahimsa', $options);
}

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => "<fieldset class='sidebarlist'>",
        'after_widget' => "</fieldset>",
        'before_title' => "<legend>$sectprefix",
        'after_title' => "</legend>",
    ));

//------------------------------------------------------------------------------
function custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    ?>

    <fieldset class='comment'>

        <legend> <?php comment_author_link() ?> writes: </legend>

        <div class="commentmeta">
            <small class='capsule'>
            <?php comment_date('F jS, Y') ?> at <?php comment_time() ?>
            </small>
            <?php if( $user_ID ) : ?>
            &nbsp;&nbsp;
            <small class='capsule'>
            <?php edit_comment_link('edit','&nbsp;',''); ?>
            </small>
            <?php endif; ?>
        </div>

        <?php
            if(function_exists('get_avatar'))
                echo get_avatar(get_comment_author_email(), '50');
        ?>

        <div class='commenttext'>

        <?php if($comment->comment_approved == '0') : ?>
            <span class='capsule'>Your comment is awaiting moderation.</span>
            <br />
        <?php endif; ?>

        <?php comment_text() ?>

        </div>

        <div class='postmetadata replybuttonbox'>
        <span class="capsule">
            <!-- spaces needed for Safari to render rounded corners! -->
            &nbsp;
            <?php comment_reply_link(
                    array_merge( $args, array('depth' => $depth,
                                'max_depth' => $args['max_depth']))) ?>
            &nbsp;
        </span>
        </div>

    </fieldset>

<?php

}

?>
