
jQuery(document).ready
(
    function()
    {
        // add our classes to WP generated elements
        reclass_wp_elements();

        // display vertical or rotated text depending on browser support
        // test in the order of browser popularity to save a few cycles ;-)
        // checking to see if at least one sidebar is active/defined...
        sidebartab_setup();
        
        // support for faded bottom bar in index page
        jQuery('.fadedbottombar').hover(
                function() { jQuery(this).css('opacity', '1.0'); },
                function() { jQuery(this).css('opacity', '0.3'); }
        );

        // display Comment edit/reply bottombar on hover
        jQuery('.comment').hover(
                function() { jQuery(this).children('.replybuttonbox').css('visibility', 'visible'); },
                function() { jQuery(this).children('.replybuttonbox').css('visibility', 'hidden'); }
        );

        // display tags permitted in comments when focus is on response box
        jQuery('#comment').focus(function() { jQuery('.form-allowed-tags').fadeIn(); });
        jQuery('#comment').blur(function() { jQuery('.form-allowed-tags').fadeOut(); });

        // if user has declared a DIV of type "download" then make the whole thing clickable
        // We could have used a shortcode for this, but shortcodes are not expanded for RSS feeds.
        jQuery('.downloadbox').click
        (
            function() { document.location = jQuery(this).find('.downlink').attr('href'); }
        );

        // style and add prefix text for sourcelink
        sourcelink_setup();
    }
);


function reclass_wp_elements()
{
    // add classes to the comment submit button
    if( jQuery('#submit').length )
    {
        jQuery('#submit').addClass('capsule');
        jQuery('#submit').addClass('actbubble');
    }

    // move the WP inserted comment form container outside ours for custom styling reasons
    if( jQuery('#respond').length )
    {
        var responsebox = jQuery('#responsebox').detach();
        jQuery('#respond').wrapInner(responsebox);

        var cancel = jQuery('#cancel-comment-reply-link').detach();
        jQuery('#submit').after(cancel);
        jQuery('#cancel-comment-reply').show();
    }
}


function sidebartab_setup()
{
    if( jQuery('#sidebartableft').length > 0 )
        tab = '#sidebartableft';
    else
    if( jQuery('#sidebartabright').length > 0 )
        tab = '#sidebartabright';
    else
        tab = "";
    if( tab != "" )
    {
        // safari returns the CSS property even if it doesn't implement it
        // so we have a special check below for safari3 which does not
        // support CSS transform
        var safari3re = /Version\/3\.0.*Safari/;
        if( !safari3re.test(navigator.appVersion) &&
            ((jQuery(tab).css('filter') != '' &&
                jQuery(tab).css('filter') != 'none') ||
            (jQuery(tab).css('-moz-transform') != '' &&
                jQuery(tab).css('-moz-transform') != 'none') ||
            (jQuery(tab).css('-webkit-transform') != '' &&
                jQuery(tab).css('-webkit-transform') != 'none') ||
            (jQuery(tab).css('-o-transform') != '' &&
                jQuery(tab).css('-o-transform') != 'none')) )
        {
            jQuery('#sidebartableft').addClass('sidebartableftrotated');
            jQuery('#sidebartabright').addClass('sidebartabrightrotated');
            jQuery('.sidebartabnorotatetext').hide();
            jQuery('.sidebartabrotatedtext').show();
        }
        else
        {
            jQuery('.sidebartab').addClass('sidebartabnorotate');
            jQuery('#sidebartableft').addClass('sidebartableftnorotate');
            jQuery('#sidebartabright').addClass('sidebartabrightnorotate');
            jQuery('.sidebartabrotatedtext').hide();
            jQuery('.sidebartabnorotatetext').show();
        }
        jQuery('.sidebartab').show();
    }
}

function sourcelink_setup()
{
    jQuery('.sourcelink').wrap('<div class="sourceboxtext" />');
    jQuery('.sourceboxtext').prepend('This post includes content from, and/or is a response to ');
    jQuery('.sourceboxtext').wrap('<div class="sourcelinkbox" />');
    jQuery('.sourcelinkbox').prepend('<div class="sourcemarker">&rarr;</div>');
    jQuery('.sourcelinkbox').append('<div style="height: 1px; clear: both;"></div>');
}



function slideSideBar(side)
{
    if( ! document.getElementById('sidebar'+side) )
        return;

    var tdid = '#tdsidebar'+side;
    var sbid = '#sidebar'+side;

    if( jQuery(sbid).is(':visible') )
    {
        contentCurve(side, '30px');
        //jQuery(tdid).css('background-color', jQuery('#content').css('background-color'));
        jQuery(sbid).hide("slide", { direction: side }, 600, function() { jQuery(tdid).hide(); });

    }
    else
    {
        contentCurve(side, '0px');
        jQuery(tdid).show();
        //jQuery(tdid).css('background-color', jQuery(sbid).css('background-color'));
        jQuery(sbid).show("slide", { direction: side }, 600);
    }
}

function contentCurve(side, size)
{
    divcont = document.getElementById('content');
    if( side == 'left' )
    {
        divcont.style.borderRadiusBottomleft = size;
        divcont.style.webkitBorderBottomLeftRadius = size;
        divcont.style.MozBorderRadiusBottomleft = size;
    }
    else
    {
        divcont.style.borderRadiusBottomright = size;
        divcont.style.webkitBorderBottomRightRadius = size;
        divcont.style.MozBorderRadiusBottomright = size;
    }
}

function recalcBlocks()
{
    document.getElementById("container").style.height = getWinHeight() + "px";
}


// code borrowed from: http://www.howtocreate.co.uk/tutorials/javascript/browserwindow
function getWinHeight()
{
    var myHeight = 0;
    if( typeof( window.innerHeight ) == 'number' )
    {
        //Non-IE
        myHeight = window.innerHeight;
    }
    else
    if( document.documentElement && document.documentElement.clientHeight )
    {
        //IE 6+ in 'standards compliant mode'
        myHeight = document.documentElement.clientHeight;
    }
    else
    if( document.body && document.body.clientHeight )
    {
        //IE 4 compatible
        myHeight = document.body.clientHeight;
    }

    return(myHeight);
}

function getWinWidth()
{
    var myWidth = 0;
    if( typeof( window.innerWidth ) == 'number' )
    {
        //Non-IE
        myWidth = window.innerWidth;
    }
    else
    if( document.documentElement && document.documentElement.clientWidth )
    {
        //IE 6+ in 'standards compliant mode'
        myWidth = document.documentElement.clientWidth;
    }
    else
    if( document.body && document.body.clientWidth )
    {
        //IE 4 compatible
        myWidth = document.body.clientWidth;
    }

    return(myWidth);
}

function toggleCatTags(postid, type)
{
    var postsel = '#post-'+postid;
    var boxsel  = '#post-'+postid+' .cattagsbox';

    var catsVisible = jQuery(postsel+' .postcats').is(':visible');
    var tagsVisible = jQuery(postsel+' .posttags').is(':visible');

    console.log("cats: " + catsVisible + " tags: " + tagsVisible);

    if( ! catsVisible && ! tagsVisible )
        jQuery(boxsel).show();

    if( (type == 'cats' && catsVisible && ! tagsVisible) ||
        (type == 'tags' && tagsVisible && ! catsVisible) )
        jQuery(boxsel).fadeOut(500);

    var sel = postsel+' .post'+type;
    console.log("Type sel: " + sel);
    if( jQuery(sel).is(':visible') )
        jQuery(sel).fadeOut(500);
    else
        jQuery(sel).fadeIn(500);
}

