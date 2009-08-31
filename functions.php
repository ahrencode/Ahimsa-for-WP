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
if( ! isset($options['iecorners'        ]) ) $options['iecorners'       ] = 0;
if( ! isset($options['showdelic'        ]) ) $options['showdelic'       ] = 0;
if( ! isset($options['delicid'          ]) ) $options['delicid'         ] = "";
if( ! isset($options['delictitle'       ]) ) $options['delictitle'      ] = "Recent News and Links";
if( ! isset($options['copyright'        ]) ) $options['copyright'       ] = "";
if( ! isset($options['skin'             ]) ) $options['skin'            ] = "none";
# end defaults

update_option('ahimsa', $options);

# setup admin menu
add_action('admin_menu', 'ahimsa_admin_menu');

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => "<fieldset class='sidebarlist'>",
        'after_widget' => "</fieldset>",
        'before_title' => "<legend>$sectprefix",
        'after_title' => "</legend>",
    ));

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
        <div style=
                '
                    clear: right;
                    float: right;
                    margin: 10px 10px 10px 30px;
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px;
                    border: 1px solid #ddc055; width: 25%;
                '
        >
            <h3>Keep up with Ahimsa For WordPress</h3>

            <p>
                Follow on Twitter, or join the Facebook Page. Subscribe to the blog.
                Create bug/feature requests, download the latest code, and more!
            </p>

            <ul>
            <li style='list-style-type: circle; margin-left: 10px;'>
                Twitter:
                <a href='http://search.twitter.com/search?q=%23ahimsa-wp'>Ahimsa</a> |
                <a href='http://twitter.com/ahrencode/'>Ahren Code</a>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a
                href='http://www.facebook.com/home.php#/pages/Ahren-Code/64305786260'>Facebook</a>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a href='http://ahren.org/code/tag/ahimsa'>Blog</a>
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
                    margin: 10px 10px 10px 30px;
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px;
                    border: 1px solid #ddc055; width: 25%;
                '
        >
            Want to add your own funky JavaScript or some such in the footer?
            Create a file called <code>footer-custom.php</code> in the Ahimsa
            theme directory and put your code in there. Note that once you
            create the file, you can edit it using the WordPress theme editor.
        </div>
 
        <form id='settings' action='' method='post' class='themeform'
            style='margin: 20px;'>

            <h3>General</h3>

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
                unless hovered over</label> (does not work in IE)</label><br />

            <input type='checkbox' name='showpagemeta' id='showpagemeta'" .
                ($options['showpagemeta'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='showpagemeta'>
                Show author and date information for pages</label><br />

            <input type='checkbox' name='iecorners' id='iecorners'" .
                ($options['iecorners'] == 1 ? ' checked' : '') .  " />
            <label style='margin-left: 5px;' for='iecorners'>
                Turn on <b>experimental</b> and <b>partial</b> support for
                rounded corners in IE
            </label><br />

            <br />

            <label style='margin-left: 5px;' for='copyright'>
                Copyright text:
            </label>
            <input type='text' size='50' name='copyright' id='copyright'
                value='$options[copyright]' />

            <br/>
            <br/>
            <hr size='1'/>

            <h3>Delicious</h3>
                (requires the <a
                 href='http://wordpress.org/extend/plugins/delicious-for-wordpress/'>del.icio.us
                 for Wordpress</a> plugin.)

            <br/>
            <br/>

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
                </dd>

            <br clear='all' />
            <hr size='1' />

            <h3>Ahimsa Skins</h3>

            <div style='
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px;
                    border: 1px solid #ddc055;
                    margin: 0px 5px 15px 30px;
                    width: 30%;
                    float: right;
                    clear: right;
                    '>
                Know your CSS and want to do more detailed customisations? That's easy!
                Just create a file called <code>custom.css</code> in the theme directory,
                and add your custom styling in there. That's it! All customisations in
                this file are retained even if you upgrade the theme.

                <br />
                <br />
                <hr size='1' />
                <br />

                Want to share your skin with others? Look up the instructions on the
                <a href='http://ahren.org/code/ahimsa/'>Ahimsa Page</a>.

            </div>

            <input type='checkbox' name='skinupdate' id='skinupdate' />
            <label style='margin-left: 5px;' for='skinupdate'>Update Skins</label>
            (PLEASE backup your skin before you attempt this)

            <br />
            <br />

            " . skins_menu() . "

            <br />
            <br clear='all' />
            <hr size='1'/>

            <p class='submit'><input type='submit' value='Save Changes' name='save'/></p>

        </form>
    ";
}

$skin_fields =
array
(
    array
    (
        name    => "skinpagebgtopbg",
        desc    => "Page Background Top",
        csssel  => "#bgtop",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinpagediv",
        desc    => "Page Background Divider Colour",
        csssel  => "#bgtop",
        attr    => "border-bottom-color"
    ),
    array
    (
        name    => "skinpagebgbotbg",
        desc    => "Page Background Bottom",
        csssel  => "BODY",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinhyperlinks",
        desc    => "Hyperlinks",
        csssel  => "A",
        attr    => "color"
    ),
    array
    (
        name    => "skincapsulebg",
        desc    => "Default Bubble Background",
        csssel  => ".capsule",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincapsulefg",
        desc    => "Default Bubble Text Colour",
        csssel  => ".capsule",
        attr    => "color"
    ),
    array
    (
        name    => "skinheaderbg",
        desc    => "Header Background",
        csssel  => "#header",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinheaderfg",
        desc    => "Header Text Colour",
        csssel  => "#header, #header table, #header a",
        attr    => "color"
    ),
    array
    (
        name    => "skinheadersepcolour",
        desc    => "Colour of Separator Bar in Header",
        csssel  => "#title",
        attr    => "border-right-color"
    ),
    array
    (
        name    => "skinsidebarbg",
        desc    => "Sidebar Background",
        csssel  => "#sidebar, #tdsidebar",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinsbwidgetbg",
        desc    => "Sidebar Widgets Background",
        csssel  => ".sidebarlist",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinsbwidgetfg",
        desc    => "Sidebar Widgets Text Colour",
        csssel  => ".sidebarlist",
        attr    => "color"
    ),
    array
    (
        name    => "skinsblegendbg",
        desc    => "Sidebar Widget Title Background",
        csssel  => ".sidebarlist > legend",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinsblegendfg",
        desc    => "Sidebar Widget Title Text Colour",
        csssel  => ".sidebarlist > legend",
        attr    => "color"
    ),
    array
    (
        name    => "skinsblistdiv",
        desc    => "Sidebar/Action Lists Divider Colour",
        csssel  => ".sidebarlist li, #postaction li",
        attr    => "border-top-color"
    ),
    array
    (
        name    => "skinsblink",
        desc    => "Sidebar Widget Hyperlinks",
        csssel  => ".sidebarlist a",
        attr    => "color"
    ),
    array
    (
        name    => "skincalcaption",
        desc    => "Sidebar Calendar Caption Colour",
        csssel  => "#wp-calendar caption",
        attr    => "color"
    ),
    array
    (
        name    => "skincalheaderbg",
        desc    => "Sidebar Calendar Column Header Background",
        csssel  => "#wp-calendar thead th, #wp-calendar tfoot td.pad",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincalheaderfg",
        desc    => "Sidebar Calendar Column Header Text Colour",
        csssel  => "#wp-calendar thead th",
        attr    => "color"
    ),
    array
    (
        name    => "skincalcellfg",
        desc    => "Sidebar Calendar Entries Text Colour",
        csssel  => "#wp-calendar tbody td",
        attr    => "color"
    ),
    array
    (
        name    => "skincalnpbg",
        desc    => "Sidebar Calendar Next/Prev Links Background",
        csssel  => "#wp-calendar #next, #wp-calendar #prev",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincalnpfg",
        desc    => "Sidebar Calendar Next/Prev Links Text Colour",
        csssel  => "#wp-calendar #next, #wp-calendar #prev, #wp-calendar tfoot a",
        attr    => "color"
    ),
    array
    (
        name    => "skintextwdgtfg",
        desc    => "Sidebar Text Widget Text Colour",
        csssel  => ".textwidget",
        attr    => "color"
    ),
    array
    (
        name    => "skincontentbg",
        desc    => "Main Content Background",
        csssel  => "#content",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinpostpagebg",
        desc    => "Post or Page Entry Background",
        csssel  => ".post > fieldset",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinpostpagefg",
        desc    => "Post or Page Entry Text Colour",
        csssel  => ".entry",
        attr    => "color"
    ),
    array
    (
        name    => "skinpptitlebg",
        desc    => "Post, Page, Comments Title Background",
        csssel  => ".post .title, #comments > legend, .comment > legend, #responsebox > legend",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinpptitlefg",
        desc    => "Post, Page, Comments Title Text Colour",
        csssel  => ".post .title, .post .title a, " .
                    "#comments > legend, .comment > legend, #responsebox > legend",
        attr    => "color"
    ),
    array
    (
        name    => "skinmetabarbg",
        desc    => "Post/Page/Comment Bottom Bar Background",
        csssel  => ".postmetadata",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincattagbg",
        desc    => "Category/Tag Lists Background",
        csssel  => ".postcattags",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincattagfg",
        desc    => "Category/Tag Lists Text/Link Colour",
        csssel  => ".postcattags, .postcattags a",
        attr    => "color"
    ),
    array
    (
        name    => "skin1cattagbubblebg",
        desc    => "Single Post Cat/Tag Bubble Background",
        csssel  => "#single .postcattags .capsule",
        attr    => "background-color"
    ),
    array
    (
        name    => "skin1cattagbubblefg",
        desc    => "Single Post Cat/Tag Bubble Text/Link Colour",
        csssel  => "#single .postcattags .capsule, #single .postcattags .capsule a",
        attr    => "color"
    ),
    array
    (
        name    => "skinbqbg",
        desc    => "Blockquote Background",
        csssel  => "blockquote",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinbqfg",
        desc    => "Blockquote Text Colour",
        csssel  => "blockquote",
        attr    => "color"
    ),
    array
    (
        name    => "skinlistbg",
        desc    => "Page/Post Ordered/Unordered List Background",
        csssel  => ".entry UL, .page UL, .entry OL, .page OL",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinlistfg",
        desc    => "Page/Post Ordered/Unordered Text Colour",
        csssel  => ".entry UL, .page UL, .entry OL, .page OL",
        attr    => "color"
    ),
    array
    (
        name    => "skinpost1stletterfg",
        desc    => "Post First Letter Colour",
        csssel  => ".entry > P:first-child:first-letter",
        attr    => "color"
    ),
    array
    (
        name    => "skinactionbg",
        desc    => "Action Bubbles (Edit, Reply, etc) Background",
        csssel  => ".actbubble",
        attr    => "background-color"
    ),
    array
    (
        name    => "skinactionfg",
        desc    => "Action Bubbles (Edit, Reply, etc) Text Colour",
        csssel  => ".actbubble, .actbubble a",
        attr    => "color"
    ),
    array
    (
        name    => "skincommentsbg",
        desc    => "Comments Block Background",
        csssel  => "#comments",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincommentbg",
        desc    => "Comment Background",
        csssel  => "fieldset.comment, fieldset.comment .commenttext",
        attr    => "background-color"
    ),
    array
    (
        name    => "skincommentfg",
        desc    => "Comment Text Colour",
        csssel  => "fieldset.comment .commenttext",
        attr    => "color"
    ),
    array
    (
        name    => "skinresponsebg",
        desc    => "Response Box Background",
        csssel  => "#responsebox",
        attr    => "background-color"
    )
);


function skins_menu()
{
    global $skin_fields, $options;

    $html = "";

    $skindir = TEMPLATEPATH . "/skins";
    if( ! is_dir($skindir) )
    {
        if( ! @mkdir($skindir) )
            $html .= "Failed to create $skindir. Permissions problems? <br/>";

        return($html);
    }

    if( ! $skinfd = opendir($skindir) )
    {
        $html .= "Unable to read skins from $skindir. <br/>";
        return($html);
    }

    $checked = ($options['skin'] == 'none') ? 'checked' : "";
    $html .= "<input type=radio name=skin value=none $checked> None <br/>\n";
    while ( ($skinfile = readdir($skinfd)) !== false )
    {
        if( ! preg_match("/^skin_(.+)\.css$/", $skinfile, $matches) )
            continue;
        $checked = ($options['skin'] == $matches[1]) ? 'checked' : "";
        $html .=
        "
            <input type=radio name=skin value='$matches[1]' $checked> $matches[1]
            (<a href='" . get_bloginfo("url") . "?ahimsaskin=$matches[1]' target=_new>Preview</a>)
            <br/>
        ";
    }

    closedir($skinfd);

    if( $options['skin'] != 'none' )
        $skinfile_array = read_skin_file("$skindir/skin_$options[skin].css");
    else
        $skinfile_array = array();

    $html .=
    "
        <br/>

        <input id='skindo' type='hidden' name='skindo' value='0'/>

        <a href='javascript:
                    document.getElementById(\"skinedit\").style.display = \"block\";
                    document.getElementById(\"skindo\").value = \"1\";
                    exit;
                    '>
        Edit Current or Create New Skin</a>

        <div id='skinedit' style='display: none;'>

        <h4>Enter Skin Details</h4>

        <p>(hint: change the name below to create a new skin)</p>
        Skin name: <input type=text name=skinname size=20 value='" . $options['skin'] . "'>
        &nbsp;&nbsp;&nbsp;
        <a href='javascript:
                    document.getElementById(\"skinedit\").style.display = \"none\";
                    document.getElementById(\"skindo\").value = \"0\";
                    exit;
                '>Cancel</a>
        <br/>
        <br/>

        <table border=0 cellspacing=0>

    ";

    foreach( $skin_fields as $style )
        $html .= get_skin_field_html($style, $skinfile_array);

    $html .= "</table>\n</div>\n";

    return($html);
}

function get_skin_field_html($style, $skinfile_array)
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

function save_options()
{
    global $_POST, $options;

    if( $_POST['skinupdate'] == 'on' )
        if( ! update_skins() )
            return;

    if( $_POST['skindo'] == '1' )
        if( ! save_skin() )
            return;

    $options['showauthors']     = ( isset($_POST['showauthors']) ) ? 1 : 0;
    $options['showloginout']    = ( isset($_POST['showloginout']) ) ? 1 : 0;
    $options['defhidesidebar']  = ( isset($_POST['defhidesidebar']) ) ? 1 : 0;
    $options['defhidesbpages']  = ( isset($_POST['defhidesbpages']) ) ? 1 : 0;
    $options['sectprefix']      = ( isset($_POST['sectprefix']) ) ? 1 : 0;
    $options['idxfadepmeta']    = ( isset($_POST['idxfadepmeta']) ) ? 1 : 0;
    $options['showpagemeta']    = ( isset($_POST['showpagemeta']) ) ? 1 : 0;
    $options['iecorners']       = ( isset($_POST['iecorners']) ) ? 1 : 0;
    $options['showdelic']       = ( isset($_POST['showdelic']) ) ? 1 : 0;
    $options['delicid']         = ( isset($_POST['delicid']) ) ? $_POST['delicid'] : "";
    $options['delictitle']      = ( isset($_POST['delictitle']) ) ? $_POST['delictitle']
                                    : "Recent News and Links";
    $options['copyright']       = ( isset($_POST['copyright']) ) ? $_POST['copyright'] : "";
    $options['skin']            = ( isset($_POST['skin']) ) ? $_POST['skin'] : "none";

    update_option('ahimsa', $options);

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
function save_skin()
{
    global $_POST, $options, $skin_fields;

    if( ! isset($_POST['skinname']) || $_POST['skinname'] == '' )
    {
        ah_admin_error("Oops! Need a name to save a skin!");
        return(false);
    }

    $skinname = $_POST['skinname'];
    if( ! preg_match("/^[a-zA-Z0-9]+(\-[a-zA-Z0-9]+)*$/", $skinname) || $skinname == "none" )
    {
        ah_admin_error("Name ($skinname) should be alphabets, numbers, and embedded hyphens.\n");
        return(false);
    }

    $skincss = "";

    foreach( $skin_fields as $field )
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

    return(write_skin_file(TEMPLATEPATH . "/skins/skin_$skinname.css", $skincss));
}

//------------------------------------------------------------------------------
function read_skin_file($skinfile)
{
    if( ! ($styles = @file("$skindir/$skinfile", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES)) )
    {
        ah_admin_error("Unable to read skin file: $skinfile");
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
            if( ! is_array($cssarray[$cursel]) )
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
function write_skin_file($filepath, $skincss)
{
    if( !$skinfile = fopen($filepath, 'w') )
    {
         ah_admin_error("Could not create skin file: $filepath");
         return(false);
    }

    if( fwrite($skinfile, $skincss) === FALSE )
    {
        ah_admin_error("Cannot write to skin file: $filepath");
        return(false);
    }

    fclose($skinfile);

    return(true);
}

//------------------------------------------------------------------------------
function update_skins()
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
        "fieldset#responsebox"                      => "#responsebox"
    );

    // TODO: some of this code is common to skins_menu() and should be
    // abstracted rather than duplicated.

    $skindir = TEMPLATEPATH . "/skins";

    if( ! is_dir($skindir) )
    {
        ah_admin_error("No skins!");
        return(false);
    }

    if( ! $skinfd = opendir($skindir) )
    {
        ah_admin_error("Unable to read skins from $skindir");
        return(false);
    }

    while( ($skinfile = readdir($skinfd)) !== false )
    {
        if( ! preg_match("/^skin_(.+)\.css$/", $skinfile, $matches) )
            continue;

        if( ($skinfile_array = read_skin_file("$skindir/$skinfile")) == false )
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

        if( ! write_skin_file("$skindir/$skinfile", $newskin) )
            return(false);
    }

    closedir($skinfd);
 
}

//------------------------------------------------------------------------------
function ah_admin_error($msg)
{
        print
        "
            <div
                style='background-color: #aa4400;
                        color: #ffffff;
                        border: 1px solid #660000;
                        padding: 3px 8px;
                        width: 300px;
                        margin-top: 30px;
                        margin-left: 20px'>
            $msg
            </div>
        ";
}

//------------------------------------------------------------------------------
function custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    ?>

    <!-- WP automatically closes this tag below in wp_list_comments -->
    <li  <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

    <fieldset class='comment'>

        <legend> <?php comment_author_link() ?> writes: </legend>

        <div class="capsule dateauthor">
            <small><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></small>
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

        <?php global $user_ID; if( $user_ID || get_option('thread_comments') ) : ?>

            <div class='postmetadata replybuttonbox'>

                <?php global $user_ID; if( $user_ID ) : ?>
                    &nbsp;&nbsp;
                    <span class='capsule actbubble'>
                        <?php edit_comment_link('Edit','&nbsp;',''); ?>
                    </span>
                <?php endif; ?>

                &nbsp; &nbsp;

               <?php if( get_option('thread_comments') ) : ?>
                    <span class="capsule actbubble">
                        <!-- spaces needed for Safari to render rounded corners! -->
                        &nbsp;
                        <?php comment_reply_link(
                                array_merge( $args, array('depth' => $depth,
                                            'max_depth' => $args['max_depth']))) ?>
                        &nbsp;
                    </span>
                <?php endif; ?>

            </div>

        <?php endif; ?>

    </fieldset>

<?php

}

?>
