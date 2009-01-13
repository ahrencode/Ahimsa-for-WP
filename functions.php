<?php

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<fieldset class="sidebarlist">',
        'after_widget' => '</fieldset>',
        'before_title' => '<legend> &sect; ',
        'after_title' => '</legend>',
    ));

if( ! is_array(get_option('ahimsa')) )
    add_option('ahimsa', array('init' => 1));

$options = get_option('ahimsa');

# defaults
if( ! isset($options['showauthors']) ) $options['showauthors'] = 1;
if( ! isset($options['showloginout']) ) $options['showloginout'] = 1;
if( ! isset($options['defhidesidebar']) ) $options['defhidesidebar'] = 0;
if( ! isset($options['idxfadepmeta']) ) $options['idxfadepmeta'] = 0;
if( ! isset($options['showdelic']) ) $options['showdelic'] = 0;
if( ! isset($options['delicid']) ) $options['delicid'] = "";
if( ! isset($options['delictitle']) ) $options['delictitle'] = "Recent News and Links";
if( ! isset($options['copyright']) ) $options['copyright'] = "";
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

            <input type='checkbox' name='showauthors' id='showauthors'" .
                ($options['showauthors'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showauthors'>Show Authors in Sidebar</label><br />

            <input type='checkbox' name='showloginout' id='showloginout'" .
                ($options['showloginout'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showloginout'>
                Show Login/Logout option in Top Menu</label><br />

            <input type='checkbox' name='defhidesidebar' id='defhidesidebar'" .
                ($options['defhidesidebar'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='defhidesidebar'>
                Hide Sidebar by default in Main/Home page</label><br />

            <input type='checkbox' name='idxfadepmeta' id='idxfadepmeta'" .
                ($options['idxfadepmeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='idxfadepmeta'>
                In index/home page, fade category, tag, comment links
                unless hovered over</label><br />
                <dd>(does not work in IE)</dd>
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
    $options['idxfadepmeta']    = ( isset($_POST['idxfadepmeta']) ) ? 1 : 0;
    $options['showdelic']       = ( isset($_POST['showdelic']) ) ? 1 : 0;
    $options['delicid']         = ( isset($_POST['delicid']) ) ? $_POST['delicid'] : "";
    $options['delictitle']      = ( isset($_POST['delictitle']) ) ? $_POST['delictitle']
                                    : "Recent News and Links";
    $options['copyright']       = ( isset($_POST['copyright']) ) ? $_POST['copyright'] : "";

    update_option('ahimsa', $options);
}


?>
