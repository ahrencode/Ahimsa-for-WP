<?php

include_once("utils.php");

// not a fan of fixed widths, but WP.org folks reject themes if this is not set
if ( ! isset( $content_width ) )
    $content_width = 600;

// i18n
load_theme_textdomain('ahimsa');

// required by WP
add_theme_support('automatic-feed-links');
// post thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 300, 300);

// support for post formats -- not ready yet!
//add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'video', 'chat'));

ahimsa_read_init_options();

// setup admin menu
add_action('admin_menu', 'ahimsa_admin_menu');

// add sidebars
if ( function_exists('register_sidebar') )
    ahimsa_add_sidebars();

// if you can't win 'em...! nav menus!
add_action( 'init', 'ahimsa_add_menus' );

// expose options to JavaScript
// let's not do this for now... not sure about json_encode()
// support across sites...
//ahimsa_options_js();


#-------------------------------------------------------------------------------
function ahimsa_read_init_options()
{
    global $ahimsa_options;

    if( ! is_array(get_option('ahimsa')) )
        add_option('ahimsa', array('init' => 1));

    $ahimsa_options = get_option('ahimsa');

    # Ahimsa 3.4 only. TODO: remove for Ahimsa 3.5? (what about non-sequential updaters?)
    if( isset($ahimsa_options['showdelic'          ]) ) delete_option('showdelic');
    if( isset($ahimsa_options['delicid'            ]) ) delete_option('delicid');
    if( isset($ahimsa_options['delictitle'         ]) ) delete_option('delictitle');
    if( isset($ahimsa_options['showpageactions'    ]) ) delete_option('showpageactions');

    # defaults
    if( ! isset($ahimsa_options['showtopmenu'      ]) ) $ahimsa_options['showtopmenu'     ] = 1;
    if( ! isset($ahimsa_options['showloginout'     ]) ) $ahimsa_options['showloginout'    ] = 1;
    if( ! isset($ahimsa_options['showauthors'      ]) ) $ahimsa_options['showauthors'     ] = 1;
    if( ! isset($ahimsa_options['defhidesidebar'   ]) ) $ahimsa_options['defhidesidebar'  ] = 0;
    if( ! isset($ahimsa_options['defhidesbpages'   ]) ) $ahimsa_options['defhidesbpages'  ] = 1;
    if( ! isset($ahimsa_options['sectprefix'       ]) ) $ahimsa_options['sectprefix'      ] = 1;
    if( ! isset($ahimsa_options['idxfadepmeta'     ]) ) $ahimsa_options['idxfadepmeta'    ] = 0;
    if( ! isset($ahimsa_options['showpagemeta'     ]) ) $ahimsa_options['showpagemeta'    ] = 1;
    if( ! isset($ahimsa_options['iecorners'        ]) ) $ahimsa_options['iecorners'       ] = 0;
    if( ! isset($ahimsa_options['googlefonts'      ]) ) $ahimsa_options['googlefonts'     ] = "";
    if( ! isset($ahimsa_options['copyright'        ]) ) $ahimsa_options['copyright'       ] = "";
    if( ! isset($ahimsa_options['skin'             ]) ) $ahimsa_options['skin'            ] = "none";
    if( ! isset($ahimsa_options['logourl'          ]) ) $ahimsa_options['logourl'         ] = "";
    if( ! isset($ahimsa_options['commentguide'     ]) ) $ahimsa_options['commentguide'    ] = "";
    # end defaults

    update_option('ahimsa', $ahimsa_options);
}

#-------------------------------------------------------------------------------
# populate a JavaScript object with the options for use
# in browser side implementation of user preferences
function ahimsa_options_js()
{
    global $ahimsa_options;

    print
    "
        <script type='text/javascript'>
            var options = " . json_encode($ahimsa_options) . ";
        </script>
    ";
}

#-------------------------------------------------------------------------------
function ahimsa_add_sidebars()
{
    global $ahimsa_options;

    $sectprefix = $ahimsa_options['sectprefix'] ? "&sect;&nbsp;" : "";

    register_sidebar(array(
        'name' => 'leftbar',
        'before_widget' => "<fieldset class='sidebarlist'>",
        'after_widget' => "</fieldset>",
        'before_title' => "<legend class='title'>$sectprefix",
        'after_title' => "</legend>",
    ));
    register_sidebar(array(
        'name' => 'rightbar',
        'before_widget' => "<fieldset class='sidebarlist'>",
        'after_widget' => "</fieldset>",
        'before_title' => "<legend class='title'>$sectprefix",
        'after_title' => "</legend>",
    ));
}

#-------------------------------------------------------------------------------
function ahimsa_add_menus()
{
    // let's start with one for now
    register_nav_menus(array('header-menu' => __('Header Menu', 'ahimsa')));
}

#-------------------------------------------------------------------------------
function ahimsa_admin_menu()
{
    add_theme_page('Ahimsa Options', 'Ahimsa Options', 'edit_themes', "Ahimsa", 'ahimsa_settings');
}

#-------------------------------------------------------------------------------
function ahimsa_settings()
{
    global $ahimsa_options;

    // TODO: sneak this in here for now
    ahimsa_check_store_mksymlinks();

    if( isset($_POST['action']) && $_POST['action'] == 'save' )
        ahimsa_save_options();
    ?>

    <form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>

    <div style=
            '
                clear: right;
                float: right;
                margin: 30px;
                background-color: #fff3cc;
                color: #000000;
                padding: 10px 20px;
                border: 1px solid #ddc055;
                width: 250px;
            '>

        <h3>Keep up with Ahimsa For WordPress</h3>

        <p>
            Follow on Twitter, or join the Facebook Page. Subscribe to the blog.
            Create bug/feature requests, download the latest code, and more!
        </p>

        <div style=
            '
                float: right;
                margin-left: 15px;
                width: 50px;
                text-align: center;
                border-top: 2px solid #ddc055;
                border-bottom: 2px solid #ddc055;
            '>
            <h4 style='margin: 3px 0px; color: #860;'>DONATE</h4>
            <a target='_new' href='https://flattr.com/thing/231042/ahrencode-on-Flattr'>
            <img src='<?php print get_template_directory_uri(); ?>/images/flattr.png' alt='Flattr This' title='Donate' /></a>
        </div>

        <ul>
        <li style='list-style-type: circle; margin-left: 10px;'>
            Twitter:
            <a href='http://twitter.com/ahrencode/'>Ahren Code</a>
        </li>
        <li style='list-style-type: circle;  margin-left: 10px;'>
            <a
            href='http://www.facebook.com/ahrencode'>Facebook</a>
        </li>
        <li style='list-style-type: circle;  margin-left: 10px;'>
            <a href='http://code.ahren.org/tag/ahimsa'>Blog</a>
        </li>
        <li style='list-style-type: circle;  margin-left: 10px;'>
            GitHub:
            <a href='http://github.com/ahrencode/Ahimsa-for-WP/'>Home</a> |
            <a href='http://github.com/ahrencode/Ahimsa-for-WP/issues'>Issues</a>
        </li>
        </ul>

        </div>

        <div style=
                '
                    clear: right;
                    float: right;
                    margin: 30px;
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px 20px;
                    border: 1px solid #ddc055;
                    width: 250px;
                '>
            Want to add your own funky JavaScript or some such in the footer?
            Create a file <code>
            <?php print WP_CONTENT_DIR; ?>/themestore/ahimsa/footer-custom.php</code>
            and put your code in there.
        
            <?php if( file_exists(TEMPLATEPATH . "/footer-custom.php") ) : ?>
                <b>You can do that by using the Theme Editor</b>
                (<i>Dashboard->Appearance->Editor</i>).
            <?php endif; ?>

        </div>

        <?php
        print
        "
            <h3>General</h3>

            <input type='hidden' id='action' name='action' value='save'>

            <input type='checkbox' name='showtopmenu' id='showtopmenu'" .
                ($ahimsa_options['showtopmenu'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showtopmenu'>
                Show Top Menu (Feeds/Login/Logout)</label><br />

            <input type='checkbox' name='showloginout' id='showloginout'" .
                ($ahimsa_options['showloginout'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showloginout'>
                Show Login/Logout option in Top Menu</label><br />

            <input type='checkbox' name='idxfadepmeta' id='idxfadepmeta'" .
                ($ahimsa_options['idxfadepmeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='idxfadepmeta'>
                In index/home page, fade category, tag, comment links
                unless hovered over</label> (does not work in IE)</label><br />

            <input type='checkbox' name='iecorners' id='iecorners'" .
                ($ahimsa_options['iecorners'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='iecorners'>
                Turn on <b>experimental</b> and <b>partial</b> support for
                rounded corners in IE
            </label><br />

            <br />

            <label style='margin-left: 5px;' for='googlefonts'>
                Comma separated list of
                <a href='http://www.google.com/webfonts'>Google Fonts</a>
                (use them in your <code>custom.css</code>):
            </label><br />
            <input type='text' size='50' name='googlefonts' id='googlefonts'
                value='$ahimsa_options[googlefonts]' />

            <br />

            <label style='margin-left: 5px;' for='copyright'>
                Copyright text:
            </label><br />
            <input type='text' size='50' name='copyright' id='copyright'
                value='$ahimsa_options[copyright]' />

            <br />

            <label style='margin-left: 5px;' for='logourl'>
                URL for logo:
            </label><br />
            <input type='text' size='50' name='logourl' id='logourl'
                value='$ahimsa_options[logourl]' />

            <h3>Sidebar</h3>

            <input type='checkbox' name='showauthors' id='showauthors'" .
                ($ahimsa_options['showauthors'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showauthors'>Show Authors in Sidebar</label><br />

            <input type='checkbox' name='defhidesidebar' id='defhidesidebar'" .
                ($ahimsa_options['defhidesidebar'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='defhidesidebar'>
                Hide Sidebar by default in Main/Home page</label><br />

            <input type='checkbox' name='defhidesbpages' id='defhidesbpages'" .
                ($ahimsa_options['defhidesbpages'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='defhidesbpages'>
                Hide Sidebar by default in posts and pages</label><br />

            <input type='checkbox' name='sectprefix' id='sectprefix'" .
                ($ahimsa_options['sectprefix'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='sectprefix'>
                Show &sect; symbol as prefix for section headers in sidebar</label><br />

            <h3>Pages</h3>

            (also see Sidebar section above)
            <br />
            <br />

            <input type='checkbox' name='showpagemeta' id='showpagemeta'" .
                ($ahimsa_options['showpagemeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='showpagemeta'>
                Show author and date information for pages</label><br />

            <h3>Comments</h3>

            Custom text (instructions) to display next to comment box: <br />
            <textarea name='commentguide' id='commentguide' rows=5 cols=60>" .
                stripslashes($ahimsa_options['commentguide']) . "</textarea>

            <br/>
            <br/>
            <hr size='1'/>

            <div style='
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px 20px;
                    border: 1px solid #ddc055;
                    margin: 20px 30px;
                    width: 250px;
                    float: right;
                    clear: right;
                    '>
                Know your CSS and want to do more detailed customisations? That's easy!
                Just create a file called <code>"
                . WP_CONTENT_DIR . "/themestore/ahimsa/custom.css</code>
                and add your custom styling in there. That's it! All customisations in
                this file should be retained even if you upgrade the theme.
        ";
        
        if( file_exists(TEMPLATEPATH . "/custom.css") )
            print
            "
                <b>You can do that by using the Theme Editor</b>
                (<i>Dashboard->Appearance->Editor</i>).
            ";

        print
        "
                <br />
                <br />
                <hr size='1' />
                <br />

                Want to share your skin with others? Look up the instructions on the
                <a href='http://code.ahren.org/ahimsa/'>Ahimsa Page</a>.

            </div>

            <h3>Ahimsa Skins</h3>

            <input type='checkbox' name='skinupdate' id='skinupdate' />
            <label style='margin-left: 5px;' for='skinupdate'>Update Skins</label>
            <div style='margin-left: 30px; font-size: smaller;'>
                (PLEASE backup your skin before you attempt this. If you are upgraded
                 Ahimsa by more than one version then you may have to do this update
                 multiple times -- one for each intermediate version.)
            </div>

            <br />
            <br />

            " . ahimsa_skins_menu() . "

            <br />
            <br clear='all' />
            <hr size='1'/>

            <p class='submit'><input type='submit' value='Save Changes' name='save'/></p>

        </form>
    ";
}

$ahimsa_skin_fields =
array
(
    array
    (
        'name'      => "skinpagebgtopbg",
        'desc'      => "Site Background Top",
        'csssel'    => "#bgtop",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinpagediv",
        'desc'      => "Site Background Divider Colour",
        'csssel'    => "#bgtop",
        'attr'      => "border-bottom-color"
    ),
    array
    (
        'name'      => "skinpagebgbotbg",
        'desc'      => "Site Background Bottom",
        'csssel'    => "BODY",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinhyperlinks",
        'desc'      => "Hyperlinks",
        'csssel'    => "A",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincapsulebg",
        'desc'      => "Default Bubble Background",
        'csssel'    => ".capsule",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincapsulefg",
        'desc'      => "Default Bubble Text Colour",
        'csssel'    => ".capsule",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinheaderbg",
        'desc'      => "Header Background",
        'csssel'    => "#header",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinheaderfg",
        'desc'      => "Header Text Colour",
        'csssel'    => "#header, #header table, #header a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinheadersepcolour",
        'desc'      => "Colour of Separator Bar in Header",
        'csssel'    => "#title",
        'attr'      => "border-right-color"
    ),
    array
    (
        'name'      => "skinsbtabbg",
        'desc'      => "Sidebar Tab Background",
        'csssel'    => ".sidebartab",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinsbtabfg",
        'desc'      => "Sidebar Tab Text Colour",
        'csssel'    => ".sidebartab",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinsidebarbg",
        'desc'      => "Sidebar Background",
        'csssel'    => ".sidebar, .tdsidebar",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinsidebarbg",
        'desc'      => "Sidebar Background",
        'csssel'    => ".sidebar, .tdsidebar",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinsbwidgetbg",
        'desc'      => "Sidebar Widgets Background",
        'csssel'    => ".sidebarlist",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinsbwidgetfg",
        'desc'      => "Sidebar Widgets Text Colour",
        'csssel'    => ".sidebarlist",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinsblegendbg",
        'desc'      => "Sidebar Widget Title Background",
        'csssel'    => ".sidebarlist .title",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinsblegendfg",
        'desc'      => "Sidebar Widget Title Text Colour",
        'csssel'    => ".sidebarlist .title",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinsblistdiv",
        'desc'      => "Sidebar Lists Divider Colour",
        'csssel'    => ".sidebarlist li",
        'attr'      => "border-top-color"
    ),
    array
    (
        'name'      => "skinsblink",
        'desc'      => "Sidebar Widget Hyperlinks",
        'csssel'    => ".sidebarlist a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincalcaption",
        'desc'      => "Sidebar Calendar Caption Colour",
        'csssel'    => "#wp-calendar caption",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincalheaderbg",
        'desc'      => "Sidebar Calendar Column Header Background",
        'csssel'    => "#wp-calendar thead th, #wp-calendar tfoot td.pad",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincalheaderfg",
        'desc'      => "Sidebar Calendar Column Header Text Colour",
        'csssel'    => "#wp-calendar thead th",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincalcellfg",
        'desc'      => "Sidebar Calendar Entries Text Colour",
        'csssel'    => "#wp-calendar tbody td",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincalnpbg",
        'desc'      => "Sidebar Calendar Next/Prev Links Background",
        'csssel'    => "#wp-calendar #next, #wp-calendar #prev",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincalnpfg",
        'desc'      => "Sidebar Calendar Next/Prev Links Text Colour",
        'csssel'    => "#wp-calendar #next, #wp-calendar #prev, #wp-calendar tfoot a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skintextwdgtfg",
        'desc'      => "Sidebar Text Widget Text Colour",
        'csssel'    => ".textwidget",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincontentbg",
        'desc'      => "Main Content Background",
        'csssel'    => "#contentbox",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinpostpagebg",
        'desc'      => "Post or Page Entry Background",
        'csssel'    => ".entrybox",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinpostpagefg",
        'desc'      => "Post or Page Entry Text Colour",
        'csssel'    => ".entry",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinpptitlebg",
        'desc'      => "Post, Page, Comments Title Background",
        'csssel'    => ".title",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinpptitlefg",
        'desc'      => "Post, Page, Comments Title Text Colour",
        'csssel'    => ".title, .title a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinmetabarbg",
        'desc'      => "Post/Page/Comment Bottom Bar Background",
        'csssel'    => ".postmetadata",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincattagfg",
        'desc'      => "Category/Tag Lists Text/Link Colour",
        'csssel'    => ".postcattags, .postcattags a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinbqbg",
        'desc'      => "Blockquote Background",
        'csssel'    => "blockquote",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinbqfg",
        'desc'      => "Blockquote Text Colour",
        'csssel'    => "blockquote",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinlistbg",
        'desc'      => "Page/Post Ordered/Unordered List Background",
        'csssel'    => ".entry UL, .entry OL",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinlistfg",
        'desc'      => "Page/Post Ordered/Unordered Text Colour",
        'csssel'    => ".entry UL, .entry OL",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinpost1stletterfg",
        'desc'      => "Post First Letter Colour",
        'csssel'    => ".entry > P:first-child:first-letter",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinactionbg",
        'desc'      => "Action Bubbles (Edit, Reply, etc) Background",
        'csssel'    => ".actbubble",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinactionfg",
        'desc'      => "Action Bubbles (Edit, Reply, etc) Text Colour",
        'csssel'    => ".actbubble, .actbubble a",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skincommentsbg",
        'desc'      => "Comments Block Background",
        'csssel'    => "#comments",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincommentbg",
        'desc'      => "Comment Background",
        'csssel'    => ".comment, .commenttext",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skincommentfg",
        'desc'      => "Comment Text Colour",
        'csssel'    => ".commenttext",
        'attr'      => "color"
    ),
    array
    (
        'name'      => "skinresponsebg",
        'desc'      => "Response Box Background",
        'csssel'    => "#responsebox",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinheadermenubg",
        'desc'      => "Header Menu Background",
        'csssel'    => "#headermenu, #headermenu UL UL",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinheadermenuhover",
        'desc'      => "Header Menu Hover Background",
        'csssel'    => "#headermenu li:hover",
        'attr'      => "background-color"
    ),
    array
    (
        'name'      => "skinheadermenufg",
        'desc'      => "Header Menu Text Colour",
        'csssel'    => "#headermenu a",
        'attr'      => "color"
    )
);

#-------------------------------------------------------------------------------
function ahimsa_skins_menu()
{
    global $ahimsa_skin_fields, $ahimsa_options;

    $html = "";
    $curskin = $ahimsa_options['skin'];

    $checked = ($curskin == 'none') ? 'checked' : "";
    $html .= "<input type=radio name=skin value=none $checked> None <br/>\n";

    $skinfiles = ahimsa_util_get_skin_files();
    foreach( $skinfiles as $skinfile )
    {
        $filename = basename($skinfile);
        $skinname = preg_replace("/^skin_([^\.]+)\.css/", "$1", $filename);
        $checked = ($skinname == $curskin) ? 'checked' : "";
        $html .=
        "
            <input type=radio name=skin value='$skinname' $checked> $skinname
            (<a href='" . home_url() . "?ahimsaskin=$skinname' target=_new>Preview</a>)
            <br/>
        ";
    }

    if( $curskin != 'none' )
        $skinfile_array = ahimsa_read_skin_file(util_get_skin_path($curskin));
    else
        $skinfile_array = array();

    $html .=
    "
        <br/>

        <div style='
                width: 50%;
                margin: 10px 10px 30px 0px;
                padding: 20px;
                background-color: #fc8;
                color: #111;
                font-size: 1.2em;
                border-top: 5px solid #b20;
                border-bottom: 5px solid #b20;
                line-height: 150%;
                '>
            WARNING: This update includes significant style changes. Before
            you edit any existing skins below, you should first run a couple of
            updates to them by selecting the Update Skins checkbox above and
            Saving Changes (below). Ideally you should also backup any skins you
            have created. If you have any questions contact me on
            <a href='http://twitter.com/ahrencode'>Twitter</a> or the
            <a href='http://help.ahren.org/'>Help Site</a>
        </div>


        <input id='skindo' type='hidden' name='skindo' value='0'/>

        <a href='javascript:
                    document.getElementById(\"skinedit\").style.display = \"block\";
                    document.getElementById(\"skindo\").value = \"1\";
                    exit;
                    '>
        Edit Current or Create New Skin</a>

        <div id='skinedit' style='display: none;'>

        <br/>
        Caution: if you edit an Ahimsa supplied skin, you really should rename
        it and save it as a new skin.

        <h4>Enter Skin Details</h4>

        <p>(hint: change the name below to create a new skin)</p>
        Skin name: <input type=text name=skinname size=20 value='$curskin'>
        &nbsp;&nbsp;&nbsp;
        <a href='javascript:
                    document.getElementById(\"skinedit\").style.display = \"none\";
                    document.getElementById(\"skindo\").value = \"0\";
                    exit;
                '>Cancel</a>
        <br/>
        <br/>

        Enter colours in hex, including a hash prefix (e.g: #f0d000)

        <br/>
        <br/>

        <table border=0 cellspacing=0>

    ";

    foreach( $ahimsa_skin_fields as $style )
        $html .= ahimsa_get_skin_field_html($style, $skinfile_array);

    $html .= "</table>\n</div>\n";

    return($html);
}

#-------------------------------------------------------------------------------
function ahimsa_get_skin_field_html($style, $skinfile_array)
{
    if( isset($skinfile_array[$style['csssel']][$style['attr']]) )
        $value = $skinfile_array[$style['csssel']][$style['attr']];
    else
        $value = "";

    return
    ("
        <tr>
        <td style='text-align: right; padding: 1px 4px;'>
        $style[desc]:
        </td>
        <td style='padding: 1px 4px;'>
        <input id='$style[name]' size='7'  name='$style[name]' value='$value'
            onBlur='document.getElementById(\"".$style['name']."clr\").style.backgroundColor = this.value;'>
        </td>
        <td>
        <span id='".$style['name']."clr' style='border: 1px solid #777777;'>&nbsp;&nbsp;&nbsp;</span>
        <script language='JavaScript'>
            document.getElementById(\"".$style['name']."clr\").style.backgroundColor =
                document.getElementById(\"$style[name]\").value;
        </script>
        </td>
        </tr>
    ");
}

#-------------------------------------------------------------------------------
function ahimsa_save_options()
{
    global $_POST, $ahimsa_options;

    if( isset($_POST['skinupdate']) && $_POST['skinupdate'] == 'on' )
        if( ! ahimsa_update_skins() )
            return;

    if( $_POST['skindo'] == '1' )
        if( ! ahimsa_save_skin() )
            return;

    $ahimsa_options['showauthors']     = ( isset($_POST['showauthors']) ) ? 1 : 0;
    $ahimsa_options['showtopmenu']     = ( isset($_POST['showtopmenu']) ) ? 1 : 0;
    $ahimsa_options['showloginout']    = ( isset($_POST['showloginout']) ) ? 1 : 0;
    $ahimsa_options['defhidesidebar']  = ( isset($_POST['defhidesidebar']) ) ? 1 : 0;
    $ahimsa_options['defhidesbpages']  = ( isset($_POST['defhidesbpages']) ) ? 1 : 0;
    $ahimsa_options['sectprefix']      = ( isset($_POST['sectprefix']) ) ? 1 : 0;
    $ahimsa_options['idxfadepmeta']    = ( isset($_POST['idxfadepmeta']) ) ? 1 : 0;
    $ahimsa_options['showpagemeta']    = ( isset($_POST['showpagemeta']) ) ? 1 : 0;
    $ahimsa_options['iecorners']       = ( isset($_POST['iecorners']) ) ? 1 : 0;
    $ahimsa_options['copyright']       = ( isset($_POST['copyright']) ) ? $_POST['copyright'] : "";
    $ahimsa_options['googlefonts']     = ( isset($_POST['googlefonts']) ) ? $_POST['googlefonts'] : "";
    $ahimsa_options['skin']            = ( isset($_POST['skin']) ) ? $_POST['skin'] : "none";
    $ahimsa_options['logourl']         = ( isset($_POST['logourl']) ) ? $_POST['logourl'] : "";
    $ahimsa_options['commentguide']    = ( isset($_POST['commentguide']) ) ? $_POST['commentguide'] : "";

    update_option('ahimsa', $ahimsa_options);

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
}

//------------------------------------------------------------------------------
function ahimsa_save_skin()
{
    global $_POST, $ahimsa_options, $ahimsa_skin_fields;

    if( ! isset($_POST['skinname']) || $_POST['skinname'] == '' )
    {
        ahimsa_admin_error("Oops! Need a name to save a skin!");
        return(false);
    }

    $skinname = $_POST['skinname'];
    if( ! preg_match("/^[a-zA-Z0-9]+(\-[a-zA-Z0-9]+)*$/", $skinname) || $skinname == "none" )
    {
        ahimsa_admin_error("Name ($skinname) should be alphabets, numbers, and embedded hyphens.\n");
        return(false);
    }

    $skincss = "";

    foreach( $ahimsa_skin_fields as $field )
    {
        $name = $field['name'];

        if( ! isset($_POST[$name]) || $_POST[$name] == '' )
            continue;

        $skincss .=
        "
            $field[csssel]
            {
                $field[attr]: $_POST[$name];
            }
        ";
    }

    return(ahimsa_write_skin_file(WP_CONTENT_DIR . "/themestore/ahimsa/skin_$skinname.css", $skincss));
}

//------------------------------------------------------------------------------
function ahimsa_read_skin_file($skinfile)
{
    if( ! ($styles = @file("$skinfile", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES)) )
    {
        ahimsa_admin_error("Unable to read skin file: $skinfile");
        return(false);
    }

    $cssarray = array();
    $state = "ENDBLOCK";
    $newskin = "";
    $ignore = 0;
    $cursel = "";
    foreach( $styles as $style )
    {
        if( preg_match("/^\s*$/", $style) )
            continue;

        $style = trim($style);

        if( $state == "ENDBLOCK" )
        {
            $cursel = $style;
            if( ! isset($cssarray[$cursel]) || ! is_array($cssarray[$cursel]) )
                $cssarray[$cursel] = array();
            $state = "STARTBLOCK";
            continue;
        }

        if( $state == "STARTBLOCK" && preg_match("/^\{$/", $style) )
        {
            $state = "INBLOCK";
            continue;
        }

        if( $state == "INBLOCK" && preg_match("/^\}$/", $style) )
        {
            $state = "ENDBLOCK";
            continue;
        }

        if( $state == "INBLOCK" && preg_match("/^([^:]+):\s*([^;]+);$/", $style, $matches) )
            $cssarray[$cursel][$matches[1]] = $matches[2];
    }

    return($cssarray);
}

//------------------------------------------------------------------------------
function ahimsa_write_skin_file($filepath, $skincss)
{
    if( !$skinfile = @fopen($filepath, 'w') )
    {
         ahimsa_admin_error("Could not create skin file: $filepath");
         return(false);
    }

    if( fwrite($skinfile, $skincss) === FALSE )
    {
        ahimsa_admin_error("Cannot write to skin file: $filepath");
        return(false);
    }

    fclose($skinfile);

    return(true);
}

//------------------------------------------------------------------------------
function ahimsa_update_skins()
{
    $sel_update_map = array
    (
        ".capsule, .capsule a"                      => ".capsule",
        "#header #title"                            => "#title",
        "#sidebar fieldset.sidebarlist"             => ".sidebarlist",
        "#sidebar fieldset.sidebarlist"             => ".sidebarlist",
        "#sidebar legend"                           => ".sidebarlist > legend",
        "#sidebar legend"                           => ".sidebarlist > legend",
        "#sidebar .sidebarlist li, #postaction li"  => ".sidebarlist li, #postaction li",
        ".sidebarlist li, #postaction li"           => ".sidebarlist li",
        "#sidebar #wp-calendar caption"             => "#wp-calendar caption",
        "#sidebar #wp-calendar thead th, #sidebar #wp-calendar tfoot td.pad"
            => "#wp-calendar thead th, #wp-calendar tfoot td.pad",
        "#sidebar #wp-calendar thead th"            => "#wp-calendar thead th",
        "#sidebar #wp-calendar tbody td"            => "#wp-calendar tbody td",
        "#sidebar #wp-calendar tfoot td#next, #sidebar #wp-calendar tfoot td#prev"
            => "#wp-calendar #next, #wp-calendar #prev",
        "#sidebar #wp-calendar tfoot td#next, #sidebar #wp-calendar tfoot td#prev, " .
            "#sidebar #wp-calendar tfoot a"
            => "#wp-calendar #next, #wp-calendar #prev, #wp-calendar tfoot a",
        "#sidebar .textwidget"                      => ".textwidget",
        ".post fieldset"                            => ".post > fieldset",
        ".post fieldset legend.title, fieldset#comments legend, " .
            "fieldset.comment legend, fieldset#responsebox legend"
            => ".post .title, #comments > legend, .comment > legend, #responsebox > legend",
        ".post fieldset legend.title, .post fieldset legend.title a, " .
            "fieldset#comments legend, fieldset.comment legend, " .
            "fieldset#responsebox legend"
            => ".post .title, .post .title a, " .
                "#comments > legend, .comment > legend, #responsebox > legend",
        ".dateauthor .capsule, .nocomments .capsule" => "REMOVE",
        "#postaction, .postmetadata .commentlink, .postmetadata .cattrigger, " .
            ".replybuttonbox .capsule, #respond INPUT#submit"
            => ".actbubble",
        "#postaction, .postmetadata .commentlink, .postmetadata .cattrigger, " .
            "#postaction a, replybuttonbox .capsule, #respond INPUT#submit"
            => ".actbubble, .actbubble a",
        "fieldset#comments"                         => "#comments",
        "fieldset#responsebox"                      => "#responsebox",
        "#sidebar, #tdsidebar"                      => ".sidebar, .tdsidebar",
        "#replytext"                                => "#comment",
        // Ahimsa 4.0
        "#content"                                  => "contentbox",
        ".post > fieldset"                          => ".entrybox",
        ".post .title, .post .title a,"             => ".title, .title a",
        ".post .title, #comments > legend, .comment > legend, #responsebox > legend" => ".title",
        ".post .title, .post .title a, #comments > legend, .comment > legend, #responsebox > legend"
            => ".title, .title a",
        "fieldset.comment, fieldset.comment .commenttext" => ".comment, .commenttext",
        "fieldset.comment .commenttext"             => ".commenttext",
        ".sidebarlist > legend"                     => ".sidebarlist .title",
        ".postcattags"                              => "REMOVE",
        "#single .postcattags .capsule"             => "REMOVE",
        "#single .postcattags .capsule, #single .postcattags .capsule a" => "REMOVE"
    );

    // TODO: some of this code is common to ahimsa_skins_menu() and should be
    // abstracted rather than duplicated.

    $skinfiles = ahimsa_util_get_skin_files();
    if( ! sizeof($skinfiles) )
    {
        ahimsa_admin_error("No skins!");
        return(false);
    }

    foreach( $skinfiles as $skinfile )
    {
        $filename = basename($skinfile);
        if( ! preg_match("/^skin_(.+)\.css$/", $filename, $matches) )
            continue;

        if( ($skinfile_array = ahimsa_read_skin_file($skinfile)) == false )
            return(false);

        $newskin = "";
        while( list($sel, $props) = each($skinfile_array) )
        {
            if( isset($sel_update_map[$sel]) )
                if( $sel_update_map[$sel] == "REMOVE" )
                    continue;
                else
                    $sel = $sel_update_map[$sel];

            $newskin .= "$sel\n{\n";
            while( list($prop, $val) = each($props) )
                $newskin .= "$prop: $val;\n";
            $newskin .= "}\n";
        }

        if( ! ahimsa_write_skin_file($skinfile, $newskin) )
            return(false);
    }
}

//------------------------------------------------------------------------------
function ahimsa_check_store_mksymlinks()
{
    $themestore = WP_CONTENT_DIR . "/themestore";
    $ahimsastore = $themestore . "/ahimsa";
    foreach( array($themestore, $ahimsastore) as $dir )
    {
        if( is_dir($dir) )
            continue;
        if( ! @mkdir($dir) )
        {
            ahimsa_admin_error(
                "
                    A bit of a problem has occurred. I could not create: $dir.
                    This is probably because your WordPress or WebServer (Apache?)
                    installation is such that the webserver program does not
                    have write access to this directory. As a consequence, you
                    cannot use the Skins feature of Ahimsa to create new colour
                    schemes.
                    
                    Don't lose heart entirely. Contact
                    <a href='mailto:code@ahren.org'>me</a> and we can see if
                    there is a way around this situation.
                ");
            return;
        }
    }


    // create some symlinks to make editing custom stuff easier
    foreach( array("custom.css", "footer-custom.php") as $file )
    {
        // fail silently
        if( ! file_exists("$ahimsastore/$file") )
            if( ! @touch("$ahimsastore/$file") )
                return;
        if( ! file_exists(TEMPLATEPATH . "/$file") )
            if( function_exists('symlink') && ! @symlink("$ahimsastore/$file", TEMPLATEPATH . "/$file") )
                return;
    }
}

//------------------------------------------------------------------------------
function ahimsa_admin_error($msg)
{
        print
        "
            <div
                style=
                '
                    background-color: #bb4400;
                    color: #ffffff;
                    padding: 15px 20px;
                    width: 500px;
                    margin-top: 30px;
                    margin-left: 20px
                '>
            $msg
            </div>
        ";
}

//------------------------------------------------------------------------------
function ahimsa_custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    ?>

    <!-- WP automatically closes this tag below in wp_list_comments -->
    <li>

    <fieldset <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>
        id="comment-<?php comment_ID() ?>">

        <legend class='title'>
            <?php printf(__('%s writes:', "ahimsa"), comment_author_link()); ?>
        </legend>

        <div class="capsule dateauthor">
            <small>
            <a href='<?php print esc_url(get_comment_link($comment->comment_ID)); ?>'>
            <?php
                /* translators: this is the comment date/time format. See http://php.net/date */
                $comment_date_format = __('F jS, Y', 'ahimsa');
                /* translators: this is the comment date bubble */
                printf(__('%1$s at %2$s', 'ahimsa'),
                     get_comment_date($comment_date_format), get_comment_time());
            ?>
            </a>
            </small>
        </div>

        <?php
            if(function_exists('get_avatar'))
                echo get_avatar(get_comment_author_email(), '50');
        ?>

        <div class='commenttext'>

            <?php if($comment->comment_approved == '0') : ?>
                <span class='capsule'>
                    <?php _e("Your comment is awaiting moderation.", "ahimsa"); ?>
                </span>
                <br />
            <?php endif; ?>

            <?php comment_text() ?>

        </div>

        <div class='postmetadata replybuttonbox'>

            <?php

                global $user_ID;

                if( $user_ID )
                    edit_comment_link(
                        /* translators: this is the comment edit button/link */
                        __('Edit', "ahimsa"),
                        "<div class='capsule actbubble commentactions'>",
                        "</div>"
                    );

                comment_reply_link(
                    array_merge(
                        $args,
                        array
                        (
                            'reply_text'    => __('Reply', 'ahimsa'),
                            'depth'         => $depth,
                            'max_depth'     => $args['max_depth'],
                            'before'        => '<div class="capsule actbubble commentactions">',
                            'after'         => '</div>'
                        )
                    )
                );
            ?>

            <div style='height: 1px; clear: both;'></div>

        </div>

    </fieldset>

<?php
}
?>
